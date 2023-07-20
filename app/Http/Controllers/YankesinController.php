<?php

namespace App\Http\Controllers;

use App\Models\BOR;
use App\Models\Event;
use App\Models\JenisPasien;
use App\Models\StatusPasien;
use App\Models\ConfigModel;
use App\Models\DataCovid;
use App\Models\RumahSakit;
use App\Models\KategoriFasilitas;
use App\Models\Fasilitas;
use App\Models\FasilitasRS;
use App\Models\FaskesFasilitasRS;
use App\Models\Matra;
use App\Models\JenisParamedis;
use App\Models\JenisSpesialis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Exception;

class YankesinController extends Controller
{
    public function index()
    {
        // $event = Event::all();
        // $pegawai = DB::table('event')->paginate(10);
        return view('yankesin/monitoring-bor');
    }

    public function monitoring_bor()
    {
        // $event = Event::all();
        // $pegawai = DB::table('event')->paginate(10);
        return view('yankesin/covid_report/bor_yankesin/monitoring-bor', ['active_menu' => 'bor_covid_yankesin']);
    }


    /* Data BOR */

    public function input_bor()
    {
        return view('yankesin/input/bor');
    }

    public function input_bor_store(Request $request)
    {

        $requestData = $request->all();
        BOR::create($requestData);
        return response()->json(["error" => false, "message" => "Successfuly Added BOR Data!"]);
    }

    public function input_bor_edit($id)
    {
        $role = BOR::find($id);

        if ($role) {

            return response()->json(["error" => false, "data" => $role]);
        } else {

            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function input_bor_update(Request $request, $id)
    {

        $requestData = $request->all();
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        foreach ($requestData as $key => $value) {
            if ($key != '_token') {
                $d = BOR::firstOrNew([
                    'tgl_update' => $tgl,
                    'id_fasilitas_rs' => substr($key, 1),
                ]);
                if (!isset($d->terpakai) || (isset($d->terpakai) && $d->terpakai != $value)) {
                    $f = FasilitasRS::find(substr($key, 1));
                    $log = FaskesFasilitasRS::create([
                        'id_rs' => $f->id_rs,
                        'id_fasilitas' => $f->id_fasilitas,
                        'status' => 'Update BOR: ' . ($d->terpakai ?? '-') . ' &rarr; ' . $value . '<br />diupdate oleh: ' . Auth::user()->name,
                    ]);
                    $d->terpakai = $value;
                    $d->save();
                }
            }
        }
        return response()->json(["error" => false, "message" => "Update Data BOR sukses", "tgl" => date_format(date_create_from_format('Y-m-d', $tgl), 'j F Y')]);
    }

    public function input_bor_destroy($id)
    {
        try {

            BOR::destroy($id);
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted BOR Data!"]);
    }

    public function get_list_bor(Request $request)
    {
        $angkatan = BOR::latest()->with("rumahsakit")->get();
        return Datatables::of($angkatan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a onclick=edit_data($(this)) data-id="' . $row->id_bor . '"  class="edit btn btn-success btn-sm">Edit</a> 
                    <a data-id="' . $row->id_bor . '" onclick=delete_data($(this)) class="btn btn-sm btn-danger" >Delete</a>
                    ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /*end data BOR*/




    public function monitoring_pasien_covid()
    {
        $active_menu = 'pasien_covid_yankesin';
        $matra = Matra::select('kode_matra')->whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        $series = array();
        $dataseries = array();
        $dataseries_1 = array();
        foreach($matra as $d) {
            $dataseries[$d->kode_matra] = array();
        }
        $tgl = array();
        date_default_timezone_set('Asia/Jakarta');
        $t = date_create();
        date_sub($t, date_interval_create_from_date_string("13 days"));
        for($i=1;$i<=14;$i++) {
            $tgl[] = date_format($t, 'Y-m-d');
            date_add($t, date_interval_create_from_date_string("1 days"));
        }
        $dc = DB::select("SELECT
            SUBSTR(nama_jenis, 1, 8) AS nama_jenis,
            nama_status,
            kode_matra,
            tanggal,
            SUM(jumlah) AS jumlah
        FROM data_covid d
        JOIN jenis_pasien j ON j.id_jenis_pasien = d.jenis_pasien
        JOIN status_pasien s ON s.id_status_pasien = d.status_pasien
        JOIN rs USING (id_rs)
        JOIN angkatan USING (id_angkatan)
        WHERE nama_status IN ('Suspect (Rawat Jalan)','Probable') AND kode_matra IN ('AD', 'AL', 'AU', 'MABES') AND tanggal BETWEEN '$tgl[0]' AND '$tgl[13]'
        GROUP BY nama_status, SUBSTR(nama_jenis, 1, 8), kode_matra, tanggal");
        foreach($dc as $d) {
            if (!isset($lines[$d->nama_status . $d->nama_jenis])) $lines[$d->nama_status . $d->nama_jenis . $d->tanggal] = 0;
            $lines[$d->nama_status . $d->nama_jenis . $d->tanggal] += $d->jumlah;
        }
        $ns = ['Suspect (Rawat Jalan)', 'Probable'];
        $nj = ['Prajurit', 'PNS', 'Keluarga'];
        foreach($ns as $s) {
            $series[$s] = array();
            foreach($nj as $j) {
                $series[$s][$j] = array();
                foreach($tgl as $t) {
                    $series[$s][$j][] = $lines[$s . $j . $t] ?? 'null';
                }
            }
        }
		$tgl = DataCovid::selectRaw('DISTINCT(tanggal)')->orderByRaw('tanggal DESC')->limit(2)->get();
		$dc = DB::select("SELECT
            nama_jenis,
            nama_status,
            kode_matra,
            SUM(jumlah) AS jumlah
        FROM data_covid d
        JOIN jenis_pasien j ON j.id_jenis_pasien = d.jenis_pasien
        JOIN status_pasien s ON s.id_status_pasien = d.status_pasien
        JOIN rs USING (id_rs)
        JOIN angkatan USING (id_angkatan)
        WHERE nama_status IN ('Suspect (Rawat Jalan)','Probable') AND kode_matra IN ('AD', 'AL', 'AU', 'MABES') AND tanggal = '" . ($tgl[0]->tanggal ?? date('Y-m-d')) . "'
        GROUP BY nama_status, nama_jenis, kode_matra");
        foreach($dc as $d) {
            if (!isset($dataseries[$d->kode_matra][$d->nama_status])) $dataseries[$d->kode_matra][$d->nama_status] = array();
            $dataseries[$d->kode_matra][$d->nama_status][$d->nama_jenis] = $d->jumlah;
        }
        $dc = DB::select("SELECT
            SUBSTR(nama_jenis, 1, 8) AS nama_jenis,
            nama_status,
            kode_matra,
            SUM(jumlah) AS jumlah
        FROM data_covid d
        JOIN jenis_pasien j ON j.id_jenis_pasien = d.jenis_pasien
        JOIN status_pasien s ON s.id_status_pasien = d.status_pasien
        JOIN rs USING (id_rs)
        JOIN angkatan USING (id_angkatan)
        WHERE nama_status IN ('Suspect (Rawat Jalan)','Probable') AND kode_matra IN ('AD', 'AL', 'AU', 'MABES') AND tanggal = '" . ($tgl[1]->tanggal ?? date_format(date_sub(date_create(), date_interval_create_from_date_string("1 days")), 'Y-m-d')) . "'
        GROUP BY nama_status, SUBSTR(nama_jenis, 1, 8), kode_matra");
        foreach($dc as $d) {
            if (!isset($dataseries_1[$d->kode_matra][$d->nama_status])) $dataseries_1[$d->kode_matra][$d->nama_status] = array();
            $dataseries_1[$d->kode_matra][$d->nama_status][$d->nama_jenis] = $d->jumlah;
        }
        $dc = DB::select("SELECT
            nama_jenis,
            nama_status,
            SUM(jumlah) AS jumlah
        FROM data_covid d
        JOIN jenis_pasien j ON j.id_jenis_pasien = d.jenis_pasien
        JOIN status_pasien s ON s.id_status_pasien = d.status_pasien
        WHERE nama_status NOT IN ('Suspect (Rawat Jalan)','Probable') AND tanggal =
        (SELECT MAX(tanggal) as tanggal FROM data_covid)
        GROUP BY nama_status, nama_jenis");
        $data=array();
        foreach($dc as $d) {
            if (!isset($data[$d->nama_status])) $data[$d->nama_status] = array();
            $data[$d->nama_status][$d->nama_jenis] = $d->jumlah;
        }
        return view('yankesin.covid_report.pasien_covid.monitoring-covid', compact(
            'active_menu',
            'series',
            'dataseries',
            'dataseries_1',
            'data',
        ));
    }

    /* Data covid */

    public function input_covid()
    {
        $jenis_pasien = JenisPasien::all();
        $status_pasien = StatusPasien::all();
        return view('yankesin/input/covid', compact("jenis_pasien", "status_pasien"));
    }

    public function input_covid_store(Request $request)
    {

        $requestData = $request->all();
        BOR::create($requestData);
        return response()->json(["error" => false, "message" => "Successfuly Added Covid Data!"]);
    }

    public function input_covid_edit($id)
    {
        $role = BOR::find($id);

        if ($role) {

            return response()->json(["error" => false, "data" => $role]);
        } else {

            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function input_covid_update(Request $request, $id)
    {

        $requestData = $request->all();
        date_default_timezone_set('Asia/Jakarta');
        $tgl = date('Y-m-d');
        foreach ($requestData as $key => $value) {
            if (substr($key, 0, 3) == 'bor') {
                $d = BOR::firstOrNew([
                    'id_fasilitas_rs' => substr($key, 4),
                    'tgl_update' => $tgl,
                ]);
                $d->terpakai = $value;
                $d->save();
            } else if ($key != '_token') {
                $val = explode('_', substr($key, 2));
                $d = DataCovid::firstOrNew([
                    'tanggal' => $tgl,
                    'jenis_pasien' => $val[1],
                    'status_pasien' => $val[0],
                    'id_rs' => $id,
                ]);
                $d->jumlah = $value;
                $d->save();
            }
        }
        return response()->json(["error" => false, "message" => "Update Covid Data sukses", "tgl" => date_format(date_create_from_format('Y-m-d', $tgl), 'j F Y')]);

        /*
         $role = BOR::findOrFail($id);
         $role->update($requestData);
 
         if($role){
 
             return response()->json(["error"=>false,"message"=>"Successfully Update Covid Data"]);
         
         }else{
 
             return response()->json(["error"=>true,"message"=>"Data Not Found"]);
 
         }
        */
    }

    public function input_covid_destroy($id)
    {
        try {

            BOR::destroy($id);
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Covid Data!"]);
    }

    public function get_list_covid(Request $request)
    {
        $angkatan = BOR::latest()->with("rumahsakit")->get();
        return Datatables::of($angkatan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<a onclick=edit_data($(this)) data-id="' . $row->id_bor . '"  class="edit btn btn-success btn-sm">Edit</a> 
                     <a data-id="' . $row->id_bor . '" onclick=delete_data($(this)) class="btn btn-sm btn-danger" >Delete</a>
                     ';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    /*end data covid*/



    public function monitoring_nakes($kategori, $id)
    {
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', $kategori)->where('id_rs', $id)->whereRaw($kategori == 'Non-Medis' ? 'true' : "nama_fasilitas LIKE '%Honorer'")->get();
        $data1 = array();
        foreach ($frs as $d) {
            $data1[$d->nama_fasilitas] = $d->jumlah;
        }
        //fasrs dari jenis paramedis
        if ($kategori == 'Paramedis') {
            $frs = FasilitasRS::join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', 'fasilitas_rs.id_fasilitas')->where('id_rs', $id)->get();
            foreach ($frs as $d) {
                $data1[$d->nama_jenis_paramedis] = $d->jumlah;
            }
        }
        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', $kategori)->whereRaw($kategori == 'Non-Medis' ? 'true' : "nama_fasilitas LIKE '%Honorer'")->get();
        $data2 = array();
        foreach ($fas as $d) {
            $data2[] = $d->nama_fasilitas;
        }
        //fas dari jenis paramedis
        if ($kategori == 'Paramedis') {
            $fas = JenisParamedis::whereNotIn('nama_jenis_paramedis', ['Apoteker', 'Bidan'])->whereRaw("nama_jenis_paramedis NOT LIKE 'Perawat%'")->get();
            foreach ($fas as $d) {
                $data2[] = $d->nama_jenis_paramedis;
            }
        }
      if ($kategori == 'Non-Medis') {
        for ($i = 0; $i < count($data2) / 3; $i++) {
            $n = strrpos($data2[$i * 3], ' ');
            $data[] = array(
                strtolower($kategori) => substr($data2[$i * 3], 0, $n),
                'tni' => $data1[$data2[$i * 3]] ?? 0,
                'pns' => $data1[$data2[$i * 3 + 1]] ?? 0,
                'honorer' => $data1[$data2[$i * 3 + 2]] ?? 0,
            );
        }
      } else {
        for ($i = 0; $i < count($data2); $i++) {
            $n = strrpos($data2[$i], 'Honorer') === false ? strlen($data2[$i]) : strrpos($data2[$i], ' ');
            $data[] = array(
                strtolower($kategori) => substr($data2[$i], 0, $n),
                'honorer' => $data1[$data2[$i]] ?? 0,
            );
        }
      }
        return response()->json(["error" => false, "data" => $data]);
    }

    public function toggleCovidReport()
    {
        $conf = ConfigModel::select('id_config', 'covid_report')->first();
        if ($conf->covid_report) $conf->covid_report = 0;
        else $conf->covid_report = 1;
        $conf->save();
        session()->put('covid_report', $conf->covid_report);

        return $conf;
    }

    public function kelola_data_covid($id='')
    {
        $active_menu = 'yankesin_rs';
        if (Auth::user()->id_faskes) {
            $id = Auth::user()->id_faskes;
            $active_menu = 'data_covid';
        }
        $rs = RumahSakit::find($id);
        $jenis_pasien = JenisPasien::all();
        $status_pasien = StatusPasien::all();
        $last = DataCovid::select('tanggal')->where('id_rs', $id)->orderByDesc('tanggal')->first();
        $data = [];
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->whereIn('nama_fasilitas', ['ICU Covid', 'Isolasi Covid'])->where('id_rs', $id)->get();
        foreach ($frs as $d) {
            if ($d->nama_fasilitas == 'ICU Covid') $data['icu'] = $d;
            else if ($d->nama_fasilitas == 'Isolasi Covid') $data['iso'] = $d;
        }
        if ($last) {
            $dc = DataCovid::where('id_rs', $id)->where('tanggal', $last->tanggal)->orderBy('created_at')->get();
            foreach ($dc as $d) $data['d_' . $d->status_pasien . '_' . $d->jenis_pasien] = $d->jumlah;
            $bor = BOR::where('tgl_update', $last->tanggal)->whereIn('id_fasilitas_rs', [$data['icu']->id_fasilitas_rs, $data['iso']->id_fasilitas_rs])->orderBy('created_at')->get();
            foreach ($bor as $d) {
                if ($d->id_fasilitas_rs == $data['icu']->id_fasilitas_rs) $data['bor_icu'] = $d->terpakai;
                else if ($d->id_fasilitas_rs == $data['iso']->id_fasilitas_rs) $data['bor_iso'] = $d->terpakai;
            }
            date_default_timezone_set('Asia/Jakarta');
            $last = date_format(date_create_from_format('Y-m-d', $last->tanggal), 'j F Y');
        } else $last = '-';
        return view('yankesin.rumah_sakit.kelola_data_covid', compact(
            'active_menu',
            'rs',
            'jenis_pasien',
            'status_pasien',
            'last',
            'data',
        ));
    }

    public function kelola_fasilitas($id='')
    {
        if (Auth::user()->id_faskes) $id = Auth::user()->id_faskes;
        if (request()->segment(2) == 'kelola_fasilitas') {
            $active_menu = 'yankesin_rs';
            $view = 'yankesin.rumah_sakit.kelola_fasilitas';
        } else if (Auth::user()->id_faskes) {
            $active_menu = 'fasilitas';
            $view = 'yankesin.rumah_sakit.kelola_fasilitas';
        } else {
            $active_menu = 'faskes';
            $view = 'matfaskes.faskes.kelola_faskes';
        }
        $rs = RumahSakit::with('angkatan.parent_.parent_')->find($id);
        if ($rs->angkatan->level == 'sub') $rs->ket = $rs->angkatan->parent_->parent_->nama_angkatan . ' / ' . $rs->angkatan->parent_->nama_angkatan . ' / ' . $rs->angkatan->nama_angkatan;
        else if ($rs->angkatan->level == 'sat') $rs->ket = $rs->angkatan->parent_->nama_angkatan . ' / ' . $rs->angkatan->nama_angkatan . ' / -';
        else $rs->ket = $rs->angkatan->nama_angkatan . ' / - / -';
        $fasrs = array();
        $fasrs_ = array();
        $nakes = array();
        $poli = array();
        $kat = KategoriFasilitas::with('fasilitas')->get();
        foreach ($kat as $k) {
            if ($k->nama_kategori == 'Paramedis' || $k->nama_kategori == 'Non-Medis') {
            } else if ($k->nama_kategori == 'Nakes') {
                $frs = FasilitasRS::with('fasilitas')->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->where('id_kategori', $k->id_kategori)->where('id_rs', $id)->where('nama_fasilitas', 'like', '%Honorer')->get();
                $data = array();
                foreach ($frs as $f) $data[$f->fasilitas->nama_fasilitas] = $f->jumlah;
                $map = [
                    'Dokter Umum' => 1,
                    'Dokter Spesialis' => 2,
                    'Dokter Gigi Umum' => 3,
                    'Dokter Gigi Spesialis' => 4,
                    'Dokter Sub-Spesialis' => 5,
                    'Dokter Gigi Sub-Spesialis' => 6,
                ];
                $dok = JenisSpesialis::selectRaw('id_kategori_dokter, UPPER(klasifikasi) as klasifikasi, COUNT(*) AS jumlah')
                    ->join('spesialis_dokter', 'jenis_spesialis.id_spesialis', 'spesialis_dokter.id_spesialis')
                    ->join('dokter', 'spesialis_dokter.id_dokter', 'dokter.id_dokter')
                    ->join('praktek_d', 'praktek_d.id_dokter', 'dokter.id_dokter')
                    ->where('id_rs', $id)
                    ->groupByRaw('id_kategori_dokter, UPPER(klasifikasi)')
                    ->get();
                $fas = Fasilitas::where('id_kategori', $k->id_kategori)->get();
                foreach ($fas as $f) {
                    if (strpos($f->nama_fasilitas, 'Honorer') !== false)
                    $nakes[$f->nama_fasilitas] = isset($data[$f->nama_fasilitas]) ? $data[$f->nama_fasilitas] : 0;
                    else if (strpos($f->nama_fasilitas, 'Apoteker') === false) $nakes[$f->nama_fasilitas] = $dok->where('id_kategori_dokter', $map[substr($f->nama_fasilitas, 0, -4)])->where('klasifikasi', strpos($f->nama_fasilitas, 'TNI') === false ? 'PNS' : 'MILITER')->pluck('jumlah')->first() ?? 0;
                }
            } else if ($k->nama_kategori == 'Rawat Jalan') {
                $kategori[$k->nama_kategori] = $k;
                $poli = array(
                    'PU' => 0,
                    'PGU' => 0,
                    'PS' => array(),
                    'PSB' => array(),
                    'PGS' => array(),
                    'PGSB' => array(),
                );
                $fas = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->where('id_kategori', $k->id_kategori)->where('id_rs', $id)->get();
                foreach ($fas as $f) {
                    if ($f->id_fasilitas == 'PU' || $f->id_fasilitas == 'PGU') $poli[$f->id_fasilitas] = $f->jumlah;
                    else $poli[$f->id_fasilitas] = explode('|', $f->keterangan);
                }
            } else {
                $kategori[$k->nama_kategori] = $k;
                $f = FasilitasRS::with('fasilitas')->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->where('id_kategori', $k->id_kategori)->where('id_rs', $id)->get();
                $fasrs[$k->nama_kategori] = $f;
                foreach ($f as $ff) $fasrs_[$k->nama_kategori][] = $ff->nama_fasilitas;
            }
        }
        $spu = JenisSpesialis::select('nama_spesialis')
                             ->where('id_kategori_dokter', '2')
                             ->pluck('nama_spesialis');
        $sbu = JenisSpesialis::select('nama_spesialis')
                             ->where('id_kategori_dokter', '5')
                             ->pluck('nama_spesialis');
        $spg = JenisSpesialis::select('nama_spesialis')
                             ->where('id_kategori_dokter', '4')
                             ->pluck('nama_spesialis');
        $sbg = JenisSpesialis::select('nama_spesialis')
                             ->where('id_kategori_dokter', '6')
                             ->pluck('nama_spesialis');
        return view($view, compact(
            'active_menu',
            'rs',
            'kategori',
            'fasrs',
            'fasrs_',
            'poli',
            'nakes',
            'spu','sbu','spg','sbg',
        ));
    }

    public function kelola_nakes($id='')
    {
        $active_menu = 'yankesin_rs';
        if (Auth::user()->id_faskes) {
            $id = Auth::user()->id_faskes;
            $active_menu = 'rekap_nakes';
        }
        $rs = RumahSakit::find($id);
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Nakes')->where('id_rs', $id)->whereRaw("nama_fasilitas LIKE '%Honorer'")->get();
        $data1 = array();
        foreach ($frs as $d) {
            $data1[$d->nama_fasilitas] = array('idf' => $d->id_fasilitas, 'jumlah' => $d->jumlah);
        }
        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Nakes')->whereRaw("nama_fasilitas LIKE '%Honorer'")->get();
        $data2 = array();
        foreach ($fas as $d) {
            $data2[] = $d->nama_fasilitas;
            if (!isset($data1[$d->nama_fasilitas])) $data1[$d->nama_fasilitas] = array('idf' => $d->id_fasilitas, 'jumlah' => 0);
        }
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Paramedis')->where('id_rs', $id)->whereRaw("nama_fasilitas LIKE '%Honorer'")->get();
        $datap1 = array();
        foreach ($frs as $d) {
            $datap1[$d->nama_fasilitas] = array('idf' => $d->id_fasilitas, 'jumlah' => $d->jumlah);
        }
        //fasrs dari jenis paramedis
        $frs = FasilitasRS::join('jenis_paramedis', 'jenis_paramedis.id_jenis_paramedis', 'fasilitas_rs.id_fasilitas')->where('id_rs', $id)->get();
        foreach ($frs as $d) {
            $datap1[$d->nama_jenis_paramedis] = array('idf' => $d->id_fasilitas, 'jumlah' => $d->jumlah);
        }
        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Paramedis')->whereRaw("nama_fasilitas LIKE '%Honorer'")->get();
        $datap2 = array();
        foreach ($fas as $d) {
            $datap2[] = $d->nama_fasilitas;
            if (!isset($datap1[$d->nama_fasilitas])) $datap1[$d->nama_fasilitas] = array('idf' => $d->id_fasilitas, 'jumlah' => 0);
        }
        //fas dari jenis paramedis
        $fas = JenisParamedis::whereNotIn('nama_jenis_paramedis', ['Apoteker', 'Bidan'])->whereRaw("nama_jenis_paramedis NOT LIKE 'Perawat%'")->get();
        foreach ($fas as $d) {
            $datap2[] = $d->nama_jenis_paramedis;
            if (!isset($datap1[$d->nama_jenis_paramedis])) $datap1[$d->nama_jenis_paramedis] = array('idf' => $d->id_jenis_paramedis, 'jumlah' => 0);
        }
        $frs = FasilitasRS::join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Non-Medis')->where('id_rs', $id)->get();
        $datan1 = array();
        foreach ($frs as $d) {
            $datan1[$d->nama_fasilitas] = array('idf' => $d->id_fasilitas, 'jumlah' => $d->jumlah);
        }
        $fas = Fasilitas::join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->where('nama_kategori', 'Non-Medis')->get();
        $datan2 = array();
        foreach ($fas as $d) {
            $datan2[] = $d->nama_fasilitas;
            if (!isset($datan1[$d->nama_fasilitas])) $datan1[$d->nama_fasilitas] = array('idf' => $d->id_fasilitas, 'jumlah' => 0);
        }
        return view('yankesin.rumah_sakit.kelola_nakes', compact(
            'active_menu',
            'rs',
            'data1',
            'data2',
            'datap1',
            'datap2',
            'datan1',
            'datan2',
        ));
    }

    public function kelola_bor($id='')
    {
        $active_menu = 'yankesin_rs';
        if (Auth::user()->id_faskes) {
            $id = Auth::user()->id_faskes;
            $active_menu = 'bor';
        }
        $rs = RumahSakit::find($id);
        $last = BOR::select('bor.created_at')->join('fasilitas_rs', 'bor.id_fasilitas_rs', 'fasilitas_rs.id_fasilitas_rs')->where('id_rs', $id)->orderByDesc('bor.created_at')->first();
        if (!$last) $last = FasilitasRS::select('created_at')->where('id_rs', $id)->orderByDesc('created_at')->first();
        $data = [];
        date_default_timezone_set('Asia/Jakarta');
        $last = date_format($last->created_at, 'j F Y');
        $frs = FasilitasRS::with(['fasilitas'])->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->whereIn('nama_kategori', ['IGD', 'Rawat Inap', 'Rawat Inap Khusus', 'Ruang Operasi'])->where('id_rs', $id)->get();
        foreach ($frs as $d) {
            $i = strpos($d->fasilitas->nama_fasilitas, '/');
            $nama = $i === false ? $d->fasilitas->nama_fasilitas : substr($d->fasilitas->nama_fasilitas, 0, $i);
            $data[$nama] = $d->jumlah;
            $b = $d->bor()->orderByDesc('created_at')->first();
            $data[$nama . '_isi'] = isset($b) ? $b->terpakai : 0;
        }
        return view('yankesin.rumah_sakit.kelola_bor', compact(
            'active_menu',
            'rs',
            'last',
            'data',
        ));
    }

    public function ubah_kelola_bor($id='')
    {
        $active_menu = 'yankesin_rs';
        if (Auth::user()->id_faskes) {
            $id = Auth::user()->id_faskes;
            $active_menu = 'bor';
        }
        $rs = RumahSakit::find($id);
        $last = BOR::select('bor.created_at')->join('fasilitas_rs', 'bor.id_fasilitas_rs', 'fasilitas_rs.id_fasilitas_rs')->where('id_rs', $id)->orderByDesc('bor.created_at')->first();
        if (!$last) $last = FasilitasRS::select('created_at')->where('id_rs', $id)->orderByDesc('created_at')->first();
        $data = [];
        date_default_timezone_set('Asia/Jakarta');
        $last = date_format($last->created_at, 'j F Y');
        $frs = FasilitasRS::with(['fasilitas'])->join('fasilitas', 'fasilitas.id_fasilitas', 'fasilitas_rs.id_fasilitas')->join('kategori_fasilitas', 'fasilitas.id_kategori', 'kategori_fasilitas.id_kategori')->whereIn('nama_kategori', ['IGD', 'Rawat Inap', 'Rawat Inap Khusus', 'Ruang Operasi'])->where('id_rs', $id)->get();
        foreach ($frs as $d) {
            $i = strpos($d->fasilitas->nama_fasilitas, '/');
            $nama = $i === false ? $d->fasilitas->nama_fasilitas : substr($d->fasilitas->nama_fasilitas, 0, $i);
            $data[$nama] = array('idf' => $d->id_fasilitas_rs, 'jumlah' => $d->jumlah);
            $b = $d->bor()->orderByDesc('created_at')->first();
            $data[$nama . '_isi'] = isset($b) ? $b->terpakai : 0;
        }
        return view('yankesin.rumah_sakit.ubah_kelola_bor', compact(
            'active_menu',
            'rs',
            'last',
            'data',
        ));
    }

    public function input_fasilitas(Request $req)
    {
        $f = Fasilitas::where('id_fasilitas', $req->idf)->orWhere('nama_fasilitas', $req->idf)->first();
        if ($f) {
            $fas_exist = FasilitasRS::where('id_fasilitas', $f->id_fasilitas)->where('id_rs', $req->id_rs)->first();
            if ($fas_exist) return response()->json([
                "error" => true,
                "message" => "Fasilitas sudah tersedia",
            ]);
            $idf = $f->id_fasilitas;
        }
        else {
            $k = KategoriFasilitas::where('nama_kategori', $req->idk)->first();
            $f = new Fasilitas;
            $f->id_kategori = $k->id_kategori;
            $f->nama_fasilitas = $req->idf;
            $f->save();
            $idf = $f->id_fasilitas;
        }
        $fr = new FasilitasRS;
        $fr->id_fasilitas = $idf;
        $fr->id_rs = $req->id_rs;
        $fr->jumlah = 0;
        $fr->save();
        $log = FaskesFasilitasRS::create([
            'id_rs' => $req->id_rs,
            'id_fasilitas' => $idf,
            'status' => 'Tambah fasilitas baru<br />diupdate oleh: ' . Auth::user()->name,
        ]);
        return response()->json([
            "error" => false,
            "message" => "Tambah fasilitas sukses",
            "idfr" => $fr->id_fasilitas_rs,
            "nama" => $f->nama_fasilitas,
        ]);
    }

    public function input_fasilitas_rs(Request $request)
    {
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if ($key != '_token' && $key != 'kat' && $key != 'id_rs') {
                if ($request->kat == 'rawat_jalan') {
                    $d = FasilitasRS::firstOrNew([
                        'id_fasilitas' => $key,
                        'id_rs' => $request->id_rs,
                    ]);
                    if ($key == 'PU' || $key == 'PGU') {
                        if ($value == 'on') $value = 1;
                        else $value = 0;
                        if ($d->jumlah != $value) $log = FaskesFasilitasRS::create([
                            'id_rs' => $request->id_rs,
                            'id_fasilitas' => $key,
                            'status' => 'Update Poli ' . ($key == 'PGU' ? 'Gigi ' : '') . 'Umum<br />diupdate oleh: ' . Auth::user()->name,
                        ]);
                        $d->jumlah = $value;
                    } else {
                        if (is_array($value)) $d->keterangan = implode('|', $value);
                        else $d->keterangan = $value;
                        $log = FaskesFasilitasRS::create([
                            'id_rs' => $request->id_rs,
                            'id_fasilitas' => $key,
                            'status' => 'Update Poli ' . (substr($key, 1, 1) == 'G' ? 'Gigi ' : '') . 'Spesialis<br />diupdate oleh: ' . Auth::user()->name,
                        ]);
                    }
                } else {
                    $d = FasilitasRS::find(substr($key, 1));
                    if ($value == 'on') $value = 1;
                    else if ($value == 'off') $value = 0;
                    if ($d->jumlah != $value) $log = FaskesFasilitasRS::create([
                        'id_rs' => $d->id_rs,
                        'id_fasilitas' => $d->id_fasilitas,
                        'status' => 'Update Jumlah: ' . ($d->jumlah ?? 0) . ' &rarr; ' . $value . '<br />diupdate oleh: ' . Auth::user()->name,
                    ]);
                    $d->jumlah = $value;
                }
                $d->save();
            }
        }
        return response()->json([
            "error" => false,
            "message" => "Update fasilitas sukses",
        ]);
    }

    public function input_nakes(Request $request)
    {
        $requestData = $request->all();
        foreach ($requestData as $key => $value) {
            if ($key != '_token' && $key != 'id_rs') {
                $d = FasilitasRS::firstOrNew([
                    'id_fasilitas' => substr($key, 1),
                    'id_rs' => $request->id_rs,
                ]);
                if (!isset($d->jumlah) || (isset($d->jumlah) && $d->jumlah != $value)) $log = FaskesFasilitasRS::create([
                    'id_rs' => $d->id_rs,
                    'id_fasilitas' => $d->id_fasilitas,
                    'status' => 'Update Jumlah: ' . ($d->jumlah ?? '-') . ' &rarr; ' . $value . '<br />diupdate oleh: ' . Auth::user()->name,
                ]);
                $d->jumlah = $value;
                $d->save();
            }
        }
        return response()->json([
            "error" => false,
            "message" => "Update nakes sukses",
        ]);
    }
}

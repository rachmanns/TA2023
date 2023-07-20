<?php

namespace App\Http\Controllers\dobekkes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\RencanaPengeluaran;
use App\Models\DetailBrgMatkesM;
use App\Models\DetailBrgMatkesD;
use App\Models\BrgOut;
use App\Models\OutPemakaian;
use App\Models\OutHibah;
use App\Models\OutTktm;
use App\Models\MasterBekkes;
use App\Models\RumahSakit;
use App\Models\PosSatgas;

class BarangKeluarController extends Controller
{
    public function rencanaKeluarList(Request $request)
    {
        $data = RencanaPengeluaran::whereRaw('tgl_keluar IS NOT NULL')
            ->whereYear('tgl_keluar', $request->tahun ?? date('Y'))
            ->withSum('brg_out', 'jml_keluar')->orderBy('tgl_keluar', 'desc')->get();
        foreach ($data as $d) {
            if ($d->file_nota_dinas) $d->file_nota_dinas = url('dobekkes/barang-keluar/file-nota-dinas/' . $d->file_nota_dinas);
            if ($d->file_spb) $d->file_spb = url('dobekkes/barang-keluar/file-spb/' . $d->file_spb);
            if ($d->file_sprindis) $d->file_sprindis = url('dobekkes/barang-keluar/file-sprindis/' . $d->file_sprindis);
            if ($d->file_pak) $d->file_pak = url('dobekkes/barang-keluar/file-PAK/' . $d->file_pak);
            if (!$d->brg_out_sum_jml_keluar) $d->brg_out_sum_jml_keluar = 0;
                $out = DB::select("SELECT no_ppm, file_ppm FROM out_" . strtolower($d->jenis_pengeluaran) . " WHERE id_rencana = '" . $d->id_rencana . "'");
                $d->no_ppm = isset($out[0]) ? $out[0]->no_ppm : '';
                $d->file_ppm = isset($out[0]) && isset($out[0]->file_ppm) ? url('dobekkes/barang-keluar/file-ppm/' . $out[0]->file_ppm) : '';
        }
        return DataTables::of($data)
            ->make(true);
    }

    public function viewFile($type, $file)
    {
        $pathToFile = public_path($type) . '/' . $file;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function rencanaList()
    {
        $data = RencanaPengeluaran::selectRaw('id_rencana, penerima, tujuan_penggunaan')->whereRaw('tgl_keluar IS NULL')->withSum('detail_brg_matkes_m', 'jumlah')->orderBy('created_at', 'desc')->get();
        foreach ($data as $d) {
            $m = DetailBrgMatkesM::with('kontrak', 'hibah', 'tktm')->where('id_rencana', $d->id_rencana)->limit(1)->first();
            $d->tgl = isset($m->kontrak) ? $m->kontrak->tgl_kontrak : (isset($m->hibah) ? $m->hibah->tgl_ba_hibah : (isset($m->tktm) ? $m->tktm->tgl_kontrak_tktm : '-'));
            $brgGudang = DB::select("SELECT SUM(COALESCE(d.jumlah, 0)) AS jml FROM detail_brg_matkes_d d JOIN detail_brg_matkes_m m USING (id_matkes_matfas) WHERE id_rencana = '" . $d->id_rencana . "'")[0];
            $d->brgGudang = $brgGudang->jml ?? 0;
            $d->ket = $d->detail_brg_matkes_m_sum_jumlah . '<br /><div class="badge badge-light-' . ($d->detail_brg_matkes_m_sum_jumlah == $d->brgGudang ? 'primary' : 'warning') . ' font-small-4 mt-50">' . $d->brgGudang . ' Barang di gudang</div>';
        }
        return DataTables::of($data)
            ->rawColumns(['ket'])
            ->make(true);
    }

    public function rencanaKeluarForm($id='')
    {
        $bats = array_unique(explode(', ', implode(', ', RencanaPengeluaran::select('batalyon')->whereNotNull('batalyon')->distinct()->pluck('batalyon')->toArray())));
        $locs = RumahSakit::selectRaw('UPPER(nama_rs) AS tempat, latitude, longitude');
        $locs = PosSatgas::selectRaw('UPPER(nama_pos) AS tempat, latitude, longitude')->union($locs);
        $locs = RencanaPengeluaran::selectRaw('DISTINCT UPPER(tempat) AS tempat, latitude, longitude')
            ->whereNotNull('tempat')
            ->orWhere('tempat', '<>', '')
            ->union($locs)
            ->orderBy('tempat')
            ->get();
        if ($id == '') {
            $data = DB::select("(SELECT id_kontrak AS id, tgl_kontrak AS tgl, nomor_kontrak AS no FROM kontrak UNION SELECT id_in_tktm AS id, tgl_kontrak_tktm AS tgl, no_kontrak_tktm AS no FROM in_tktm UNION SELECT id_ba_hibah AS id, tgl_ba_hibah AS tgl, no_ba_hibah AS no FROM ba_hibah) ORDER BY tgl DESC");
            return view('dobekkes.barang_keluar.tdk_ada_rp', ['active_menu' => 'barang_keluar', 'kontrak' => $data, 'bats' => $bats, 'locs' => $locs]);
        }
        $data = RencanaPengeluaran::find($id);
        return view('dobekkes.barang_keluar.ada_rp', ['active_menu' => 'barang_keluar', 'rp' => $data, 'bats' => $bats, 'locs' => $locs]);
    }

    public function barangRencanaList($id)
    {
        $data = DetailBrgMatkesM::with('kontrak', 'hibah', 'tktm')->where('id_rencana', $id)->get();
		foreach ($data as $d) {
            $d->no = isset($d->kontrak) ? $d->kontrak->nomor_kontrak : (isset($d->hibah) ? $d->hibah->no_ba_hibah : (isset($d->tktm) ? $d->tktm->no_kontrak_tktm : '-'));
            unset($d->kontrak);
            unset($d->hibah);
            unset($d->tktm);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function inputRencanaKeluar(Request $request, $id='')
    {
        if ($id!='') $d = RencanaPengeluaran::find($id);
        else {
            $d = new RencanaPengeluaran;
            $d->penerima = $request->penerima;
            $d->tujuan_penggunaan = $request->catatan;
        }
        $d->jenis_pengeluaran = $request->jenis_pengeluaran;
        $d->tempat = $request->tempat;
        $d->latitude = $request->lat;
        $d->longitude = $request->lng;
        $d->no_nota_dinas = $request->nodin;
        $d->no_spb = $request->spb;
        $d->no_sprindis = $request->sprindis;
        $d->no_pak = $request->pak;
        if ($request->file('file_nodin') !== null) {
        $file = $request->file('file_nodin');
        $filename = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('nota-dinas'), $filename);
        $d->file_nota_dinas = $filename;
        }
        if ($request->file('file_spb') !== null) {    
            $file = $request->file('file_spb');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('spb'), $filename);
            $d->file_spb = $filename;
        }
        if ($request->file('file_sprindis') !== null) {    
            $file = $request->file('file_sprindis');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('sprindis'), $filename);
            $d->file_sprindis = $filename;
        }
        if ($request->file('file_pak') !== null) {
            $file = $request->file('file_pak');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('PAK'), $filename);
            $d->file_pak = $filename;
        }
        $d->tgl_keluar = date('Y-m-d');
        if (isset($request->batalyon)) {
            if (is_array($request->batalyon)) $d->batalyon = implode(', ', $request->batalyon);
            else $d->batalyon = $request->batalyon;
        }
        $d->save();
        $nom = 0;
      if ($id!='') {
        $bm = DetailBrgMatkesM::with('detail_brg_matkes_d')->where('id_rencana', $d->id_rencana)->get();
        foreach ($bm as $m) {
            $nom += $m->jumlah * $m->harga_satuan;
            foreach ($m->detail_brg_matkes_d as $dd) {
                $out = new BrgOut;
                $out->id_matkes_dobek = $dd->id_matkes_dobek;
                $out->id_rencana = $d->id_rencana;
                $out->jml_keluar = $dd->jumlah;
                $out->save();
            }
        }
      } else {
        $jml = $request->jml;
        foreach ($request->id as $key => $id) {
            $m = DetailBrgMatkesD::select('harga_satuan')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')->where('id_matkes_dobek', $id)->first();
            $nom += $jml[$key] * $m->harga_satuan;
            $out = new BrgOut;
            $out->id_matkes_dobek = $id;
            $out->id_rencana = $d->id_rencana;
            $out->jml_keluar = $jml[$key];
            $out->save();
        }
      }
        if ($d->jenis_pengeluaran == 'Pemakaian') $out = new OutPemakaian;
        else if ($d->jenis_pengeluaran == 'TKTM') $out = new OutTktm;
        else $out = new OutHibah;
        $out->id_rencana = $d->id_rencana;
        $out->kode_nota_dinas = $d->no_nota_dinas;
        $out->nominal = $nom;
        $out->no_ppm = $request->ppm;
        if ($request->file('file_ppm') !== null) {
            $file = $request->file('file_ppm');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('ppm'), $filename);
            $out->file_ppm = $filename;
            $out->tgl_upload = date('Y-m-d');
        }
        $out->save();
        return redirect('/dobekkes/barang_keluar');
    }

    public function barangList($id)
    {
        $brg = DetailBrgMatkesD::selectRaw('detail_brg_matkes_d.id_matkes_dobek as id, nama_matkes, satuan_brg, detail_brg_matkes_d.jumlah, SUM(COALESCE(jml_keluar, 0)) AS jml_keluar, keterangan, exp_date, detail_brg_matkes_d.created_at')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek')
            ->whereRaw('detail_brg_matkes_m.id_rencana IS NULL')
            ->where('id_barang_masuk', $id)
            ->groupBy('id')
            ->havingRaw('jumlah - jml_keluar > 0')->get();
        foreach($brg as $d) {
            $d->responsive_id = '';
            $d->jumlah -= $d->jml_keluar;
        }
        return DataTables::of($brg)
            ->make(true);
    }

    public function barangKeluar($id)
    {
        $data = RencanaPengeluaran::selectRaw('tgl_keluar, penerima, batalyon')->find($id);
        return view('dobekkes.barang_keluar.lihat_barang', compact('data'), ['active_menu' => 'barang_keluar']);
    }

    public function barangKeluarList($id)
    {
        $brg = BrgOut::selectRaw('id_brg_out, nama_matkes, satuan_brg, jml_keluar, detail_brg_matkes_m.keterangan, COALESCE(nomor_kontrak, no_kontrak_tktm, no_ba_hibah) AS no, detail_brg_matkes_d.jumlah AS jml_max')
            ->join('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_m.id_matkes_matfas', 'detail_brg_matkes_d.id_matkes_matfas')
            ->leftJoin('kontrak', 'detail_brg_matkes_m.id_barang_masuk', 'kontrak.id_kontrak')
            ->leftJoin('in_tktm', 'detail_brg_matkes_m.id_barang_masuk', 'in_tktm.id_in_tktm')
            ->leftJoin('ba_hibah', 'detail_brg_matkes_m.id_barang_masuk', 'ba_hibah.id_ba_hibah')
            ->where('brg_out.id_rencana', $id)
            ->get();
        return DataTables::of($brg)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <div class="text-center">
                    <button class="btn text-primary p-0 pr-25" title="Retur" data-id="' .  $row->id_brg_out . '" data-nama="' .  $row->nama_matkes . '" data-jml="' .  $row->jml_keluar . '" data-max="' .  $row->jml_max . '" onclick="edit_brg($(this))"><i data-feather="edit" class="font-medium-4"></i></button>
                    <button title="Retur Semua" class="btn p-0" onclick="hapus_brg($(this))" data-id="' . $row->id_brg_out . '"><i data-feather="trash" class="font-medium-4 text-danger"></i></button>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function updateRencanaKeluar(Request $request, $id)
    {
        $d = RencanaPengeluaran::find($id);
        $d->tempat = $request->tempat;
        $d->latitude = $request->lat;
        $d->longitude = $request->lng;
        $d->no_nota_dinas = $request->nodin;
        $d->no_spb = $request->spb;
        $d->no_sprindis = $request->sprindis;
        $d->no_pak = $request->pak;
        if ($request->file('file_nodin') !== null) {
            $file = $request->file('file_nodin');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('nota-dinas'), $filename);
            $d->file_nota_dinas = $filename;
        }
        if ($request->file('file_spb') !== null) {
            $file = $request->file('file_spb');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('spb'), $filename);
            $d->file_spb = $filename;
        }
        if ($request->file('file_sprindis') !== null) {
            $file = $request->file('file_sprindis');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('sprindis'), $filename);
            $d->file_sprindis = $filename;
        }
        if ($request->file('file_pak') !== null) {
            $file = $request->file('file_pak');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('PAK'), $filename);
            $d->file_pak = $filename;
        }
        $d->save();

        if ($d->jenis_pengeluaran == 'Pemakaian') $out = OutPemakaian::where('id_rencana', $d->id_rencana)->first();
        else if ($d->jenis_pengeluaran == 'TKTM') $out = OutTktm::where('id_rencana', $d->id_rencana)->first();
        else $out = OutHibah::where('id_rencana', $d->id_rencana)->first();

        $out->no_ppm = $request->ppm;
        if ($request->file('file_ppm') !== null) {
            $file = $request->file('file_ppm');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('ppm'), $filename);
            $out->file_ppm = $filename;
            $out->tgl_upload = date('Y-m-d');
        }
        $out->kode_nota_dinas = $d->no_nota_dinas;
        $out->save();

        return response()->json(["error" => false, "message" => 'Data berhasil diupdate']);
    }

    public function updateBarangKeluar(Request $request)
    {
        $brg = BrgOut::with('detail_brg_matkes_d.detail_brg_matkes_m')->find($request->id);
        $d = RencanaPengeluaran::find($brg->id_rencana);
        if ($d->jenis_pengeluaran == 'Pemakaian') $out = OutPemakaian::where('id_rencana', $d->id_rencana)->first();
        else if ($d->jenis_pengeluaran == 'TKTM') $out = OutTktm::where('id_rencana', $d->id_rencana)->first();
        else $out = OutHibah::where('id_rencana', $d->id_rencana)->first();

        if (!isset($out)) return response()->json([
            "error" => true,
            "message" => "Terjadi kesalahan",
        ]);
        //pisahkan barang retur
        $brgm = $brg->detail_brg_matkes_d->detail_brg_matkes_m;
        $newm = DetailBrgMatkesM::firstOrNew([
            'id_barang_masuk' => $brgm->id_barang_masuk,
            'kode_barang' => $brgm->kode_barang,
            'kategori_barang' => $brgm->kategori_barang,
            'nama_matkes' => $brgm->nama_matkes,
            'harga_satuan' => $brgm->harga_satuan,
            'tgl_pendataan' => $brgm->tgl_pendataan,
            'satuan_brg' => $brgm->satuan_brg,
            'id_rencana' => null,
        ]);
        $newm->keterangan = $brgm->keterangan;
        $newm->jumlah = $brg->jml_keluar - $request->jml;
        $newm->save();
        $brgm->jumlah = $request->jml;
        $brgm->save();
        //input barang retur ke gudang
        $brgm = $brg->detail_brg_matkes_d;
        unset($brgm->detail_brg_matkes_m);
        $newd = DetailBrgMatkesD::firstOrNew([
            'id_matkes_matfas' => $newm->id_matkes_matfas,
            'id_gudang' => $brgm->id_gudang,
            'exp_date' => $brgm->exp_date,
        ]);
        $newd->jumlah = $newm->jumlah;
        $newd->save();
        $brgm->jumlah = $request->jml;
        $brgm->save();
        $brg->jml_keluar = $request->jml;
        $brg->save();

        $total = BrgOut::selectRaw('COALESCE(SUM(jml_keluar * harga_satuan), 0) AS total')
            ->join('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_m.id_matkes_matfas', 'detail_brg_matkes_d.id_matkes_matfas')
            ->where('brg_out.id_rencana', $d->id_rencana)
            ->pluck('total')->first();
        $out->nominal = $total;
        $out->save();

        return response()->json([
            "error" => false,
            "message" => "Barang keluar berhasil disimpan",
        ]);
    }

    public function hapusBarangKeluar($id)
    {
        $brg = BrgOut::with('detail_brg_matkes_d.detail_brg_matkes_m')->find($id);
        $d = RencanaPengeluaran::find($brg->id_rencana);
        if ($d->jenis_pengeluaran == 'Pemakaian') $out = OutPemakaian::where('id_rencana', $d->id_rencana)->first();
        else if ($d->jenis_pengeluaran == 'TKTM') $out = OutTktm::where('id_rencana', $d->id_rencana)->first();
        else $out = OutHibah::where('id_rencana', $d->id_rencana)->first();

        if (!isset($out)) return response()->json([
            "error" => true,
            "message" => "Terjadi kesalahan",
        ]);
        //hapus barang retur dari rencana
        $brgm = $brg->detail_brg_matkes_d->detail_brg_matkes_m;
        $brgm->id_rencana = null;
        $brgm->save();
        $brg->delete();
        $total = BrgOut::selectRaw('COALESCE(SUM(jml_keluar * harga_satuan), 0) AS total')
            ->join('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_m.id_matkes_matfas', 'detail_brg_matkes_d.id_matkes_matfas')
            ->where('brg_out.id_rencana', $d->id_rencana)
            ->pluck('total')->first();
        $out->nominal = $total;
        $out->save();

        return response()->json([
            "error" => false,
            "message" => "Barang keluar berhasil diretur",
            'table' => '.data-barang-keluar',
        ]);
    }

    public function petaLokasiBarangKeluar(Request $request)
    {
        $active_menu = 'maps_dobekkes';
        $data = RencanaPengeluaran::with('brg_out.detail_brg_matkes_d.detail_brg_matkes_m')
            ->whereRaw('tgl_keluar IS NOT NULL')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();
        foreach ($data as $d) {
                $out = DB::select("SELECT no_ppm, file_ppm FROM out_" . strtolower($d->jenis_pengeluaran) . " WHERE id_rencana = '" . $d->id_rencana . "'");
                $d->no_ppm = isset($out[0]) ? $out[0]->no_ppm : '-';
                $d->file_ppm = isset($out[0]) && isset($out[0]->file_ppm) ? $out[0]->file_ppm : null;
        }

        $tahun = $request->tahun ?? date('Y');
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get()->pluck('nama_bekkes');
        $brg = DetailBrgMatkesM::selectRaw('(SUM(detail_brg_matkes_m.jumlah) - COALESCE(SUM(jml_keluar), 0)) as sisa, nama_matkes')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'brg_out.id_matkes_dobek', 'detail_brg_matkes_d.id_matkes_dobek')
            ->where('satuan_brg', 'kat')
            ->whereYear('tgl_pendataan', $tahun)
            ->groupBy('nama_matkes')
            ->get();
        $berjalan = [];
        foreach($brg as $b) {
            $berjalan[$b->nama_matkes] = $b->sisa;
        }
        $brg = DetailBrgMatkesM::selectRaw('(SUM(detail_brg_matkes_m.jumlah) - COALESCE(SUM(jml_keluar), 0)) as sisa, nama_matkes')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'brg_out.id_matkes_dobek', 'detail_brg_matkes_d.id_matkes_dobek')
            ->where('satuan_brg', 'kat')
            ->whereYear('tgl_pendataan', $tahun-1)
            ->groupBy('nama_matkes')
            ->get();
        $lampau = [];
        foreach($brg as $b) {
            $lampau[$b->nama_matkes] = $b->sisa;
        }
        $categories = [];
        $data_berjalan = [];
        $data_lampau = [];
        foreach ($master_bekkes as $v) {
            $categories[] = ['label' => $v];
            $data_berjalan[] = ['value' => $berjalan[$v] ?? 0];
            $data_lampau[] = ['value' => $lampau[$v] ?? 0];
        }

        return view('dobekkes.maps.maps', compact('data', 'active_menu', 'tahun', 'categories', 'data_berjalan', 'data_lampau'));
    }
}

<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosSatgasRequest;
use App\Models\BekkesPenugasanPeta;
use App\Models\BekkesPos;
use App\Models\Geografis;
use App\Models\MasterBekkes;
use App\Models\PosSatgas;
use App\Models\RSPemdaSwasta;
use App\Models\RSPos;
use App\Models\RumahSakit;
use App\Models\SatgasOps;
use App\Models\TipePos;
use App\Services\PosSatgasService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosSatgasController extends Controller
{
    public function index()
    {
        $active_menu = 'pos_satgas';
        return view('dukkesops.pos_satgas.index', compact(
            'active_menu'
        ));
    }

    public function create()
    {
        $active_menu = 'pos_satgas';
        $satgas_ops = SatgasOps::get();
        $geografis = Geografis::get();
        $rs_pemda_swasta = RSPemdaSwasta::select('id_rs_pem_swas', 'nama_rs')->get();
        $tipe = [
            'mobile',
            'darat',
            'udara',
            'kapal'
        ];
        return view('dukkesops.pos_satgas.form', compact(
            'satgas_ops',
            'geografis',
            'active_menu',
            'tipe',
            'rs_pemda_swasta'
        ));
    }

    public function edit(PosSatgas $pos_satgas)
    {
        $active_menu = 'pos_satgas';
        $satgas_ops = SatgasOps::get();
        $geografis = Geografis::get();
        $tipe = [
            'mobile',
            'darat',
            'udara',
            'kapal'
        ];
        return view('dukkesops.pos_satgas.form', compact(
            'satgas_ops',
            'geografis',
            'pos_satgas',
            'active_menu',
            'tipe',
        ));
    }

    public function get()
    {
        return PosSatgasService::dataTable();
    }

    public function show(PosSatgas $pos_satgas)
    {
        $active_menu = 'pos_satgas';
        $pos_satgas = $pos_satgas->load('geografis', 'satgas_ops');
        $rs_pos = RSPos::with('rs_militer', 'rs_pemda_swasta')->select('id_rs_pem_swas', 'tipe', 'jarak', 'evakuasi')->where('id_pos', $pos_satgas->id_pos)->get();

        return view('dukkesops.pos_satgas.detail', compact('active_menu', 'pos_satgas', 'rs_pos'));
    }

    public function store(PosSatgasRequest $request)
    {
        PosSatgasService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'Pos Satgas Created!',
            'url' => url('dukkesops/pos-satgas')
        ]);
    }

    public function update(PosSatgasRequest $request, PosSatgas $pos_satgas)
    {
        PosSatgasService::update($request, $pos_satgas);

        return response()->json([
            'error' => false,
            'message' => 'Pos Satgas Updated!',
            'url' => url('dukkesops/pos-satgas')
        ]);
    }

    public function destroy(PosSatgas $pos_satgas)
    {
        PosSatgasService::destroy($pos_satgas);

        return response()->json([
            'error' => false,
            'message' => 'Pos Satgas Delete!',
            'table' => '#pos-satgas'
        ]);
    }

    public function peta_sebaran_old(Request $req)
    {
        $active_menu = 'peta_pos_satgas';
        echo date('i:s');



        $pos_satgas = DB::table('pos_satgas')->select('pos_satgas.*', 'pos_satgas.keterangan as keterangan_pos_satgas', 'satgas_ops.nama_kat_satgas', 'satgas_ops.jenis_satgas', 'satgas_ops.keterangan', 'geografis.jenis_geografis', 'penugasan_satgas.id_tugas', 'penugasan_satgas.nama_batalyon')
            ->leftJoin('satgas_ops', 'satgas_ops.id_satgas_ops', 'pos_satgas.id_satgas_ops')
            ->leftJoin('penugasan_satgas', function ($query) {
                $query->on('satgas_ops.id_satgas_ops', '=', 'penugasan_satgas.id_satgas_ops')
                    ->whereRaw('penugasan_satgas.dept_date IN (select MAX(ps2.dept_date) from penugasan_satgas as ps2 group by ps2.id_satgas_ops)');
                // $query->on('satgas_ops.id_satgas_ops', '=', 'penugasan_satgas.id_satgas_ops')
                //     ->whereRaw('penugasan_satgas.dept_date IN (select MAX(ps2.dept_date) from penugasan_satgas as ps2 join satgas_ops as so2 on so2.id_satgas_ops = ps2.id_satgas_ops group by ps2.id_satgas_ops)');
            })
            ->leftJoin('geografis', 'geografis.id_geografis', 'pos_satgas.id_geografis')
            ->get();


        if (isset($req->id_pos)) $pos_cari = $pos_satgas->where("id_pos", $req->id_pos)->first();
        else $pos_cari = null;

        // return $pos_cari;
        // foreach ($pos_satgas as $key => $ps) {

        //     $penugasan_pos = DB::table('penugasan_pos')->select('nama_ketua', 'no_telp', 'jml_personil')->where('id_pos', $ps->id_pos)->where('id_tugas', $ps->id_tugas)->first();

        //     $ps->nama_batalyon = $ps->nama_batalyon ?? '-';
        //     $ps->jml_pers = $penugasan_pos->jml_personil ?? '-';
        //     $ps->nama_pers = $penugasan_pos->nama_ketua ?? '-';
        //     $ps->no_telp = $penugasan_pos->no_telp ?? '-';

        //     $ps->bekkes_pos = BekkesPos::select('bekkes_pos.id_mas_bek', 'urutan', 'nama_bekkes', 'jumlah')->join('master_bekkes', 'master_bekkes.id_mas_bek', 'bekkes_pos.id_mas_bek')->where('id_pos_satgas', $ps->id_pos)->whereRaw('NOT TRIM(nama_bekkes) = "KAT SERPAS"')->get();

        //     $temp = RSPos::with('rs_pemda_swasta')->where('id_pos', $ps->id_pos)->get();

        //     $rs_pos_pem_swas = [];
        //     foreach ($temp as $key => $val) {
        //         $x = $val->rs_pemda_swasta;
        //         if (!empty($x)) {
        //             $x->evakuasi = $val->evakuasi;
        //         }
        //         $rs_pos_pem_swas[] = $x;
        //     }

        //     $ps->rs_pos_pem_swas = $rs_pos_pem_swas;
        // }

        $rs = RumahSakit::select('rs.*', 'kode_matra')->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->whereNotNull('latitude')->whereNotNull('longitude')->get();

        return view('dukkesops.pos_satgas.peta_sebaran', compact(
            'pos_satgas',
            'pos_cari',
            'rs',
            'active_menu'
        ));
    }

    public function peta_sebaran(Request $req)
    {
        $active_menu = 'peta_pos_satgas';

        $pos_satgas = DB::select(
            'SELECT
            a.*,
            a.keterangan AS keterangan_pos_satgas,
            d.nama_kat_satgas,
            d.jenis_satgas,
            d.keterangan,
            e.jenis_geografis,
            c.id_tugas,
            IFNULL(c.nama_batalyon,"-") AS nama_batalyon,
            b.nama_ketua AS nama_pers,
            b.jml_personil AS jml_pers,
            b.no_telp,
            b.id_penugasan_pos
        FROM
            pos_satgas a
        LEFT JOIN penugasan_pos b ON
            a.id_pos = b.id_pos
        LEFT JOIN penugasan_satgas c ON
            c.id_tugas = b.id_tugas
        LEFT JOIN satgas_ops d ON
            d.id_satgas_ops = c.id_satgas_ops
        LEFT JOIN geografis e ON
            a.id_geografis = e.id_geografis
        WHERE
            (
                (b.id_pos, c.dept_date) IN(
                SELECT
                    penugasan_pos.id_pos,
                    MAX(dept_date)
                FROM
                    penugasan_pos
                LEFT JOIN penugasan_satgas ON penugasan_satgas.id_tugas = penugasan_pos.id_tugas
                GROUP BY
                    penugasan_pos.id_pos
                ) OR c.dept_date IS NULL
            )'
        );

        $data_id_pos = array_column($pos_satgas, 'id_pos');

        $bpp = BekkesPenugasanPeta::select('id_penugasan_pos', 'id_mas_bek', 'jumlah')
            ->get();

        $rspos = RSPos::with('rs_pemda_swasta', 'rs_militer')->whereIn('id_pos', $data_id_pos)->get();

        $arr_bpp = [];
        foreach ($bpp as $key => $v) {
            $arr_bpp[$v->id_penugasan_pos . '-' . $v->id_mas_bek] = $v->jumlah;
        }

        if (isset($req->id_pos)) $pos_cari = collect($pos_satgas)->where("id_pos", $req->id_pos)->first();
        else $pos_cari = null;

        $master_bekkes = MasterBekkes::select('id_mas_bek', 'nama_bekkes', 'urutan')->orderBy('urutan', 'asc')->get();

        foreach ($pos_satgas as $key => $ps) {

            foreach ($master_bekkes as $k => $v) {
                $jumlah = $arr_bpp[$ps->id_penugasan_pos . '-' . $v->id_mas_bek] ?? '-';
                $ps->bekkes_pos[] = [
                    "id_mas_bek" => $v->id_mas_bek,
                    "urutan" => $v->urutan,
                    "nama_bekkes" => $v->nama_bekkes,
                    "jumlah" => $jumlah
                ];
            }

            $temp = $rspos->where('id_pos', $ps->id_pos);

            $rs_pos_pem_swas = [];
            foreach ($temp as $key => $val) {
                $x = $val->rs_pemda_swasta;
                $y = $val->rs_militer;

                if (!empty($x)) {
                    $x->evakuasi = $val->evakuasi;
                    $rs_pos_pem_swas[] = $x;
                }

                if (!empty($y)) {
                    $rs_pos_pem_swas[] = [
                        "id_rs_pem_swas" => $y->id_rs,
                        "nama_rs" => $y->nama_rs,
                        "kategori" => "",
                        "latitude" => $y->latitude,
                        "longitude" => $y->longitude,
                        'evakuasi' => $val->evakuasi
                    ];
                }
            }

            $ps->rs_pos_pem_swas = $rs_pos_pem_swas;
        }

        $rs = RumahSakit::select('rs.*', 'kode_matra')
            ->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        $path_icon_pos = url("app-assets/images/ico");
        $icon = [];
        $tipe_pos = TipePos::get();
        foreach ($tipe_pos as $key => $value) {
            $icon[$value->tipe] = $path_icon_pos . "/" . ($value->image == "" ? ($value->tipe == 'darat' ? $value->tipe . ".png" : "pos-" . $value->tipe . ".png") : $value->image);
        }
        // return $icon;

        return view('dukkesops.pos_satgas.peta_sebaran', compact(
            'pos_satgas',
            'rs',
            'pos_cari',
            'icon',
            'active_menu'
        ));
    }

    public function get_faskes(Request $request)
    {
        return PosSatgasService::detail_faskes($request);
    }

    public function get_bekkes($id_mas_bek)
    {
        return PosSatgasService::list_bekkes($id_mas_bek);
    }

    public function form_faskes_rujukan(PosSatgas $pos_satgas)
    {
        $active_menu = 'pos_satgas';
        $rs = RumahSakit::select('id_rs', 'nama_rs', 'latitude', 'longitude')->orderBy('nama_rs')->get();
        $rs_pemda_swasta = RSPemdaSwasta::select('id_rs_pem_swas', 'nama_rs', 'latitude', 'longitude')->orderBy('nama_rs')->get();
        $rs_pos = RSPos::with('rs_militer', 'rs_pemda_swasta')->select('id_rs_pem_swas', 'tipe', 'jarak', 'evakuasi')->where('id_pos', $pos_satgas->id_pos)->get();
        $tipe = [
            'DARAT',
            'LAUT',
            'UDARA'
        ];
        return view('dukkesops.pos_satgas.edit_faskes', compact(
            'pos_satgas',
            'active_menu',
            'tipe',
            'rs',
            'rs_pemda_swasta',
            'rs_pos'
        ));
    }

    public function update_faskes_rujukan($id, Request $request)
    {
        $res = $request->all();
        $ids = [];
        if (isset($res['faskesmil'])) {
            foreach ($res['faskesmil'] as $rs) {
                if (isset($rs['id_rs'])) {
                    $d = RSPos::firstOrNew([
                        'id_pos' => $id,
                        'id_rs_pem_swas' => $rs['id_rs'],
                    ], [
                        'tipe' => 'M',
                        'jarak' => $rs['jarak'],
                    ]);
                    $d->evakuasi = $rs['evakuasi'];
                    $d->save();
                    $ids[] = $d->id_rs_pos;
                }
            }
        }
        if (isset($res['faskesps'])) {
            foreach ($res['faskesps'] as $rsps) {
                if (isset($rsps['id_rs_pem_swas'])) {
                    $d = RSPos::firstOrNew([
                        'id_pos' => $id,
                        'id_rs_pem_swas' => $rsps['id_rs_pem_swas'],
                    ], [
                        'tipe' => 'PS',
                        'jarak' => $rsps['jarak'],
                    ]);
                    $d->evakuasi = $rsps['evakuasi'];
                    $d->save();
                    $ids[] = $d->id_rs_pos;
                }
            }
        }
        RSPos::where('id_pos', $id)->whereNotIn('id_rs_pos', $ids)->delete();
        return redirect("/dukkesops/pos-satgas/faskes-rujukan/$id");
    }
}

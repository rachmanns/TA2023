<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenugasanPosRequest;
use App\Models\BekkesPenugasanPeta;
use App\Models\DataKegiatanDuk;
use App\Models\DetailAnggota;
use App\Models\MasterBekkes;
use App\Models\PenugasanPos;
use App\Models\PenugasanSatgas;
use App\Models\PosSatgas;
use App\Services\PenugasanPosService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PenugasanPosController extends Controller
{
    public function edit(PenugasanPos $penugasan_pos)
    {
        $active_menu = 'rotasi_satgas_dn';
        $penugasan_pos->load('penugasan_satgas', 'pos_satgas');

        $bekkes_penugasan_peta = BekkesPenugasanPeta::where('id_penugasan_pos', $penugasan_pos->id_penugasan_pos)->get();
        $bpp = $bekkes_penugasan_peta->mapWithKeys(function ($item) {
            return [$item['id_mas_bek'] => $item['jumlah']];
        });

        $master_bekkes = MasterBekkes::select('id_mas_bek', 'nama_bekkes')->get();

        return view('dukkesops.rotasi_satgas.dalam_negeri.edit_data_rotasi', compact(
            'active_menu',
            'master_bekkes',
            'bpp',
            'penugasan_pos'
        ));
    }

    public function update(PenugasanPosRequest $request, PenugasanPos $penugasan_pos)
    {
        return PenugasanPosService::update($request, $penugasan_pos);
    }

    public function destroy(PenugasanPos $penugasan_pos)
    {
        $penugasan_pos->deleteOrFail();
        return [
            'error' => false,
            'table' => '#table'
        ];
    }

    public function download(PenugasanSatgas $penugasan_satgas)
    {
        return PenugasanPosService::download_template($penugasan_satgas);
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filename = date('YmdHis') . '.xlsx';
        $file->move(base_path() . '/uploads/', $filename);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(base_path() . '/uploads/' . $filename);

        unlink(base_path() . '/uploads/' . $filename);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        $ps = [];

        $master_bekkes = MasterBekkes::select('id_mas_bek', 'nama_bekkes')->get();

        $temp_bekkes = [];
        foreach ($master_bekkes as $k => $v) {
            $temp_bekkes[$v->id_mas_bek] = $v->nama_bekkes;
        }

        for ($i = 3; $i < $count_rows; $i++) {
            if ($rows[$i][0] != null) {
                $ps[] = [
                    'nama_pos' => $rows[$i][0],
                    'nama_ketua' => $rows[$i][1],
                    'no_telp' => $rows[$i][2],
                    'jml_personil' => $rows[$i][3],
                ];

                for ($j = 4; $j < count($rows[$i]); $j++) {
                    $ps[$i - 3]['bekkes'][$master_bekkes[$j - 4]->id_mas_bek] = $rows[$i][$j];
                }
            }
        }

        $request->session()->put('ps', json_encode($ps));

        $active_menu = 'rotasi_satgas_dn';

        $id = $request->id;

        return view('dukkesops.rotasi_satgas.dalam_negeri.preview_pos', compact(
            'active_menu',
            'ps',
            'id',
            'temp_bekkes'
        ));
    }

    public function import(Request $request)
    {
        $data = json_decode($request->session()->get('ps'), true);
        foreach ($data as $k => $v) {
            $pos = PosSatgas::where('nama_pos', strtolower($v['nama_pos']))->pluck('id_pos')->first();
            $v['id_pos'] = $pos ?? null;
            $v['id_tugas'] = $request->id;
            if ($v['id_pos'] != null) {
                $penugasan_pos = PenugasanPos::updateOrCreate(
                    [
                        'id_tugas' =>  $v['id_tugas'],
                        'id_pos' => $pos,
                    ],
                    [
                        'nama_ketua' => $v['nama_ketua'],
                        'no_telp' => $v['no_telp'],
                        'jml_personil' => $v['jml_personil'],
                    ]
                );
                foreach ($v['bekkes'] as $key1 => $value1) {
                    BekkesPenugasanPeta::updateOrCreate(
                        [
                            'id_mas_bek' => $key1,
                            'id_penugasan_pos' =>  $penugasan_pos->id_penugasan_pos,
                        ],
                        [
                            'jumlah' => $value1 ?? 0
                        ]
                    );
                }
            }
        }

        $request->session()->forget(['ps']);

        return redirect('dukkesops/rotasi-satgas/show/' . $request->id);
    }


    public function detail_personil(PenugasanPos $penugasan_pos)
    {
        $penugasan_pos->load('penugasan_satgas.satgas_ops', 'pos_satgas');
        $active_menu = 'rotasi_satgas_' . strtolower($penugasan_pos->penugasan_satgas->satgas_ops->jenis_satgas);
        return view('dukkesops.rotasi_satgas.dalam_negeri.detail_personil', compact(
            'active_menu',
            'penugasan_pos'
        ));
    }

    public function create_anggota(PenugasanPos $penugasan_pos)
    {
        // $detail_anggota = DetailAnggota::where('id_penugasan_pos', $penugasan_pos->id_penugasan_pos)->get()->pluck('id_data_kegiatan_duk')->toArray();

        $penugasan_pos->load('penugasan_satgas.satgas_ops');

        $penugasan_satgas = PenugasanSatgas::has('data_kegiatan_duk')->with(['data_kegiatan_duk' => function ($q) {
            return $q->where('isPlotted', 0);
        }])->where('id_satgas_ops', $penugasan_pos->penugasan_satgas->id_satgas_ops)->first();

        // return $penugasan_pos;


        $active_menu = 'rotasi_satgas_' . strtolower($penugasan_pos->penugasan_satgas->satgas_ops->jenis_satgas);
        return view('dukkesops.rotasi_satgas.dalam_negeri.tambah_personil', compact(
            'active_menu',
            'penugasan_pos',
            'penugasan_satgas',
            // 'detail_anggota'
        ));
    }

    public function store_anggota(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->id_data_kegiatan_duk as $k => $v) {
                $data_kegiatan_duk = DataKegiatanDuk::find($v);
                $data_kegiatan_duk->isPlotted = 1;
                $data_kegiatan_duk->save();

                DetailAnggota::create([
                    'id_penugasan_pos' => $request->id_penugasan_pos,
                    'id_data_kegiatan_duk' => $v
                ]);
            }
        });

        return response()->json([
            'error' => false,
            'url' => url('dukkesops/penugasan-pos/detail-personil/' . $request->id_penugasan_pos)
        ]);
    }

    public function get_personil($id_penugasan_pos)
    {
        return PenugasanPosService::get_personil($id_penugasan_pos);
    }

    public function destroy_personil(DetailAnggota $detail_anggota)
    {
        DB::transaction(function () use ($detail_anggota) {
            DataKegiatanDuk::where('id_data_kegiatan_duk', $detail_anggota->id_data_kegiatan_duk)->update(['isPlotted' => 0]);
            $detail_anggota->deleteOrFail();
        });
        return [
            'error' => false,
            'table' => '#table'
        ];
    }
}

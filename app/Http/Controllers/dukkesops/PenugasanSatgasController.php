<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\PenugasanSatgasRequest;
use App\Models\MasterBekkes;
use App\Models\PenugasanPos;
use App\Models\PenugasanSatgas;
use App\Models\PosSatgas;
use App\Models\SatgasOps;
use App\Services\PenugasanSatgasService;
use Illuminate\Http\Request;

class PenugasanSatgasController extends Controller
{
    public function index(string $jenis_satgas)
    {
        $active_menu = 'rotasi_satgas_' . $jenis_satgas;
        return view('dukkesops.rotasi_satgas.dalam_negeri.index', compact(
            'active_menu'
        ));
    }

    public function create(string $jenis_satgas)
    {
        $active_menu = 'rotasi_satgas_' . $jenis_satgas;
        $satgas_ops = SatgasOps::select('id_satgas_ops', 'nama_kat_satgas')->where('jenis_satgas', $jenis_satgas)->get();
        return view('dukkesops.rotasi_satgas.dalam_negeri.form', compact(
            'active_menu',
            'satgas_ops'
        ));
    }

    public function store(PenugasanSatgasRequest $request)
    {
        $type = gettype($request->nama_batalyon);
        if ($type == 'string') {
            $penugasan_satgas = PenugasanSatgasService::store($request);
        } else {
            $penugasan_satgas = PenugasanSatgasService::store_multi_batalyon($request);
        }

        return response()->json([
            'error' => false,
            'message' => 'Rotasi Satgas Created!',
            'url' => url('dukkesops/rotasi-satgas/' . strtolower($penugasan_satgas->jenis_satgas))
        ]);
    }

    public function get(Request $request)
    {
        return PenugasanSatgasService::dataTable($request);
    }

    public function destroy(PenugasanSatgas $penugasan_satgas)
    {
        try {
            PenugasanSatgasService::destroy($penugasan_satgas);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Rotasi Satgas Deleted!',
            'table' => '#rs'
        ]);
    }

    public function edit(string $jenis_satgas, PenugasanSatgas $penugasan_satgas)
    {
        $active_menu = 'rotasi_satgas_' . $jenis_satgas;
        $satgas_ops = SatgasOps::select('id_satgas_ops', 'nama_kat_satgas')->where('jenis_satgas', $jenis_satgas)->get();
        return view('dukkesops.rotasi_satgas.dalam_negeri.form', compact(
            'active_menu',
            'satgas_ops',
            'penugasan_satgas'
        ));
    }

    public function update(PenugasanSatgasRequest $request, PenugasanSatgas $penugasan_satgas)
    {
        $penugasan_satgas = PenugasanSatgasService::update($request, $penugasan_satgas);

        return response()->json([
            'error' => false,
            'message' => 'Rotasi Satgas Created!',
            'url' => url('dukkesops/rotasi-satgas/' . strtolower($penugasan_satgas->jenis_satgas))
        ]);
    }

    public function download($jenis_satgas, $tahun)
    {
        return PenugasanSatgasService::download_template($jenis_satgas, $tahun);
    }

    public function show(PenugasanSatgas $penugasan_satgas)
    {
        $penugasan_satgas->load('satgas_ops');
        $penugasan_satgas->dept_date = indonesian_date_format($penugasan_satgas->dept_date);
        $penugasan_satgas->arrv_date = indonesian_date_format($penugasan_satgas->arrv_date);

        $master_bekkes = MasterBekkes::select('nama_bekkes as data')->orderBy('urutan', 'asc')->get();
        $master_bekkes = $master_bekkes->map(function ($item) {
            $item->defaultContent = 0;
            return $item;
        });

        $active_menu = 'rotasi_satgas_' . strtolower($penugasan_satgas->satgas_ops->jenis_satgas);
        return view('dukkesops.rotasi_satgas.luar_negeri.show', compact(
            'active_menu',
            'penugasan_satgas',
            'master_bekkes'
        ));
    }

    public function upload(Request $request, string $jenis_satgas)
    {
        $file = $request->file('file');
        $filename = date('YmdHis') . '.xlsx';
        $file->move(base_path() . '/uploads/rotasi_satgas/', $filename);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(base_path() . '/uploads/rotasi_satgas/' . $filename);

        unlink(base_path() . '/uploads/rotasi_satgas/' . $filename);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        $ps = [];

        for ($i = 3; $i < $count_rows; $i++) {
            if ($rows[$i][3] != null && $rows[$i][4] != null) {
                $satgas_ops = SatgasOps::where('nama_kat_satgas', $rows[$i][0])->first();
                if ($satgas_ops != null) {
                    $pos = PosSatgas::where('nama_pos', $rows[$i][1])->first();
                    if ($pos != null) {
                        $ps[] = [
                            'id_satgas_ops' => $satgas_ops->id_satgas_ops,
                            'id_pos' => $pos->id_pos,
                            'nama_satgas' => $rows[$i][0],
                            'nama_pos' => $rows[$i][1],
                            'nama_batalyon' => $rows[$i][2],
                            'dept_date' => $rows[$i][3],
                            'arrv_date' => $rows[$i][4],
                            'jenis_satgas' => $jenis_satgas,
                        ];
                    }
                }
            }
        }

        $request->session()->put('ps', json_encode($ps));

        $active_menu = 'rotasi_satgas_dn';

        return view('dukkesops.rotasi_satgas.dalam_negeri.preview', compact(
            'active_menu',
            'ps'
        ));
    }

    public function import(Request $request)
    {
        $data = json_decode($request->session()->get('ps'), true);
        $jenis_satgas = '';
        foreach ($data as $k => $v) {
            $psatgas = PenugasanSatgas::updateOrCreate(
                [
                    'id_satgas_ops' => $v['id_satgas_ops'],
                    'nama_satgas' => $v['nama_satgas'],
                    'nama_batalyon' => $v['nama_batalyon'],
                ],
                [
                    'dept_date' => $v['dept_date'],
                    'arrv_date' => $v['arrv_date'],
                ]
            );

            PenugasanPos::updateOrCreate(
                [
                    'id_tugas' => $psatgas->id_tugas,
                    'id_pos' => $v['id_pos'],
                ],
            );

            $jenis_satgas = $v['jenis_satgas'];
        }

        $request->session()->forget(['ps']);

        return redirect('dukkesops/rotasi-satgas/' . $jenis_satgas);
    }

    public function get_kat($id_tugas)
    {
        return PenugasanSatgasService::dataTable_kat($id_tugas);
    }

    public function field_batalyon(Request $request)
    {
        $html = '';


        if ($request->batalyon_check == 'ya') {

            $pos_satgas = PosSatgas::where('id_satgas_ops', $request->id_satgas_ops)->get();

            foreach ($pos_satgas as $k => $v) {
                $html .= '<div class="col-6">
                            <div class="form-group form-input">
                                <label class="form-label">Pos</label>
                                <input type="text" class="form-control" placeholder="Pos" value="' . $v->nama_pos . '" readonly/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group form-input">
                                <label class="form-label">Batalyon</label>
                                <input type="text" class="form-control" placeholder="Batalyon" name="nama_batalyon[' . $v->id_pos . ']" value="" required="" oninvalid="this.setCustomValidity(`Batalyon harus diisi.`)"/>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>';
            }
        } else if ($request->batalyon_check == 'tidak') {
            $html .= '<div class="col-12">
                        <div class="form-group form-input">
                            <label class="form-label">Batalyon</label>
                            <input type="text" class="form-control" placeholder="Batalyon" name="nama_batalyon" value=""/>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>';
        }


        return $html;
    }
}

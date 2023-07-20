<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\BekkesPenugasanRequest;
use App\Models\BekkesPenugasan;
use App\Models\DetailBekkesPenugasan;
use App\Models\MasterBekkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class BekkesPenugasanController extends Controller
{
    public function index($jenis_satgas)
    {
        $master_bekkes = MasterBekkes::select('nama_bekkes as data')->orderBy('urutan', 'asc')->get();
        $master_bekkes = $master_bekkes->map(function ($item) {
            $item->defaultContent = 0;
            return $item;
        });

        $data = [
            'active_menu' => 'bekkes_' . $jenis_satgas . '_dukkesops',
            'master_bekkes' => $master_bekkes
        ];

        return view('dukkesops.bekkes.satgas_new.index', $data);
    }

    public function create($jenis_satgas)
    {
        $data = [
            'active_menu' => 'bekkes_' . $jenis_satgas . '_dukkesops',
            'master_bekkes' => MasterBekkes::select('id_mas_bek', 'nama_bekkes')->get()
        ];
        return view('dukkesops.bekkes.satgas_new.create', $data);
    }

    public function store(BekkesPenugasanRequest $request)
    {
        DB::transaction(function () use ($request) {
            $bekkes_penugasan =  BekkesPenugasan::create($request->validated());

            if (isset($request->detail_bekkes_penugasan)) {
                foreach ($request->detail_bekkes_penugasan as $k => $v) {
                    DetailBekkesPenugasan::create([
                        'id_bekkes_penugasan' => $bekkes_penugasan->id_bekkes_penugasan,
                        'id_mas_bek' => $v['id_mas_bek'],
                        'jumlah' => $v['jumlah']
                    ]);
                }
            }
        });

        return response()->json([
            'error' => false,
            'message' => 'Bekkes Satgas Created!',
            'url' => url('dukkesops/bekkes-satgas/' . $request->jenis_satgas)
        ]);
    }

    public function show($id)
    {
        //
    }

    public function edit(BekkesPenugasan $bekkes_penugasan)
    {
        $data = [
            'active_menu' => 'bekkes_' . $bekkes_penugasan->jenis_satgas . '_dukkesops',
            'master_bekkes' => MasterBekkes::select('id_mas_bek', 'nama_bekkes')->get(),
            'bekkes_penugasan' => $bekkes_penugasan,
            'detail_bp' => DetailBekkesPenugasan::where('id_bekkes_penugasan', $bekkes_penugasan->id_bekkes_penugasan)->get()
        ];
        return view('dukkesops.bekkes.satgas_new.create', $data);
    }

    public function update(BekkesPenugasanRequest $request,  BekkesPenugasan $bekkes_penugasan)
    {
        DB::transaction(function () use ($request, $bekkes_penugasan) {
            $bekkes_penugasan->update($request->validated());
            DetailBekkesPenugasan::where('id_bekkes_penugasan', $bekkes_penugasan->id_bekkes_penugasan)->delete();

            if (isset($request->detail_bekkes_penugasan)) {
                foreach ($request->detail_bekkes_penugasan as $k => $v) {
                    DetailBekkesPenugasan::create([
                        'id_bekkes_penugasan' => $bekkes_penugasan->id_bekkes_penugasan,
                        'id_mas_bek' => $v['id_mas_bek'],
                        'jumlah' => $v['jumlah']
                    ]);
                }
            }
        });

        return response()->json([
            'error' => false,
            'message' => 'Bekkes Satgas Updated!',
            'url' => url('dukkesops/bekkes-satgas/' . $request->jenis_satgas)
        ]);
    }

    public function destroy(BekkesPenugasan $bekkes_penugasan)
    {
        $bekkes_penugasan->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'Bekkes Satgas Deleted!',
            'table' => '#dn'
        ]);
    }

    public function get(Request $request)
    {

        $year = date('Y');
        $bekkes_penugasan = BekkesPenugasan::where('jenis_satgas', $request->jenis_satgas);

        if ($request->tahun != null || $request->tahun != '') {
            if ($request->tahun != '*') {
                $bekkes_penugasan->when($request->tahun, function ($query) use ($request) {
                    return $query->where(DB::raw('YEAR(tgl_berangkat)'), $request->tahun);
                });
            }
        } else {
            $bekkes_penugasan->where(DB::raw('YEAR(tgl_berangkat)'), $year);
        }

        $bekkes_penugasan->get();

        $id_bp = $bekkes_penugasan->pluck('id_bekkes_penugasan')->toArray();
        $detail_bp = DetailBekkesPenugasan::with('master_bekkes')->whereIn('id_bekkes_penugasan', $id_bp)->get();

        foreach ($bekkes_penugasan as $index => $bp) {
            $detail = $detail_bp->where('id_bekkes_penugasan', $bp->id_bekkes_penugasan);
            foreach ($detail as $k => $v) {
                $bp[$v->master_bekkes->nama_bekkes] = $v->jumlah;
            }
        }

        return DataTables::of($bekkes_penugasan)
            ->addIndexColumn()
            ->editColumn('endemik', function ($r) {
                if ($r->endemik == 1) return 'Endemik';
                return 'Non Endemik';
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . url('dukkesops/bekkes-satgas/' . $row->id_bekkes_penugasan . '/edit') . "'><button title='Edit' class='btn text-primary p-0 pr-75'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_bekkes_penugasan . "' data-url='" . url('dukkesops/bekkes-satgas') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function download()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/excel_upload_bekkes_satgas.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        // $sheet->getProtection()->setSheet(true);
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get();
        $lastColumn = $sheet->getHighestColumn();
        $lastColumn++;
        $column = $lastColumn;
        foreach ($master_bekkes as $mb) {
            // $sheet->setCellValue($column . '1', $mb->nama_bekkes);
            $sheet->setCellValue($column . '1', $mb->id_mas_bek);
            $sheet->setCellValue($column . '2', $mb->nama_bekkes);
            $column++;
        }
        // $sheet->getStyle('A2:' . $column . '2')->getProtection()
        //     ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_PROTECTED);
        $sheet->getStyle('A1:' . $column . '1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $sheet->getStyle('D')
            ->getNumberFormat()
            ->setFormatCode(
                \PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDDSLASH
            );
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="bekkes_satgas.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function preview(Request $request)
    {
        $file = $request->file('file');
        $filename = date('YmdHis') . '.xlsx';
        $file->move(base_path() . '/uploads/', $filename);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(base_path() . '/uploads/' . $filename);

        unlink(base_path() . '/uploads/' . $filename);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get();
        $mb_length = count($master_bekkes);

        $bekkes_penugasan = [];

        for ($i = 2; $i < $count_rows; $i++) {

            $mb_data = [];

            $col = 7;
            for ($j = 0; $j < $mb_length; $j++) {
                $mb_data[$rows[0][$col]] = $rows[2][$col] ?? 0;
                $col++;
            }

            if ($rows[$i][1] != null) {
                $bekkes_penugasan[] = [
                    'nama_satgas' => $rows[$i][1],
                    'operasi' => $rows[$i][2],
                    'tgl_berangkat' => date('Y-m-d', strtotime($rows[$i][3])),
                    'jumlah_pers' => $rows[$i][4],
                    'endemik' => ($rows[$i][5] == 'e') ? 1 : 0,
                    'keterangan' => $rows[$i][6],
                    'jenis_satgas' => $request->jenis_satgas,
                    'mb_data' => $mb_data
                ];
            }
        }

        $request->session()->put('bekkes_penugasan', json_encode($bekkes_penugasan));

        return view('dukkesops.bekkes.satgas_new.preview', [
            'active_menu' => 'bekkes_dn_dukkesops',
            'bekkes_penugasan' => $bekkes_penugasan,
            'master_bekkes' => $master_bekkes,
            'jenis_satgas' => $request->jenis_satgas,
        ]);
    }

    public function import(Request $request)
    {
        DB::transaction(function () use ($request) {

            $bekkes_penugasan = json_decode($request->session()->get('bekkes_penugasan'), true);
            foreach ($bekkes_penugasan as $k => $v) {
                $bp = new BekkesPenugasan();
                $bp->nama_satgas = $v['nama_satgas'];
                $bp->operasi = $v['operasi'];
                $bp->tgl_berangkat = $v['tgl_berangkat'];
                $bp->jumlah_pers = $v['jumlah_pers'];
                $bp->endemik = $v['endemik'];
                $bp->keterangan = $v['keterangan'];
                $bp->jenis_satgas = $v['jenis_satgas'];
                $bp->save();

                foreach ($v['mb_data'] as $key => $value) {
                    $dbp = new DetailBekkesPenugasan();
                    $dbp->id_bekkes_penugasan = $bp->id_bekkes_penugasan;
                    $dbp->id_mas_bek = $key;
                    $dbp->jumlah = $value;
                    $dbp->save();
                }
            }
        });

        $request->session()->forget(['bekkes_penugasan']);

        return response()->json([
            'error' => false,
            'message' => 'Bekkes Satgas Created!',
            'url' => url('dukkesops/bekkes-satgas/' . $request->jenis_satgas)
        ]);
    }
}

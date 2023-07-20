<?php

namespace App\Services;

use App\Http\Requests\PenugasanSatgasRequest;
use App\Models\BekkesPenugasanPeta;
use App\Models\KegiatanDuk;
use App\Models\MasterBekkes;
use App\Models\PenugasanPos;
use App\Models\PenugasanSatgas;
use App\Models\PosSatgas;
use App\Models\SatgasOps;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class PenugasanSatgasService
{
    public static function store(PenugasanSatgasRequest $request): PenugasanSatgas
    {
        $satgas_ops = SatgasOps::findOrFail($request->id_satgas_ops);
        $satgas_ops = $satgas_ops->load('pos_satgas');


        $request_data = $request->validated();
        $request_data['nama_satgas'] = $satgas_ops->nama_kat_satgas;
        $request_data['tahun_anggaran'] = date('Y', strtotime($request->dept_date));

        $penugasan_satgas = DB::transaction(function () use ($request_data, $satgas_ops) {
            $penugasan_satgas = PenugasanSatgas::create($request_data);
            foreach ($satgas_ops->pos_satgas as $k => $v) {
                PenugasanPos::create([
                    'id_tugas' => $penugasan_satgas->id_tugas,
                    'id_pos' => $v->id_pos
                ]);
            }

            return $penugasan_satgas;
        });

        $penugasan_satgas->jenis_satgas = $satgas_ops->jenis_satgas;

        return $penugasan_satgas;
    }

    public static function store_multi_batalyon(PenugasanSatgasRequest $request): PenugasanSatgas
    {
        $satgas_ops = SatgasOps::findOrFail($request->id_satgas_ops);

        $penugasan_satgas = DB::transaction(function () use ($request, $satgas_ops) {
            foreach ($request->nama_batalyon as $k => $v) {

                $request_data = $request->validated();
                $request_data['nama_satgas'] = $satgas_ops->nama_kat_satgas;
                $request_data['nama_batalyon'] = $v;
                $request_data['tahun_anggaran'] = date('Y', strtotime($request->dept_date));

                $penugasan_satgas = PenugasanSatgas::create($request_data);

                PenugasanPos::create([
                    'id_tugas' => $penugasan_satgas->id_tugas,
                    'id_pos' => $k
                ]);
            }

            return $penugasan_satgas;
        });

        $penugasan_satgas->jenis_satgas = $satgas_ops->jenis_satgas;

        return $penugasan_satgas;
    }

    public static function dataTable(Request $request): JsonResponse
    {
        $year = date('Y');
        $penugasan_satgas = PenugasanSatgas::with('satgas_ops')->whereHas('satgas_ops', function (Builder $query) use ($request) {
            $query->where('jenis_satgas', $request->jenis_satgas);
        });

        if ($request->tahun != null || $request->tahun != '') {
            if ($request->tahun != '*') {
                $penugasan_satgas->when($request->tahun, function ($query) use ($request) {
                    return $query->where(DB::raw('YEAR(dept_date)'), $request->tahun);
                });
            }
        } else {
            $penugasan_satgas->where(DB::raw('YEAR(dept_date)'), $year);
        }

        $penugasan_satgas->get();

        return DataTables::of($penugasan_satgas)
            ->addIndexColumn()
            ->addColumn('arrv_date', function ($row) {
                $date_locale = Carbon::parse($row->arrv_date)->locale('id')->isoFormat('D MMMM YYYY');
                return "<div class='text-center'>" . $date_locale . "</div>";
            })
            ->addColumn('dept_date', function ($row) {
                $date_locale = Carbon::parse($row->dept_date)->locale('id')->isoFormat('D MMMM YYYY');
                return "<div class='text-center'>" . $date_locale . "</div>";
            })
            ->addColumn('action', function ($row) {

                return "<div class='text-center'><a href='" . url('dukkesops/rotasi-satgas/show/' . $row->id_tugas) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><a href='" . url('dukkesops/rotasi-satgas/edit/' . strtolower($row->satgas_ops->jenis_satgas) . '/' . $row->id_tugas) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_tugas . "' data-url='" . url('dukkesops/rotasi-satgas') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['arrv_date', 'dept_date', 'action'])
            ->toJson();
    }

    public static function destroy(PenugasanSatgas $penugasan_satgas): bool
    {
        $kegiatan_duk = KegiatanDuk::where('id_kat_duk', $penugasan_satgas->id_tugas)->first();
        if ($kegiatan_duk) throw new Exception('Ada data terkait ');

        return $penugasan_satgas->deleteOrFail();
    }

    public static function update(PenugasanSatgasRequest $request, PenugasanSatgas $penugasan_satgas): PenugasanSatgas
    {
        $satgas_ops = SatgasOps::findOrFail($request->id_satgas_ops);

        $request_data = $request->validated();

        $penugasan_satgas->update($request_data);
        $penugasan_satgas->jenis_satgas = $satgas_ops->jenis_satgas;
        return $penugasan_satgas;
    }

    public static function download_template($jenis_satgas, $tahun)
    {
        $jenis_satgas = strtolower($jenis_satgas);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/rotasi_satgas.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getProtection()->setSheet(true);

        $penugasan_pos = PenugasanPos::
            // with('pos_satgas')
            join('pos_satgas', 'pos_satgas.id_pos', '=', 'penugasan_pos.id_pos')
            ->join('penugasan_satgas', 'penugasan_satgas.id_tugas', '=', 'penugasan_pos.id_tugas')
            ->join('satgas_ops', 'satgas_ops.id_satgas_ops', '=', 'penugasan_satgas.id_satgas_ops')
            ->where('satgas_ops.jenis_satgas', $jenis_satgas)
            // ->groupBy('id_pos')
            ->whereYear('dept_date', $tahun)
            ->select('pos_satgas.nama_pos as nmpos', 'satgas_ops.nama_kat_satgas as nks', 'penugasan_satgas.nama_batalyon as nb', 'penugasan_satgas.arrv_date as ad', 'penugasan_satgas.dept_date as dd', 'pos_satgas.id_pos')
            ->get();

        $pos_satgas = PosSatgas::join('penugasan_satgas', 'penugasan_satgas.id_satgas_ops', '=', 'pos_satgas.id_satgas_ops')
            ->join('satgas_ops', 'satgas_ops.id_satgas_ops', '=', 'penugasan_satgas.id_satgas_ops')
            ->where('satgas_ops.jenis_satgas', $jenis_satgas)
            ->whereNotIn('id_pos', $penugasan_pos->pluck('id_pos')->toArray())

            ->groupBy('id_pos')
            ->select('pos_satgas.nama_pos as nmpos', 'satgas_ops.nama_kat_satgas as nks')
            ->get();
        $temp = array_merge($penugasan_pos->toArray(), $pos_satgas->toArray());
        $sheet->mergeCells('A1:D1');
        $sheet->setCellValue('A1', 'Jadwal Rotasi Satgas Tahun Anggaran '. $tahun);

        $i = 3;
        foreach ($temp as $so) {
            $i++;
            $sheet->setCellValue('A' . $i, $so['nks']);
            $sheet->setCellValue('B' . $i, $so['nmpos']);
            $sheet->setCellValue('C' . $i, isset($so['nb']) ? $so['nb'] : '');
            $sheet->setCellValue('D' . $i, isset($so['dd']) ? $so['dd'] : '');
            $sheet->setCellValue('E' . $i, isset($so['ad']) ? $so['ad'] : '');
        }

        // return 
        $sheet->getStyle('B4:E' . $i)->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="rotasi_satgas.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public static function dataTable_kat($id_tugas): JsonResponse
    {
        $penugasan_pos = PenugasanPos::with('pos_satgas:id_pos,nama_pos')->where('id_tugas', $id_tugas)->get();

        foreach ($penugasan_pos as $k => $pp) {
            $bpp = BekkesPenugasanPeta::with('master_bekkes')->where('id_penugasan_pos', $pp->id_penugasan_pos)->get();
            foreach ($bpp as  $b) {
                $pp[$b->master_bekkes->nama_bekkes] = $b->jumlah;
            }
        }

        return DataTables::of($penugasan_pos)
            ->addIndexColumn()
            ->addColumn('nama_pos', function ($row) {
                return $row->pos_satgas->nama_pos ?? '-';
            })
            ->addColumn('action', function ($row) {

                return "<div class='text-center'>
                            <a href='" . url('dukkesops/penugasan-pos/detail-personil/' . $row->id_penugasan_pos) . "'>
                                <button title='Personil' class='btn text-primary p-0 pr-50'><i data-feather='user' class='font-medium-4'></i></button>
                            </a>
                            <a href='" . url('dukkesops/penugasan-pos/' . $row->id_penugasan_pos . '/edit') . "'>
                                <button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button>
                            </a>
                            <button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_penugasan_pos . "' data-url='" . url('dukkesops/penugasan-pos') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}

<?php

namespace App\Services;

use App\Http\Requests\PenugasanPosRequest;
use App\Models\BekkesPenugasanPeta;
use App\Models\DetailAnggota;
use App\Models\MasterBekkes;
use App\Models\PenugasanPos;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class PenugasanPosService
{
    public static function update(PenugasanPosRequest $request, PenugasanPos $penugasan_pos): PenugasanPos
    {
        DB::transaction(function () use ($penugasan_pos, $request) {
            $penugasan_pos->update($request->validated());

            BekkesPenugasanPeta::where('id_penugasan_pos', $penugasan_pos->id_penugasan_pos)->delete();

            foreach ($request->id_mas_bek as $k => $v) {
                BekkesPenugasanPeta::create([
                    'id_penugasan_pos' => $penugasan_pos->id_penugasan_pos,
                    'id_mas_bek' => $k,
                    'jumlah' => $v
                ]);
            }
        });

        return $penugasan_pos;
    }

    public static function download_template($penugasan_satgas): void
    {
        $master_bekkes = MasterBekkes::select('id_mas_bek', 'nama_bekkes')->get();

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/penugasan_pos.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getProtection()->setSheet(true);

        $col_kat = 3;
        $kat_range = range('E', 'Z');
        foreach ($master_bekkes as $k => $v) {
            $sheet->setCellValue($kat_range[$k] . $col_kat, $v->nama_bekkes);
        }

        $temp = [];
        $bekkes_penugasan_peta = BekkesPenugasanPeta::get();
        foreach ($bekkes_penugasan_peta as $key2 => $value2) {
            $temp[$value2->id_penugasan_pos][$value2->id_mas_bek] = $value2->jumlah;
        }

        $penugasan_pos = PenugasanPos::with('pos_satgas')->where('id_tugas', $penugasan_satgas->id_tugas)->get();

        $i = 3;
        foreach ($penugasan_pos as $key => $p) {
            $i++;
            $sheet->setCellValue('A' . $i, $p->pos_satgas->nama_pos);
            $sheet->setCellValue('B' . $i, $p->nama_ketua);
            $sheet->setCellValue('C' . $i, $p->no_telp);
            $sheet->setCellValue('D' . $i, $p->jml_personil);
            foreach ($master_bekkes as $key1 => $value1) {
                $sheet->setCellValue($kat_range[$key1] . $i, $temp[$p->id_penugasan_pos][$value1->id_mas_bek] ?? 0);
            }
        }

        $sheet->getStyle('A4:' . $kat_range[count($master_bekkes) - 1] . '1000')->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="penugasan_pos.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public static function get_personil($id_penugasan_pos)
    {
        $detail_anggota = DetailAnggota::with('data_kegiatan_duk')->where('id_penugasan_pos', $id_penugasan_pos)->get();

        return DataTables::of($detail_anggota)
            ->addIndexColumn()
            ->addColumn('nama', function ($r) {
                return  $r->data_kegiatan_duk->nama;
            })
            ->addColumn('nrp_jabatan', function ($r) {
                return  $r->data_kegiatan_duk->nrp . '<br>' . $r->data_kegiatan_duk->jabatan;
            })
            ->addColumn('pangkat', function ($r) {
                return  $r->data_kegiatan_duk->pangkat;
            })
            ->addColumn('action', function ($row) {

                return "<div class='text-center'><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_detail_anggota . "' data-url='" . url('dukkesops/detail-anggota') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['nama', 'nrp_jabatan', 'pangkat', 'action'])
            ->toJson();
    }
}

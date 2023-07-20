<?php

namespace App\Services;

use App\Http\Requests\PosyanduRequest;
use App\Models\Posyandu;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PosyanduService
{
    public static function store(PosyanduRequest $request): Posyandu
    {
        return Posyandu::create($request->validated());
    }

    public static function dataTable()
    {
        $posyandu = Posyandu::with('matra')->get();
        return DataTables::of($posyandu)
            ->addIndexColumn()
            ->addColumn('satker', function ($row) {
                return $row->matra->nama_matra ?? '-';
            })
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><a type="button" class="text-primary pr-75" title="Edit" href="' . url('yankesin/posyandu/' . $row->id_posyandu . '/edit') . '"><i data-feather="edit" class="font-medium-4"></i></button></a><a title="Delete" type="button" data-id="' . $row->id_posyandu . '" data-url="' . url('yankesin/posyandu') . '" class="delete-data"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>';
            })
            ->rawColumns([
                'action',
                'satker'
            ])
            ->toJson();
    }

    public static function destroy(Posyandu $posyandu): bool
    {
        return $posyandu->deleteOrFail();
    }

    public static function update(PosyanduRequest $request, Posyandu $posyandu): Posyandu
    {
        $posyandu->update($request->validated());
        return $posyandu;
    }

    public static function download_template()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/posyandu.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getProtection()->setSheet(true);
        $sheet->getStyle('A4:J1000')->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="posyandu.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}

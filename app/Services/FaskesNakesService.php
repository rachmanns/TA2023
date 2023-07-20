<?php

namespace App\Services;

use App\Models\FaskesNakes;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Facades\DataTables;

class FaskesNakesService
{
    public static function dataTable_approve(): JsonResponse
    {
        $dokter = FaskesNakes::with('jenis_spesialis.kategori_dokter')->latest()->get();
        return DataTables::of($dokter)
            ->addColumn('kategori_dokter', function ($row) {
                return "<div class='text-center'>" . $row->jenis_spesialis->kategori_dokter->nama_kategori . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";
            })
            ->editColumn('nama_spesialis', function ($row) {
                return $row->jenis_spesialis->nama_spesialis;
            })
            ->addColumn('pangkat_korps', function ($row) {
                $pangkat_korps = $row->pangkat_korps ?? '-';
                return "<div class='text-center'> " . $pangkat_korps . " <br> " . $row->no_identitas . " </div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_dokter . "' data-url='" . url('bangkes/tenaga-medis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->addColumn('sebaran', function ($row) {
                $nama_rs = $row->rumah_sakit()->orderBy('created_at', 'desc')->first()->nama_rs;
                return $nama_rs;
            })
            ->rawColumns(['kategori_dokter', 'action', 'id_spesialis', 'pangkat_korps', 'sebaran'])
            ->toJson();
    }
}

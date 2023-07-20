<?php

namespace App\Services;

use App\Models\FaskesParamedis;
use Yajra\DataTables\Facades\DataTables;

class FaskesParamedisService
{
    public static function dataTable_approve()
    {
        $faskes_paramedis = FaskesParamedis::with('jenis_paramedis')->latest()->get();
        return DataTables::of($faskes_paramedis)
            ->addColumn('jenis_paramedis', function ($row) {
                return "<div class='text-center'>" . $row->jenis_paramedis->nama_jenis_paramedis . "<br> <div class='badge badge-light-success font-small-4 mt-50'>" . $row->klasifikasi . "</div></div>";
            })
            ->addColumn('sebaran', function ($row) {
                $nama_rs = $row->rumah_sakit()->orderBy('created_at', 'desc')->first()->nama_rs;
                return $nama_rs;
            })
            ->addColumn('pangkat', function ($row) {
                $pangkat = $row->pangkat ?? '-';
                return "<div class='text-center'> " . $pangkat . " <br> " . $row->no_identitas . " </div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.paramedis.edit', $row->id_paramedis) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_paramedis . "' data-url='" . url('bangkes/paramedis') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['jenis_paramedis', 'action', 'id_spesialis', 'pangkat'])
            ->toJson();
    }
}

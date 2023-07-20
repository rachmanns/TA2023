<?php

namespace App\Services;

use App\Http\Requests\CicilanRequest;
use App\Http\Requests\HutangRequest;
use App\Models\Cicilan;
use App\Models\Hutang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HutangService
{
    public static function store(HutangRequest $request): Hutang
    {
        return Hutang::create($request->validated());
    }

    public static function dataTable(Request $request): JsonResponse
    {
        $hutang = Hutang::get();
        return DataTables::of($hutang)
            ->addIndexColumn()
            ->addColumn('sisa', function ($row) {
                return $row->jml_tagihan - $row->jml_bayar;
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . url('bidum/anggaran/hutang/' . $row->id_hutang) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><a href='" . url('bidum/anggaran/hutang/' . $row->id_hutang . '/edit') . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' data-id='" . $row->id_hutang . "' data-url='" . url('bidum/anggaran/hutang') . "' class='delete-data btn p-0'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action', 'sisa'])
            ->toJson();
    }

    public static function update(HutangRequest $request, Hutang $hutang): Hutang
    {
        $hutang->update($request->validated());
        return $hutang;
    }

    public static function destroy(Hutang $hutang): bool
    {
        return $hutang->deleteOrFail();
    }

    public static function store_cicilan(CicilanRequest $request): Cicilan
    {
        $requestData = $request->validated();
        $requestData['bukti_bayar'] = $request->bukti_bayar->store('cicilan');

        return Cicilan::create($requestData);
    }

    public static function dataTable_cicilan($id_hutang)
    {
        $cicilan = Cicilan::with('hutang')->where('id_hutang', $id_hutang)->orderBy('created_at', 'asc')->get();
        return DataTables::of($cicilan)
            ->addIndexColumn()
            ->addColumn('jml_bayar', function ($row) {
                return 'Rp' . indonesian_money_format($row->jml_bayar);
            })
            ->addColumn('tgl_bayar', function ($row) {
                return indonesian_date_format($row->tgl_bayar);
            })
            ->addColumn('bukti_bayar', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->bukti_bayar) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Bukti Bayar</u></a></div>";
            })
            ->addColumn('action', function ($row) {

                return "<div class='text-center'><a data-id='" . $row->id_cicilan . "' onclick='edit_cicilan($(this))'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_cicilan . "' data-url='" . url('bidum/anggaran/cicilan') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action', 'jml_bayar', 'tgl_bayar', 'bukti_bayar'])
            ->toJson();
    }

    public static function destroy_cicilan(Cicilan $cicilan): bool
    {
        return $cicilan->deleteOrFail();
    }

    public static function update_cicilan(CicilanRequest $request, Cicilan $cicilan): Cicilan
    {
        $request_data = $request->validated();
        if ($request->bukti_bayar != null) $request_data['bukti_bayar'] = $request->bukti_bayar->store('cicilan');

        $cicilan->update($request_data);
        return $cicilan;
    }

    public static function status_hutang($id_hutang)
    {
        $hutang = Hutang::select('id_hutang', 'jml_tagihan')->with('latest_cicilan:id_cicilan,id_hutang,tgl_bayar')->withSum('cicilan as cicilan_bayar', 'jml_bayar')->where('id_hutang', $id_hutang)->first();
        $hutang->sisa_tagihan = $hutang->jml_tagihan - $hutang->cicilan_bayar;

        if ($hutang->sisa_tagihan <= 0) $hutang->status = 'Lunas';
        else $hutang->status = 'Belum Lunas';

        $hutang->sisa_tagihan = indonesian_money_format($hutang->sisa_tagihan);
        $hutang->tgl_lunas = indonesian_date_format($hutang->latest_cicilan->tgl_bayar);

        return $hutang;
    }
}

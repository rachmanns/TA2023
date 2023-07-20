<?php

namespace App\Services;

use App\Http\Requests\PelatihanBangkesRequest;
use App\Models\JenisPelatihan;
use App\Models\PelatihanBangkes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PelatihanBangkesService
{
    public static function store(PelatihanBangkesRequest $request): PelatihanBangkes
    {
        return PelatihanBangkes::create($request->validated());
    }

    public static function dataTable(Request $request): JsonResponse
    {
        $pelatihan_bangkes = PelatihanBangkes::with('jenis_pelatihan')->when($request->tahun, function ($q) use ($request) {
            return $q->whereYear('tgl_pelaksanaan', $request->tahun);
        })->latest()->get();
        return DataTables::of($pelatihan_bangkes)
            ->editColumn('tgl_pelaksanaan', function ($row) {
                return indonesian_date_format($row->tgl_pelaksanaan);
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.pelatihan.show', $row->id_pelatihan_bangkes) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><a href='" . route('bangkes.pelatihan.edit', $row->id_pelatihan_bangkes) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0'  data-id='" . $row->id_pelatihan_bangkes . "' data-url='" . url('bangkes/pelatihan') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function update(PelatihanBangkesRequest $request, PelatihanBangkes $pelatihan_bangkes): PelatihanBangkes
    {
        $pelatihan_bangkes->update($request->validated());
        return $pelatihan_bangkes;
    }

    public static function destroy(PelatihanBangkes $pelatihan_bangkes): Bool
    {
        return $pelatihan_bangkes->deleteOrFail();
    }

    public static function get_count_jenis_pelatihan(): int
    {
        return PelatihanBangkes::join('jenis_pelatihan', 'pelatihan_bangkes.id_jenis_pelatihan', '=', 'jenis_pelatihan.id_jenis_pelatihan')
            ->select('jenis_pelatihan.nama_pelatihan')
            ->distinct()
            ->get()
            ->count();
    }
}

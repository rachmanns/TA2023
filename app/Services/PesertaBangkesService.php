<?php

namespace App\Services;

use App\Http\Requests\PesertaBangkesRequest;
use App\Models\JenisPelatihan;
use App\Models\PesertaBangkes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PesertaBangkesService
{
    public static function store(PesertaBangkesRequest $request): PesertaBangkes
    {
        return PesertaBangkes::create($request->validated());
    }

    public static function dataTable(Request $request): JsonResponse
    {
        $peserta_bangkes = PesertaBangkes::where('id_pelatihan_bangkes', $request->id_pelatihan_bangkes)->latest()->get();
        return DataTables::of($peserta_bangkes)
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . url('bangkes/peserta/edit/' . $row->id_pelatihan_bangkes . '/' . $row->id_peserta_bangkes) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_peserta_bangkes . "' data-url='" . url('bangkes/peserta') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function update(PesertaBangkesRequest $request, PesertaBangkes $peserta_bangkes): PesertaBangkes
    {
        $peserta_bangkes->update($request->validated());
        return $peserta_bangkes;
    }

    public static function destroy(PesertaBangkes $peserta_bangkes): Bool
    {
        return $peserta_bangkes->deleteOrFail();
    }

    public static function peserta_bangkes_chart_by_jenis(): array
    {
        $jenis_pelatihan = PesertaBangkes::join('pelatihan_bangkes', 'peserta_bangkes.id_pelatihan_bangkes', '=', 'pelatihan_bangkes.id_pelatihan_bangkes')
            ->join('jenis_pelatihan', 'pelatihan_bangkes.id_jenis_pelatihan', '=', 'jenis_pelatihan.id_jenis_pelatihan')
            ->select('jenis_pelatihan.nama_pelatihan', DB::raw('count(*) as total'))
            ->groupBy('jenis_pelatihan.nama_pelatihan')
            ->get();

        $data = [];
        $total = 0;
        $return = [];
        foreach ($jenis_pelatihan as $key => $value) {
            $data[] = ['label' => $value['nama_pelatihan'], 'value' => $value['total']];
            $total += $value['total'];
        }
        $return['total'] = $total;
        $return['data'] = $data;
        return $return;
    }

    public static function peserta_bangkes_chart_by_matra(): array
    {
        $peserta_bangkes = PesertaBangkes::select('matra', DB::raw('count(*) as total'))
            ->groupBy('matra')
            ->get();

        $data = [];
        $total = 0;
        $return = [];
        foreach ($peserta_bangkes as $key => $value) {
            $data[] = ['label'=>$value->matra, 'value'=>$value->total];
            $total += $value['total'];
        }
        $return['total'] = $total;
        $return['data'] = $data;
        return $return;
    }
}

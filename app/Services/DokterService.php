<?php

namespace App\Services;

use App\Models\Dokter;
use App\Models\FaskesNakes;
use App\Models\KategoriDokter;
use App\Models\PraktekD;
use App\Models\RumahSakit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DokterService
{
    public static function approve_dokter(Request $request): Dokter
    {
        $faskes_nakes = FaskesNakes::get();

        foreach ($request->checked_dokter as $key => $value) {
            $fn = $faskes_nakes->where('id_dokter', $value)->first();
            $dokter = new Dokter($fn->toArray());
            $dokter->id_dokter = $fn->id_dokter;

            DB::transaction(function () use ($dokter, $fn, $request) {
                $dokter->save();

                PraktekD::where('id_dokter', $fn->id_dokter)->update(['status' => $request->status_dokter]);

                $fn->delete();
            });
        }
        return $dokter;
    }

    public static function dokter_chart_by_kategori(): array
    {
        $kategori_dokter = KategoriDokter::with(['dokter' => function ($query) {
            return $query->groupBy('id_dokter');
        }])->get();

        $data = [];
        foreach ($kategori_dokter as $key => $value) {
            $data['label'][] = ['label'=>$value->nama_kategori];
            $data['data'][] = ['value'=>$value->dokter->count()]; 
        }
        return $data;
    }

    public static function count_dokter(): int
    {
        return Dokter::count();
    }

    public static function count_dokter_by_rs()
    {
        $rumah_sakit = DB::table('rs')
            ->select('rs.jenis_rs', DB::raw('COUNT(dokter.id_dokter) as total_dokter'))
            ->leftJoin('praktek_d', 'praktek_d.id_rs', '=', 'rs.id_rs')
            ->leftJoin('dokter', 'dokter.id_dokter', '=', 'praktek_d.id_dokter')
            ->groupBy('rs.jenis_rs')
            ->get();

        $data=[];
        foreach ($rumah_sakit as $k => $v) {
            // $jenis_rs = $v->jenis_rs;
            // if ($v->jenis_rs ==='FKTL RSS') {
            //     $jenis_rs = 'FKTL OPS';
            // }
            
            $data[] = ['label'=>$v->jenis_rs, 'value'=>$v->total_dokter];      
        }            
        return $data;
    }
}

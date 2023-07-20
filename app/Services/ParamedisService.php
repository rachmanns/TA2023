<?php

namespace App\Services;

use App\Models\FaskesParamedis;
use App\Models\JenisParamedis;
use App\Models\Paramedis;
use App\Models\PraktekP;
use App\Models\RumahSakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParamedisService
{
    public static function approve_paramedis(Request $request): Paramedis
    {
        $faskes_paramedis = FaskesParamedis::get();

        foreach ($request->checked_paramedis as $key => $value) {
            $fp = $faskes_paramedis->where('id_paramedis', $value)->first();
            $paramedis = new Paramedis($fp->toArray());
            $paramedis->id_paramedis = $fp->id_paramedis;

            DB::transaction(function () use ($paramedis, $fp, $request) {
                $paramedis->save();

                PraktekP::where('id_paramedis', $fp->id_paramedis)->update(['status' => $request->status_paramedis]);

                $fp->delete();
            });
        }
        return $paramedis;
    }

    public static function count_paramedis(): int
    {
        return Paramedis::count();
    }

    public static function paramedis_chart_by_jenis(): array
    {
        $jenis_paramedis = JenisParamedis::withCount('paramedis')->get();

        $data = [];
        foreach ($jenis_paramedis as $key => $value) {
            $data['label'][] = ['label'=>$value->nama_jenis_paramedis];
            $data['data'][] = ['value'=>$value->paramedis_count]; 
        }
        return $data;
    }

    public static function count_paramedis_by_rs(): array
    {
        $rumah_sakit = DB::table('rs')
            ->select('rs.jenis_rs', DB::raw('COUNT(paramedis.id_paramedis) as total_paramedis'))
            ->leftJoin('praktek_p', 'praktek_p.id_rs', '=', 'rs.id_rs')
            ->leftJoin('paramedis', 'paramedis.id_paramedis', '=', 'praktek_p.id_paramedis')
            ->groupBy('rs.jenis_rs')
            ->get();

        $data=[];
        foreach ($rumah_sakit as $k => $v) {
            // $jenis_rs = $v->jenis_rs;
            // if ($v->jenis_rs ==='FKTL RSS') {
            //     $jenis_rs = 'FKTL OPS';
            // }
            
            $data[] = ['label'=>$v->jenis_rs, 'value'=>$v->total_paramedis];      
        }            
        return $data;
    }
}

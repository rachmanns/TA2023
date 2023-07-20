<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Models\PenugasanSatgas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CalendarDukkesController extends Controller
{
    public function index($type, $year = null)
    {   
        $month=[
            1=>"Januari",
            2=>"Februari",
            3=>"Maret",
            4=>"April",
            5=>"Mei",
            6=>"Juni",
            7=>"Juli",
            8=>"Agustus",
            9=>"September",
            10=>"Oktober",
            11=>"November",
            12=>"Desember"
        ];
        
        $year_current = $year ?? date("Y");

        $data = PenugasanSatgas::where("tahun_anggaran", $year_current)->whereHas("satgas_ops", function (Builder $query) use($type){

            $query->where('jenis_satgas',strtoupper( $type));

        })->with("pos_satgas:id_pos,latitude,longitude")->groupBy('nama_satgas', 'nama_batalyon')->get();

        $return = [
            "berangkat" => [],
            "pulang" => []
        ];

        foreach ($data as $key => $val) {

            if ($val->dept_date) {
               
                $date = $this->week_number($val->dept_date);
                $return[$date["month"]][$date["week"]]["berangkat"][$val->nama_satgas][] = $val;
                ksort($return[$date["month"]],1);
                unset($date);

            }


            if ($val->arrv_date) {

                $date = $this->week_number($val->arrv_date);
                $return[$date["month"]][$date["week"]]["pulang"][$val->nama_satgas][] = $val;
                ksort($return[$date["month"]],1);
                unset($date);

            }

        }
        $active_menu='kalender_'.$type;
        // return $return;
        return view('dukkesops.kalender_ops.kalender', compact('active_menu','return','type','year_current','month'));
    }

    function week_number($date = 'today')
    {
        return array(
            "week"=>date('d M Y', strtotime($date)),
            "month"=>(int)date("m",strtotime($date))
        );
    }
}

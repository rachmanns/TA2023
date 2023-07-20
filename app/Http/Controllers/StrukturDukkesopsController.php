<?php

namespace App\Http\Controllers;

use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturDukkesopsController extends Controller
{
    public function index()
    {
        $kabid = Personil::where('nrp', 11960012240969)->first()->foto ?? null;
        $kom1 = Personil::where('nrp', 98925)->first()->foto ?? null;
        $kom2 = Personil::where('nrp', 21080865350988)->first()->foto ?? null;
        $tamudi = Personil::where('nrp', 31060139680685)->first()->foto ?? null;
        $siapdukkes = Personil::where('nrp', 11990016500474)->first()->foto ?? null;
        $rikujikes = Personil::where('nrp', 11000000800370)->first()->foto ?? null;
        $rikkes = Personil::where('nrp', 11080100651183)->first()->foto ?? null;
        $kode=base64_encode("DUKKESOP");

        // $ujikes = Personil::where('nrp', 21970218230677)->first()->foto ?? null;
        return view('struktur_organisasi', [
            'active_menu' => 'struktur_organisasi_dukkesops',
            'kabid' => $kabid,
            'kom1' => $kom1,
            'kom2' => $kom2,
            'tamudi' => $tamudi,
            'siapdukkes' => $siapdukkes,
            'rikujikes' => $rikujikes,
            'rikkes' => $rikkes,
            'kode'=>$kode

            // 'ujikes' => $ujikes,
        ]);
    }
}

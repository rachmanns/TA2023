<?php

namespace App\Http\Controllers;
use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturLavibiovakController extends Controller
{
    public function index()
    {
        $kalavi = Personil::where('nrp', 513108)->first()->foto ?? null;
        $oprkomp = Personil::where('nrp', 3930439300872)->first()->foto ?? null;
        $kasubbiddalprod = Personil::where('nrp', 15144)->first()->foto ?? null;
        $kabidrendal = Personil::where('nrp', 11783)->first()->foto ?? null;
        $kasubbiddaldia = Personil::where('nrp', 11317)->first()->foto ?? null;
        $kabagrengar = Personil::where('nrp', 522928)->first()->foto ?? null;
        $kode=base64_encode("LAFIBIOVAK");

        return view('struktur_organisasi', [
            'active_menu' => 'struktur_organisasi_lafi',
            'kalavi' => $kalavi,
            'oprkomp' => $oprkomp,
            'kasubbiddalprod' => $kasubbiddalprod,
            'kabidrendal' => $kabidrendal,
            'kasubbiddaldia' => $kasubbiddaldia,
            'kabagrengar' => $kabagrengar,
            'kode'=>$kode

        ]);
    }
}

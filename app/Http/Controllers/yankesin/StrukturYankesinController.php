<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturYankesinController extends Controller
{
    public function index()
    {
        $active_menu = 'struktur_organisasi_yankesin';
        $kabidyankesin = Personil::where('nrp', 10836)->first()->foto ?? null;
        $kasubbidkeskurehab = Personil::where('nrp', 13175)->first()->foto ?? null;
        $kasikesnubika = Personil::where('nrp', 2920028470771)->first()->foto ?? null;
        $kasubbidkesprev = Personil::where('nrp', 12797)->first()->foto ?? null;
        $kaurkeskurehab = Personil::where('nrp', 19710011994032002)->first()->foto ?? null;
        $baturkomp1 = Personil::where('nrp', 21080728400588)->first()->foto ?? null;
        $tamudi = Personil::where('nrp', 539845)->first()->foto ?? null;
        $kode=base64_encode("YANKESIN");

        return view('struktur_organisasi', compact('active_menu', 'kabidyankesin', 'kasubbidkesprev', 'kaurkeskurehab', 'kasubbidkeskurehab', 'kasikesnubika', 'baturkomp1', 'tamudi','kode'));
    }
}

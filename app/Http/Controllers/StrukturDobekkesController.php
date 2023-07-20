<?php

namespace App\Http\Controllers;
use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturDobekkesController extends Controller
{
    public function index()
    {
        $kadobek = Personil::where('nrp', 524545)->first()->foto ?? null;
        $paurmin = Personil::where('nrp', 21980350460677)->first()->foto ?? null;
        $kabag = Personil::where('nrp', 14101)->first()->foto ?? null;
        $kasibat = Personil::where('nrp', 596513)->first()->foto ?? null;
        $kasialkes = Personil::where('nrp', 196804071989032001)->first()->foto ?? null;
        $kaurtran = Personil::where('nrp', 196712011991031001)->first()->foto ?? null;
        $kaurbat = Personil::where('nrp', 196901281991032001)->first()->foto ?? null;
        $kaurmatum = Personil::where('nrp', 197408161994031003)->first()->foto ?? null;
        $kode=base64_encode("DOBEKKES");

        return view('struktur_organisasi', [
            'active_menu' => 'struktur_organisasi_dobekkes',
            'kadobek' => $kadobek,
            'paurmin' => $paurmin,
            'kabag' => $kabag,
            'kasibat' => $kasibat,
            'kasialkes' => $kasialkes,
            'kaurtran' => $kaurtran,
            'kaurbat' => $kaurbat,
            'kaurmatum' => $kaurmatum,
            'kode'=>$kode

        ]);
    }
}

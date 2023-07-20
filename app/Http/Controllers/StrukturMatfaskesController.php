<?php

namespace App\Http\Controllers;
use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturMatfaskesController extends Controller
{
    public function index()
    {
        $kabid = Personil::where('nrp', 10455)->first()->foto ?? null;
        $kadalada = Personil::where('nrp', 11867)->first()->foto ?? null;
        $kadaldisi = Personil::where('nrp', 622223)->first()->foto ?? null;
        $kaurrenada = Personil::where('nrp', 197204111994022001)->first()->foto ?? null;
        $kaurdalada = Personil::where('nrp', 197201041999031006)->first()->foto ?? null;
        $kode=base64_encode("MATFASKES");

        return view('struktur_organisasi', [
            'active_menu' => 'struktur_organisasi_matfaskes',
            'kabid' => $kabid,
            'kadalada' => $kadalada,
            'kadaldisi' => $kadaldisi,
            'kaurrenada' => $kaurrenada,
            'kaurdalada' => $kaurdalada,
            'kode'=>$kode

        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Personil;
use Illuminate\Http\Request;

class StrukturKermabaktikesController extends Controller
{
    public function index()
    {
        $kaunit = Personil::where('nrp', 13690)->first()->foto ?? null;
        $kasibakti = Personil::where('nrp', 18079)->first()->foto ?? null;
        $opkom = Personil::where('nrp', 31000792470579)->first()->foto ?? null;
        $kode=base64_encode("KERMABAKTIKES");

        return view('struktur_organisasi', [
            'active_menu' => 'struktur_organisasi_kerma',
            'kaunit' => $kaunit,
            'kasibakti' => $kasibakti,
            'opkom' => $opkom,
            'kode'=>$kode

        ]);
    }
}

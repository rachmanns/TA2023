<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StrukturOrganisasiLogistikController extends Controller
{
    public function index()
    {
        $active_menu = 'struktur_bidlog';
        return view('bidum.logistik.struktur_organisasi', compact('active_menu'));
    }
}

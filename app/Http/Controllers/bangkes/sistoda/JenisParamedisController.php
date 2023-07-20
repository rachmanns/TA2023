<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JenisParamedisController extends Controller
{
    public function index()
    {
        return view('bangkes.master_data.spesialis.jenis_paramedis.index', ['active_menu' => 'jp']);
    }

    public function create()
    {
        return view('bangkes.master_data.spesialis.jenis_paramedis.create', ['active_menu' => 'jp']);
    }
}

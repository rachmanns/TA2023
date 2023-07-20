<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpesialisController extends Controller
{
    public function index()
    {
        return view('bangkes.master_data.spesialis.index', ['active_menu' => 'spesialis']);
    }
}

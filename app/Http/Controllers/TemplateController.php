<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function detail_barang()
    {
        $pathToFile = public_path('templates/detail_barang.xlsx');
        return response()->file($pathToFile);
    }

    public function pagu_awal()
    {
        $pathToFile = public_path('templates/pagu_awal.xlsx');
        return response()->file($pathToFile);
    }

    public function pendidikan_dukkesops()
    {
        $pathToFile = public_path('templates/template_pendidikan.xlsx');
        return response()->file($pathToFile);
    }

    public function werving_dukkesops()
    {
        $pathToFile = public_path('templates/template_werving.xlsx');
        return response()->file($pathToFile);
    }

    public function satgas_dukkesops()
    {
        $pathToFile = public_path('templates/template_satgas.xlsx');
        return response()->file($pathToFile);
    }

    public function detail_bekkes()
    {
        $pathToFile = public_path('templates/detail_bekkes.xlsx');
        return response()->file($pathToFile);
    }
}

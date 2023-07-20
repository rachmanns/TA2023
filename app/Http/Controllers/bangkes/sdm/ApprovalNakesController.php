<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Services\DokterService;
use App\Services\FaskesNakesService;
use App\Services\FaskesParamedisService;
use App\Services\ParamedisService;
use Illuminate\Http\Request;

class ApprovalNakesController extends Controller
{
    public function index()
    {
        $active_menu = 'approval';
        return view('bangkes.subbid_sdm.approval.index', compact('active_menu'));
    }

    public function get_dokter()
    {
        return FaskesNakesService::dataTable_approve();
    }

    public function get_paramedis()
    {
        return FaskesParamedisService::dataTable_approve();
    }

    public function approve_dokter(Request $request)
    {
        return DokterService::approve_dokter($request);
    }

    public function approve_paramedis(Request $request)
    {
        return ParamedisService::approve_paramedis($request);
    }
}

<?php

namespace App\Http\Controllers\dukkesops\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\MasterBekkesRequest;
use App\Models\MasterBekkes;
use App\Services\MasterBekkesService;
use Illuminate\Http\Request;

class MasterBekkesController extends Controller
{
    public function index()
    {
        $active_menu = 'master_bekkes';
        return view('dukkesops.master_bekkes.index', compact(
            'active_menu'
        ));
    }

    public function get()
    {
        return MasterBekkesService::dataTable();
    }

    public function show(MasterBekkes $master_bekkes)
    {
        return $master_bekkes;
    }

    public function store(MasterBekkesRequest $request)
    {
        MasterBekkesService::store($request);

        return response()->json([
            'error' => false,
            'message' => 'MasterBekkes Created!',
            'modal' => '#mb',
            'table' => '#master_bekkes'
        ]);
    }

    public function update(MasterBekkesRequest $request, MasterBekkes $master_bekkes)
    {
        MasterBekkesService::update($request, $master_bekkes);

        return response()->json([
            'error' => false,
            'message' => 'MasterBekkes Updated!',
            'modal' => '#mb',
            'table' => '#master_bekkes'
        ]);
    }

    public function destroy(MasterBekkes $master_bekkes)
    {
        MasterBekkesService::destroy($master_bekkes);

        return response()->json([
            'error' => false,
            'message' => 'MasterBekkes Delete!',
            'modal' => '#mb',
            'table' => '#master_bekkes'
        ]);
    }

    public function update_urutan(Request $request)
    {
        return MasterBekkesService::update_urutan($request);
    }
}

<?php

namespace App\Http\Controllers\bidum\anggaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\CicilanRequest;
use App\Http\Requests\HutangRequest;
use App\Models\Cicilan;
use App\Models\Hutang;
use App\Services\HutangService;
use Illuminate\Http\Request;

class HutangController extends Controller
{
    public function index()
    {
        $active_menu = 'hutang';
        return view('bidum.anggaran.hutang.index', compact(
            'active_menu'
        ));
    }

    public function create()
    {
        $active_menu = 'hutang';
        $button = 'Tambah Hutang';
        return view('bidum.anggaran.hutang.create', compact(
            'active_menu',
            'button'
        ));
    }

    public function store(HutangRequest $request)
    {
        HutangService::store($request);
        return response()->json([
            'error' => false,
            'message' => 'Hutang Created',
            'url' => url('bidum/anggaran/hutang')
        ]);
    }

    public function get(Request $request)
    {
        return HutangService::dataTable($request);
    }

    public function edit(Hutang $hutang)
    {
        $active_menu = 'hutang';
        $button = 'Edit Hutang';
        return view('bidum.anggaran.hutang.create', compact(
            'active_menu',
            'hutang',
            'button'
        ));
    }

    public function update(HutangRequest $request, Hutang $hutang)
    {
        HutangService::update($request, $hutang);
        return response()->json([
            'error' => false,
            'message' => 'Hutang Updated',
            'url' => url('bidum/anggaran/hutang')
        ]);
    }

    public function destroy(Hutang $hutang)
    {
        HutangService::destroy($hutang);
        return response()->json([
            'error' => false,
            'message' => 'Hutang Deleted',
            'table' => '#table'
        ]);
    }

    public function show(Hutang $hutang)
    {
        $data = [
            'active_menu' => 'hutang',
            'hutang' => $hutang
        ];

        return view('bidum.anggaran.hutang.detail', $data);
    }

    public function store_cicilan(CicilanRequest $request)
    {
        HutangService::store_cicilan($request);
        return response()->json([
            'error' => false,
            'message' => 'Cicilan Created',
            'modal' => '#add',
            'status_hutang' => true,
            'table' => '#table'
        ]);
    }

    public function get_cicilan($id_hutang)
    {
        return HutangService::dataTable_cicilan($id_hutang);
    }

    public function destroy_cicilan(Cicilan $cicilan)
    {
        HutangService::destroy_cicilan($cicilan);
        return response()->json([
            'error' => false,
            'message' => 'Cicilan Deleted',
            'modal' => '#add',
            'status_hutang' => true,
            'table' => '#table'
        ]);
    }

    public function edit_cicilan(Cicilan $cicilan)
    {
        return $cicilan;
    }

    public function update_cicilan(CicilanRequest $request, Cicilan $cicilan)
    {
        HutangService::update_cicilan($request, $cicilan);
        return response()->json([
            'error' => false,
            'message' => 'Cicilan Updated',
            'modal' => '#add',
            'status_hutang' => true,
            'table' => '#table'
        ]);
    }

    public function status_hutang($id_hutang)
    {
        return HutangService::status_hutang($id_hutang);
    }
}

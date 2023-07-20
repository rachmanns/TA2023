<?php

namespace App\Http\Controllers\matfaskes;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataBekkesRequest;
use App\Models\DataBekkes;
use App\Models\MasterBekkes;
use App\Services\DataBekkesService;
use Illuminate\Http\Request;

class DataBekkesController extends Controller
{
    public function index()
    {
        $active_menu = 'daftar_bekkes';
        $master_bekkes = MasterBekkes::select('id_mas_bek', 'nama_bekkes')->get();

        return view('matfaskes.daftar_bekkes.index', compact(
            'active_menu',
            'master_bekkes'
        ));
    }

    public function store(DataBekkesRequest $request)
    {
        DataBekkesService::store($request);
        return response()->json([
            'error' => false,
            'message' => 'Daftar Bekkes Created!',
            'table' => '#table',
            'modal' => '#add'
        ]);
    }

    public function update(DataBekkesRequest $request, DataBekkes $data_bekkes)
    {
        DataBekkesService::update($request, $data_bekkes);
        return response()->json([
            'error' => false,
            'message' => 'Daftar Bekkes updated!',
            'table' => '#table',
            'modal' => '#edit'
        ]);
    }

    public function show(DataBekkes $data_bekkes)
    {
        $active_menu = 'daftar_bekkes';
        $data_bekkes = $data_bekkes->load('master_bekkes');
        return view('matfaskes.daftar_bekkes.detail', compact(
            'active_menu',
            'data_bekkes'
        ));
    }

    public function get(Request $request)
    {
        return DataBekkesService::dataTable($request);
    }

    public function update_foto(Request $request, DataBekkes $data_bekkes)
    {
        $validated = $request->validate([
            'foto' => 'required|mimes:jpg,bmp,png'
        ]);

        DataBekkesService::update_foto($request, $data_bekkes);
    }

    public function destroy(DataBekkes $data_bekkes)
    {
        DataBekkesService::destroy($data_bekkes);
        return response()->json([
            'error' => false,
            'message' => 'Daftar Bekkes Deleted!',
            'table' => '#table'
        ]);
    }

    public function preview(DataBekkesRequest $request)
    {

        $active_menu = 'daftar_bekkes';
        if ($request->detail_bekkes == null) {
            $this->store($request);
            return redirect('matfaskes/data-bekkes');
        }
        $data_bekkes = $request->validated();

        $path = public_path('matfaskes');
        $detail_bekkes = $request->file('detail_bekkes');
        $detail_bekkes_name =  $request->detail_bekkes->hashName();
        $detail_bekkes->move($path, $detail_bekkes_name);

        $request->session()->put('data_bekkes', json_encode($data_bekkes));

        $data_detail_bekkes = DataBekkesService::get_import_data($path, $detail_bekkes_name);

        $request->session()->put('data_detail_bekkes', json_encode($data_detail_bekkes));

        return view('matfaskes.daftar_bekkes.preview', compact('active_menu', 'data_detail_bekkes'));
    }

    public function store_import(Request $request)
    {
        DataBekkesService::store_import($request);
        return redirect('matfaskes/data-bekkes');
    }

    public function edit(DataBekkes $data_bekkes)
    {
        return $data_bekkes;
    }
}

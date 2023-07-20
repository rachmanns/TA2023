<?php

namespace App\Http\Controllers\bidum\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\KesatuanRequest;
use App\Models\Kesatuan;
use App\Models\Matra;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KesatuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'master_kesatuan';
        $matra = Matra::where('kode_matra', '<>', 'TNI')->get();
        return view('bidum.master.kesatuan.index', compact('matra', 'active_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KesatuanRequest $request)
    {
        try {
            $request_data = $request->validated();
            $request_data['kode_kesatuan'] = uniqid();
            Kesatuan::create($request_data);
            return response()->json([
                'error' => false,
                'message' => 'Kesatuan Created!',
                'modal' => '#create_kesatuan_modal',
                'table' => '#kesatuan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kesatuan $kesatuan)
    {
        return $kesatuan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KesatuanRequest $request, Kesatuan $kesatuan)
    {
        try {
            $kesatuan->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Kesatuan Updated!',
                'modal' => '#edit_kesatuan_modal',
                'table' => '#kesatuan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kesatuan $kesatuan)
    {
        try {
            $kesatuan->delete();
            return response()->json([
                'error' => false,
                'message' => 'Kesatuan Deleted!',
                'table' => '#kesatuan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function list()
    {
        $kesatuan = Kesatuan::all();
        return DataTables::of($kesatuan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_kesatuan . '" onclick="edit_kesatuan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_kesatuan . '" data-url="' . url('master/kesatuan/delete') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}

<?php

namespace App\Http\Controllers\dobekkes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AsetDobek;
use Yajra\DataTables\Facades\DataTables;

class AsetDobekController extends Controller
{
    public function index()
    {
        $data = AsetDobek::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <div class="text-center">
                    <button class="btn text-primary p-0 pr-50" title="Edit" data-id="' .  $row->id_aset . '" onclick="edit_aset($(this))"><i data-feather="edit" class="font-medium-4"></i></button>
                    <button title="Delete" class="btn p-0 delete-data" data-id="' . $row->id_aset . '" data-url="/dobekkes/aset-gudang"><i data-feather="trash" class="font-medium-4 text-danger"></i></button>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        $d = new AsetDobek;
        $d->nama_aset = $request->nama_aset;
        $d->jml_aset = $request->jml_aset;
        $d->satuan = $request->satuan;
        $d->keterangan = $request->keterangan;
        $d->save();

        return response()->json([
            "error" => false,
            "message" => "Aset berhasil disimpan",
        ]);
    }

    public function show($id)
    {
        $data = AsetDobek::find($id);
        if ($data) {
            return response()->json(["error" => false, "data" => $data]);
        } else {
            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function update(Request $request, $id)
    {
        $d = AsetDobek::find($id);
        $d->nama_aset = $request->nama_aset;
        $d->jml_aset = $request->jml_aset;
        $d->satuan = $request->satuan;
        $d->keterangan = $request->keterangan;
        $d->save();

        return response()->json([
            "error" => false,
            "message" => "Aset berhasil disimpan",
        ]);
    }

    public function destroy($id)
    {
        $d = AsetDobek::where('id_aset', $id)->delete();

        return response()->json([
            "error" => false,
            "message" => "Aset berhasil dihapus",
            'table' => '.aset-gudang',
        ]);
    }
}

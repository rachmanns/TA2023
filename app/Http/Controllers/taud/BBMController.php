<?php

namespace App\Http\Controllers\taud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\JenisBBM;
use App\Models\BBM;

class BBMController extends Controller
{
    public function index()
    {
        $jenis = JenisBBM::all();
        return view('taud.distribusi_bbm.index', ['active_menu' => 'taud', 'jenis' => $jenis]);
    }

    public function list(Request $request)
    {
        $data = BBM::with('jenis_bbm')->where('ta', $request->tahun ?? date('Y'))->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_bbm . "' onclick='edit_bbm($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' class='delete-data btn p-0' data-id='" . $row->id_bbm . "' data-url='/taud/bbm'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $d = new BBM;
        $d->periode = $request->tanggal;
        $d->id_jenis_bbm = $request->jenis;
        $d->ta = substr($request->tanggal, 0, 4);
        $d->jml_in = $request->jml;
        $d->jml_out = $request->operasional;
        $d->keterangan = $request->ket;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $data = BBM::find($id);
        if ($data) return response()->json(["error" => false, "data" => $data]);
        else return response()->json(["error" => true, "message" => "Data Not Found"]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $d = BBM::find($id);
        $d->periode = $request->tanggal;
        $d->id_jenis_bbm = $request->jenis;
        $d->ta = substr($request->tanggal, 0, 4);
        $d->jml_in = $request->jml;
        $d->jml_out = $request->operasional;
        $d->keterangan = $request->ket;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function destroy($id)
    {
        BBM::where('id_bbm', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "Data berhasil dihapus",
            'table' => '#taud',
        ]);
    }
}

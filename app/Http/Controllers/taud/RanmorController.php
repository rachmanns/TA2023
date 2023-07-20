<?php

namespace App\Http\Controllers\taud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Ranmor;

class RanmorController extends Controller
{
    public function index()
    {
        $jenis = ['Sedan', 'Minibus', 'Truck', 'Bus', 'Jeep', 'Sepeda Motor'];
        $data = Ranmor::selectRaw('DISTINCT(jenis_ranmor)')->get();
        foreach ($data as $d) {
            if (!in_array($d->jenis_ranmor, $jenis)) $jenis[] = $d->jenis_ranmor;
        }
        return view('taud.daftar_ranmor.index', ['active_menu' => 'ranmor', 'jenis' => $jenis]);
    }

    public function list(Request $request)
    {
        $data = Ranmor::orderBy('jenis_ranmor')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_ranmor . "' onclick='edit_ranmor($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' class='delete-data btn p-0' data-id='" . $row->id_ranmor . "' data-url='/taud/ranmor'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
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
        $d = new Ranmor;
        $d->jenis_ranmor = $request->jenis;
        $d->merk = $request->merk;
        $d->no_reg = $request->no_reg;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        $data = Ranmor::find($id);
        if ($data) return response()->json(["error" => false, "data" => $data]);
        else return response()->json(["error" => true, "message" => "Data Not Found"]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $d = Ranmor::find($id);
        $d->jenis_ranmor = $request->jenis;
        $d->merk = $request->merk;
        $d->no_reg = $request->no_reg;
        $d->save();
        return response()->json(["error" => false, "message" => 'Data berhasil disimpan']);
    }

    public function destroy($id)
    {
        Ranmor::where('id_ranmor', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "Data berhasil dihapus",
            'table' => '#ranmor',
        ]);
    }
}

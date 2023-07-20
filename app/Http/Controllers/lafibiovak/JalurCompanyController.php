<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\JalurCompany;

class JalurCompanyController extends Controller
{
    public function index()
    {
        return view('lafibiovak.jalur_company.index', ['active_menu' => 'data_jalur_company']);
    }

    public function list()
    {
        $data = JalurCompany::get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/jalur-company/" . $row->id_jalur_company . "/edit'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_jalur_company . "' data-url='/lafibiovak/jalur-company'><i data-feather='trash' class='font-medium-4 text-danger'></i></button> </div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('lafibiovak.jalur_company.create', ['active_menu' => 'data_jalur_company']);
    }

    public function store(Request $request)
    {
        $d = new JalurCompany;
        $d->nama_jalur = $request->nama;
        $d->alamat = $request->alamat;
        $d->latitude = $request->lat;
        $d->longitude = $request->lng;
        $d->jml_personil = $request->jmlp;
        $d->jml_mesin = $request->jmlm;
        $d->izin_opr = $request->izin;
        $d->cpob = $request->cpob;
        $d->sumber_puskes = $request->sumberp;
        $d->sumber_angkatan = $request->sumbera;
        if ($request->file('foto') !== null) {
            $file = $request->file('foto');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/jalur_company'), $filename);
            $d->foto = $filename;
        }
        $d->video = $request->video;
        $d->save();
        return response()->json(["error" => false, "message" => 'Jalur company berhasil disimpan']);
    }

    public function show(Request $request, $id)
    {
        $data = JalurCompany::find($id);
        if ($data) {
            return response()->json(["error" => false, "data" => $data]);
        } else {
            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function edit($id)
    {
        $d = JalurCompany::find($id);
        return view('lafibiovak.jalur_company.create', ['active_menu' => 'data_jalur_company', 'data' => $d]);
    }

    public function update($id, Request $request)
    {
        $d = JalurCompany::find($id);
        $d->nama_jalur = $request->nama;
        $d->alamat = $request->alamat;
        $d->latitude = $request->lat;
        $d->longitude = $request->lng;
        $d->jml_personil = $request->jmlp;
        $d->jml_mesin = $request->jmlm;
        $d->izin_opr = $request->izin;
        $d->cpob = $request->cpob;
        $d->sumber_puskes = $request->sumberp;
        $d->sumber_angkatan = $request->sumbera;
        if ($request->file('foto') !== null) {
            $file = $request->file('foto');
            $filename = rand() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/jalur_company'), $filename);
            $d->foto = $filename;
        }
        $d->video = $request->video;
        $d->save();
        return response()->json(["error" => false, "message" => 'Jalur company berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = JalurCompany::with('litbang')->find($id);
        if (count($d->litbang) > 0) return response()->json([
            "error" => false,
            "message" => "Jalur company tidak boleh dihapus",
        ]);
        $d->delete();
        return response()->json([
            "error" => false,
            "message" => "Jalur company berhasil dihapus",
            'table' => '#table',
        ]);
    }
}

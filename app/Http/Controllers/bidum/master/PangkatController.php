<?php

namespace App\Http\Controllers\bidum\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\PangkatRequest;
use App\Models\Matra;
use App\Models\Pangkat;
use App\Models\Personil;
use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PangkatController extends Controller
{
    public function index()
    {
        $active_menu = 'master_pangkat';
        $matra = Matra::whereIn('kode_matra', ['TNI', 'PNS'])->get();
        return view('bidum.master.pangkat.index', compact('matra', 'active_menu'));
    }

    public function store(PangkatRequest $request)
    {
        try {
            Pangkat::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Pangkat Created!',
                'modal' => '#create_pangkat_modal',
                'table' => '#pangkat-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(Pangkat $pangkat)
    {
        return $pangkat;
    }

    public function update(PangkatRequest $request, Pangkat $pangkat)
    {
        try {
            $pangkat->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Pangkat Updated!',
                'modal' => '#create_pangkat_modal',
                'table' => '#pangkat-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Pangkat $pangkat)
    {
        try {
            $personil = Personil::where('id_pangkat_terakhir', $pangkat->id_pangkat)->first();

            if ($personil) throw new \Exception("Cannot delete this data, please check personil first.");

            RiwayatPangkat::where('id_pangkat', $pangkat->id_pangkat)->delete();

            $pangkat->delete();
            return response()->json([
                'error' => false,
                'message' => 'Pangkat Deleted!',
                'table' => '#pangkat-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list()
    {
        $pangkat = Pangkat::with('parent')->get();
        return DataTables::of($pangkat)
            ->editColumn('next_pangkat', function ($query) {
                if (!empty($query->parent)) {
                    return $query->parent->nama_pangkat;
                }
            })
            ->editColumn('masa_kenkat', function ($query) {
                if ($query->masa_kenkat == 0) return 'Kenaikan alih golongan';
                return $query->masa_kenkat . ' tahun';
            })
            ->editColumn('usia_pensiun', function ($query) {
                return $query->usia_pensiun . ' tahun';
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_pangkat . '" onclick="edit_pangkat($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_pangkat . '" data-url="' . url('master/pangkat/delete') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function next_pangkat($kode_matra)
    {
        $list_all = Pangkat::where("kode_matra", $kode_matra)->orderByRaw('CONVERT(id_pangkat, SIGNED) asc')->get();

        $select = [];

        $select[] = ["id" => "", "text" => "Pilih Next Pangkat"];
        foreach ($list_all as $item) {
            $select[] = ["id" => $item->id_pangkat, "text" => $item->nama_pangkat];
        }
        return response()->json(["error" => false, "data" => $select]);
    }
}

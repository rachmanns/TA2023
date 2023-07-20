<?php

namespace App\Http\Controllers\dukkesops\bekkes;

use App\Http\Controllers\Controller;
use App\Http\Requests\BekkesDukRequest;
use App\Models\BekkesDuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SatgasDNController extends Controller
{
    public function index()
    {
        $active_menu = 'satgas_dn';
        return view('dukkesops.bekkes.satgas_dn.index', compact('active_menu'));
    }

    public function store(BekkesDukRequest $request)
    {
        try {
            $request_data = $request->validated();
            $request_data['cakupan'] = 'dn';
            $request_data['file_disetujui'] = $request->file_disetujui->store('bekkes_duk');

            BekkesDuk::create($request_data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Satgas DN Created!',
            'modal' => '#add',
            'table' => '#dn'
        ]);
    }

    public function list(Request $request)
    {
        $bekkes_duk = BekkesDuk::where('cakupan', BekkesDuk::DN)->when($request->tahun, function ($query) use ($request) {
            return $query->where('tahun', $request->tahun);
        })->get();
        return DataTables::of($bekkes_duk)
            ->addColumn('file_pengajuan', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->file_pengajuan) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a></div>";
            })
            ->addColumn('file_disetujui', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->file_disetujui) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a></div>";
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit DN" class="btn pr-0 text-primary" data-id="' . $query->id_bekkes_duk . '" onclick="edit_bekkes_duk($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_bekkes_duk . '" data-url="' . url('dukkesops/satgas-dn') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action', 'file_pengajuan', 'file_disetujui'])
            ->toJson();
    }

    public function edit(BekkesDuk $satgas_dn)
    {
        return $satgas_dn;
    }

    public function update(BekkesDuk $satgas_dn, BekkesDukRequest $request)
    {
        try {

            $request_data = $request->validated();

            if ($request->file('file_disetujui') != null) {
                Storage::delete($satgas_dn->file_disetujui);
                $request_data['file_disetujui'] = $request->file_disetujui->store('bekkes_duk');
            }

            $satgas_dn->update($request_data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
        return response()->json([
            'error' => false,
            'message' => 'Satgas DN Updated!',
            'modal' => '#add',
            'table' => '#dn'
        ]);
    }

    public function destroy(BekkesDuk $satgas_dn)
    {
        try {
            Storage::delete($satgas_dn->file_disetujui);

            $satgas_dn->delete();
            return response()->json([
                'error' => false,
                'message' => 'Satgas DN Deleted!',
                'table' => '#dn'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

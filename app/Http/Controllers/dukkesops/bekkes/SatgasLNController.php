<?php

namespace App\Http\Controllers\dukkesops\bekkes;

use App\Http\Controllers\Controller;
use App\Http\Requests\BekkesDukRequest;
use App\Models\BekkesDuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SatgasLNController extends Controller
{
    public function index()
    {
        $active_menu = 'satgas_ln';
        return view('dukkesops.bekkes.satgas_ln.index', compact('active_menu'));
    }

    public function store(BekkesDukRequest $request)
    {
        try {
            $request_data = $request->validated();
            $request_data['cakupan'] = 'ln';
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
            'message' => 'Satgas LN Created!',
            'modal' => '#add',
            'table' => '#ln'
        ]);
    }

    public function list(Request $request)
    {
        $bekkes_duk = BekkesDuk::where('cakupan', BekkesDuk::LN)->when($request->tahun, function ($query) use ($request) {
            return $query->where('tahun', $request->tahun);
        })->get();
        return DataTables::of($bekkes_duk)
            ->addColumn('file_disetujui', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->file_disetujui) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a></div>";
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit LN" class="btn pr-0 text-primary" data-id="' . $query->id_bekkes_duk . '" onclick="edit_bekkes_duk($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_bekkes_duk . '" data-url="' . url('dukkesops/satgas-ln') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action', 'file_disetujui'])
            ->toJson();
    }

    public function edit(BekkesDuk $satgas_ln)
    {
        return $satgas_ln;
    }

    public function update(BekkesDuk $satgas_ln, BekkesDukRequest $request)
    {
        try {

            $request_data = $request->validated();

            if ($request->file('file_disetujui') != null) {
                Storage::delete($satgas_ln->file_disetujui);
                $request_data['file_disetujui'] = $request->file_disetujui->store('bekkes_duk');
            }

            $satgas_ln->update($request_data);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Satgas LN Updated!',
            'modal' => '#add',
            'table' => '#ln'
        ]);
    }

    public function destroy(BekkesDuk $satgas_ln)
    {
        try {
            Storage::delete($satgas_ln->file_disetujui);

            $satgas_ln->delete();
            return response()->json([
                'error' => false,
                'message' => 'Satgas LN Deleted!',
                'table' => '#ln'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

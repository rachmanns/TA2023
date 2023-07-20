<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnggaranDukRequest;
use App\Models\AnggaranDuk;
use App\Models\KategoriDuk;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class AnggaranDukController extends Controller
{
    public function index()
    {
        $active_menu = 'anggaran';
        $kategori = AnggaranDuk::select('kategori')->distinct()->get();
        return view('dukkesops.anggaran.index', compact('active_menu', 'kategori'));
    }

    public function create()
    {
        $active_menu = 'anggaran';
        $kategori_duk = KategoriDuk::get();
        return view('dukkesops.anggaran.create', compact('active_menu', 'kategori_duk'));
    }

    public function store(AnggaranDukRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['file_anggaran'] = $request->file_anggaran->store('anggaran_duk');

            AnggaranDuk::create($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Anggaran Created!',
                'url' => url('dukkesops/anggaran')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        $anggaran_duk = AnggaranDuk::when($request->kategori, function ($q) use ($request) {
            return $q->where('kategori', $request->kategori);
        })->latest()->get();
        return DataTables::of($anggaran_duk)
            ->addColumn('file_anggaran', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->file_anggaran) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a></div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_anggaran_duk . "' onclick='edit_anggaran_duk($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_anggaran_duk . "' data-url='" . url('dukkesops/anggaran') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['file_anggaran', 'action'])
            ->toJson();
    }

    public function update(AnggaranDuk $anggaran, Request $request)
    {
        try {
            Storage::delete($anggaran->file_anggaran);
            $anggaran->update(['file_anggaran' => $request->file_anggaran->store('anggaran_duk')]);

            return response()->json([
                'error' => false,
                'message' => 'Anggaran Updated!',
                'modal' => '#edit',
                'table' => '#anggaran'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(AnggaranDuk $anggaran)
    {
        try {
            Storage::delete($anggaran->file_anggaran);
            $anggaran->delete();

            return response()->json([
                'error' => false,
                'message' => 'Anggaran Deleted!',
                'table' => '#anggaran'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers\kermabaktikes\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\KegiatanRequest;
use App\Models\AcaraKerma;
use App\Models\Event;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KegiatanController extends Controller
{
    public function index()
    {
        $active_menu = 'master_kegiatan';
        $event = Event::all();
        return view('kermabaktikes.master_data.kegiatan', compact('active_menu', 'event'));
    }

    public function list()
    {
        $kegiatan = Kegiatan::with('event')->get();
        return DataTables::of($kegiatan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_kegiatan . '" onclick="edit_kegiatan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_kegiatan . '" data-url="' . url('kerma/kegiatan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(KegiatanRequest $request)
    {
        try {
            Kegiatan::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Kegiatan Created!',
                'modal' => '#tambah',
                'table' => '#kegiatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(Kegiatan $kegiatan)
    {
        return $kegiatan;
    }

    public function update(KegiatanRequest $request, Kegiatan $kegiatan)
    {
        try {
            $kegiatan->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Kegiatan Updated!',
                'modal' => '#tambah',
                'table' => '#kegiatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Kegiatan $kegiatan)
    {
        try {
            $acara_kerma = AcaraKerma::where('id_kegiatan', $kegiatan->id_kegiatan)->first();
            if ($acara_kerma) throw new \Exception("Cannot delete this data, please check kerma first.");
            $kegiatan->delete();
            return response()->json([
                'error' => false,
                'message' => 'Kegiatan Deleted!',
                'table' => '#kegiatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}

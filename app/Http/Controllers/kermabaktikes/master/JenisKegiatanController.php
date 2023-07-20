<?php

namespace App\Http\Controllers\kermabaktikes\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\JenisKegiatanRequest;
use App\Models\AcaraBakti;
use App\Models\AcaraKerma;
use App\Models\JenisKegiatan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JenisKegiatanController extends Controller
{
    public function index()
    {
        $active_menu = 'master_jenis_kegiatan';
        return view('kermabaktikes.master_data.jenis_kegiatan', compact('active_menu'));
    }

    public function list()
    {
        $jenis_kegiatan = JenisKegiatan::get();
        return DataTables::of($jenis_kegiatan)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_jenis_keg . '" onclick="edit_jenis_kegiatan($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_jenis_keg . '" data-url="' . url('kerma/jenis-kegiatan') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(JenisKegiatanRequest $request)
    {
        try {
            JenisKegiatan::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Jenis Kegiatan Created!',
                'modal' => '#tambah',
                'table' => '#jenis-kegiatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(JenisKegiatan $jenis_kegiatan)
    {
        return $jenis_kegiatan;
    }

    public function update(JenisKegiatanRequest $request, JenisKegiatan $jenis_kegiatan)
    {
        try {
            $jenis_kegiatan->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Jenis Kegiatan Updated!',
                'modal' => '#tambah',
                'table' => '#jenis-kegiatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(JenisKegiatan $jenis_kegiatan)
    {
        try {
            $acara_kerma = AcaraKerma::where('id_jenis_keg', $jenis_kegiatan->id_jenis_keg)->first();
            $acara_bakti = AcaraBakti::where('id_jenis_keg', $jenis_kegiatan->id_jenis_keg)->first();

            if ($acara_kerma || $acara_bakti) throw new \Exception("Cannot delete this data, please check kerma or bakti first.");

            $jenis_kegiatan->delete();

            return response()->json([
                'error' => false,
                'message' => 'Jenis Kegiatan Deleted!',
                'table' => '#jenis-kegiatan-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}

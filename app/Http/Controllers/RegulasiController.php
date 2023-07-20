<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegulasiRequest;
use App\Models\Bidang;
use App\Models\KatBuku;
use App\Models\Regulasi;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class RegulasiController extends Controller
{
    public function index($kode_bidang)
    {
        $active_menu = 'regulasi_' . $kode_bidang;
        $id_bidang = Bidang::where('kode_bidang', $kode_bidang)->first()->id_bidang;
        $kategori = KatBuku::select('id_kat_buku', 'nama_kat_buku')->get();
        return view('regulasi.index', compact(
            'active_menu',
            'kode_bidang',
            'id_bidang',
            'kategori'
        ));
    }

    public function store(RegulasiRequest $request)
    {
        $requestData = $request->validated();
        $requestData['file'] = $request->file->store('regulasi');

        Regulasi::create($requestData);

        return response()->json([
            'error' => false,
            'message' => 'Regulasi Created!',
            'modal' => '#rf',
            'table' => '#regulasi'
        ]);
    }

    public function get($id_bidang)
    {
        $regulasi = Regulasi::with('kat_buku')->where('id_bidang', $id_bidang)->get();
        return DataTables::of($regulasi)
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return date('j F Y', strtotime($row->created_at));
            })
            ->addColumn('action', function ($row) {
                $edit_button = '<button title="Edit" class="btn pr-75 text-primary" data-id="' . $row->id_regulasi . '" onclick="edit_regulasi($(this))"><i data-feather="edit" class="font-medium-4"></i></button>';

                return  "<div class='text-center'>{$edit_button}<a href='" . asset('storage/' . $row->file) . "' target='_blank'><button title='Download' class='btn text-primary p-0'><i data-feather='download' class='font-medium-4'></i></button></a><button title='Delete' type='button' data-id=" . $row->id_regulasi . " data-url=" . url('regulasi') . " class='delete-data btn pl-75'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->addColumn('kategori', function ($row) {
                return  $row->kat_buku->nama_kat_buku ?? '-';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function destroy(Regulasi $regulasi)
    {
        Storage::delete($regulasi->file);
        $regulasi->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'Regulasi Deleted!',
            'table' => '#regulasi'
        ]);
    }

    public function edit(Regulasi $regulasi)
    {
        return $regulasi;
    }

    public function update(RegulasiRequest $request, Regulasi $regulasi)
    {
        $requestData = $request->validated();
        if ($request->file) {
            $requestData['file'] = $request->file->store('regulasi');
        }

        $regulasi->update($requestData);

        return response()->json([
            'error' => false,
            'message' => 'Regulasi Updated!',
            'modal' => '#rf',
            'table' => '#regulasi'
        ]);
    }
}

<?php

namespace App\Http\Controllers\dukkesops;

use App\Http\Controllers\Controller;
use App\Http\Requests\DukkesRequest;
use App\Models\Dukkes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DukkesController extends Controller
{
    public function index()
    {
        $active_menu = 'daftar_dukkes';
        return view('dukkesops.daftar_dukkes.index', compact('active_menu'));
    }

    public function store(DukkesRequest $request)
    {
        try {
            $request_data = $request->validated();
            $request_data['lampiran_surat'] = $request->lampiran_surat->store('dukkes');

            Dukkes::create($request_data);
            return response()->json([
                'error' => false,
                'message' => 'Dukkes Created!',
                'modal' => '#add',
                'table' => '#dukkes'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function list()
    {
        $dukkes = Dukkes::get();
        return DataTables::of($dukkes)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                return indonesian_date_format($row->tanggal);
            })
            ->addColumn('lampiran_surat', function ($row) {
                return "<div class='text-center'><a href='" . asset('storage/' . $row->lampiran_surat) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a></div>";
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_dukkes . '" onclick="edit_dukkes($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_dukkes . '" data-url="' . url('dukkesops/dukkes') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action', 'tanggal', 'lampiran_surat'])
            ->toJson();
    }

    public function edit(Dukkes $dukkes)
    {
        return $dukkes;
    }

    public function update(Dukkes $dukkes, DukkesRequest $request)
    {
        try {

            $request_data = $request->validated();

            if ($request->file('lampiran_surat') != null) {
                Storage::delete($dukkes->lampiran_surat);
                $request_data['lampiran_surat'] = $request->lampiran_surat->store('bekkes_duk');
            }

            $dukkes->update($request_data);

            return response()->json([
                'error' => false,
                'message' => 'Dukkes Updated!',
                'modal' => '#add',
                'table' => '#dukkes'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Dukkes $dukkes)
    {
        try {
            Storage::delete($dukkes->file_pengajuan);

            $dukkes->delete();
            return response()->json([
                'error' => false,
                'message' => 'Dukkes Deleted!',
                'table' => '#dukkes'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

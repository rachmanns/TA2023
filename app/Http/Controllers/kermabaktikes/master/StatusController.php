<?php

namespace App\Http\Controllers\kermabaktikes\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatusRequest;
use App\Models\Status;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StatusController extends Controller
{
    public function index()
    {
        $active_menu = 'master_status';
        return view('kermabaktikes.master_data.status', compact('active_menu'));
    }

    public function list()
    {
        $status = Status::get();
        return DataTables::of($status)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Detail" class="btn pr-0 text-primary" data-id="' . $query->id_status . '" onclick="edit_status($(this))"><i data-feather="file-text" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_status . '" data-url="' . url('kerma/status') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(StatusRequest $request)
    {
        try {
            Status::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Status Created!',
                'modal' => '#tambah',
                'table' => '#status-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(Status $status)
    {
        return $status;
    }

    public function update(StatusRequest $request, Status $status)
    {
        try {
            $status->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Status Updated!',
                'modal' => '#tambah',
                'table' => '#status-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Status $status)
    {
        try {
            $status->delete();
            return response()->json([
                'error' => false,
                'message' => 'Status Deleted!',
                'table' => '#status-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

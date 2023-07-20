<?php

namespace App\Http\Controllers\matfaskes;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorController extends Controller
{
    public function index()
    {
        return view('matfaskes.daftar_vendor.index', ['active_menu' => 'daftar_vendor']);
    }

    public function store(VendorRequest $request)
    {
        try {
            Vendor::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Vendor Created!',
                'modal' => '#modal_vendor',
                'table' => '#table-vendor'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list()
    {
        $vendor = Vendor::get();
        return DataTables::of($vendor)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><a title="Edit" class="text-primary mr-75" data-id="' . $query->id_vendor . '" data-url="' . route('matfaskes.vendor.update', $query->id_vendor) . '" onclick="edit_vendor($(this))"><i data-feather="edit" class="font-medium-4"></i></a><a title="Delete" class="delete-data"><i data-feather="trash" class="font-medium-4 text-danger"></i></a></div>
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function edit(Vendor $vendor)
    {
        return $vendor;
    }

    public function update(Vendor $vendor, VendorRequest $request)
    {
        try {
            $vendor->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Vendor Updated!',
                'modal' => '#modal_vendor',
                'table' => '#table-vendor'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}

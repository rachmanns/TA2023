<?php

namespace App\Services;

use App\Http\Requests\DocTenagaMedisRequest;
use App\Models\DocTenagaMedis;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class DocTenagaMedisService
{
    public static function store(DocTenagaMedisRequest $request): DocTenagaMedis
    {
        $requestData = $request->validated();
        $requestData['file'] = $request->file->store('doc_tenaga_medis');

        return DocTenagaMedis::create($requestData);
    }

    public static function dataTable()
    {
        $doc = DocTenagaMedis::get();
        return DataTables::of($doc)
            ->addIndexColumn()
            ->addColumn('file', function ($r) {
                return "<div class='text-center'><a href='" . asset('storage/' . $r->file) . "'><u><i data-feather='download' class='font-medium-4 mr-50'></i>Download Dokumen</u></a></div>";
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_doc_tenaga_medis . '" onclick="edit_doc($(this))"><i data-feather="edit" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_doc_tenaga_medis . '" data-url="' . url('bangkes/dokumen-tenaga-medis') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['file', 'action'])
            ->toJson();
    }

    public static function destroy(DocTenagaMedis $doc_tenaga_medis): bool
    {
        if ($doc_tenaga_medis->file != null) Storage::delete($doc_tenaga_medis->file);
        return $doc_tenaga_medis->deleteOrFail();
    }

    public static function update(DocTenagaMedisRequest $request, DocTenagaMedis $doc_tenaga_medis): DocTenagaMedis
    {
        $requestData = $request->validated();
        if ($request->file) {
            Storage::delete($doc_tenaga_medis->file);
            $requestData['file'] = $request->file->store('doc_tenaga_medis');
        }

        $doc_tenaga_medis->update($requestData);
        return $doc_tenaga_medis;
    }
}

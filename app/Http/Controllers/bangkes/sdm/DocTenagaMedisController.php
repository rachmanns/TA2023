<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocTenagaMedisRequest;
use App\Models\DocTenagaMedis;
use App\Services\DocTenagaMedisService;
use Illuminate\Http\Request;

class DocTenagaMedisController extends Controller
{
    public function index()
    {
        $data = [
            'active_menu' => 'dokumen_tenaga_medis'
        ];
        return view('bangkes.dokumen_tenaga_medis.index', $data);
    }

    public function store(DocTenagaMedisRequest $request)
    {
        DocTenagaMedisService::store($request);
        return response()->json([
            'error' => false,
            'message' => 'Dokumen Tenaga Medis Created!',
            'modal' => '#add',
            'table' => '#table'
        ]);
    }

    public function get()
    {
        return DocTenagaMedisService::dataTable();
    }

    public function destroy(DocTenagaMedis $doc_tenaga_medis)
    {
        DocTenagaMedisService::destroy($doc_tenaga_medis);
        return response()->json([
            'error' => false,
            'message' => 'Dokumen Deleted!',
            'table' => '#table'
        ]);
    }

    public function edit(DocTenagaMedis $doc_tenaga_medis)
    {
        return $doc_tenaga_medis;
    }

    public function update(DocTenagaMedisRequest $request, DocTenagaMedis $doc_tenaga_medis)
    {
        DocTenagaMedisService::update($request, $doc_tenaga_medis);
        return response()->json([
            'error' => false,
            'message' => 'Dokumen Updated!',
            'modal' => '#add',
            'table' => '#table'
        ]);
    }
}

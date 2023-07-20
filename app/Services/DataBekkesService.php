<?php

namespace App\Services;

use App\Http\Requests\DataBekkesRequest;
use App\Models\DataBekkes;
use App\Models\DetailBekkes;
use App\Models\KategoriBrg;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataBekkesService
{
    public static function store(DataBekkesRequest $request): DataBekkes
    {
        return DataBekkes::create($request->validated());
    }

    public static function update(DataBekkesRequest $request, DataBekkes $data_bekkes): DataBekkes
    {
        $data_bekkes->update($request->validated());
        return $data_bekkes;
    }

    public static function dataTable(Request $request): JsonResponse
    {
        $data_bekkes = DataBekkes::with('master_bekkes')
            ->when($request->jenis_tujuan != 'all', function ($query) use ($request) {
                return $query->where('jenis_tujuan', $request->jenis_tujuan);
            })
            ->when($request->year, function ($query) use ($request) {
                return $query->where('tahun_anggaran', $request->year);
            })
            ->get();

        return DataTables::of($data_bekkes)
            ->addIndexColumn()
            ->editColumn('jenis_tujuan', function ($r) {
                return strtoupper($r->jenis_tujuan);
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'>
                    <a data-id='" . $row->id_data_bekkes . "' onclick='edit_data_bekkes($(this))'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a>
                    <a href='" . url('matfaskes/data-bekkes/' . $row->id_data_bekkes) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a>
                    <button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_data_bekkes . "' data-url='" . url('matfaskes/data-bekkes') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button>
                </div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public static function destroy(DataBekkes $data_bekkes): bool
    {
        return $data_bekkes->deleteOrFail();
    }

    public static function update_foto(Request $request, DataBekkes $data_bekkes)
    {
        $validated = $request->validate([
            'foto' => 'required|mimes:jpg,bmp,png'
        ]);

        $validated['foto'] = $request->foto->store('matfaskes/data_bekkes');

        $data_bekkes->update($validated);

        return $data_bekkes;
    }

    public static function get_import_data($path, $detail_bekkes_name)
    {
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path . '/' . $detail_bekkes_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($path . '/' . $detail_bekkes_name);

        unlink($path . '/' . $detail_bekkes_name);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);
        $data_detail_bekkes = [];

        for ($i = 1; $i < $count_rows; $i++) {
            $data_detail_bekkes[] = [
                'kategori_brg' => $rows[$i][0],
                'jenis_brg' => $rows[$i][1],
                'nama_brg' => $rows[$i][2],
                'satuan' => $rows[$i][3],
                'jml' => $rows[$i][4],
                'keterangan' => $rows[$i][5]

            ];
        }

        return $data_detail_bekkes;
    }

    public static function store_import(Request $request)
    {
        DB::transaction(function () use ($request) {
            $data_bekkes_value = json_decode($request->session()->get('data_bekkes'), true);
            $data_bekkes = DataBekkes::create($data_bekkes_value);

            $data_detail_bekkes = json_decode($request->session()->get('data_detail_bekkes'), true);
            foreach ($data_detail_bekkes as $key => $value) {
                $value['id_data_bekkes'] = $data_bekkes->id_data_bekkes;
                $value['id_kategori_brg'] = KategoriBrg::where('nama_kategori', $value['kategori_brg'])->first()->id_kategori ?? 1;
                DetailBekkes::create($value);
            }
        });

        $request->session()->forget(['data_bekkes', 'data_detail_bekkes']);
    }
}

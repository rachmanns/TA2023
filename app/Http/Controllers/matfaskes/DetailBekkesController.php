<?php

namespace App\Http\Controllers\matfaskes;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailBekkesRequest;
use App\Models\DetailBekkes;
use App\Models\KategoriBrg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DetailBekkesController extends Controller
{
    public function create($id_data_bekkes)
    {
        $active_menu = 'daftar_bekkes';
        $kategori_brg = KategoriBrg::select('id_kategori', 'nama_kategori')->get();
        return view('matfaskes.daftar_bekkes.create', compact(
            'active_menu',
            'id_data_bekkes',
            'kategori_brg'
        ));
    }

    public function store(DetailBekkesRequest $request)
    {
        DetailBekkes::create($request->validated());
        return response()->json([
            'error' => false,
            'message' => 'Detail Bekkes Created!',
            'url' => url('matfaskes/data-bekkes/' . $request->id_data_bekkes)
        ]);
    }

    public function get(Request $request)
    {
        $detail_bekkes = DetailBekkes::with('kategori_brg')->where('id_data_bekkes', $request->id_data_bekkes)->get();
        return DataTables::of($detail_bekkes)
            ->addIndexColumn()
            ->addColumn('nama_kategori', function ($row) {
                return $row->kategori_brg->nama_kategori;
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'>
                    <a href='" . url('matfaskes/detail-bekkes/edit/' . $row->id_detail_bekkes)  . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a>
                    <button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_detail_bekkes . "' data-url='" . url('matfaskes/detail-bekkes') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button>
                </div>";
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function destroy(DetailBekkes $detail_bekkes)
    {
        $detail_bekkes->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'Detail Bekkes Deleted!',
            'table' => '#table'
        ]);
    }

    public function update(DetailBekkesRequest $request, DetailBekkes $detail_bekkes)
    {
        $detail_bekkes->update($request->validated());
        return response()->json([
            'error' => false,
            'message' => 'Detail Bekkes Updated!',
            'url' => url('matfaskes/data-bekkes/' . $request->id_data_bekkes)
        ]);
    }

    public function edit(DetailBekkes $detail_bekkes)
    {
        $active_menu = 'daftar_bekkes';
        $kategori_brg = KategoriBrg::select('id_kategori', 'nama_kategori')->get();
        return view('matfaskes.daftar_bekkes.create', compact(
            'active_menu',
            'kategori_brg',
            'detail_bekkes'
        ));
    }

    public function preview(Request $request)
    {
        $active_menu = 'daftar_bekkes';
        $path = public_path('matfaskes');
        $detail_bekkes = $request->file('detail_bekkes');
        $detail_bekkes_name =  $request->detail_bekkes->hashName();
        $detail_bekkes->move($path, $detail_bekkes_name);

        $data_detail_bekkes['data'] = $this->get_excel_data($path, $detail_bekkes_name);
        $data_detail_bekkes['id_data_bekkes'] = $request->id_data_bekkes;

        $request->session()->put('data_detail_bekkes', json_encode($data_detail_bekkes));

        return view('matfaskes.daftar_bekkes.preview_detail_bekkes', [
            'active_menu' => $active_menu,
            'data_detail_bekkes' => $data_detail_bekkes
        ]);
    }

    public function get_excel_data($path, $detail_bekkes_name)
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

    public function store_excel(Request $request)
    {
        $data_detail_bekkes = json_decode($request->session()->get('data_detail_bekkes'), true);
        $id_data_bekkes = $data_detail_bekkes['id_data_bekkes'];
        DB::transaction(function () use ($data_detail_bekkes) {
            foreach ($data_detail_bekkes['data'] as $key => $value) {
                $value['id_data_bekkes'] = $data_detail_bekkes['id_data_bekkes'];
                $value['id_kategori_brg'] = KategoriBrg::where('nama_kategori', $value['kategori_brg'])->first()->id_kategori ?? 1;
                DetailBekkes::create($value);
            }
        });

        $request->session()->forget(['data_detail_bekkes']);
        return redirect('matfaskes/data-bekkes/' . $id_data_bekkes);
    }
}

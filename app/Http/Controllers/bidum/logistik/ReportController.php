<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\KategoriLaporan;
use App\Models\Pelaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index()
    {
        $active_menu = 'report_bidlog';
        $kategori_laporan = KategoriLaporan::get();
        return view('bidum.logistik.report_bidlog.index', compact('active_menu', 'kategori_laporan'));
    }

    public function create(Request $request)
    {
        $active_menu = 'report_bidlog';
        $kategori_laporan = KategoriLaporan::get();
        $kl_report = $kategori_laporan->where('type', 'R');
        $kl_master = $kategori_laporan->where('type', 'M');
        return view('bidum.logistik.report_bidlog.create', compact('active_menu', 'kl_report', 'kl_master'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'periode_laporan' => 'required',
                'id_kat_lap.*' => 'mimes:xlsx,xls,pdf,jpg,jpeg,png,doc,docs'
            ],
            [
                'periode_laporan.required' => 'Periode harus diisi',
                'id_kat_lap.*.mimes' => 'File must be a file of type: xlsx, xls, pdf, jpg, jpeg, png, doc, docs.'
            ]
        );
        $periode_laporan = $request->periode_laporan;
        $path = public_path('logistik/report');
        try {
            foreach ($request->id_kat_lap as $key => $value) {
                $file = $value;
                $file_name =  rand() . '.' . $value->getClientOriginalExtension();
                $file->move($path, $file_name);
                Pelaporan::create([
                    'periode_laporan' => $periode_laporan,
                    'tgl_upload' => date('Y-m-d'),
                    'id_kategori' => $key,
                    'file' => $file_name,
                ]);
            }
            return response()->json([
                'error' => false,
                'message' => 'Report Updated!',
                'url' => url('bidum/logistik/report')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list($id_kategori, $from_date, $to_date)
    {
        $pelaporan = Pelaporan::where('id_kategori', $id_kategori)->whereBetween('periode_laporan', [$from_date, $to_date])->latest()->get();

        return DataTables::of($pelaporan)
            ->editColumn('periode_laporan', function ($row) {
                return date('j F Y', strtotime($row->periode_laporan));
            })
            ->editColumn('tgl_upload', function ($row) {
                return date('j F Y', strtotime($row->tgl_upload));
            })
            ->addColumn('file', function ($row) {
                if ($row->file != null) {
                    $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.report.pdf', $row->file) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                    return $btn;
                }
            })
            ->addColumn('action', function ($row) {
                $delete_button = '<a title="Delete" data-id="' . $row->id_pelaporan . '" data-url="' . url('bidum/logistik/report') . '" class="delete-data pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></a>';

                return '<div class="text-center">' . $delete_button . '</div>';
            })
            ->rawColumns(['file', 'action'])
            ->toJson();
    }

    public function pdf($file)
    {
        $pathToFile = public_path('logistik/report') . '/' . $file;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function destroy(Pelaporan $pelaporan)
    {
        $pelaporan->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'Report Deleted!',
            'reload_page' => true
        ]);
    }
}

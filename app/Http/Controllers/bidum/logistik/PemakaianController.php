<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\OutPemakaian;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PemakaianController extends Controller
{
    public function list($from_date, $to_date)
    {
        $data = DB::select("SELECT
        o.id_rencana,
        o.kode_nota_dinas,
        r.no_nota_dinas,
        file_ppm,
        file_spb,
        no_spb,
        no_rth,
        file_rth,
        r.penerima,
        r.tgl_keluar,
        id_out_pemakaian,
        r.file_nota_dinas,
        r.jenis_pengeluaran,
        SUM(b.jml_keluar * m.harga_satuan) AS nominal
    FROM
        out_pemakaian o
    JOIN rencana_pengeluaran r ON
        r.id_rencana = o.id_rencana
    JOIN brg_out b ON
        b.id_rencana = r.id_rencana
    JOIN detail_brg_matkes_d d ON
        d.id_matkes_dobek = b.id_matkes_dobek
    JOIN detail_brg_matkes_m m ON
        m.id_matkes_matfas = d.id_matkes_matfas
    WHERE
        m.id_barang_masuk IN(
        SELECT
            t.id_in_tktm AS id_barang_masuk
        FROM
            in_tktm t
        WHERE
            t.jenis_tktm = 'persediaan'
        UNION
    SELECT
        h.id_ba_hibah AS id_barang_masuk
    FROM
        ba_hibah h
    WHERE
        h.kode_ba_hibah = 'P'
    UNION
    SELECT
        k.id_kontrak AS id_barang_masuk
    FROM
        kontrak k
    WHERE
        k.kode_kontrak = 'P'
    )
    AND 
        CASE
            WHEN '{$from_date}' <> '*' THEN r.tgl_keluar BETWEEN '{$from_date}' AND '{$to_date}'
            ELSE r.tgl_keluar
        END
    GROUP BY
        o.id_rencana");

        return DataTables::of($data)
            ->addColumn('no_nota_dinas', function ($row) {
                if ($row->file_nota_dinas != null) {
                    $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.nota_dinas.pdf', $row->file_nota_dinas) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                    return $row->no_nota_dinas . ' ' . $btn;
                }
            })
            ->editColumn('nominal', function ($row) {
                return  number_format($row->nominal, 2, ',', '.');
            })
            ->addColumn('file_ppm', function ($row) {
                if ($row->jenis_pengeluaran != 'Hibah') {
                    if ($row->file_ppm == null) {
                        return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                    }
                    $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.pemakaian.pdf_ppm', $row->file_ppm) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                    $no_ppm = $row->no_ppm ?? '-';
                    return  $no_ppm . ' ' . $btn;
                }
                return '-';
            })
            ->addColumn('file_rth', function ($row) {
                if ($row->file_rth == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $no_rth = $row->no_rth ?? '-';
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.pemakaian.pdf_rth', $row->file_rth) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return $no_rth . ' ' . $btn;
            })
            ->addColumn('file_spb', function ($row) {
                if ($row->file_spb == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.spb.pdf', $row->file_spb) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_spb . ' ' . $btn;
            })
            ->addColumn('action', function ($row) {
                return '<a title="Edit" data-url="' . route('bidum.logistik.pemakaian.update', $row->id_out_pemakaian) . '" data-id="' .  $row->id_out_pemakaian . '" onclick="edit_pemakaian($(this))"><i data-feather="edit" class="font-medium-4 text-primary"></i></a></div>';
            })
            ->rawColumns(['no_nota_dinas', 'file_ppm', 'file_spb', 'file_rth', 'action'])
            ->toJson();
    }

    public function edit(OutPemakaian $out_pemakaian)
    {
        return $out_pemakaian->load('rencana_pengeluaran');
    }

    public function update(Request $request, OutPemakaian $out_pemakaian)
    {
        $requestData = $request->validate([
            'no_ppm' => 'nullable',
            'file_ppm' => 'nullable',
            'no_rth' => 'nullable',
            'file_rth' => 'nullable',
        ]);
        try {
            $path = public_path('logistik/pemakaian');

            if ($request->file('file_ppm') != null) {
                if ($out_pemakaian->file_ppm != null) {
                    if (file_exists($path . '/' . $out_pemakaian->file_ppm)) unlink($path . '/' . $out_pemakaian->file_ppm);
                }
                $file_ppm = $request->file('file_ppm');
                $file_ppm_name =  rand() . '.' . $request->file('file_ppm')->getClientOriginalExtension();
                $file_ppm->move($path, $file_ppm_name);
                $requestData['file_ppm'] = $file_ppm_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }


            if ($request->file('file_rth') != null) {
                if ($out_pemakaian->file_rth != null) {
                    if (file_exists($path . '/' . $out_pemakaian->file_rth)) unlink($path . '/' . $out_pemakaian->file_rth);
                }
                $file_rth = $request->file('file_rth');
                $file_rth_name =  'file_rth_' . rand() . '.' . $request->file('file_rth')->getClientOriginalExtension();
                $file_rth->move($path, $file_rth_name);
                $requestData['file_rth'] = $file_rth_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }

            $out_pemakaian->update($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Pemakaian Updated!',
                'modal' => '#pemakaian_modal',
                'table' => '#pemakaian-table'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function pdf_ppm($file_ppm)
    {
        $pathToFile = public_path('logistik/pemakaian') . '/' . $file_ppm;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_rth($file_rth)
    {
        $pathToFile = public_path('logistik/pemakaian') . '/' . $file_rth;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\OutHibah;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HibahKeluarController extends Controller
{
    public function list($prefix, $from_date, $to_date)
    {

        if ($prefix == 'P') {
            $kode = 'P';
            $jenis = 'persediaan';
        } else {
            $kode = 'A';
            $jenis = 'aset';
        }

        $data = DB::select("SELECT
        o.id_rencana,
        o.kode_nota_dinas,
        no_nota_dinas,
        file_rth_hibah,
        no_rth_hibah,
        r.penerima,
        r.tgl_keluar,
        id_out_hibah,
        r.file_nota_dinas,
        SUM(b.jml_keluar * m.harga_satuan) AS nominal
    FROM
        out_hibah o
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
            t.jenis_tktm = '{$jenis}'
        UNION
    SELECT
        h.id_ba_hibah AS id_barang_masuk
    FROM
        ba_hibah h
    WHERE
        h.kode_ba_hibah = '{$kode}'
    UNION
    SELECT
        k.id_kontrak AS id_barang_masuk
    FROM
        kontrak k
    WHERE
        k.kode_kontrak = '{$kode}'
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
            ->addColumn('file_rth_hibah', function ($row) {
                if ($row->file_rth_hibah == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.hibah_keluar.pdf_rth_hibah', $row->file_rth_hibah) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_rth_hibah . ' ' . $btn;
            })
            ->addColumn('action', function ($row) {
                if ($row->id_out_hibah) {
                    return '<a title="Edit" data-url="' . route('bidum.logistik.hibah_keluar.update', $row->id_out_hibah) . '" data-id="' .  $row->id_out_hibah . '" onclick="edit_hibah($(this))"><i data-feather="edit" class="font-medium-4 text-primary"></i></a></div>';
                }
            })
            ->rawColumns(['no_nota_dinas', 'file_rth_hibah',  'action'])
            ->toJson();
    }

    public function edit(OutHibah $out_hibah)
    {
        return $out_hibah->load('rencana_pengeluaran');
    }

    public function update(Request $request, OutHibah $out_hibah)
    {
        $requestData = $request->validate([
            'no_rth_hibah' => 'nullable',
            'file_rth_hibah' => 'nullable',
        ]);
        try {
            $path = public_path('logistik/hibah_keluar');

            if ($request->file('file_rth_hibah') != null) {
                if ($out_hibah->file_rth_hibah != null) unlink($path . '/' . $out_hibah->file_rth_hibah);
                $file_rth_hibah = $request->file('file_rth_hibah');
                $file_rth_hibah_name =  'file_rth_hibah_' . rand() . '.' . $request->file('file_rth_hibah')->getClientOriginalExtension();
                $file_rth_hibah->move($path, $file_rth_hibah_name);
                $requestData['file_rth_hibah'] = $file_rth_hibah_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }

            $out_hibah->update($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Hibah Updated!',
                'modal' => '#hibah_modal',
                'table' => '#hibah-table'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function pdf_rth_hibah($file_rth_hibah)
    {
        $pathToFile = public_path('logistik/hibah_keluar') . '/' . $file_rth_hibah;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\OutTktm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransferKeluarController extends Controller
{
    public function list($prefix, $from_date, $to_date)
    {
        if ($prefix == 'persediaan') {
            $kode = 'P';
            $jenis = 'persediaan';
        } else {
            $kode = 'A';
            $jenis = 'aset';
        }

        $data = DB::select("SELECT
            o.id_rencana,
            o.kode_nota_dinas,
            r.no_nota_dinas,
            file_ppm,
            no_ppm,
            file_spb,
            no_spb,
            r.penerima,
            r.tgl_keluar,
            o.file_rth_tk,
            o.file_rth_tm,
            r.file_nota_dinas,
            id_out_tktm,
            SUM(b.jml_keluar * m.harga_satuan) AS nominal
        FROM
            out_tktm o
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
            ->addColumn('file_ppm', function ($row) {
                if ($row->file_ppm == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.transfer_keluar.pdf_ppm', $row->file_ppm) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_ppm . ' ' . $btn;
            })
            ->addColumn('file_spb', function ($row) {
                if ($row->file_spb == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.spb.pdf', $row->file_spb) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_spb . ' ' . $btn;
            })
            ->addColumn('file_rth_tk', function ($row) {
                if ($row->file_rth_tk == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.transfer_keluar.pdf_rth_tk', $row->file_rth_tk) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_rth_tk . ' ' . $btn;
            })
            ->addColumn('file_rth_tm', function ($row) {
                if ($row->file_rth_tm == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.transfer_keluar.pdf_rth_tm', $row->file_rth_tm) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_rth_tm . ' ' . $btn;
            })
            ->addColumn('action', function ($row) {
                return '<a title="Edit" data-url="' . route('bidum.logistik.transfer_keluar.update', $row->id_out_tktm) . '" data-id="' .  $row->id_out_tktm . '" onclick="edit_transfer($(this))"><i data-feather="edit" class="font-medium-4 text-primary"></i></a></div>';
            })
            ->rawColumns(['no_nota_dinas', 'file_ppm', 'file_spb', 'file_rth_tk', 'file_rth_tm',  'action'])
            ->toJson();
    }

    public function edit(OutTktm $out_tktm)
    {
        return $out_tktm->load('rencana_pengeluaran');
    }

    public function update(Request $request, OutTktm $out_tktm)
    {
        $requestData = $request->validate([
            'no_ppm' => 'nullable',
            'file_ppm' => 'nullable',
            'no_rth_tk' => 'nullable',
            'file_rth_tk' => 'nullable',
            'no_rth_tm' => 'nullable',
            'file_rth_tm' => 'nullable',
        ]);
        try {
            $path = public_path('logistik/transfer_keluar');

            if ($request->file('file_ppm') != null) {
                if ($out_tktm->file_ppm != null) unlink($path . '/' . $out_tktm->file_ppm);
                $file_ppm = $request->file('file_ppm');
                $file_ppm_name =  rand() . '.' . $request->file('file_ppm')->getClientOriginalExtension();
                $file_ppm->move($path, $file_ppm_name);
                $requestData['file_ppm'] = $file_ppm_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }

            if ($request->file('file_rth_tk') != null) {
                if ($out_tktm->file_rth_tk != null) unlink($path . '/' . $out_tktm->file_rth_tk);
                $file_rth_tk = $request->file('file_rth_tk');
                $file_rth_tk_name =  'file_rth_tk_' . rand() . '.' . $request->file('file_rth_tk')->getClientOriginalExtension();
                $file_rth_tk->move($path, $file_rth_tk_name);
                $requestData['file_rth_tk'] = $file_rth_tk_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }
            if ($request->file('file_rth_tm') != null) {
                if ($out_tktm->file_rth_tm != null) unlink($path . '/' . $out_tktm->file_rth_tm);
                $file_rth_tm = $request->file('file_rth_tm');
                $file_rth_tm_name =  'file_rth_tm_' . rand() . '.' . $request->file('file_rth_tm')->getClientOriginalExtension();
                $file_rth_tm->move($path, $file_rth_tm_name);
                $requestData['file_rth_tm'] = $file_rth_tm_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }

            $out_tktm->update($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Transfer Updated!',
                'modal' => '#transfer_modal',
                'table' => '#transfer-table'
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
        $pathToFile = public_path('logistik/transfer_keluar') . '/' . $file_ppm;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_rth_tm($file_rth_tm)
    {
        $pathToFile = public_path('logistik/transfer_keluar') . '/' . $file_rth_tm;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_rth_tk($file_rth_tk)
    {
        $pathToFile = public_path('logistik/transfer_keluar') . '/' . $file_rth_tk;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

<?php

namespace App\Http\Controllers\matfaskes;

use App\Http\Controllers\Controller;
use App\Models\BaHibah;
use App\Models\DetailBrgMatkesM;
use App\Models\InTktm;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataMatkesController extends Controller
{
    public function index()
    {
        $active_menu = 'data_matkes';
        return view('matfaskes.data_matkes.index', compact('active_menu'));
    }

    public function list(Request $request)
    {
        $kontrak = Kontrak::select('kontrak.id_kontrak', DB::raw('YEAR(kontrak.tgl_kontrak) as tahun'), 'detail_brg_matkes_m.id_barang_masuk', 'kontrak.nomor_kontrak as nomor_brg_masuk', DB::raw('max(detail_brg_matkes_m.tgl_pendataan)'), 'detail_brg_matkes_m.nama_matkes', 'detail_brg_matkes_m.keterangan', DB::raw('sum(detail_brg_matkes_m.jumlah) as jml_brg_matfas'), DB::raw('sum(brg_out.jml_keluar) as jml_keluar'))
            ->leftJoin('detail_brg_matkes_m', 'kontrak.id_kontrak', 'detail_brg_matkes_m.id_barang_masuk')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek');

        if ($request->tahun) {
            $kontrak = $kontrak->whereYear('kontrak.tgl_kontrak', $request->tahun);
        } else {
            $kontrak = $kontrak->whereNotNull('kontrak.tgl_kontrak');
        }

        $kontrak = $kontrak->groupBy('kontrak.id_kontrak')
            ->get();

        $kontrak = $kontrak->transform(function ($item) {
            $item->jenis_matkes = 'Kontrak';
            return $item;
        });

        $ba_hibah = BaHibah::select('ba_hibah.id_ba_hibah', DB::raw('YEAR(ba_hibah.tgl_ba_hibah) as tahun'), 'detail_brg_matkes_m.id_barang_masuk', 'ba_hibah.no_ba_hibah as nomor_brg_masuk', DB::raw('max(detail_brg_matkes_m.tgl_pendataan)'), 'detail_brg_matkes_m.nama_matkes', 'detail_brg_matkes_m.keterangan', DB::raw('sum(detail_brg_matkes_m.jumlah) as jml_brg_matfas'), DB::raw('sum(brg_out.jml_keluar) as jml_keluar'))
            ->leftJoin('detail_brg_matkes_m', 'ba_hibah.id_ba_hibah', 'detail_brg_matkes_m.id_barang_masuk')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek');

        if ($request->tahun) {
            $ba_hibah = $ba_hibah->whereYear('ba_hibah.tgl_ba_hibah', $request->tahun);
        }

        $ba_hibah = $ba_hibah->groupBy('ba_hibah.id_ba_hibah')
            ->get();

        $ba_hibah = $ba_hibah->transform(function ($item) {
            $item->jenis_matkes = 'Hibah';
            return $item;
        });

        $in_tktm = InTktm::select('in_tktm.id_in_tktm', DB::raw('YEAR(in_tktm.tgl_kontrak_tktm) as tahun'), 'detail_brg_matkes_m.id_barang_masuk', 'in_tktm.no_kontrak_tktm as nomor_brg_masuk', DB::raw('max(detail_brg_matkes_m.tgl_pendataan)'), 'detail_brg_matkes_m.nama_matkes', 'detail_brg_matkes_m.keterangan', DB::raw('sum(detail_brg_matkes_m.jumlah) as jml_brg_matfas'), DB::raw('sum(brg_out.jml_keluar) as jml_keluar'))
            ->leftJoin('detail_brg_matkes_m', 'in_tktm.id_in_tktm', 'detail_brg_matkes_m.id_barang_masuk')
            ->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('brg_out', 'detail_brg_matkes_d.id_matkes_dobek', 'brg_out.id_matkes_dobek');

        if ($request->tahun) {
            $in_tktm = $in_tktm->whereYear('in_tktm.tgl_kontrak_tktm', $request->tahun);
        }

        $in_tktm = $in_tktm->groupBy('in_tktm.id_in_tktm')
            ->get();

        $in_tktm = $in_tktm->transform(function ($item) {
            $item->jenis_matkes = 'TKTM';
            return $item;
        });


        $detail_brg = $kontrak->merge($ba_hibah)->merge($in_tktm);

        return DataTables::of($detail_brg)
            // ->editColumn('no_barang_masuk', function ($query) {
            //     if (!empty($query->kontrak)) {
            //         return $query->kontrak->nomor_kontrak;
            //     } else if (!empty($query->hibah)) {
            //         return $query->hibah->no_ba_hibah;
            //     }
            //     return $query->tktm->no_kontrak_tktm;
            // })
            ->addColumn('sisa', function ($query) {
                // $sisa = $query->jumlah - $query->brg_out_sum_jml_keluar;
                $sisa = $query->jml_brg_matfas - $query->jml_keluar;
                return $sisa;
            })
            ->addColumn('action', function ($row) {
                $id_barang_masuk = '';
                if (!empty($row->id_kontrak)) {
                    $id_barang_masuk = $row->id_kontrak;
                } else if (!empty($row->id_ba_hibah)) {
                    $id_barang_masuk = $row->id_ba_hibah;
                } elseif (!empty($row->id_in_tktm)) {
                    $id_barang_masuk = $row->id_in_tktm;
                }

                $actionBtn = '<div class="text-center" title="Detail Matkes"><a data-nk="' . $row->nomor_brg_masuk . '" data-id="' . $id_barang_masuk . '" onclick="detail($(this))"><i data-feather="file-text" class="font-medium-4 text-primary"></i></a></div>';
                // $actionBtn = '<div class="text-center" title="Detail Matkes"><a data-toggle="modal" data-target="#detail_matkes"><i data-feather="file-text" class="font-medium-4 text-primary"></i></a></div>';
                return $actionBtn;
            })
            ->rawColumns(['action', 'sisa'])

            ->toJson();
    }

    public function detail($id_barang_masuk)
    {
        $detail_brg = DetailBrgMatkesM::with('rencana_pengeluaran')
            ->withSum('brg_out', 'jml_keluar')
            ->where('id_barang_masuk', $id_barang_masuk)
            ->get();

        return DataTables::of($detail_brg)
            ->addColumn('tujuan_penggunaan', function ($row) {
                return $row->rencana_pengeluaran->tujuan_penggunaan ?? '-';
            })
            ->addColumn('penerima', function ($row) {
                return $row->rencana_pengeluaran->penerima ?? '-';
            })
            ->rawColumns(['tujuan_penggunaan', 'penerima'])
            ->toJson();
    }
}

<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\InPengadaan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PengadaanMasukController extends Controller
{
    public function list_pengadaan($from_date, $to_date, $kode_dipa, $prefix_kontrak)
    {
        $data = InPengadaan::with('kontrak.vendor')->whereHas('kontrak', function (Builder $query) use ($kode_dipa, $prefix_kontrak) {
            $query->where('kode_dipa', $kode_dipa)->where('kode_kontrak', $prefix_kontrak);
        });

        if ($from_date != '*' && $to_date != '*') {
            $data->whereHas('kontrak.vendor', function (Builder $query) use ($from_date, $to_date) {
                $query->whereBetween('tgl_kontrak', [$from_date, $to_date]);
            });
        }

        $data->get();

        return DataTables::of($data)
            ->addColumn('nomor_kontrak', function ($row) {
                $nomor_kontrak = $row->kontrak->nomor_kontrak ?? '-';
                if ($row->kontrak->file_kontrak != null) {
                    $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.pengadaan_masuk.pdf_kontrak', $row->kontrak->file_kontrak) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                    return $nomor_kontrak . ' ' . $btn;
                }

                return $nomor_kontrak;
            })
            ->addColumn('nilai_kontrak', function ($row) {
                return  number_format($row->kontrak->nominal_kontrak, 2, ',', '.');
            })
            ->addColumn('tgl_kontrak', function ($row) {
                return date('d F Y', strtotime($row->kontrak->tgl_kontrak));
            })
            ->addColumn('pelaksana_kontrak', function ($row) {
                return $row->kontrak->vendor->nama_vendor ?? '-';
            })
            ->addColumn('file_rth', function ($row) {
                if ($row->file_rth == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.pengadaan_masuk.pdf_rth', $row->file_rth) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_rth . ' ' . $btn;
            })
            ->addColumn('status', function ($row) {
                if ($row->file_rth != null) {
                    return "<div class='mt-50'><div class='badge badge-light-success font-small-4'>Completed</div></div>";
                }
                return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Not Complete</div></div>";
            })
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><a title="Edit" data-url="' . route('bidum.logistik.pengadaan_masuk.update_pengadaan', $row->id_in_pengadaan) . '" data-id="' .  $row->id_in_pengadaan . '" onclick="edit_pengadaan($(this))"><i data-feather="edit" class="font-medium-4 text-primary"></i></a></div>';
            })
            ->rawColumns(['nomor_kontrak', 'nilai_kontrak', 'file_rth', 'pelaksana_kontrak', 'status', 'action'])
            ->toJson();
    }

    public function edit_pengadaan(InPengadaan $in_pengadaan)
    {
        return $in_pengadaan->load('kontrak');
    }

    public function update_pengadaan(Request $request, InPengadaan $in_pengadaan)
    {
        $requestData = $request->validate([
            'no_rth' => 'required',
            'file_rth' => 'required',
        ]);
        $data = $in_pengadaan->load('kontrak');
        if ($data->kontrak->kode_dipa == 'DIPPUS') {
            $table = 'pusat';
        } elseif ($data->kontrak->kode_dipa == 'DIPDAR') {
            $table = 'daerah';
        }
        try {
            $path = public_path('logistik/pengadaan_masuk');

            if ($request->file('file_rth') != null) {
                if ($in_pengadaan->file_rth) unlink($path . '/' . $in_pengadaan->file_rth);
                $file_rth = $request->file('file_rth');
                $file_rth_name =  rand() . '.' . $request->file('file_rth')->getClientOriginalExtension();
                $file_rth->move($path, $file_rth_name);
                $requestData['file_rth'] = $file_rth_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }
            $in_pengadaan->update($requestData);
            return response()->json([
                'error' => false,
                'message' => 'Successfully Update!',
                'modal' => '#pengadaan_modal',
                'table' => '#table-pengadaan-' . $table
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function pdf_rth($file_rth)
    {
        $pathToFile = public_path('logistik/pengadaan_masuk') . '/' . $file_rth;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_kontrak($file_kontrak)
    {
        $pathToFile = public_path('kontrak') . '/' . $file_kontrak;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

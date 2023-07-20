<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\BaHibah;
use App\Models\InHibah;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class HibahMasukController extends Controller
{
    public function list_hibah($from_date, $to_date, $kode_ba)
    {
        $data = BaHibah::with('vendor')->where('kode_ba_hibah',  $kode_ba);
        if ($from_date != '*' && $to_date != '*') {
            $data->whereBetween('tgl_ba_hibah', [$from_date, $to_date]);
        }
        $data->get();

        return DataTables::of($data)
            ->addColumn('no_ba_hibah', function ($row) {
                return $row->no_ba_hibah;
            })
            ->addColumn('file_app_hibah', function ($row) {
                if ($row->file_app_hibah == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.hibah_masuk.pdf_hibah', $row->file_app_hibah) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_app_hibah . ' ' . $btn;
            })
            ->editColumn('tgl_ba_hibah', function ($row) {
                return  date('j F Y', strtotime($row->tgl_ba_hibah));
            })
            ->editColumn('nominal', function ($row) {
                return  number_format($row->nominal, 2, ',', '.');
            })
            ->addColumn('status', function ($row) {
                if ($row->file_app_hibah != null) {
                    return "<div class='mt-50'><div class='badge badge-light-success font-small-4'>Completed</div></div>";
                }
                return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Not Complete</div></div>";
            })
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><a title="Edit" data-url="' . route('bidum.logistik.hibah_masuk.update_hibah', $row->id_ba_hibah) . '" data-id="' .  $row->id_ba_hibah . '" onclick="edit_hibah($(this))"><i data-feather="edit" class="font-medium-4 text-primary"></i></a></div>';
            })
            ->rawColumns(['file_app_hibah', 'status', 'action'])
            ->toJson();
    }

    public function edit_hibah(BaHibah $ba_hibah)
    {
        return $ba_hibah;
    }

    public function update_hibah(Request $request, BaHibah $ba_hibah)
    {
        $requestData = $request->validate([
            'no_app_hibah' => 'nullable',
            'tgl_app_hibah' => 'nullable',
            'file_app_hibah' => 'nullable',
        ]);

        try {
            $path = public_path('logistik/hibah_masuk');

            if ($request->file('file_app_hibah') != null) {
                if ($ba_hibah->file_app_hibah) unlink($path . '/' . $ba_hibah->file_app_hibah);
                $file_app_hibah = $request->file('file_app_hibah');
                $file_app_hibah_name =  rand() . '.' . $request->file('file_app_hibah')->getClientOriginalExtension();
                $file_app_hibah->move($path, $file_app_hibah_name);
                $requestData['file_app_hibah'] = $file_app_hibah_name;
                $requestData['tgl_last_upload_doc'] = date('Y-m-d');
            }
            $ba_hibah->update($requestData);
            return response()->json([
                'error' => false,
                'message' => 'Successfully Update!',
                'modal' => '#hibah_modal',
                'table' => '#table-hibah'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function pdf_hibah($file_app_hibah)
    {
        $pathToFile = public_path('logistik/hibah_masuk') . '/' . $file_app_hibah;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

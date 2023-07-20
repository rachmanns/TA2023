<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransferMasukRequest;
use App\Models\InTktm;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class TransferMasukController extends Controller
{
    public function store_transfer(TransferMasukRequest $request, $jenis_tktm)
    {
        try {
            $requestData = $request->validated();
            $tujuan_upload = public_path('logistik/transfer_masuk');

            $file_kontrak_tktm = $request->file('file_kontrak_tktm');
            $file_kontrak_tktm_name =  'file_kontrak_tktm_' . rand() . '.' . $request->file('file_kontrak_tktm')->getClientOriginalExtension();
            $file_kontrak_tktm->move($tujuan_upload, $file_kontrak_tktm_name);
            $requestData['file_kontrak_tktm'] = $file_kontrak_tktm_name;
            $requestData['tgl_upload'] = date('Y-m-d');
            $requestData['jenis_tktm'] = $jenis_tktm;
            $requestData['nominal'] = str_replace(array('Rp', '.'), '', $request->nominal);

            if ($request->file('file_rth_tm') != null) {
                $file_rth_tm = $request->file('file_rth_tm');
                $file_rth_tm_name =  'file_rth_tm_' . rand() . '.' . $request->file('file_rth_tm')->getClientOriginalExtension();
                $file_rth_tm->move($tujuan_upload, $file_rth_tm_name);
                $requestData['file_rth_tm'] = $file_rth_tm_name;
            }

            // if ($request->file('file_rth_tk') != null) {
            //     $file_rth_tk = $request->file('file_rth_tk');
            //     $file_rth_tk_name =  'file_rth_tk_' . rand() . '.' . $request->file('file_rth_tk')->getClientOriginalExtension();
            //     $file_rth_tk->move($tujuan_upload, $file_rth_tk_name);
            //     $requestData['file_rth_tk'] = $file_rth_tk_name;
            // }

            InTktm::create($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Dokumen Aset Masuk Created!',
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

    public function list_transfer($from_date, $to_date, $jenis_tktm)
    {
        $data = InTktm::with('vendor')->where('jenis_tktm', $jenis_tktm);

        if ($from_date != '*' && $to_date != '*') {
            $data = $data->whereBetween('tgl_kontrak_tktm', [$from_date, $to_date]);
        }

        $data->get();

        return DataTables::of($data)
            ->addColumn('no_kontrak_tktm', function ($row) {
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.transfer_masuk.pdf_kontrak_tktm', $row->file_kontrak_tktm) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return $row->no_kontrak_tktm . ' ' . $btn;
            })
            ->editColumn('nominal', function ($row) {
                return  number_format($row->nominal, 2, ',', '.');
            })
            ->editColumn('tgl_kontrak_tktm', function ($row) {
                return date('d F Y', strtotime($row->tgl_kontrak_tktm));
            })
            ->editColumn('pelaksana_tktm', function ($row) {
                return $row->vendor->nama_vendor ?? null;
            })
            ->addColumn('file_rth_tm', function ($row) {
                if ($row->file_rth_tm == null) {
                    return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
                }
                $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.transfer_masuk.pdf_rth_tm', $row->file_rth_tm) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                return  $row->no_rth_tm . ' ' . $btn;
            })
            // ->addColumn('file_rth_tk', function ($row) {
            //     if ($row->file_rth_tk == null) {
            //         return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Belum Upload Dokumen</div></div>";
            //     }
            //     $btn = "<div class='mt-50'><a href='" . route('bidum.logistik.transfer_masuk.pdf_rth_tk', $row->file_rth_tk) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
            //     return  $row->no_rth_tk . ' ' . $btn;
            // })
            ->addColumn('status', function ($row) {
                // if ($row->file_rth_tk != null && $row->file_rth_tm != null) {
                if ($row->file_rth_tm != null) {
                    return "<div class='mt-50'><div class='badge badge-light-success font-small-4'>Completed</div></div>";
                }
                return "<div class='mt-50'><div class='badge badge-light-danger font-small-4'>Not Complete</div></div>";
            })
            ->addColumn('action', function ($row) {
                $delete_button = '<a title="Delete" data-id="' . $row->id_in_tktm . '" data-url="' . url('bidum/logistik/transfer-masuk') . '" class="delete-data pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></a>';

                return '<div class="text-center"><a href="' . route('bidum.logistik.daftar_barang', $row->id_in_tktm) . '" title="Detail" class="pr-0 text-primary"><i data-feather="file-text" class="font-medium-4"></i></a></button><a title="Edit" class="pl-75" data-url="' . route('bidum.logistik.transfer_masuk.update_transfer', $row->id_in_tktm) . '" data-id="' .  $row->id_in_tktm . '" onclick="edit_transfer($(this))"><i data-feather="edit" class="font-medium-4 text-primary"></i></a>' . $delete_button . '</div>';
            })
            // ->rawColumns(['no_kontrak_tktm', 'file_rth_tm', 'file_rth_tk', 'status', 'action'])
            ->rawColumns(['no_kontrak_tktm', 'file_rth_tm', 'status', 'action'])
            ->toJson();
    }

    public function edit_transfer(InTktm $in_tktm)
    {
        return $in_tktm;
    }

    public function update_transfer(TransferMasukRequest $request, InTktm $in_tktm)
    {
        try {
            $requestData = $request->validated();
            $requestData['nominal'] = str_replace(array('Rp', '.'), '', $request->nominal);
            $path = public_path('logistik/transfer_masuk');

            if ($request->file('file_kontrak_tktm') != null) {
                unlink($path . '/' . $in_tktm->file_kontrak_tktm);
                $file_kontrak_tktm = $request->file('file_kontrak_tktm');
                $file_kontrak_tktm_name =  'file_kontrak_tktm_' . rand() . '.' . $request->file('file_kontrak_tktm')->getClientOriginalExtension();
                $file_kontrak_tktm->move($path, $file_kontrak_tktm_name);
                $requestData['file_kontrak_tktm'] = $file_kontrak_tktm_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }


            if ($request->file('file_rth_tm') != null) {
                if ($in_tktm->file_rth_tm != null) unlink($path . '/' . $in_tktm->file_rth_tm);
                $file_rth_tm = $request->file('file_rth_tm');
                $file_rth_tm_name =  'file_rth_tm_' . rand() . '.' . $request->file('file_rth_tm')->getClientOriginalExtension();
                $file_rth_tm->move($path, $file_rth_tm_name);
                $requestData['file_rth_tm'] = $file_rth_tm_name;
                $requestData['tgl_upload'] = date('Y-m-d');
            }

            // if ($request->file('file_rth_tk') != null) {
            //     if ($in_tktm->file_rth_tk != null) unlink($path . '/' . $in_tktm->file_rth_tk);
            //     $file_rth_tk = $request->file('file_rth_tk');
            //     $file_rth_tk_name =  'file_rth_tk_' . rand() . '.' . $request->file('file_rth_tk')->getClientOriginalExtension();
            //     $file_rth_tk->move($path, $file_rth_tk_name);
            //     $requestData['file_rth_tk'] = $file_rth_tk_name;
            //     $requestData['tgl_upload'] = date('Y-m-d');
            // }

            $in_tktm->update($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Transfer Masuk Updated!',
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

    public function pdf_rth_tm($file_rth_tm)
    {
        $pathToFile = public_path('logistik/transfer_masuk') . '/' . $file_rth_tm;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_rth_tk($file_rth_tk)
    {
        $pathToFile = public_path('logistik/transfer_masuk') . '/' . $file_rth_tk;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function pdf_kontrak_tktm($file_kontrak_tktm)
    {
        $pathToFile = public_path('logistik/transfer_masuk') . '/' . $file_kontrak_tktm;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function destroy(InTktm $in_tktm)
    {
        $in_tktm->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'Dokumen Aset Masuk Deleted!',
            'table' => '#transfer-table'
        ]);
    }
}

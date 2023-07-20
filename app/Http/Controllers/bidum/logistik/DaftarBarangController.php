<?php

namespace App\Http\Controllers\bidum\logistik;

use App\Http\Controllers\Controller;
use App\Models\BrgOut;
use App\Models\DetailBrgMatkesM;
use App\Models\InTktm;
use App\Models\KategoriBrg;
use App\Models\RencanaPengeluaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class DaftarBarangController extends Controller
{
    public function daftar_barang(InTktm $in_tktm)
    {
        $active_menu = 'aset_masuk';

        $detail_brg = DetailBrgMatkesM::where('id_barang_masuk', $in_tktm->id_in_tktm)->where('kode_barang', 'tktm')->orderBy('id_rencana', 'desc')->get();

        if ($detail_brg->isEmpty()) return view('bidum.logistik.transaksi_masuk.aset.empty_daftar_barang', compact('active_menu', 'in_tktm'));

        $total_harga = $detail_brg->sum(function ($t) {
            return $t->jumlah * $t->harga_satuan;
        });

        $detail_brg = $detail_brg->groupBy('id_rencana');

        $rencana_pengeluaran = RencanaPengeluaran::select('id_rencana', 'penerima')->get();

        $data = [];
        foreach ($detail_brg as $key => $value) {
            if ($key == null) $data['other'] = 'Belum ada tujuan/peruntukan';
            else $data[$key] = $rencana_pengeluaran->where('id_rencana', $key)->first()->penerima;
        }

        return view('bidum.logistik.transaksi_masuk.aset.daftar_barang_tujuan', compact('active_menu', 'in_tktm', 'data', 'total_harga'));
    }

    public function excel_import(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|mimes:xls,csv,xlsx|max:2000'
        ]);
        $file_array = explode(".", $request->file('file')->getClientOriginalName());
        $file_extension = end($file_array);

        $public_dir = base_path() . '/uploads/daftar_barang/';
        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($request->file('file'),  $public_dir . $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($public_dir . $file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($public_dir . $file_name);

        unlink($public_dir . $file_name);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        $data = [];
        for ($i = 1; $i < $count_rows; $i++) {
            $data[] = [
                'id_barang_masuk' => $request->id_barang_masuk,
                'kode_barang' => 'tktm',
                'kategori_barang' => ($rows[$i][0] == '-') ? null : $rows[$i][0],
                'nama_matkes' => $rows[$i][1],
                'jumlah' => $rows[$i][3],
                'harga_satuan' => $rows[$i][4],
                'jumlah_harga' => $rows[$i][3] * $rows[$i][4],
                'tgl_pendataan' => date('Y-m-d'),
                'satuan_brg' => $rows[$i][2],
                'keterangan' => $rows[$i][5]
            ];
        }

        $penerima = null;
        $tujuan_penggunaan = null;
        if ($request->rencana_pengeluaran == 'ada') {
            $penerima = $request->penerima;
            $tujuan_penggunaan = $request->tujuan_penggunaan;
        }
        $sum_jumlah = array_sum(array_column($data, 'jumlah'));
        $sum_harga_satuan = array_sum(array_column($data, 'harga_satuan'));
        $sum_jumlah_harga = array_sum(array_column($data, 'jumlah_harga'));

        return view('bidum.logistik.transaksi_masuk.aset.review_data_barang', [
            'active_menu' => 'aset_masuk',
            'data' => $data,
            'penerima' => $penerima,
            'tujuan_penggunaan' => $tujuan_penggunaan,
            'id_barang_masuk' => $request->id_barang_masuk,
            'sum_jumlah' => $sum_jumlah,
            'sum_harga_satuan' => $sum_harga_satuan,
            'sum_jumlah_harga' => $sum_jumlah_harga,
        ]);
    }

    public function excel_store(Request $request)
    {
        try {
            $data = json_decode($request->daftar_barang, true);

            if ($request->penerima != null && $request->tujuan_penggunaan != null) {
                $rencana_pengeluaran = RencanaPengeluaran::create([
                    'penerima' => $request->penerima,
                    'tujuan_penggunaan' => $request->tujuan_penggunaan
                ]);
            }
            foreach ($data as $key => $value) {
                $kat = KategoriBrg::firstOrCreate([
                    'nama_kategori' => $value['kategori_barang'] ? strtoupper(trim($value['kategori_barang'])) : 'LAIN-LAIN'
                ]);
                DetailBrgMatkesM::create([
                    'id_barang_masuk' => $value['id_barang_masuk'],
                    'kode_barang' => $value['kode_barang'],
                    'kategori_barang' => $kat->id_kategori,
                    'nama_matkes' => $value['nama_matkes'],
                    'jumlah' => $value['jumlah'],
                    'harga_satuan' => $value['harga_satuan'],
                    'tgl_pendataan' => $value['tgl_pendataan'],
                    'satuan_brg' => $value['satuan_brg'],
                    'id_rencana' => $rencana_pengeluaran->id_rencana ?? null,
                    'keterangan' => $value['keterangan']
                ]);
            }


            return response()->json([
                'error' => false,
                'message' => 'Succesfully upload file',
                'url' => url('bidum/logistik/daftar-barang') . '/' . $request->id_barang_masuk
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list_tujuan($id_barang_masuk, $kode_barang, $id_rencana)
    {
        $detail_barang = DetailBrgMatkesM::with('kategori_brg')->where('id_barang_masuk', $id_barang_masuk)->where('kode_barang', $kode_barang)->when($id_rencana <> 'other', function ($query) use ($id_rencana) {
            return $query->where('id_rencana', $id_rencana);
        }, function ($query) {
            return $query->whereNull('id_rencana');
        })
            ->get();

        return DataTables::of($detail_barang)
            ->editColumn('harga_satuan', function ($query) {
                return "Rp" . number_format($query->harga_satuan, 0, ',', '.');
            })
            ->addColumn('jumlah_harga', function ($query) {
                $total = $query->harga_satuan * $query->jumlah;
                return "Rp" . number_format($total, 0, ',', '.');
            })
            ->addColumn('kategori_barang', function ($query) {
                $kat = $query->kategori_brg->nama_kategori ?? $query->kategori_barang;
                return $kat;
            })
            ->addColumn('ket', function ($query) {
                return "";
            })
            ->rawColumns(['jumlah_harga', 'ket'])
            ->toJson();
    }

    public function destroy($id_rencana_pengeluaran)
    {
        try {
            $brg_out = BrgOut::where('id_rencana', $id_rencana_pengeluaran)->first();

            if (!empty($brg_out)) throw new Exception('Barang sudah out');

            DB::transaction(function () use ($id_rencana_pengeluaran) {
                DetailBrgMatkesM::where('id_rencana', $id_rencana_pengeluaran)->update(['id_rencana' => null]);
                RencanaPengeluaran::find($id_rencana_pengeluaran)->delete();
            });
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return response()->json(['error' => false, 'message' => 'Deleted', 'reload_page' => true]);
    }

    public function download_edit($id_barang_masuk)
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/detail_barang.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getProtection()->setSheet(true);
        $detail_brg = DetailBrgMatkesM::with('kategori_brg')->where('id_barang_masuk', $id_barang_masuk)->get();
        $i = 2;
        foreach ($detail_brg as $db) {
            $sheet->setCellValue('A' . $i, $db->kategori_brg->nama_kategori);
            $sheet->setCellValue('B' . $i, $db->nama_matkes);
            $sheet->setCellValue('C' . $i, $db->satuan_brg);
            $sheet->setCellValue('D' . $i, $db->jumlah);
            $sheet->setCellValue('E' . $i, (int)$db->harga_satuan);
            $sheet->setCellValue('F' . $i, $db->keterangan);
            $sheet->setCellValue('G' . $i, $db->id_matkes_matfas);
            $i++;
        }
        $sheet->getStyle('B2:B' . $i)->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        $sheet->getStyle('E2:E' . $i)->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        $sheet->getStyle('G2:G' . $i)->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="detail_barang_edit.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function edit_excel_brg(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|mimes:xls,csv,xlsx|max:2048'
        ]);
        $file_array = explode(".", $request->file('file')->getClientOriginalName());
        $file_extension = end($file_array);

        $public_dir = base_path() . '/uploads/daftar_barang/';
        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($request->file('file'),  $public_dir . $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($public_dir . $file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($public_dir . $file_name);

        unlink($public_dir . $file_name);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        $data = [];
        for ($i = 1; $i < $count_rows; $i++) {
            $data[] = [
                'kode_barang' => 'kontrak',
                'kategori_barang' => ($rows[$i][0] == '-') ? null : $rows[$i][0],
                'nama_matkes' => $rows[$i][1],
                'jumlah' => $rows[$i][3],
                'harga_satuan' => $rows[$i][4],
                'satuan_brg' => $rows[$i][2],
                'keterangan' => $rows[$i][5],
                'id_matkes_matfas' => $rows[$i][6]
            ];
        }

        $request->session()->put('data_detail_brg', json_encode($data));
        $request->session()->put('id_barang_masuk', $request->id_barang_masuk);

        return view('bidum.logistik.transaksi_masuk.aset.review_edit_data', [
            'active_menu' => 'pengadaan',
            'data' => $data
        ]);
    }

    public function update_excel_brg(Request $request)
    {
        $id_barang_masuk = $request->session()->get('id_barang_masuk', $request->id_brg_masuk);
        try {
            DB::transaction(function () use ($request) {

                $data_detail_brg = json_decode($request->session()->get('data_detail_brg'), true);
                foreach ($data_detail_brg as $k => $v) {
                    DetailBrgMatkesM::where('id_matkes_matfas', $v['id_matkes_matfas'])->update([
                        'nama_matkes' => $v['nama_matkes'],
                        'harga_satuan' => $v['harga_satuan']
                    ]);
                }
            });

            $request->session()->forget(['data_detail_brg', 'id_barang_masuk']);

            return redirect('bidum/logistik/daftar-barang/' . $id_barang_masuk);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}

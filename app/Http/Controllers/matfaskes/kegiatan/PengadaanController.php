<?php

namespace App\Http\Controllers\matfaskes\kegiatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengadaanRequest;
use App\Models\BrgOut;
use App\Models\DetailBrgMatkesM;
use App\Models\InPengadaan;
use App\Models\Kontrak;
use App\Models\RencanaPengeluaran;
use App\Models\Vendor;
use App\Models\KategoriBrg;
use App\Models\MasterBekkes;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class PengadaanController extends Controller
{
    public function index()
    {
        $data = [
            'active_menu' => 'pengadaan',
            'tahun' => date('Y')
        ];
        return view('matfaskes.kegiatan.pengadaan.index', $data);
    }

    public function create()
    {
        $active_menu = 'pengadaan';
        $vendor = Vendor::all();
        return view('matfaskes.kegiatan.pengadaan.create', compact('active_menu', 'vendor'));
    }

    public function store(PengadaanRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['jumlah'] = str_replace(array('Rp', '.'), '', $request->jumlah);
            $requestData['nominal_kontrak'] = str_replace(array('Rp', '.'), '', $request->nominal_kontrak);
            $path = public_path('kontrak');

            if ($request->file_kontrak != null) {
                $file_kontrak = $request->file('file_kontrak');
                $file_kontrak_name =  rand() . '.' . $request->file('file_kontrak')->getClientOriginalExtension();
                $file_kontrak->move($path, $file_kontrak_name);
                $requestData['file_kontrak'] = $file_kontrak_name;
            }

            if ($request->dasar_pengadaan != null) {
                $dasar_pengadaan = $request->file('dasar_pengadaan');
                $dasar_pengadaan_name =  rand() . '.' . $request->file('dasar_pengadaan')->getClientOriginalExtension();
                $dasar_pengadaan->move($path, $dasar_pengadaan_name);
                $requestData['dasar_pengadaan'] = $dasar_pengadaan_name;
            }

            if ($request->file_pendukung != null) {
                $file_pendukung = $request->file('file_pendukung');
                $file_pendukung_name =  rand() . '.' . $request->file('file_pendukung')->getClientOriginalExtension();
                $file_pendukung->move($path, $file_pendukung_name);
                $requestData['file_pendukung'] = $file_pendukung_name;
            }

            DB::transaction(function () use ($requestData) {
                $kontrak = Kontrak::create($requestData);
                InPengadaan::create([
                    'id_kontrak' => $kontrak->id_kontrak,
                    'nominal' => $kontrak->nominal_kontrak
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Pengadaan Created!',
                'url' => url('matfaskes/pengadaan')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(Kontrak $kontrak)
    {
        $active_menu = 'pengadaan';
        $vendor = Vendor::all();
        return view('matfaskes.kegiatan.pengadaan.create', compact('active_menu', 'vendor', 'kontrak'));
    }

    public function update(PengadaanRequest $request, Kontrak $kontrak)
    {
        try {
            $requestData = $request->validated();
            $requestData['jumlah'] = str_replace(array('Rp', '.'), '', $request->jumlah);
            $requestData['nominal_kontrak'] = str_replace(array('Rp', '.'), '', $request->nominal_kontrak);

            if ($request->file('file_kontrak') != null) {
                $path = public_path('kontrak');
                unlink($path . '/' . $kontrak->file_kontrak);
                $file_kontrak = $request->file('file_kontrak');
                $file_kontrak_name =  rand() . '.' . $request->file('file_kontrak')->getClientOriginalExtension();
                $file_kontrak->move($path, $file_kontrak_name);
                $requestData['file_kontrak'] = $file_kontrak_name;
            }

            if ($request->file('dasar_pengadaan') != null) {
                $path = public_path('kontrak');
                unlink($path . '/' . $kontrak->dasar_pengadaan);
                $dasar_pengadaan = $request->file('dasar_pengadaan');
                $dasar_pengadaan_name =  rand() . '.' . $request->file('dasar_pengadaan')->getClientOriginalExtension();
                $dasar_pengadaan->move($path, $dasar_pengadaan_name);
                $requestData['dasar_pengadaan'] = $dasar_pengadaan_name;
            }

            if ($request->file('file_pendukung') != null) {
                $path = public_path('kontrak');
                if ($kontrak->file_pendukung != null) unlink($path . '/' . $kontrak->file_pendukung);
                $file_pendukung = $request->file('file_pendukung');
                $file_pendukung_name =  rand() . '.' . $request->file('file_pendukung')->getClientOriginalExtension();
                $file_pendukung->move($path, $file_pendukung_name);
                $requestData['file_pendukung'] = $file_pendukung_name;
            }

            $kontrak->update($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Pengadaan Updated!',
                'url' => url('matfaskes/pengadaan')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list($kode_dipa, $tahun)
    {
        $kontrak = Kontrak::with('vendor')->where('kode_dipa', $kode_dipa)->whereYear('tgl_kegiatan_pengadaan', $tahun)->get();
        return DataTables::of($kontrak)
            ->addColumn('dipa_kegiatan', function ($query) {
                $tgl_dipa = date('j F Y', strtotime($query->tgl_dipa));
                $jumlah = number_format($query->jumlah, 0, ',', '.');
                return "{$query->nama_kegiatan} <br><br> {$query->no_dipa} {$tgl_dipa} <br><br> <span class='font-weight-bolder'>JUMLAH ANGGARAN</span> <div class='text-primary'>{$jumlah}</div>";
            })
            ->addColumn('jumlah', function ($query) {
                return 'Rp' . number_format($query->jumlah, 0, ',', '.');
            })
            ->addColumn('kontrak', function ($query) {
                $tgl_kontrak = '-';
                if ($query->tgl_kontrak != null) $tgl_kontrak = date('j F Y', strtotime($query->tgl_kontrak));
                $masa_berlaku = $query->masa_berlaku ?? 0;
                $nominal_kontrak = number_format($query->nominal_kontrak, 0, ',', '.');
                $url = '';
                if ($query->file_kontrak != null) $url = "<a href='" . route('matfaskes.pengadaan.pdf_kontrak', $query->file_kontrak) . "'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a>";

                return "{$query->nomor_kontrak} <br><br> {$tgl_kontrak} <br> Masa Berlaku: {$masa_berlaku} hari <br><br> <span class='font-weight-bolder'>NOMINAL KONTRAK</span> <div class='text-primary'>{$nominal_kontrak}</div> <br> <div class='badge badge-light-success font-small-4'>Pengadaan Matkes</div> <br> <div class='mt-50'>{$url}</div> ";
            })
            ->addColumn('pelaksanaan', function ($query) {
                $nama = $query->vendor->nama_vendor ?? null;
                $alamat = $query->vendor->alamat ?? null;
                $direktur = $query->vendor->direktur ?? null;
                $npwp = $query->vendor->npwp ?? null;

                return "{$nama} <br> {$alamat} <br><br> <span class='font-weight-bolder'>DIREKTUR</span> <br> {$direktur} <br><br> NPWP <br> {$npwp}";
            })
            ->addColumn('action', function ($query) {
                return "<div class='text-center'><div class='btn-group'>
                <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> More </button> 
                        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuButton'> 
                            <a class='dropdown-item' href='" . route('matfaskes.pengadaan.edit', $query->id_kontrak) . "'>Edit Data</a> 
                            <a class='dropdown-item' href='" . route('matfaskes.pengadaan.daftar_barang', $query->id_kontrak) . "'>Daftar Barang</a>
                            <a class='dropdown-item' data-id='" . $query->id_kontrak . "' data-url='" . route('matfaskes.pengadaan.update_lapju', $query->id_kontrak) . "' onclick='edit_lapju($(this))'>Edit Lapju</a>
                            <a class='dropdown-item delete-data' data-id='" . $query->id_kontrak . "' data-url='" . url('matfaskes/pengadaan') . "'>Delete Pengadaan</a>
                        </div>
                    </div>
                </div>";
            })
            ->rawColumns(['dipa_kegiatan', 'kontrak', 'pelaksanaan', 'action'])
            ->toJson();
    }

    public function pdf_kontrak($file_kontrak)
    {
        $pathToFile = public_path('kontrak') . '/' . $file_kontrak;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function edit_lapju(Kontrak $kontrak)
    {
        return $kontrak->only(['lapju_min', 'lapju_sik', 'keterangan']);
    }

    public function update_lapju(Request $request, Kontrak $kontrak)
    {
        $validatedData = $request->validate([
            'lapju_min' => 'nullable',
            'lapju_sik' => 'nullable',
            'keterangan' => 'nullable'
        ]);

        if ($kontrak->kode_dipa == 'DIPPUS') $table = '#table-pengadaan-pusat';
        else $table = '#table-pengadaan-daerah';

        try {
            $kontrak->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Lapju Updated!',
                'modal' => '#lapju',
                'table' => $table
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function daftar_barang(Kontrak $kontrak)
    {
        $active_menu = 'pengadaan';
        $detail_brg = DetailBrgMatkesM::where('id_barang_masuk', $kontrak->id_kontrak)->where('kode_barang', 'kontrak')->orderBy('id_rencana', 'desc')->get();

        if ($detail_brg->isEmpty()) return view('matfaskes.kegiatan.pengadaan.empty_barang', compact('active_menu', 'kontrak'));

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

        return view('matfaskes.kegiatan.pengadaan.daftar_barang_tujuan', compact('active_menu', 'kontrak', 'data', 'total_harga'));
    }

    public function excel_import(Request $request)
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
                'id_barang_masuk' => $request->id_barang_masuk,
                'kode_barang' => 'kontrak',
                'kategori_barang' => ($rows[$i][0] == '-') ? null : $rows[$i][0],
                'nama_matkes' => $rows[$i][1],
                'jumlah' => $rows[$i][3],
                'harga_satuan' => $rows[$i][4],
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

        return view('matfaskes.kegiatan.pengadaan.review_data', ['active_menu' => 'pengadaan', 'data' => $data, 'penerima' => $penerima, 'tujuan_penggunaan' => $tujuan_penggunaan, 'id_barang_masuk' => $request->id_barang_masuk]);
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
                'url' => url('matfaskes/pengadaan/daftar-barang') . '/' . $request->id_barang_masuk
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
                if ($query->kategori_brg) {
                    return $query->kategori_brg->nama_kategori;
                }
                return $query->kategori_barang;
            })
            ->addColumn('ket', function ($query) {
                return "";
            })
            ->rawColumns(['jumlah_harga', 'ket', 'kategori_barang'])
            ->toJson();
    }

    public function destroy_rencana_pengeluaran($id_rencana_pengeluaran)
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

    public function download()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/detail_barang.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getProtection()->setSheet(true);
        $master_bekkes = MasterBekkes::orderBy('urutan', 'asc')->get();
        $i = 2;
        foreach ($master_bekkes as $mb) {
            $sheet->setCellValue('B' . $i, $mb->nama_bekkes);
            $sheet->setCellValue('C' . $i, 'kat');
            $i++;
        }
        $sheet->getStyle('A2:A' . $i)->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        $sheet->getStyle('D2:F' . $i)->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="detail_barang_kat.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
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

        return view('matfaskes.kegiatan.pengadaan.review_edit_data', [
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

            return redirect('matfaskes/pengadaan/daftar-barang/' . $id_barang_masuk);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function destroy(Kontrak $kontrak)
    {
        $table = 'pusat';
        if ($kontrak->kode_dipa == 'DIPDAR') $table = 'daerah';
        $kontrak->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'Pengadaan Deleted!',
            'table' => '#table-pengadaan-' . $table
        ]);
    }
}

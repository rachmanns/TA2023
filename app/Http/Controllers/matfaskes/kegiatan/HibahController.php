<?php

namespace App\Http\Controllers\matfaskes\kegiatan;

use App\Http\Controllers\Controller;
use App\Http\Requests\HibahRequest;
use App\Models\BaHibah;
use App\Models\BrgOut;
use App\Models\DetailBrgMatkesM;
use App\Models\KategoriBrg;
use App\Models\RencanaPengeluaran;
use App\Models\Vendor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class HibahController extends Controller
{
    public function index()
    {
        $active_menu = 'hibah';
        return view('matfaskes.kegiatan.hibah.index', compact('active_menu'));
    }

    public function create()
    {
        $active_menu = 'hibah';
        $vendor = Vendor::get();
        return view('matfaskes.kegiatan.hibah.create', compact('active_menu', 'vendor'));
    }

    public function store(HibahRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['nominal'] = str_replace(array('Rp', '.'), '', $request->nominal);

            $path = public_path('ba_hibah');
            $file_ba_hibah = $request->file('file_ba_hibah');
            $file_ba_hibah_name =  rand() . '.' . $request->file('file_ba_hibah')->getClientOriginalExtension();
            $file_ba_hibah->move($path, $file_ba_hibah_name);
            $requestData['file_ba_hibah'] = $file_ba_hibah_name;
            $requestData['tgl_last_upload_doc'] = date('Y-m-d');

            BaHibah::create($requestData);

            return response()->json([
                'error' => false,
                'message' => 'Hibah Created!',
                'url' => url('matfaskes/hibah')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        $ba_hibah = BaHibah::with('vendor')->whereYear('tgl_ba_hibah', $request->year)->latest()->get();
        return DataTables::of($ba_hibah)
            ->addColumn('ba', function ($query) {
                return $query->no_ba_hibah . " <br> " . date('j F Y', strtotime($query->tgl_ba_hibah)) . " <br> <div class='mt-50'><a href='" . route('matfaskes.hibah.pdf_ba_hibah', $query->file_ba_hibah) . "'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
            })
            ->addColumn('tahun', function ($query) {
                return date('Y', strtotime($query->tgl_ba_hibah));
            })
            ->editColumn('nominal', function ($query) {
                return "Rp" . number_format($query->nominal, 0, ',', '.');;
            })
            ->addColumn('jenis_barang', function ($query) {
                if ($query->kode_ba_hibah == 'A') {
                    return "<div class='text-center'><div class='badge badge-light-success font-small-4'>Alkes</div></div>";
                } else {
                    return "<div class='text-center'><div class='badge badge-light-success font-small-4'>Bekkes</div></div>";
                }
            })
            ->addColumn('action', function ($query) {
                return "<div class='text-center'><div class='btn-group'><button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'> More </button> <div class='dropdown-menu dropdown-menu-left' aria-labelledby='dropdownMenuButton'> <a class='dropdown-item' href='" . route('matfaskes.hibah.edit', $query->id_ba_hibah) . "'>Edit Data</a> <a class='dropdown-item' href='" . route('matfaskes.hibah.daftar_barang', $query->id_ba_hibah) . "'>Daftar Barang</a></div></div></div>";
            })
            ->rawColumns(['ba', 'jenis_barang', 'action'])
            ->toJson();
    }

    public function edit(BaHibah $ba_hibah)
    {
        $active_menu = 'hibah';
        $vendor = Vendor::get();
        $kode_ba_hibah = $ba_hibah->kode_ba_hibah;
        return view('matfaskes.kegiatan.hibah.create', compact('active_menu', 'vendor', 'ba_hibah', 'kode_ba_hibah'));
    }

    public function update(HibahRequest $request, BaHibah $ba_hibah)
    {
        try {
            $requestData = $request->validated();
            $requestData['nominal'] = str_replace(array('Rp', '.'), '', $request->nominal);

            if ($request->file('file_ba_hibah') != null) {
                $path = public_path('ba_hibah');
                unlink($path . '/' . $ba_hibah->file_ba_hibah);
                $file_ba_hibah = $request->file('file_ba_hibah');
                $file_ba_hibah_name =  rand() . '.' . $request->file('file_ba_hibah')->getClientOriginalExtension();
                $file_ba_hibah->move($path, $file_ba_hibah_name);
                $requestData['file_ba_hibah'] = $file_ba_hibah_name;
                $requestData['tgl_last_upload_doc'] = date('Y-m-d');
            }

            $ba_hibah->update($requestData);

            return response()->json([
                'error' => false,
                'message' => 'BA Hibah Updated!',
                'url' => url('matfaskes/hibah')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function daftar_barang(BaHibah $ba_hibah)
    {
        $active_menu = 'hibah';
        $detail_brg = DetailBrgMatkesM::where('id_barang_masuk', $ba_hibah->id_ba_hibah)->where('kode_barang', 'hibah')->orderBy('id_rencana', 'desc')->get();

        if ($detail_brg->isEmpty()) return view('matfaskes.kegiatan.hibah.empty_barang', compact('active_menu', 'ba_hibah'));

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

        return view('matfaskes.kegiatan.hibah.daftar_barang_tujuan', compact('active_menu', 'ba_hibah', 'data', 'total_harga'));
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
            if ($rows[$i][1] !== null) {
                $data[] = [
                    'id_barang_masuk' => $request->id_barang_masuk,
                    'kode_barang' => 'hibah',
                    'kategori_barang' => ($rows[$i][0] == '-') ? null : $rows[$i][0],
                    'nama_matkes' => $rows[$i][1],
                    'jumlah' => $rows[$i][3],
                    'harga_satuan' => $rows[$i][4],
                    'tgl_pendataan' => date('Y-m-d'),
                    'satuan_brg' => $rows[$i][2],
                    'keterangan' => $rows[$i][5]
                ];
            }
        }

        $penerima = null;
        $tujuan_penggunaan = null;
        if ($request->rencana_pengeluaran == 'ada') {
            $penerima = $request->penerima;
            $tujuan_penggunaan = $request->tujuan_penggunaan;
        }

        return view('matfaskes.kegiatan.hibah.review_data', ['active_menu' => 'pengadaan', 'data' => $data, 'penerima' => $penerima, 'tujuan_penggunaan' => $tujuan_penggunaan, 'id_barang_masuk' => $request->id_barang_masuk]);
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
                'url' => url('matfaskes/hibah/daftar-barang') . '/' . $request->id_barang_masuk
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
            ->rawColumns(['jumlah_harga', 'ket'])
            ->toJson();
    }

    public function pdf_ba_hibah($file_ba_hibah)
    {
        $pathToFile = public_path('ba_hibah') . '/' . $file_ba_hibah;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
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
}

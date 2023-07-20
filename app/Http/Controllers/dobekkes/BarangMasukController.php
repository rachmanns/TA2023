<?php

namespace App\Http\Controllers\dobekkes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\DetailBrgMatkesM;
use App\Models\DetailBrgMatkesD;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BarangMasukController extends Controller
{
    public function kontrakList(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $query = '';
        if (!$request->jenis || ($request->jenis && substr($request->jenis, 0, 3) == 'DIP')) $query .= "SELECT id_kontrak AS id, tgl_kontrak AS tgl, nomor_kontrak AS no, 'Pengadaan' AS jenis, nominal_kontrak AS nilai, file_kontrak AS link, kode_kontrak AS kk, kode_dipa AS kd, SUM(d.jumlah) AS jml FROM kontrak LEFT JOIN detail_brg_matkes_m d ON kontrak.id_kontrak = d.id_barang_masuk WHERE SUBSTR(tgl_kontrak, 1, 4) = '" . ($request->tahun ?? date('Y')) . "'" . ($request->jenis ? (" AND kode_dipa =  '" . substr($request->jenis, 0, 6) . "' AND kode_kontrak = '" . substr($request->jenis, -1) . "'") : '') . " GROUP BY id_kontrak";
        if (!$request->jenis || ($request->jenis && $request->jenis == 'TKTM')) {
            if (!$request->jenis) $query .= ' UNION ';
            $query .= "SELECT id_in_tktm AS id, tgl_kontrak_tktm AS tgl, no_kontrak_tktm AS no, 'TKTM' AS jenis, nominal AS nilai, file_kontrak_tktm AS link, '-' AS kk, '-' AS kd, SUM(d.jumlah) AS jml FROM in_tktm JOIN detail_brg_matkes_m d ON in_tktm.id_in_tktm = d.id_barang_masuk WHERE SUBSTR(tgl_kontrak_tktm, 1, 4) = '" . ($request->tahun ?? date('Y')) . "'  GROUP BY id_in_tktm";
        }
        if (!$request->jenis || ($request->jenis && $request->jenis == 'Hibah')) {
            if (!$request->jenis) $query .= ' UNION ';
            $query .= "SELECT id_ba_hibah AS id, tgl_ba_hibah AS tgl, no_ba_hibah AS no, 'Hibah' AS jenis, nominal AS nilai, file_ba_hibah AS link, '-' AS kk, '-' AS kd, SUM(d.jumlah) AS jml FROM ba_hibah JOIN detail_brg_matkes_m d ON ba_hibah.id_ba_hibah = d.id_barang_masuk WHERE SUBSTR(tgl_ba_hibah, 1, 4) = '" . ($request->tahun ?? date('Y')) . "'  GROUP BY id_ba_hibah";
        }
        $trx = DB::select("SELECT * FROM ($query) AS data ORDER BY tgl DESC");
        foreach ($trx as $t) {
            $t->tgl = date_format(date_create($t->tgl), 'j F Y');
            $t->nilai = 'Rp ' . number_format($t->nilai, 0, '', '.');
            $t->link = url('dobekkes/barang-masuk/file-kontrak/' . substr($t->jenis, 0, 1) . '/' . $t->link);
            if ($t->jenis == 'Pengadaan') {
                if ($t->kd == 'DIPPUS') $t->jenis .= ' KP';
                else $t->jenis .= ' KD';
                if ($t->kk == 'A') $t->jenis .= ' - Alkes';
                else $t->jenis .= ' - Bekkes';
                $query = 'kontrak ON kontrak.id_kontrak = m.id_barang_masuk WHERE id_kontrak';
            } else if ($t->jenis == 'TKTM') $query = 'in_tktm ON id_in_tktm = m.id_barang_masuk WHERE id_in_tktm';
            else $query = 'ba_hibah ON id_ba_hibah = m.id_barang_masuk WHERE id_ba_hibah';
            $t->jenis = '<div class="text-center"><div class="badge badge-light-primary font-small-4 mt-50">' . $t->jenis . '</div></div>';
            $brgGudang = DB::select("SELECT SUM(COALESCE(d.jumlah, 0)) AS jml FROM detail_brg_matkes_d d JOIN detail_brg_matkes_m m USING (id_matkes_matfas) JOIN $query = '" . $t->id . "'")[0];
            $t->jml = $t->jml ?? 0;
            $brgGudang->jml = $brgGudang->jml ?? 0;
            $t->jmlBrg = $t->jml - $brgGudang->jml;
            $t->jml .= ' Barang <br /><div class="badge badge-light-' . ($t->jml > 0 && $t->jml == $brgGudang->jml ? 'primary' : 'warning') . ' font-small-4 mt-50">' . ($brgGudang->jml) . ' Barang di gudang</div>';
        }
        return DataTables::of($trx)
            ->addIndexColumn()
            ->rawColumns(['jenis', 'jml'])
            ->make(true);
    }

    public function kontrakFile($type, $file)
    {
        if ($type == 'P') $f = 'kontrak';
        else if ($type == 'H') $f = 'ba_hibah';
        else $f = 'logistik/transfer_masuk';
        $pathToFile = public_path($f) . '/' . $file;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }

    public function barangList($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $brg = DetailBrgMatkesM::selectRaw('detail_brg_matkes_m.id_matkes_matfas as id, nama_matkes, detail_brg_matkes_m.jumlah, satuan_brg, SUM(detail_brg_matkes_d.jumlah) as jmlBrgGudang')->leftJoin('detail_brg_matkes_d', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')->where('id_barang_masuk', $id)->groupBy('id')->havingRaw('detail_brg_matkes_m.jumlah - SUM(COALESCE(detail_brg_matkes_d.jumlah, 0)) > 0')->get();
        foreach ($brg as $b) {
            $b->responsive_id = '';
            $b->exp_date = '&nbsp;<div id="exp' . $b->id . '"></div>';
            $b->jml = ($b->jumlah-$b->jmlBrgGudang) . ' <span id="sat' . $b->id . '">' . $b->satuan_brg . '</span><div id="jml' . $b->id . '"></div>';
        }
        return DataTables::of($brg)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = 
                '<div class="text-center">
                    <a class="item-edit" title="Edit" data-id="' .  $row->id . '" data-nama="' .  $row->nama_matkes . '" data-jml="' . ($row->jumlah-$row->jmlBrgGudang) . '" onclick="edit_exp($(this))">
                        <i data-feather="edit" class="font-medium-4"></i>
                    </a>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['jml','exp_date','action'])
            ->make(true);
    }

    public function inputBarangGudang(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        foreach(json_decode($request->form_data) as $d) {
            $brg = new DetailBrgMatkesD;
            $brg->id_matkes_matfas = $d->id;
            $brg->id_gudang = $request->idg;
            $brg->jumlah = $d->jml;
            if ($d->exp) $brg->exp_date = $d->exp;
            $brg->save();
        }
        return response()->json(["error" => false, "message" => 'Barang berhasil dimasukkan ke gudang']);
    }

    public function barangGudangList($id)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = DetailBrgMatkesD::selectRaw('id_matkes_dobek as id, detail_brg_matkes_d.*, nomor_kontrak as no, nama_matkes, nama_kategori, satuan_brg, detail_brg_matkes_m.keterangan, \'Kontrak\' AS jenis')
            ->withSum('brg_out', 'jml_keluar')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->join('kontrak', 'detail_brg_matkes_m.id_barang_masuk', 'kontrak.id_kontrak')
            ->leftJoin('kategori_brg', 'detail_brg_matkes_m.kategori_barang', 'kategori_brg.id_kategori')
            ->where('id_gudang', $id);
        $data = DetailBrgMatkesD::selectRaw('id_matkes_dobek as id, detail_brg_matkes_d.*, no_kontrak_tktm as no, nama_matkes, nama_kategori, satuan_brg, detail_brg_matkes_m.keterangan, \'TKTM\' AS jenis')
            ->withSum('brg_out', 'jml_keluar')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->join('in_tktm', 'detail_brg_matkes_m.id_barang_masuk', 'in_tktm.id_in_tktm')
            ->leftJoin('kategori_brg', 'detail_brg_matkes_m.kategori_barang', 'kategori_brg.id_kategori')
            ->where('id_gudang', $id)
            ->union($data);
        $data = DetailBrgMatkesD::selectRaw('id_matkes_dobek as id, detail_brg_matkes_d.*, no_ba_hibah as no, nama_matkes, nama_kategori, satuan_brg, detail_brg_matkes_m.keterangan, \'Hibah\' AS jenis')
            ->withSum('brg_out', 'jml_keluar')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->join('ba_hibah', 'detail_brg_matkes_m.id_barang_masuk', 'ba_hibah.id_ba_hibah')
            ->leftJoin('kategori_brg', 'detail_brg_matkes_m.kategori_barang', 'kategori_brg.id_kategori')
            ->where('id_gudang', $id)
            ->union($data)
            ->get();
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $actionBtn = 
                '<div class="text-center">
                    <a class="item-edit text-primary" title="Edit" data-id="' . $row->id . '" data-exp="' . $row->exp_date . '" onclick="edit_exp($(this))">
                        <i data-feather="edit" class="font-medium-4"></i>
                    </a>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function updateExpDate(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $brg = DetailBrgMatkesD::find($request->id);
        $brg->exp_date = $request->exp;
        $brg->save();
        return response()->json(["error" => false, "message" => 'Exp. Date Barang berhasil di-update']);
    }

    public function dashboard(Request $request)
    {
        $total_ = DB::select("SELECT SUM(d.jumlah) AS jumlah, SUM(d.jumlah*harga_satuan) AS nilai, id_gudang FROM detail_brg_matkes_d d JOIN detail_brg_matkes_m m USING (id_matkes_matfas) GROUP BY id_gudang");
        $total_out = DB::select("SELECT SUM(jml_keluar) AS jumlah, SUM(jml_keluar*harga_satuan) AS nilai, id_gudang FROM brg_out JOIN detail_brg_matkes_d USING (id_matkes_dobek) JOIN detail_brg_matkes_m m USING (id_matkes_matfas) GROUP BY id_gudang");
        $total = array();
        $gdgKosong = array();
        foreach($total_ as $t) {
            $j = substr($t->id_gudang, -1);
            $total[$j-1] = $t;
        }
        foreach($total_out as $t) {
            $j = substr($t->id_gudang, -1);
            if (isset($total[$j-1])) {
                $total[$j-1]->jumlah -= $t->jumlah;
                $total[$j-1]->nilai -= $t->nilai;
            }
        }
		for($i=0;$i<3;$i++) {
            if (!isset($total[$i])) {
                $total[$i]['jumlah'] = 0;
                $total[$i]['nilai'] = 0;
                $total[$i] = json_decode(json_encode($total[$i]));
            }
            if ($total[$i]->jumlah == 0) $gdgKosong[] = $i+1;
        }
        $stok = DB::select("SELECT SUM(COALESCE(jml_keluar, 0)) AS jumlah, id_gudang, nama_kategori FROM brg_out JOIN detail_brg_matkes_d USING (id_matkes_dobek) JOIN detail_brg_matkes_m m USING (id_matkes_matfas) JOIN kategori_brg k ON m.kategori_barang = k.id_kategori GROUP BY id_gudang, nama_kategori ORDER BY id_gudang, id_kategori");
        $datao = array();
        foreach($stok as $d) {
          if (!in_array(substr($d->id_gudang, -1), $gdgKosong))
            $datao[$d->id_gudang . $d->nama_kategori] = $d->jumlah;
        }
        $stok = DB::select("SELECT SUM(COALESCE(d.jumlah, 0)) AS jumlah, id_gudang, nama_kategori FROM detail_brg_matkes_d d JOIN detail_brg_matkes_m m USING (id_matkes_matfas) RIGHT JOIN kategori_brg k ON m.kategori_barang = k.id_kategori GROUP BY id_gudang, nama_kategori ORDER BY id_gudang, id_kategori");
        $data = array('Gudang 1'=>array('labels'=>array(), 'series'=>array()), 'Gudang 2'=>array('labels'=>array(), 'series'=>array()), 'Gudang 3'=>array('labels'=>array(), 'series'=>array()));
        $dataall = array();
        foreach($stok as $d) {
          if (!in_array(substr($d->id_gudang, -1), $gdgKosong)) {
            if (isset($d->id_gudang) && isset($datao[$d->id_gudang . $d->nama_kategori])) $d->jumlah -= $datao[$d->id_gudang . $d->nama_kategori];
            $data[$d->id_gudang]['labels'][] = $d->nama_kategori;
            $data[$d->id_gudang]['series'][] = $d->jumlah;
            if (!isset($dataall[$d->nama_kategori])) $dataall[$d->nama_kategori] = 0;
            $dataall[$d->nama_kategori] += $d->jumlah;
          }
        }
        $data_p = array();
        $kat = array();
        foreach($dataall as $k => $jml) {
            $kat[] = $k;
            $data_p[] = $jml;
		}
        $a = DB::select("SELECT jml_aset, nama_aset FROM aset_dobek");
        $aset_nama = array();
        $aset_jml = array();
        foreach($a as $d) {
            $aset_nama[] = $d->nama_aset;
            $aset_jml[] = $d->jml_aset;
		}
		$active_menu = 'dashboard_dobekkes';
        return view('dobekkes.dashboard', compact(
            'total',
            'data',
            'data_p',
            'kat',
            'aset_nama',
            'aset_jml',
            'active_menu'
        ));
    }

    public function stokOpname()
    {
        $data = DetailBrgMatkesD::selectRaw('nama_matkes, nama_kategori, harga_satuan, satuan_brg, keterangan, id_gudang, SUM(COALESCE(detail_brg_matkes_d.jumlah, 0)) AS jumlah')
            ->withSum('brg_out', 'jml_keluar')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('kategori_brg', 'detail_brg_matkes_m.kategori_barang', 'kategori_brg.id_kategori')
            ->groupBy('nama_matkes', 'harga_satuan', 'satuan_brg')
            ->orderByRaw('id_gudang, nama_kategori')
            ->get();
        $total = array();
        foreach ($data as $d) {
            if (!isset($d->nama_kategori)) $d->nama_kategori = 'LAIN-LAIN';
            if (!isset($total[$d->id_gudang])) $total[$d->id_gudang] = 0;
            $total[$d->id_gudang] += ($d->jumlah - $d->brg_out_sum_jml_keluar) * $d->harga_satuan;
            $d->stok = number_format($d->jumlah - $d->brg_out_sum_jml_keluar, 0, '', '.') . ' ' . $d->satuan_brg;
            $d->harga_total = 'Rp ' . number_format(($d->jumlah - $d->brg_out_sum_jml_keluar) * $d->harga_satuan, 0, '', '.');
            $d->harga_satuan = 'Rp ' . number_format($d->harga_satuan, 0, '', '.');
            unset($d->jumlah, $d->brg_out_sum_jml_keluar);
        }
        foreach ($data as $d) {
            $d->id_gudang = 'STOK ' . $d->id_gudang . ' (Rp ' . number_format($total[$d->id_gudang], 0, '', '.') . ')';
        }
        return DataTables::of($data)
            ->make(true);
    }

    public function exportStokOpname()
    {
        $data = DetailBrgMatkesD::selectRaw('nama_matkes, nama_kategori, harga_satuan, satuan_brg, keterangan, id_gudang, SUM(COALESCE(detail_brg_matkes_d.jumlah, 0)) AS jumlah')
            ->withSum('brg_out', 'jml_keluar')
            ->join('detail_brg_matkes_m', 'detail_brg_matkes_d.id_matkes_matfas', 'detail_brg_matkes_m.id_matkes_matfas')
            ->leftJoin('kategori_brg', 'detail_brg_matkes_m.kategori_barang', 'kategori_brg.id_kategori')
            ->groupBy('nama_matkes', 'harga_satuan', 'satuan_brg')
            ->orderByRaw('id_gudang, id_kategori')
            ->get();
        $total = array();
        $totalkat = array();
        $totals = 0;
        foreach ($data as $d) {
            if (!isset($d->nama_kategori)) $d->nama_kategori = 'LAIN-LAIN';
            if (!isset($total[$d->id_gudang])) $total[$d->id_gudang] = 0;
            if (!isset($totalkat[$d->id_gudang . $d->nama_kategori])) $totalkat[$d->id_gudang . $d->nama_kategori] = 0;
            $total_harga = ($d->jumlah - $d->brg_out_sum_jml_keluar) * $d->harga_satuan;
            $total[$d->id_gudang] += $total_harga;
            $totalkat[$d->id_gudang . $d->nama_kategori] += $total_harga;
            $totals += $total_harga;
            $d->stok = number_format($d->jumlah - $d->brg_out_sum_jml_keluar, 0, '', '.');
            $d->harga_total = number_format($total_harga, 2, ',', '.');
            $d->harga_satuan = number_format($d->harga_satuan, 2, ',', '.');
        }

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet();

        $sheet = $spreadsheet->createSheet(0);
        $style = [
            'font' => [
                'bold' => false,
                'name'  => 'Arial',
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $style_judul = [
            'font' => [
                'bold' => true,
                'name'  => 'Arial',
                'size' => 11
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];
        $style_borders = [
            'borders' => [
                'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
                'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,],
            ],
        ];
        $sheet->mergeCells('A7:G7')
                ->mergeCells('A8:G8')
                ->mergeCells('A10:A11')
                ->mergeCells('B10:B11')
                ->mergeCells('C10:C11')
                ->mergeCells('D10:D11')
                ->mergeCells('E10:F10')
                ->mergeCells('G10:G11');
        $sheet->setCellValue('B1', 'MARKAS BESAR TENTARA NASIONAL INDONESIA');
        $sheet->setCellValue('B2', 'PUSAT KESEHATAN');
        $sheet->setCellValue('B3', '__________________________________________');
        $sheet->setCellValue('G1', 'Lampiran BA Stock Opname Puskes TNI');
        $sheet->setCellValue('G2', 'Nomor');
        $sheet->setCellValue('G3', 'Tanggal');
        $sheet->setCellValue('G4', '___________________________________');
        $sheet->setCellValue('A7', 'DATA STOK OPNAME PUSKES TNI');
        $sheet->setCellValue('A8', 'SM   TA ' . date('Y'));
        $sheet->setCellValue('A10', ' NO ');
        $sheet->setCellValue('B10', ' NAMA BARANG/ SATUAN ');
        $sheet->setCellValue('C10', ' SATUAN ');
        $sheet->setCellValue('D10', ' STOK AKHIR ');
        $sheet->setCellValue('E10', ' JUMLAH ');
        $sheet->setCellValue('E11', ' HARGA SAT ');
        $sheet->setCellValue('F11', ' HARGA TOTAL ');
        $sheet->setCellValue('G10', ' Keterangan ');
        $sheet->setCellValue('G12', '9');
        $ch = 'A';
        for ($i=1;$i<=6;$i++) {
            $sheet->setCellValue($ch++ . '12', $i);
        }
        $sheet->getStyle('B1:B3')->applyFromArray($style);
        $sheet->getStyle('A7:A8')->applyFromArray($style_judul);
        $sheet->getStyle('A10:G12')->applyFromArray($style_judul);
        $style_d = $style;
        unset($style_d['alignment']);
        $sheet->getStyle('G1:G4')->applyFromArray($style_d);

        $i = 14;
        $gdgke = 0;
        $gdg = '';
        $kat = '';
        $ii = 1;
        foreach ($data as $d) {
            if ($gdg != '' && $kat != '' && ($gdg != $d->id_gudang || $kat != $d->nama_kategori)) {
                $sheet->setCellValue('F' . $i, number_format($totalkat[$gdg . $kat], 2, ',', '.'));
                $sheet->getStyle('F' . $i)->applyFromArray($style_gdg);
                $i += 2;
            }

            if ($gdg != $d->id_gudang) {
                $gdg = $d->id_gudang;
                $ch = 'A';
                $gdgke++;
                $rom = '';
                for($j = 0; $j < $gdgke; $j++) $rom .= 'I';
                $sheet->setCellValue('A' . $i, $rom);
                $sheet->setCellValue('B' . $i, 'STOK ' . $d->id_gudang);
                $sheet->setCellValue('F' . $i, number_format($total[$d->id_gudang], 2, ',', '.'));
                $sheet->getStyle('A' . $i)->applyFromArray($style_judul);
                $style_gdg = $style_judul;
                unset($style_gdg['alignment']);
                $sheet->getStyle('B' . $i)->applyFromArray($style_gdg);
                $style_gdg['alignment'] = [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                ];
                $sheet->getStyle('F' . $i)->applyFromArray($style_gdg);
                $i += 2;
            }

            if ($kat != $d->nama_kategori) {
                $kat = $d->nama_kategori;
                $sheet->setCellValue('A' . $i, $ch++);
                $sheet->setCellValue('B' . $i, $d->nama_kategori);
                $sheet->getStyle('A' . $i)->applyFromArray($style_judul);
                $style_cat = $style_judul;
                unset($style_cat['alignment']);
                $sheet->getStyle('B' . $i)->applyFromArray($style_cat);
                $i += 2;
            }

            $sheet->setCellValue('A' . $i, $ii++);
            $sheet->setCellValue('B' . $i, $d->nama_matkes);
            $sheet->setCellValue('C' . $i, $d->satuan_brg);
            $sheet->setCellValueExplicit('D' . $i, $d->stok, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('E' . $i, $d->harga_satuan);
            $sheet->setCellValue('F' . $i, $d->harga_total);
            $sheet->setCellValue('G' . $i, $d->keterangan);
            $style_d = $style;
            $sheet->getStyle('A' . $i)->applyFromArray($style);
            $sheet->getStyle('C' . $i)->applyFromArray($style);
            unset($style_d['alignment']);
            $sheet->getStyle('B' . $i)->applyFromArray($style_d);
            $sheet->getStyle('G' . $i)->applyFromArray($style_d);
            $style_d['alignment'] = [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
            ];
            $sheet->getStyle('D' . $i)->applyFromArray($style_d);
            $sheet->getStyle('E' . $i)->applyFromArray($style_d);
            $sheet->getStyle('F' . $i++)->applyFromArray($style_d);
        }
        $sheet->setCellValue('F' . $i, number_format($totalkat[$gdg . $kat], 2, ',', '.'));
        $sheet->getStyle('F' . $i++)->applyFromArray($style_gdg);
        $sheet->mergeCells('B' . ++$i . ':D' . $i);
        $sheet->setCellValue('B' . $i, 'Total');
        $sheet->getStyle('B' . $i)->applyFromArray($style_judul);
        $sheet->setCellValue('F' . $i, number_format($totals, 2, ',', '.'));
        $sheet->getStyle('F' . $i)->applyFromArray($style_gdg);
        foreach(range('A','G') as $columnID) {
            for($j=10;$j<=$i;$j++) $sheet->getStyle($columnID . $j)->applyFromArray($style_borders);
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }
        $sheet->setCellValue('G' . ($i+4), 'Mengetahui');
        $sheet->setCellValue('G' . ($i+5), 'a.n. Kepala Pusat Kesehatan TNI');
        $sheet->setCellValue('G' . ($i+6), 'Waka,');
        $sheet->getStyle('G' . ($i+4) . ':G' . ($i+15))->applyFromArray($style);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="stok_opname.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}

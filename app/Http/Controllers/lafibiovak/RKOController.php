<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\RKO;
use App\Models\DetilRKO;
use App\Models\Produk;
use App\Models\RumahSakit;
use App\Models\Kemasan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RKOController extends Controller
{
    public function index()
    {
        $p = Kemasan::selectRaw("id_kemasan as id_produk, CONCAT(nama_produk, ' / ', nama_kemasan) AS nama_produk")
                       ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                       ->orderByRaw('kategori_produk, nama_produk')->get();
        return view('lafibiovak.manage_rko.rko_faskes.index', ['active_menu' => 'rko_faskes', 'data' => $p]);
    }

    public function total(Request $request)
    {
        $p = Kemasan::selectRaw('id_kemasan as id_produk')
                    ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                    ->orderByRaw('kategori_produk, nama_produk')->get();
        $dr = DetilRKO::selectRaw('kemasan.id_kemasan as id_produk, COALESCE(SUM(jml_penggunaan_per_tahun), 0) AS jml')
            ->join('rko', 'rko.id_rko', 'detil_rko.id_rko')
            ->join('rs', 'rs.id_rs', 'rko.id_rs')
            ->join('kemasan', 'kemasan.id_kemasan', 'detil_rko.id_kemasan')
            ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
            ->where('periode_pengajuan', $request->tahun ?? date('Y'))
            ->where('status', $request->status ?? 'Disetujui')
            ->groupBy('kemasan.id_kemasan')
            ->orderByRaw('kategori_produk, nama_produk');
        if (isset($request->jenis)) $dr = $dr->where('jenis_rs', $request->jenis);
        $dr = $dr->get();
        $drko = array();
        foreach($dr as $d) {
            $drko[$d->id_produk] = number_format($d->jml, 0, '', '.');
        }
        foreach($p as $d) {
            $d->jml = $drko[$d->id_produk] ?? 0;
        }
        $f = RumahSakit::count();
        $r = RKO::where('periode_pengajuan', $request->tahun ?? date('Y'))
                ->where('status', 'Disetujui')
                ->count();
        return response()->json([
            "error" => false,
            "data" => $p,
            "belum_lapor" => $f-$r,
        ]);
    }

    public function list(Request $request)
    {
        $data = RKO::with('detil_rko.kemasan.produk')
                   ->selectRaw('id_rko, nama_rs, jenis_rs, email, no_telp, waktu_pengajuan, status')
                   ->join('rs', 'rs.id_rs', 'rko.id_rs')
                   ->where('periode_pengajuan', $request->tahun ?? date('Y'))
                   ->where('status', $request->status ?? 'Disetujui');
        if (isset($request->jenis)) $data = $data->where('jenis_rs', $request->jenis);
        $data = $data->get();
        $prods = Kemasan::selectRaw('nama_produk, nama_kemasan')
                 ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                 ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            foreach($d->detil_rko as $p) {
                $prod = ($p->kemasan->produk->nama_produk ?? '-') . ' / ' . ($p->kemasan->nama_kemasan ?? '-');
                $d->$prod = number_format($p->jml_penggunaan_per_tahun, 0, '', '.');
            }
            foreach($prods as $p) {
                $prod = $p->nama_produk . ' / ' . $p->nama_kemasan;
                if (!isset($d->$prod)) $d->$prod = 0;
            }
            unset($d->detil_rko);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if ($row->status == 'Disetujui') $actionBtn = "<div class='text-center'><a href='/lafibiovak/rko/form/" . $row->id_rko . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_rko . "' data-url='/lafibiovak/rko'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                else $actionBtn = "<div class='text-center'><button type='button' class='btn btn-primary' data-id='" . $row->id_rko . "' onclick='approve($(this))'>Setujui</button> &nbsp; <button type='button' class='btn btn-secondary' data-id='" . $row->id_rko . "' onclick='reject($(this))'>Tolak</button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function form($id='')
    {
        if (!Auth::user()->id_faskes) {
            $f = RumahSakit::all();
        }
        if ($id != '') {
            $data = RKO::with('rs')->where('id_rko', $id);
            if (Auth::user()->id_faskes) $data = $data->where('id_rs', Auth::user()->id_faskes);
            $data = $data->first();
        }
        if (Auth::user()->id_faskes) return response()->json([
            "error" => false,
            "data" => $data ?? null,
        ]);
        return view('lafibiovak.manage_rko.rko_faskes.edit', ['active_menu' => 'rko_faskes', 'data' => $data ?? null, 'faskes' => $f ?? null]);
    }

    public function download()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./templates/rko.xlsx');
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getProtection()->setSheet(true);
        $k = Kemasan::with('produk.zat_aktif', 'satuan_produk')
            ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
            ->orderByRaw('kategori_produk, nama_produk')->get();
        $i = 8;
        $no = 0;
        $kat = 'Obat';
        foreach($k as $d) {
            $i++;
            if ($d->kategori_produk != $kat) {
                $kat = $d->kategori_produk;
                $i++;
                $no = 0;
                $sheet->setCellValue('A'.$i, 'II');
                $sheet->getStyle('A'.$i)->getFont()->setBold(true);
                $sheet->setCellValue('B'.$i, 'PKRT');
                $sheet->getStyle('B'.$i)->getFont()->setBold(true);
                $i++;
            }
            $no++;
            $sheet->setCellValue('A'.$i, $no);
            $sheet->setCellValue('B'.$i, $d->nama_produk);
            $sheet->setCellValue('C'.$i, $d->produk->zat_aktif[0]->nama_zat . ' ' .  $d->produk->zat_aktif[0]->takaran);
            $sheet->setCellValue('D'.$i, $d->satuan_produk->nama_satuan);
            $sheet->setCellValue('E'.$i, $d->nama_kemasan);
        }
        $sheet->getStyle('B2:B4')->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        $sheet->getStyle('F9:F'.$i)->getProtection()
            ->setLocked(\PhpOffice\PhpSpreadsheet\Style\Protection::PROTECTION_UNPROTECTED);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="formulir_rko.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function upload(Request $request)
    {
        $r = new RKO;
        $r->id_rs = Auth::user()->id_faskes ?? $request->faskes;
        $r->periode_pengajuan = $request->tahun;
        $r->uploaded_by = Auth::user()->name;
        $file = $request->file('file');
        $filename = date('YmdHis') . '.xlsx';
        $file->move(public_path('uploads/rko'), $filename);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('./uploads/rko/' . $filename);
        $sheet = $spreadsheet->getActiveSheet();
        $r->nama_cp_faskes = $sheet->getCell('B2')->getValue() ?? '-';
        $r->email = $sheet->getCell('B3')->getValue() ?? '-';
        $r->no_telp = $sheet->getCell('B4')->getValue() ?? '-';
        $r->save();
        $highestRow = $sheet->getHighestRow();
        for($i=9; $i<=$highestRow; $i++) {
            if ($sheet->getCell('B'.$i)->getValue() != '' && $sheet->getCell('D'.$i)->getValue() != '' && $sheet->getCell('F'.$i)->getValue() != '') {
                $k = Kemasan::select('id_kemasan')
                    ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                    ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
                    ->where('nama_produk', $sheet->getCell('B'.$i)->getValue())
                    ->where('nama_satuan', $sheet->getCell('D'.$i)->getValue())
                    ->first();
                if (isset($k)) {
                    $d = new DetilRKO;
                    $d->id_rko = $r->id_rko;
                    $d->id_kemasan = $k->id_kemasan;
                    $d->jml_penggunaan_per_tahun = $sheet->getCell('F'.$i)->getValue();
                    $d->save();
                }
            }
        }
        return response()->json([
            "error" => false,
            "message" => "RKO telah disimpan",
        ]);
    }

    public function approve($id)
    {
        $r = RKO::find($id);
        $rlama = RKO::where('id_rs', $r->id_rs)
                    ->where('periode_pengajuan', $r->periode_pengajuan)
                    ->where('status', 'Disetujui')
                    ->where('id_rko', '<>', $r->id_rko)
                    ->first();
        if (isset($rlama)) {
            DetilRKO::where('id_rko', $rlama->id_rko)->delete();
            RKO::where('id_rko', $rlama->id_rko)->delete();
        }
        $r->status = 'Disetujui';
        $r->confirmed_at = date('Y-m-d H:i:s');
        $r->confirmed_by = Auth::user()->name;
        $r->save();
        return response()->json([
            "error" => false,
            "message" => "RKO telah disetujui",
        ]);
    }

    public function reject(Request $request, $id)
    {
        $r = RKO::find($id);
        $r->status = 'Ditolak';
        $r->reject_reason = $request->reason;
        $r->confirmed_at = date('Y-m-d H:i:s');
        $r->confirmed_by = Auth::user()->name;
        $r->save();
        return response()->json([
            "error" => false,
            "message" => "RKO telah ditolak",
        ]);
    }

    public function destroy($id)
    {
        DetilRKO::where('id_rko', $id)->delete();
        RKO::where('id_rko', $id)->delete();
        return response()->json([
            "error" => false,
            "message" => "RKO berhasil dihapus",
            'table' => '#rko',
        ]);
    }

    public function list_rekap(Request $request)
    {
        $matra = ['AD', 'AL', 'AU', 'MABES'];
        $jenis = ['FKTL', 'FKTP', 'RSS'];
        $data = Kemasan::selectRaw("id_kemasan, CONCAT(nama_produk, ' / ', nama_kemasan) AS nama_produk")
                       ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                       ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $fas = DetilRKO::selectRaw('kode_matra, jenis_rs, id_kemasan, COALESCE(SUM(jml_penggunaan_per_tahun), 0) AS jml')
                           ->join('rko', 'rko.id_rko', 'detil_rko.id_rko')
                           ->join('rs', 'rs.id_rs', 'rko.id_rs')
                           ->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')
                           ->where('id_kemasan', $d->id_kemasan)
                           ->where('periode_pengajuan', $request->tahun ?? date('Y'))
                           ->where('status', 'Disetujui')
                           ->groupBy('kode_matra', 'jenis_rs')
                           ->get();
            $total = 0;
            foreach($fas as $f) {
                $attr = $f->kode_matra;
                $attr .= isset($f->jenis_rs) ? '_' . $f->jenis_rs : '';
                $d->$attr = number_format($f->jml, 0, '', '.');
                $total += $f->jml;
            }
            foreach($matra as $m) {
                foreach($jenis as $j) {
                    $attr = $m;
                    $attr .= $m == 'MABES' ? '' : '_' . $j;
                    if (!isset($d->$attr)) $d->$attr = 0;
                }
            }
            $d->total = number_format($total, 0, '', '.');
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function list_faskes(Request $request)
    {
        if (Auth::user()->id_faskes) $data = RKO::selectRaw('id_rko, waktu_pengajuan, periode_pengajuan, status')->orderByRaw('waktu_pengajuan DESC')
            ->where('id_rs', Auth::user()->id_faskes)
            ->where('periode_pengajuan', $request->tahun ?? date('Y'))->get();
        else {
            $data = RKO::selectRaw('id_rko, waktu_pengajuan, periode_pengajuan, status, rs.id_rs, nama_rs, confirmed_at, confirmed_by, reject_reason')->orderByRaw('waktu_pengajuan DESC')
                ->join('rs', 'rs.id_rs', 'rko.id_rs')
                ->where('periode_pengajuan', $request->tahun ?? date('Y'));
            if (isset($request->status) && $request->status != 'Belum') $data = $data->where('status', $request->status);
            $data = $data->get();
            if (!isset($request->status) || (isset($request->status) && $request->status == 'Belum')) {
                $excl = array();
                foreach($data as $d) {
                    if (!in_array($d->id_rs, $excl)) $excl[] = $d->id_rs;
                }
                $rs = RumahSakit::selectRaw('id_rs, nama_rs')->whereNotIn('id_rs', $excl)->get();
                if (isset($request->status)) $data = $rs;
                else {
                    foreach($rs as $d) {
                        $data[] = $d;
                    }
                }
            }
        }
        return DataTables::of($data)
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'>";
                if ($row->status != 'Disetujui')
                    $actionBtn .= "<button title='Upload RKO' class='btn text-primary p-0 pr-50' data-id='" . $row->id_rs . "' data-nama='" . $row->nama_rs . "' onclick='edit_rko($(this))'><i data-feather='upload' class='font-medium-4'></i></button>";
                if (Auth::user()->id_faskes && $row->status == 'Menunggu Persetujuan')
                    $actionBtn = "<button title='Delete' class='delete-data btn p-0' data-id='" . $row->id_rko . "' data-url='/lafibiovak/rko'><i data-feather='trash' class='font-medium-4 text-danger'></i></button>";
                $actionBtn .= "</div>";
                return $actionBtn ?? '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function rkoFile($file)
    {
        $pathToFile = public_path('uploads/rko') . '/' . $file . '.xlsx';
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

<?php

namespace App\Http\Controllers\bidum\anggaran;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\PeriodeLaporan;
use App\Models\Realisasi;
use App\Models\Uraian;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class RealisasiHarianController extends Controller
{

    public function realisasi_pertahun()
    {
        return view('bidum.anggaran.realisasi_harian.realisasi_pertahun', ['active_menu' => 'realisasi_harian']);
    }

    public function index($tahun)
    {
        $data = [
            'bidang' => Bidang::select('kode_bidang')->get(),
            'active_menu' => 'realisasi_harian',
            'from_date' => date($tahun . '-01-01'),
            'to_date' => date($tahun . '-12-31')
        ];
        return view('bidum.anggaran.realisasi_harian.index', $data);
    }

    public function get_realisasi_pertahun()
    {
        $realisasi = DB::table('realisasi')
            ->select('realisasi.tgl_realisasi', 'uraian.kode_dipa', DB::raw('SUM(jumlah) as jumlah'))
            ->join('uraian', 'uraian.id_uraian', 'realisasi.id_uraian')
            ->groupBy(DB::raw('YEAR(tgl_realisasi)'), 'uraian.kode_dipa')
            ->get();

        $tgl_realisasi = $realisasi->pluck('tgl_realisasi');

        $data = [];

        foreach ($tgl_realisasi as $k => $v) {
            $pusat = $realisasi->where('tgl_realisasi', $v)->where('kode_dipa', 'DIPPUS')->first()->jumlah ?? 0;
            $daerah = $realisasi->where('tgl_realisasi', $v)->where('kode_dipa', 'DIPDAR')->first()->jumlah ?? 0;

            $data[] = [
                'tahun' => date('Y', strtotime($v)),
                'pusat' => 'Rp' . indonesian_money_format($pusat),
                'daerah' => 'Rp' . indonesian_money_format($daerah)
            ];
        }

        return DataTables::of($data)

            ->addColumn('action', function ($r) {
                return "<div class='text-center'><a href='" . url('bidum/anggaran/realisasi/' . $r['tahun']) . "'><button title='Detail' class='btn text-primary p-0 pr-75'><i data-feather='file-text' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->toJson();
    }

    public function export_format()
    {
        $year = date('Y');
        // $start = Carbon::parse($from_date)->locale('id');
        // $end = Carbon::parse($to_date)->locale('id');
        // $start->settings(['formatFunction' => 'translatedFormat']);
        // $end->settings(['formatFunction' => 'translatedFormat']);

        // $periode = PeriodeLaporan::whereDate('periode_awal', $from_date)->whereDate('periode_akhir', $to_date)->first();

        // if (!$periode) return redirect()->back();
        // if (!$periode) return redirect()->back();
        // $pusat = Uraian::whereYear('tahun_anggaran', 2022)->where('kode_dipa', 'DIPPUS')->get();
        $pusat = Uraian::where('tahun_anggaran', $year)->where('kode_dipa', 'DIPPUS')->get();

        // $daerah = Uraian::whereYear('tahun_anggaran', 2022)->where('kode_dipa', 'DIPDAR')->get();
        $daerah = Uraian::where('tahun_anggaran', $year)->where('kode_dipa', 'DIPDAR')->get();

        if ($pusat->isEmpty() || $daerah->isEmpty()) return redirect()->back()->with('error', 'Data Pagu Not Found');;

        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet();

        $i = 0;
        while ($i < 2) {

            if ($i == 0) {
                $uraian = $pusat;
                $title = 'realisasi_pusat';
            } else {
                $uraian = $daerah;
                $title = 'realisasi_daerah';
            }

            $sheet = $spreadsheet->createSheet($i);

            $style_judul = [
                'font' => [
                    'bold' => true,
                    'name'  => 'Arial',
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],
                'borders' => [
                    'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,],
                    'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,],
                    'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,],
                    'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_NONE,],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    // 'rotation' => 90,
                    'startColor' => [
                        'argb' => 'f8cbad',
                    ],
                    // 'endColor' => [
                    //     'argb' => 'FFFFFFFF',
                    // ],
                ],
            ];

            $sheet->mergeCells('B1:H1')
                ->mergeCells('B2:H2')
                ->mergeCells('B3:H3')
                ->mergeCells('B5:E5')
                ->mergeCells('F5:H5')
                ->mergeCells('B6:E6')
                ->mergeCells('F6:H6')
                ->mergeCells('B7:E7')
                ->mergeCells('F7:H7');

            $sheet->getStyle('B1')->applyFromArray($style_judul);
            $sheet->getStyle('B2')->applyFromArray($style_judul);
            $sheet->getStyle('B3')->applyFromArray($style_judul);

            $sheet->setCellValue('B1', 'PELAKSANAAN ANGGARAN DIPA PETIKAN KEWENANGAN PUSAT (KP) BAGIAN ANGGARAN 012')
                ->setCellValue('B2', 'TAHUN ' . $year)
                // ->setCellValue('B3', 'PERIODE ' . $start->format('j F Y') . ' s/d ' . $end->format('j F Y'))
                ->setCellValue('B5', 'Tahun Anggaran')
                ->setCellValue('B6', 'Tanggal Periode Awal')
                ->setCellValue('B7', 'Tanggal Periode Akhir')
                ->setCellValue('F5', $year);
            // ->setCellValue('F6', $start->format('j F Y'))
            // ->setCellValue('F7', $end->format('j F Y'));

            $sheet->setCellValue('B9', 'NO')
                ->setCellValue('C9', 'BIDANG')
                ->setCellValue('D9', 'NO URUT')
                ->setCellValue('E9', 'AKUN')
                ->setCellValue('F9', 'URAIAN')
                ->setCellValue('G9', 'TANGGAL')
                ->setCellValue('H9', 'REALISASI (WABKU)')
                ->setCellValue('I9', 'ID');

            $sheet->setCellValue('B10', '1')
                ->setCellValue('C10', '2')
                ->setCellValue('D10', '3')
                ->setCellValue('E10', '4')
                ->setCellValue('F10', '5')
                ->setCellValue('G10', '6')
                ->setCellValue('H10', '7');

            $row = 11;
            $no = 1;
            $kode_bidang = '';
            foreach ($uraian as $key => $value) {

                $sheet->setCellValue('E' . $row, $value->kode_akun)
                    ->setCellValue('F' . $row, $value->nama_uraian);
                if ($value->kode_akun != null) $sheet->setCellValue('I' . $row, $value->id_uraian);
                if ($value->kode_bidang != $kode_bidang) {
                    $sheet->setCellValue('B' . $row, $no)
                        ->setCellValue('C' . $row, $value->kode_bidang);
                    $kode_bidang = $value->kode_bidang;
                    $no++;
                }
                $row++;
            }

            $sheet->setTitle($title);
            $i++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="realisasi.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function import(Request $request)
    {
        if ($request->file('file')->getClientOriginalName() != '') {
            $allowed_extension = array('xls', 'csv', 'xlsx');
            $file_array = explode(".", $request->file('file')->getClientOriginalName());
            $file_extension = end($file_array);

            if (in_array($file_extension, $allowed_extension)) {
                $public_dir = base_path() . '/uploads/anggaran/';
                $file_name = time() . '.' . $file_extension;
                move_uploaded_file($request->file('file'),  $public_dir . $file_name);
                // move_uploaded_file($_FILES['import_attendance']['tmp_name'], $file_name);
                $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($public_dir . $file_name);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

                $spreadsheet = $reader->load($public_dir . $file_name);

                unlink($public_dir . $file_name);

                $rows_pusat = $spreadsheet->getSheetByName('realisasi_pusat')->toArray();
                $rows_daerah = $spreadsheet->getSheetByName('realisasi_daerah')->toArray();

                $data_pusat = $this->get_import_data($rows_pusat, 'PUSAT');
                $data_daerah = $this->get_import_data($rows_daerah, 'DAERAH');

                $data = array_merge($data_pusat, $data_daerah);

                return view('bidum.anggaran.realisasi_harian.import_realisasi', ['data' => $data]);
            }
        } else {
            return back();
        }
    }

    public function get_import_data($rows, $dipa)
    {

        $tahun_anggaran = $rows[4][5];
        // $periode_awal = Carbon::parseFromLocale($rows[5][5], 'id')->isoFormat('YYYY-MM-DD');
        // $periode_akhir = Carbon::parseFromLocale($rows[6][5], 'id')->isoFormat('YYYY-MM-DD');

        // $periode = PeriodeLaporan::whereDate('periode_awal', $periode_awal)->whereDate('periode_akhir', $periode_akhir)->first();

        $count_rows = count($rows);

        $uraian = Uraian::get();

        $data = [];
        $bidang = '';
        $id_uraian = null;
        for ($i = 10; $i < $count_rows; $i++) {
            if (!empty(trim($rows[$i][2]))) $bidang = $rows[$i][2];
            if (!empty(trim($rows[$i][6])) && !empty(trim($rows[$i][7]))) {
                if (!empty(trim($rows[$i][8]))) $uraian = $uraian->where('id_uraian', $rows[$i][8])->first();
                else $uraian = $uraian->where('id_uraian', $id_uraian)->first();

                if ($uraian) {
                    $tgl_realisasi = date('Y-m-d', strtotime($rows[$i][6]));
                    $data[] = [
                        'id_uraian' => $uraian->id_uraian,
                        'tgl_realisasi' => $tgl_realisasi,
                        'jumlah' => $rows[$i][7],
                        'akun' => $uraian->kode_akun,
                        'uraian' => $uraian->nama_uraian,
                        'kewenangan' => $dipa,
                        'bidang' => $bidang
                    ];
                    $id_uraian = $uraian->id_uraian;
                }
            }
        }
        return $data;
    }

    public function import_store(Request $request)
    {
        try {
            $data = json_decode($request->realisasi, true);

            foreach ($data as $key => $value) {
                Realisasi::create([
                    'id_uraian' => $value['id_uraian'],
                    'tgl_realisasi' => $value['tgl_realisasi'],
                    'jumlah' => $value['jumlah']
                ]);
            }
            return response()->json([
                'error' => false,
                'message' => 'Succesfully upload file'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list($from_date, $to_date, $dipa)
    {
        $realisasi = Realisasi::with('uraian')->whereHas('uraian', function ($query) use ($dipa) {
            return $query->where('kode_dipa', $dipa);
        })
            ->whereDate('tgl_realisasi', '>=', $from_date)
            ->whereDate('tgl_realisasi', '<=', $to_date);

        return DataTables::of($realisasi)
            ->addColumn('kode_bidang', function (Realisasi $realisasi) {
                return $realisasi->uraian->kode_bidang;
            })
            ->addColumn('kode_akun', function (Realisasi $realisasi) {
                return $realisasi->uraian->kode_akun;
            })
            ->addColumn('nama_uraian', function (Realisasi $realisasi) {
                return $realisasi->uraian->nama_uraian;
            })
            ->editColumn('jumlah', function ($query) {
                return "Rp" . number_format($query->jumlah, 0, ',', '.');
            })
            ->editColumn('tgl_realisasi', function ($query) {
                $date = Carbon::parse($query->tgl_realisasi)->locale('id');
                $date->settings(['formatFunction' => 'translatedFormat']);
                return $date->format('j F Y');
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_realisasi . '" onclick="edit_realisasi($(this))"><i data-feather="edit" class="font-medium-4"></i></button></button><button title="Delete" type="button" data-id="' . $query->id_realisasi . '" data-url="' . url('bidum/anggaran/realisasi') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_uraian' => 'required',
            'tgl_realisasi' => 'required',
            'jumlah' => 'required'
        ]);
        $kode_dipa = Uraian::where('id_uraian', $request->id_uraian)->first()->kode_dipa;
        $jumlah = str_replace(array('Rp', '.'), '', $request->jumlah);

        if ($kode_dipa == 'DIPPUS') {
            $table = 'pusat';
        } else {
            $table = 'daerah';
        }

        try {
            Realisasi::create([
                'id_uraian' => $request->id_uraian,
                'tgl_realisasi' => $request->tgl_realisasi,
                'jumlah' => $jumlah,
            ]);
            return response()->json([
                'error' => false,
                'message' => 'Successfully Add Realisasi',
                'modal' => '#add',
                'table' => '#realisasi-' . $table
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function get_bidang($kode_dipa)
    {
        $uraian = Uraian::select('kode_bidang')->where('kode_dipa', $kode_dipa)->distinct()->get();
        $select = [];
        $select[] = ['id' => '', 'text' => 'Pilih Bidang'];
        foreach ($uraian as $key => $value) {
            $select[] = ['id' => $value->kode_bidang, 'text' => $value->kode_bidang];
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function get_uraian($kode_dipa, $kode_bidang)
    {
        $uraian = Uraian::select('id_uraian', 'nama_uraian')->where('kode_bidang', $kode_bidang)->where('kode_dipa', $kode_dipa)->where('kode_akun', '!=', null)->get();
        $select = [];
        foreach ($uraian as $key => $value) {
            $select[] = ['id' => $value->id_uraian, 'text' => $value->nama_uraian];
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function edit(Realisasi $realisasi)
    {
        return $realisasi->load('uraian');
    }

    public function update(Request $request, Realisasi $realisasi)
    {
        $validatedData = $request->validate([
            'id_uraian' => 'required',
            'tgl_realisasi' => 'required',
            'jumlah' => 'required'
        ]);
        $kode_dipa = Uraian::where('id_uraian', $request->id_uraian)->first()->kode_dipa;
        $jumlah = str_replace(array('Rp', '.'), '', $request->jumlah);

        if ($kode_dipa == 'DIPPUS') {
            $table = 'pusat';
        } else {
            $table = 'daerah';
        }

        try {
            $realisasi->update([
                'id_uraian' => $request->id_uraian,
                'tgl_realisasi' => $request->tgl_realisasi,
                'jumlah' => $jumlah,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Successfully Update Realisasi',
            'modal' => '#add',
            'table' => '#realisasi-' . $table
        ]);
    }

    public function destroy(Realisasi $realisasi)
    {
        $kode_dipa = Uraian::where('id_uraian', $realisasi->id_uraian)->first()->kode_dipa;
        if ($kode_dipa == 'DIPPUS') $table = 'pusat';
        else $table = 'daerah';

        $realisasi->delete();

        return response()->json([
            'error' => false,
            'message' => 'Realisasi Deleted!',
            'modal' => '#add',
            'table' => '#realisasi-' . $table
        ]);
    }
}

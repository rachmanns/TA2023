<?php

namespace App\Http\Controllers\bidum\anggaran;

use App\Http\Controllers\Controller;
use App\Models\PeriodeLaporan;
use App\Models\Realisasi;
use App\Models\Uraian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class ReportController extends Controller
{
    public function index($bidang = '')
    {
        $data = [
            'year' => date('Y'),
            'active_menu' => 'report',
            'bidang' => $bidang
        ];
        return view('bidum.anggaran.report_anggaran.index', $data);
    }

    public function report_list($from_date, $to_date, $dipa, $bidang = '')
    {
        $year = date('Y', strtotime($from_date));
        $data = Uraian::withCount([
            'revisi as revisi_tambah' => function ($query) {
                $query->select(DB::raw('SUM(tambah)'));
            },
            'revisi as revisi_kurang' => function ($query) {
                $query->select(DB::raw('SUM(kurang)'));
            },
            'realisasi as realisasi' => function ($query) use ($from_date, $to_date) {
                $query->select(DB::raw('SUM(jumlah)'))
                    ->whereDate('tgl_realisasi', '>=', $from_date)
                    ->whereDate('tgl_realisasi', '<=', $to_date);
            }
        ])->when($bidang != '', function ($query) use ($bidang) {
            return $query->where('kode_bidang', $bidang);
        })
            ->where('kode_dipa', $dipa)->where('tahun_anggaran', $year)
            ->get();

        $new_data = [];
        foreach ($data as $key => $value) {
            $revisi_pagu = $value->pagu_awal + (int) $value->revisi_tambah - (int) $value->revisi_kurang;
            $persentase = null;
            if ($revisi_pagu != 0) $persentase =  $value->realisasi / $revisi_pagu * 100;
            $new_data[] = [
                'id_uraian' => $value->id_uraian,
                'kode_bidang' => $value->kode_bidang,
                'nama_uraian' => $value->nama_uraian,
                'pagu_awal' => $value->pagu_awal,
                'kode_akun' => $value->kode_akun,
                'revisi_tambah' => $value->revisi_tambah,
                'revisi_kurang' => $value->revisi_kurang,
                'revisi_pagu' => $revisi_pagu,
                'realisasi' => $value->realisasi,
                'persentase' => $persentase,
                'sisa_anggaran' => $revisi_pagu - $value->realisasi,
            ];
        }

        return DataTables::of($new_data)
            ->editColumn('pagu_awal', function ($pusat) {
                return "Rp" . number_format($pusat['pagu_awal'], 0, ',', '.');
            })
            ->editColumn('revisi_tambah', function ($pusat) {
                return "Rp" . number_format($pusat['revisi_tambah'], 0, ',', '.');
            })
            ->editColumn('revisi_kurang', function ($pusat) {
                return "Rp" . number_format($pusat['revisi_kurang'], 0, ',', '.');
            })
            ->editColumn('revisi_pagu', function ($pusat) {
                return "Rp" . number_format($pusat['revisi_pagu'], 0, ',', '.');
            })
            ->editColumn('realisasi', function ($pusat) {
                return "Rp" . number_format($pusat['realisasi'], 0, ',', '.');
            })
            ->editColumn('sisa_anggaran', function ($pusat) {
                return "Rp" . number_format($pusat['sisa_anggaran'], 0, ',', '.');
            })
            ->editColumn('persentase', function ($pusat) {
                return number_format($pusat['persentase'], 2) . '%';
            })
            ->toJson();
    }

    public function export($from_date, $to_date)
    {
        $year = date('Y', strtotime($from_date));

        setlocale(LC_TIME, 'id');
        $start = Carbon::parse($from_date)->formatLocalized('%d %B %Y');
        $end = Carbon::parse($to_date)->formatLocalized('%d %B %Y');

        $query = Uraian::withCount([
            'revisi as revisi_tambah' => function ($query) {
                $query->select(DB::raw('SUM(tambah)'));
            },
            'revisi as revisi_kurang' => function ($query) {
                $query->select(DB::raw('SUM(kurang)'));
            },
            'realisasi as realisasi' => function ($query) use ($from_date, $to_date) {
                $query->select(DB::raw('SUM(jumlah)'))
                    ->whereDate('tgl_realisasi', '>=', $from_date)
                    ->whereDate('tgl_realisasi', '<=', $to_date);
            }
        ])->where('tahun_anggaran', $year)->get();


        $pusat = $query->where('kode_dipa', 'DIPPUS');
        $daerah = $query->where('kode_dipa', 'DIPDAR');


        $spreadsheet = new Spreadsheet();
        $spreadsheet->getActiveSheet();

        for ($i = 0; $i < 2; $i++) {

            if ($i == 0) {
                $uraian = $pusat;
                $title = 'laporan_pusat';
                $title_header = 'PELAKSANAAN ANGGARAN DIPA PETIKAN KEWENANGAN PUSAT (KP) BAGIAN ANGGARAN 012';
            } else {
                $uraian = $daerah;
                $title = 'laporan_daerah';
                $title_header = 'PELAKSANAAN ANGGARAN DIPA PETIKAN KEWENANGAN DAERAH (KD) BAGIAN ANGGARAN 012';
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

            $sheet->mergeCells('B1:L1')
                ->mergeCells('B2:L2')
                ->mergeCells('B3:L3')
                ->mergeCells('B5:E5')
                ->mergeCells('F5:L5')
                ->mergeCells('B6:E6')
                ->mergeCells('F6:L6')
                ->mergeCells('B7:E7')
                ->mergeCells('F7:L7')
                ->mergeCells('B9:B10')
                ->mergeCells('C9:C10')
                ->mergeCells('D9:D10')
                ->mergeCells('E9:E10')
                ->mergeCells('F9:F10')
                ->mergeCells('I9:I10')
                ->mergeCells('J9:J10')
                ->mergeCells('K9:K10')
                ->mergeCells('L9:L10')
                ->mergeCells('G9:H9');

            $sheet->getStyle('B1')->applyFromArray($style_judul);
            $sheet->getStyle('B2')->applyFromArray($style_judul);
            $sheet->getStyle('B3')->applyFromArray($style_judul);

            $sheet->setCellValue('B1', $title_header)
                ->setCellValue('B2', 'TAHUN ' . date('Y', strtotime($from_date)))
                ->setCellValue('B3', 'PERIODE PELAPORAN' . $start . ' s/d ' . $end)
                ->setCellValue('B5', 'Tahun Anggaran')
                ->setCellValue('B6', 'Tanggal Periode Awal')
                ->setCellValue('B7', 'Tanggal Periode Akhir')
                ->setCellValue('F5', date('Y', strtotime($from_date)))
                ->setCellValue('F6', $start)
                ->setCellValue('F7', $end);

            $sheet->setCellValue('B9', 'NO')
                ->setCellValue('C9', 'BIDANG')
                ->setCellValue('D9', 'AKUN')
                ->setCellValue('E9', 'URAIAN')
                ->setCellValue('F9', 'PAGU AWAL')
                ->setCellValue('G9', 'REVISI PAGU')
                ->setCellValue('G10', 'TAMBAH')
                ->setCellValue('H10', 'KURANG')
                ->setCellValue('I9', 'PAGU SETELAH REVISI')
                ->setCellValue('J9', 'REALISASI (WABKU)')
                ->setCellValue('K9', '%')
                ->setCellValue('L9', 'SISA ANGGARAN');

            $sheet->setCellValue('B11', '1')
                ->setCellValue('C11', '2')
                ->setCellValue('D11', '3')
                ->setCellValue('E11', '4')
                ->setCellValue('F11', '5')
                ->setCellValue('G11', '6')
                ->setCellValue('H11', '7')
                ->setCellValue('I11', '8')
                ->setCellValue('J11', '9')
                ->setCellValue('K11', '10')
                ->setCellValue('L11', '11');

            $sheet->setTitle($title);

            $row = 12;
            $temp_row = $row;
            $no = 1;
            $kode_bidang = '';
            foreach ($uraian as $key => $value) {
                if ($value->kode_bidang != $kode_bidang) {
                    $sheet->setCellValue('B' . $row, $no)
                        ->setCellValue('C' . $row, $value->kode_bidang);
                    $kode_bidang = $value->kode_bidang;
                    $no++;
                }
                $sheet->setCellValue('D' . $row, $value->kode_akun)
                    ->setCellValue('E' . $row, $value->nama_uraian)
                    ->setCellValue('F' . $row, $value->pagu_awal);


                $sheet->setCellValue('G' . $row, $value->revisi_tambah)
                    ->setCellValue('H' . $row, $value->revisi_kurang)
                    ->setCellValue('I' . $row, $value->pagu_awal + $value->revisi_tambah - $value->revisi_kurang);
                $pagu_setelah_revisi = $value->pagu_awal + $value->revisi_tambah - $value->revisi_kurang;


                $sheet->setCellValue('J' . $row, $value->realisasi)
                    // ->setCellValue('K' . $row, round((float)$pagu_setelah_revisi / $value->realisasi * 100) . '%')
                    ->setCellValue('L' . $row, $pagu_setelah_revisi - $value->realisasi);
                $row++;
            }
        }



        // $i++;


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporan anggaran.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }
}

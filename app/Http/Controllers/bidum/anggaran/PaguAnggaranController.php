<?php

namespace App\Http\Controllers\bidum\anggaran;

use App\Http\Controllers\Controller;
use App\Http\Requests\UraianRequest;
use App\Models\Bidang;
use App\Models\PeriodeLaporan;
use App\Models\Realisasi;
use App\Models\RevisiPagu;
use App\Models\Uraian;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class PaguAnggaranController extends Controller
{
    private $bidangs;

    public function __construct()
    {
        $this->bidangs = Bidang::select('id_bidang', 'kode_bidang', 'nama_bidang')->get();
    }


    public function index()
    {
        return view('bidum.anggaran.pagu_anggaran.index', ['active_menu' => 'daftar_pagu']);
    }

    public function list_pagu()
    {
        $pusat = Uraian::select('tahun_anggaran', 'kode_dipa', DB::raw('SUM(pagu_awal) as total'))
            ->where('id_parent', null)
            ->where('kode_dipa', 'DIPPUS')
            ->groupBy('tahun_anggaran', 'kode_dipa')
            ->get();

        $daerah = Uraian::select('tahun_anggaran', 'kode_dipa', DB::raw('SUM(pagu_awal) as total'))
            ->where('id_parent', null)
            ->where('kode_dipa', 'DIPDAR')
            ->groupBy('tahun_anggaran', 'kode_dipa')
            ->get();

        if ($pusat->isEmpty() && $daerah->isEmpty()) {
            $data = [];
        } else {
            foreach ($pusat as $key => $value) {
                $data[] = [
                    'tahun_anggaran' => $value->tahun_anggaran,
                    'total_pagu_pusat' => $value->total ?? 0,
                    'total_pagu_daerah' => $daerah->where('tahun_anggaran', $value->tahun_anggaran)->first()->total ?? 0,
                ];
            }
        }


        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('total_pagu_pusat', function ($anggaran) {
                return "Rp" . number_format($anggaran['total_pagu_pusat'], 0, ',', '.');
            })
            ->editColumn('total_pagu_daerah', function ($anggaran) {
                return "Rp" . number_format($anggaran['total_pagu_daerah'], 0, ',', '.');
            })
            ->addColumn('action', function ($anggaran) {
                return '<div class="text-center" title="Detail"><a href="pagu/' . $anggaran['tahun_anggaran'] . '"><i data-feather="file-text" class="font-medium-4"></i></a></div>';
            })
            ->toJson();
    }

    public function show_pagu($year)
    {
        $bidang = $this->bidangs;
        $pusat = Uraian::where('kode_dipa', 'DIPPUS')->get()->groupBy('kode_bidang');
        // return $pusat;
        return view('bidum.anggaran.pagu_anggaran.detail', compact('year', 'bidang', 'pusat'));
    }

    public function list_pusat($year)
    {
        $data = Uraian::withCount([
            'revisi as revisi_tambah' => function ($query) {
                $query->select(DB::raw('SUM(tambah)'));
            },
            'revisi as revisi_kurang' => function ($query) {
                $query->select(DB::raw('SUM(kurang)'));
            }
        ]) // return $query->select(DB::raw("SUM(tambah) as tambah"))->groupBy('tambah');
            ->where('kode_dipa', 'DIPPUS')->where('tahun_anggaran', $year)
            ->orderBy('kode_bidang', 'asc')
            ->orderBy('id_uraian', 'asc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->setRowClass(function ($pusat) {
                if ($pusat->id_parent != null && $pusat->kode_akun == null) {
                    return 'text-info font-weight-bold';
                } else if ($pusat->id_parent == null) {
                    return 'bg-light-info font-weight-bold';
                }
                return '';
            })
            ->editColumn('pagu_awal', function ($pusat) {
                return "Rp" . number_format($pusat->pagu_awal, 0, ',', '.');
            })
            ->editColumn('revisi_tambah', function ($pusat) {
                return "Rp" . number_format($pusat->revisi_tambah, 0, ',', '.');
            })
            ->editColumn('revisi_kurang', function ($pusat) {
                return "Rp" . number_format($pusat->revisi_kurang, 0, ',', '.');
            })
            ->addColumn('pagu_revisi', function ($pusat) {
                $tambah = 0;
                $kurang = 0;
                if ($pusat->revisi_tambah != null) $tambah = $pusat->revisi_tambah;
                if ($pusat->revisi_kurang != null) $kurang = $pusat->revisi_kurang;
                $pagu_revisi = $pusat->pagu_awal + $tambah - $kurang;
                return "Rp" . number_format($pagu_revisi, 0, ',', '.');
            })
            ->addColumn('action', function ($pusat) use ($year) {
                $revisi_realisasi_button = '';
                if ($pusat->kode_akun != null) {
                    $revisi_realisasi_button = '
                    <a href="' . url('bidum/anggaran/revisi/history/' . $pusat->id_uraian) . '" title="History Revisi"><i
                    data-feather="file-text" class="font-medium-4 text-primary mr-50"></i></a>
                    <a data-id="' . $pusat->id_uraian . '" onclick="revisi($(this))" title="Revisi"><i
                    data-feather="edit" class="font-medium-4 text-primary"></i></a>
                    ';
                }
                $delete_button = '<a title="Delete" data-id="' . $pusat->id_uraian . '" data-url="' . url('bidum/anggaran/pagu') . '" class="delete-data pl-50"><i data-feather="trash" class="font-medium-4 text-danger"></i></a>';
                return '<div class="text-center cursor-pointer">' . $revisi_realisasi_button . $delete_button . '</div>';
            })
            ->rawColumns(['pagu_revisi', 'action'])
            ->toJson();
    }

    public function list_daerah($year)
    {
        $data = Uraian::withCount([
            'revisi as revisi_tambah' => function ($query) {
                $query->select(DB::raw('SUM(tambah)'));
            },
            'revisi as revisi_kurang' => function ($query) {
                $query->select(DB::raw('SUM(kurang)'));
            }
        ]) // return $query->select(DB::raw("SUM(tambah) as tambah"))->groupBy('tambah');
            ->where('kode_dipa', 'DIPDAR')->where('tahun_anggaran', $year)
            ->orderBy('kode_bidang', 'asc')
            ->orderBy('id_uraian', 'asc')
            ->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->setRowClass(function ($daerah) {
                if ($daerah->id_parent != null && $daerah->kode_akun == null) {
                    return 'text-info font-weight-bold';
                } else if ($daerah->id_parent == null) {
                    return 'bg-light-info font-weight-bold';
                }
                return '';
            })
            ->editColumn('pagu_awal', function ($daerah) {
                return "Rp" . number_format($daerah->pagu_awal, 0, ',', '.');
            })
            ->editColumn('revisi_tambah', function ($daerah) {
                return "Rp" . number_format($daerah->revisi_tambah, 0, ',', '.');
            })
            ->editColumn('revisi_kurang', function ($daerah) {
                return "Rp" . number_format($daerah->revisi_kurang, 0, ',', '.');
            })
            ->addColumn('pagu_revisi', function ($pusat) {
                $tambah = 0;
                $kurang = 0;
                if ($pusat->revisi_tambah != null) $tambah = $pusat->revisi_tambah;
                if ($pusat->revisi_kurang != null) $kurang = $pusat->revisi_kurang;
                $pagu_revisi = $pusat->pagu_awal + $tambah - $kurang;
                return "Rp" . number_format($pagu_revisi, 0, ',', '.');
            })
            ->addColumn('action', function ($daerah) use ($year) {
                $revisi_realisasi_button = null;
                if ($daerah->kode_akun != null) {
                    $revisi_realisasi_button = '
                    <a href="' . url('bidum/anggaran/revisi/history/' . $daerah->id_uraian) . '" title="History Revisi"><i
                    data-feather="file-text" class="font-medium-4 text-primary mr-50"></i></a>
                    <a data-id="' . $daerah->id_uraian . '" onclick="revisi($(this))" title="Revisi"><i
                    data-feather="edit" class="font-medium-4 text-primary"></i></a>';
                }
                $delete_button = '<button title="Delete" type="button" data-id="' . $daerah->id_uraian . '" data-url="' . url('bidum/anggaran/pagu') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button>';
                return '<div class="text-center cursor-pointer">' . $revisi_realisasi_button . $delete_button . '</div>';
            })
            ->rawColumns(['pagu_revisi', 'action'])
            ->toJson();
    }

    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|mimes:xls,csv,xlsx|max:2000'
        ]);
        $file_array = explode(".", $request->file('file')->getClientOriginalName());
        $file_extension = end($file_array);

        $public_dir = base_path() . '/uploads/anggaran/';
        $file_name = time() . '.' . $file_extension;
        move_uploaded_file($request->file('file'),  $public_dir . $file_name);
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($public_dir . $file_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($public_dir . $file_name);

        unlink($public_dir . $file_name);

        $rows_pusat = $spreadsheet->getSheetByName('pagu_awal_pusat')->toArray();
        $rows_daerah = $spreadsheet->getSheetByName('pagu_awal_daerah')->toArray();

        if (Uraian::has('realisasi')->where('tahun_anggaran', $rows_pusat[4][4])->exists() || Uraian::has('realisasi')->where('tahun_anggaran', $rows_daerah[4][4])->exists()) {
            return redirect()->back()->with('error', 'Data Pagu Sudah Ada');
        }

        $data_pusat = $this->get_data_import($rows_pusat, 'DIPPUS');
        $data_daerah = $this->get_data_import($rows_daerah, 'DIPDAR');

        $pagu_awal = array_merge($data_pusat, $data_daerah);

        return view('bidum.anggaran.pagu_anggaran.import_pagu', ['pagu_awal' => $pagu_awal]);
    }

    public function import_store(Request $request)
    {
        $data = json_decode($request->pagu_awal_data, true);
        $temp_parent1 = null;
        $temp_parent2 = null;
        foreach ($data as $key => $value) {
            if ($value['level'] == 1) {
                $uraian = Uraian::create([
                    'nama_uraian' => $value['nama_uraian'],
                    'kode_akun' => $value['kode_akun'],
                    'kode_bidang' => $value['kode_bidang'],
                    'kode_dipa' => $value['kode_dipa'],
                    'pagu_awal' => $value['pagu_awal'],
                    'tahun_anggaran' => $value['tahun_anggaran'],

                ]);
                $temp_parent1 = $uraian->id_uraian;
            } elseif ($value['level'] == 2) {
                $uraian = Uraian::create([
                    'nama_uraian' => $value['nama_uraian'],
                    'kode_akun' => $value['kode_akun'],
                    'kode_bidang' => $value['kode_bidang'],
                    'kode_dipa' => $value['kode_dipa'],
                    'pagu_awal' => $value['pagu_awal'],
                    'tahun_anggaran' => $value['tahun_anggaran'],
                    'id_parent' => $temp_parent1
                ]);
                $temp_parent2 = $uraian->id_uraian;
            } elseif ($value['level'] == 3) {
                $uraian = Uraian::create([
                    'nama_uraian' => $value['nama_uraian'],
                    'kode_akun' => $value['kode_akun'],
                    'kode_bidang' => $value['kode_bidang'],
                    'kode_dipa' => $value['kode_dipa'],
                    'pagu_awal' => $value['pagu_awal'],
                    'tahun_anggaran' => $value['tahun_anggaran'],
                    'id_parent' => $temp_parent2
                ]);
            }
        }
        return redirect('bidum/anggaran/pagu');
    }

    public function get_data_import($rows, $kode_dipa)
    {
        $tahun_anggaran = $rows[4][4];

        $count_data = count($rows);

        $kode_bidang = '';
        $temp_level_1 = 0;
        $temp_level_2 = 0;
        $data = [];

        for ($i = 10; $i < $count_data; $i++) {

            if (!empty(trim($rows[$i][5])) && !empty(trim($rows[$i][2]))) {

                $level = explode(".", $rows[$i][3]);
                $count_level = count($level);

                $bidang = $this->bidangs->where('kode_bidang', str_replace(' ', '', $rows[$i][2]))->first();
                if ($bidang) {
                    if ($count_level == 2) {
                        $data[] = [
                            'nama_uraian' => $rows[$i][5],
                            'kode_akun' => $rows[$i][4],
                            'kode_bidang' => $bidang->kode_bidang,
                            'kode_dipa' => $kode_dipa,
                            // 'pagu_awal' => str_replace(",", "", $rows[$i][6] ?? 0),
                            'pagu_awal' => str_replace(",", "", $rows[$i][6]),
                            'tahun_anggaran' => $tahun_anggaran,
                            'level' => 1,
                            'no_urut' => $rows[$i][3]
                        ];
                        $kode_bidang = $bidang->kode_bidang;
                        // $temp_level_1 = $uraian->id_uraian;
                    }
                }
            } elseif (!empty(trim($rows[$i][5])) && empty(trim($rows[$i][2]))) {

                $level = explode(".", $rows[$i][3]);
                $count_level = count($level);

                if ($count_level == 2) {

                    $data[] = [
                        'nama_uraian' => $rows[$i][5],
                        'kode_akun' => $rows[$i][4],
                        'kode_bidang' => $kode_bidang,
                        'kode_dipa' => $kode_dipa,
                        // 'pagu_awal' => str_replace(",", "", $rows[$i][6] ?? 0),
                        'pagu_awal' => str_replace(",", "", $rows[$i][6]),
                        'tahun_anggaran' => $tahun_anggaran,
                        'level' => 1,
                        'no_urut' => $rows[$i][3]
                    ];
                } elseif ($count_level == 3) {

                    $data[] = [
                        'nama_uraian' => $rows[$i][5],
                        'kode_akun' => $rows[$i][4],
                        'kode_bidang' => $kode_bidang,
                        'kode_dipa' => $kode_dipa,
                        // 'pagu_awal' => str_replace(",", "", $rows[$i][6] ?? 0),
                        'pagu_awal' => str_replace(",", "", $rows[$i][6]),
                        'tahun_anggaran' => $tahun_anggaran,
                        'level' => 2,
                        'no_urut' => $rows[$i][3]
                    ];
                } elseif ($count_level == 4) {
                    $data[] = [
                        'nama_uraian' => $rows[$i][5],
                        'kode_akun' => $rows[$i][4],
                        'kode_bidang' => $kode_bidang,
                        'kode_dipa' => $kode_dipa,
                        // 'pagu_awal' => str_replace(",", "", $rows[$i][6] ?? 0),
                        'pagu_awal' => str_replace(",", "", $rows[$i][6]),
                        'tahun_anggaran' => $tahun_anggaran,
                        'level' => 3,
                        'no_urut' => $rows[$i][3]
                    ];
                }
            }
        }
        return $data;
    }

    public function realisasi($year)
    {
        return view('bidum.anggaran.pagu_anggaran.realisasi', compact(
            'year'
        ));
    }

    public function list_realisasi($year, $dipa)
    {
        $realisasi = Realisasi::with('uraian')->whereHas('uraian', function ($query) use ($dipa) {
            return $query->where('kode_dipa', $dipa);
        })->whereYear('tgl_realisasi', $year);
        // return $realisasi;
        return DataTables::eloquent($realisasi)
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
            // ->toJson();
            ->make();
    }

    public function store(UraianRequest $request)
    {
        try {
            $table = 'pusat';
            if ($request->kode_dipa == 'DIPDAR') $table = 'daerah';

            $validateData = $request->validated();
            $validateData['pagu_awal'] = 0;
            $revisi = str_replace(array('Rp', '.'), '', $request->pagu_awal);

            DB::transaction(function () use ($validateData, $revisi) {
                $uraian = Uraian::create($validateData);
                RevisiPagu::create([
                    'id_uraian' => $uraian->id_uraian,
                    'tambah' => $revisi,
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Pagu Created',
                'modal' => '#add',
                'table' => '#table-' . $table
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Uraian $uraian)
    {
        $table = 'pusat';
        if ($uraian->kode_dipa == 'DIPDAR') $table = 'daerah';
        DB::transaction(function () use ($uraian) {
            $id_uraian = Uraian::where('id_parent', $uraian->id_uraian)->pluck('id_uraian')->toArray();
            $id_uraian[] = $uraian->id_uraian;
            RevisiPagu::whereIntegerInRaw('id_uraian', $id_uraian)->delete();
            Realisasi::whereIntegerInRaw('id_uraian', $id_uraian)->delete();
            Uraian::whereIntegerInRaw('id_uraian', $id_uraian)->delete();
        });

        return response()->json([
            'error' => false,
            'message' => 'Pagu Deleted',
            'table' => '#table-' . $table
        ]);
    }
}

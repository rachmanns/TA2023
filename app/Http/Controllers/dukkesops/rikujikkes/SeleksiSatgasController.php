<?php

namespace App\Http\Controllers\dukkesops\rikujikkes;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataKegiatanDukRequest;
use App\Http\Requests\KegiatanDukRequest;
use App\Models\DataKegiatanDuk;
use App\Models\JenisKegDuk;
use App\Models\KategoriDuk;
use App\Models\KegiatanDuk;
use App\Models\PenugasanSatgas;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SeleksiSatgasController extends Controller
{
    public function index(string $jenis_kegiatan, string $keterangan)
    {
        $active_menu = 'seleksi_satgas_' . $jenis_kegiatan;
        $kegiatan_duk = KategoriDuk::where('id_jenis_keg_duk', JenisKegDuk::SATGAS_LN)->get();
        return view('dukkesops.rikujikkes.seleksi_satgas_ln.index', compact(
            'active_menu',
            'kegiatan_duk',
            'keterangan',
            'jenis_kegiatan'
        ));
    }

    public function create($jenis_kegiatan, $keterangan)
    {
        $active_menu = 'seleksi_satgas_' . $jenis_kegiatan;
        // $kategori_duk = KategoriDuk::where('id_jenis_keg_duk', JenisKegDuk::SATGAS_LN)->get();
        $kategori_duk = PenugasanSatgas::whereHas("satgas_ops", function (Builder $query)  use ($jenis_kegiatan) {
            $query->where('jenis_satgas',  $jenis_kegiatan);
        })->select('id_tugas', 'id_satgas_ops', 'nama_satgas', 'nama_batalyon', 'tahun_anggaran')->orderBy("dept_date", "desc")->get();

        $kategori_duk = $kategori_duk->unique('id_satgas_ops');

        return view('dukkesops.rikujikkes.seleksi_satgas_ln.create', compact('active_menu', 'kategori_duk', 'keterangan', 'jenis_kegiatan'));
    }

    public function preview(KegiatanDukRequest $request)
    {

        $active_menu = 'seleksi_satgas_ln';
        $kegiatan_duk = $request->validated();


        $path = public_path('dukkesops');
        $file_kegiatan = $request->file('file_kegiatan');
        $file_kegiatan_name =  $request->file_kegiatan->hashName();
        $file_kegiatan->move($path, $file_kegiatan_name);
        $kegiatan_duk['file_kegiatan'] = $file_kegiatan_name;
        $kegiatan_duk['tgl_upload'] = date('Y-m-d');
        $kegiatan_duk['jenis_kegiatan'] = 'satgas ' . $request->jk;


        $request->session()->put('kegiatan_duk', json_encode($kegiatan_duk));

        $data_kegiatan_duk = $this->get_import_data($path, $file_kegiatan_name);

        $request->session()->put('data_kegiatan_duk', json_encode($data_kegiatan_duk));

        return view('dukkesops.rikujikkes.seleksi_satgas_ln.preview', compact('active_menu', 'data_kegiatan_duk'));
    }

    public function preview_update_data(Request $request, $id_kegiatan_duk)
    {

        $validatedData = $request->validate([
            'file_kegiatan' => 'required|mimes:xls,csv,xlsx|max:2000'
        ]);

        $active_menu = 'seleksi_satgas_ln';

        $path = public_path('dukkesops');

        $file_kegiatan = $request->file('file_kegiatan');
        $file_kegiatan_name =  $request->file_kegiatan->hashName();
        $file_kegiatan->move($path, $file_kegiatan_name);
        $kegiatan_duk['file_kegiatan'] = $file_kegiatan_name;
        $kegiatan_duk['tgl_upload'] = date('Y-m-d');
        $kegiatan_duk['id_kegiatan_duk'] = $id_kegiatan_duk;

        $request->session()->put('kegiatan_duk', json_encode($kegiatan_duk));
        $data_kegiatan_duk = $this->get_import_data($path, $file_kegiatan_name, $id_kegiatan_duk);
        $request->session()->put('data_kegiatan_duk', json_encode($data_kegiatan_duk));

        return view('dukkesops.rikujikkes.seleksi_satgas_ln.preview', compact('active_menu', 'data_kegiatan_duk', 'id_kegiatan_duk'));
    }

    public function get_import_data($path, $file_kegiatan_name, $id_kegiatan_duk = null)
    {
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path . '/' . $file_kegiatan_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($path . '/' . $file_kegiatan_name);

        // unlink($path . '/' . $file_kegiatan_name);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        for ($i = 5; $i < $count_rows; $i++) {
            $npj = preg_replace('/\s\s+/', '_', $rows[$i][2]);
            $npj = explode('_', $npj);
            $data_kegiatan_duk[] = [
                'id_kegiatan_duk' => $id_kegiatan_duk,
                'no_urt' => $rows[$i][0],
                'no_tes' => $rows[$i][1],
                'nama' => $npj[0],
                'pangkat' => $npj[1],
                'nrp' => $npj[2],
                'jabatan' => $npj[3],
                'tb_bb' => preg_replace('/\s\s+/', '_', $rows[$i][3]),
                'imt' => preg_replace('/\s\s+/', '_', $rows[$i][4]),
                'tensi_nadi' => preg_replace('/\s\s+/', '_', $rows[$i][5]),
                'peny_dalam' => preg_replace('/\s\s+/', '_', $rows[$i][6]) ?? '-',
                'ekg' => preg_replace('/\s\s+/', '_', $rows[$i][7]),
                'ro' => preg_replace('/\s\s+/', '_', $rows[$i][8]),
                'lab' => preg_replace('/\s\s+/', '_', $rows[$i][9]),
                'tht' => preg_replace('/\s\s+/', '_', $rows[$i][10]),
                'kulit' => preg_replace('/\s\s+/', '_', $rows[$i][11]),
                'bedah' => preg_replace('/\s\s+/', '_', $rows[$i][12]),
                'atas' => preg_replace('/\s\s+/', '_', $rows[$i][13]),
                'bawah' => preg_replace('/\s\s+/', '_', $rows[$i][14]),
                'mata' => preg_replace('/\s\s+/', '_', $rows[$i][15]),
                'gigi' => preg_replace('/\s\s+/', '_', $rows[$i][16]),
                'jiwa' => preg_replace('/\s\s+/', '_', $rows[$i][17]),
                'hasil_um' => trim((string) $rows[$i][18]),
                'hasil_wa' => trim((string) $rows[$i][19]),
                'ket_nilai' => trim((string) $rows[$i][20]),
                'ket_hasil' => trim((string) $rows[$i][21]),
                'kesimpulan' => str_replace(';', '_', trim((string) $rows[$i][22])),
            ];
        }

        return $data_kegiatan_duk;
    }

    public function store(Request $request)
    {
        try {
            $kd_values = json_decode($request->session()->get('kegiatan_duk'), true);
            DB::transaction(function () use ($request, $kd_values) {
                $kegiatan_duk = KegiatanDuk::create($kd_values);

                $data_kegiatan_duk = json_decode($request->session()->get('data_kegiatan_duk'), true);
                foreach ($data_kegiatan_duk as $key => $value) {
                    $value['id_kegiatan_duk'] = $kegiatan_duk->id_kegiatan_duk;
                    DataKegiatanDuk::create($value);
                }
            });

            $request->session()->forget(['kegiatan_duk', 'data_kegiatan_duk']);

            // return redirect('dukkesops/seleksi-satgas-ln/' . $kd_values['keterangan']);
            return redirect('dukkesops/seleksi-satgas/' . $kd_values['jk'] . '/' . $kd_values['keterangan']);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function update_data(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $kd_values = json_decode($request->session()->get('kegiatan_duk'), true);
                $kegiatan_duk = KegiatanDuk::where('id_kegiatan_duk', $kd_values['id_kegiatan_duk'])->first();
                $path = public_path('dukkesops');
                unlink($path . '/' . $kegiatan_duk->file_kegiatan);
                $kegiatan_duk->update(['file_kegiatan' => $kd_values['file_kegiatan'], 'tgl_upload' => $kd_values['tgl_upload']]);
                DataKegiatanDuk::where('id_kegiatan_duk', $kegiatan_duk->id_kegiatan_duk)->delete();

                $data_kegiatan_duk = json_decode($request->session()->get('data_kegiatan_duk'), true);
                foreach ($data_kegiatan_duk as $key => $value) {
                    DataKegiatanDuk::create($value);
                }
            });

            $request->session()->forget(['kegiatan_duk', 'data_kegiatan_duk']);

            return redirect('dukkesops/seleksi-satgas-ln');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function list(Request $request)
    {
        if ($request->jenis_kegiatan == 'ln') $jenis_kegiatan = KegiatanDuk::SATGAS_LN;
        else $jenis_kegiatan = KegiatanDuk::SATGAS_DN;

        $kegiatan_duk = KegiatanDuk::with('penugasan_satgas')
            ->where('jenis_kegiatan', $jenis_kegiatan)
            ->where('keterangan', $request->keterangan)
            ->when($request->id_kat_duk, function ($query) use ($request) {
                return $query->where('id_kat_duk', $request->id_kat_duk);
            })
            ->when($request->tahun, function ($query) use ($request) {
                return $query->where('tahun_anggaran', $request->tahun);
            })->get();

        return DataTables::of($kegiatan_duk)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                $date_locale = Carbon::parse($row->tanggal)->locale('id')->isoFormat('D MMMM YYYY');
                return "<div class='text-center'>" . $date_locale . "</div>";
            })
            ->addColumn('action', function ($row) {

                return "<div class='text-center'><a href='" . url('dukkesops/seleksi-satgas/' . $row->id_kegiatan_duk) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_kegiatan_duk . "' data-url='" . url('dukkesops/seleksi-satgas') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['tanggal', 'action'])
            ->toJson();
    }

    public function show(KegiatanDuk $seleksi_satgas_ln)
    {
        $jenis = explode(" ", $seleksi_satgas_ln->jenis_kegiatan)[1];
        $active_menu = 'seleksi_satgas_' . $jenis;
        $data_kegiatan_duk = DataKegiatanDuk::where('id_kegiatan_duk', $seleksi_satgas_ln->id_kegiatan_duk)->get();

        $um = $data_kegiatan_duk->groupBy('hasil_um')->map->count();
        $wa = $data_kegiatan_duk->groupBy('hasil_wa')->map->count();
        $um_wa = $data_kegiatan_duk->groupBy('ket_hasil')->map->count();

        $hasil_um = [];
        $hasil_wa = [];
        $hasil_um_wa = [];

        $legend = [
            'MSI',
            'MSII',
            'MSIII',
            'TMS',
            'TH',
            'MMS'
        ];

        foreach ($legend as $k => $v) {
            $hasil_um[$v] = $um[$v] ?? 0;
            $hasil_wa[$v] = $wa[$v] ?? 0;
            $hasil_um_wa[$v] = $um_wa[$v] ?? 0;
        }

        $chart = [
            'hasil_um' => $hasil_um,
            'hasil_wa' => $hasil_wa,
            // 'um_wa' => $data_kegiatan_duk->pluck('hasil_um')->merge($data_kegiatan_duk->pluck('hasil_wa'))->countby()
            'um_wa' => $hasil_um_wa
        ];
        return view('dukkesops.rikujikkes.seleksi_satgas_ln.hasil_rikkes', compact('active_menu', 'seleksi_satgas_ln', 'chart', 'jenis'));
    }

    public function list_data_kegiatan($id_kegiatan_duk)
    {
        $data_kegiatan_duk = DataKegiatanDuk::where('id_kegiatan_duk', $id_kegiatan_duk)->get();

        return DataTables::of($data_kegiatan_duk)
            ->addColumn('nama', function ($row) {
                return $row->nama . "<br>" . $row->pangkat . "<br>" . $row->nrp . "<br>" . $row->jabatan;
            })
            ->addColumn('tb_bb', function ($row) {
                return explode_data_kegiatan_duk($row->tb_bb);
            })
            ->addColumn('imt', function ($row) {
                return explode_data_kegiatan_duk($row->imt);
            })
            ->addColumn('tensi_nadi', function ($row) {
                return explode_data_kegiatan_duk($row->tensi_nadi);
            })
            ->addColumn('peny_dalam', function ($row) {
                return explode_data_kegiatan_duk($row->peny_dalam);
            })
            ->addColumn('ekg', function ($row) {
                return explode_data_kegiatan_duk($row->ekg);
            })
            ->addColumn('ro', function ($row) {
                return explode_data_kegiatan_duk($row->ro);
            })
            ->addColumn('lab', function ($row) {
                return explode_data_kegiatan_duk($row->lab);
            })
            ->addColumn('tht', function ($row) {
                return explode_data_kegiatan_duk($row->tht);
            })
            ->addColumn('kulit', function ($row) {
                return explode_data_kegiatan_duk($row->kulit);
            })
            ->addColumn('bedah', function ($row) {
                return explode_data_kegiatan_duk($row->bedah);
            })
            ->addColumn('atas', function ($row) {
                return explode_data_kegiatan_duk($row->atas);
            })
            ->addColumn('bawah', function ($row) {
                return explode_data_kegiatan_duk($row->bawah);
            })
            ->addColumn('mata', function ($row) {
                return explode_data_kegiatan_duk($row->mata);
            })
            ->addColumn('gigi', function ($row) {
                return explode_data_kegiatan_duk($row->gigi);
            })
            ->addColumn('jiwa', function ($row) {
                return explode_data_kegiatan_duk($row->jiwa);
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_data_kegiatan_duk . "' onclick='edit_data_kegiatan($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_data_kegiatan_duk . "' data-url='" . url('dukkesops/seleksi-satgas/delete-data') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns([
                'nama',
                'tb_bb',
                'imt',
                'tensi_nadi',
                'peny_dalam',
                'ekg',
                'ro',
                'lab',
                'tht',
                'kulit',
                'bedah',
                'atas',
                'bawah',
                'mata',
                'gigi',
                'jiwa',
                'action'
            ])
            ->toJson();
    }

    public function destroy(KegiatanDuk $seleksi_satgas_ln)
    {
        try {
            DB::transaction(function () use ($seleksi_satgas_ln) {
                $path = public_path('dukkesops');
                unlink($path . '/' . $seleksi_satgas_ln->file_kegiatan);

                DataKegiatanDuk::where('id_kegiatan_duk', $seleksi_satgas_ln->id_kegiatan_duk)->delete();

                $seleksi_satgas_ln->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Seleksi Satgas Deleted!',
                'table' => '#seleksi_satgas_ln'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function destroy_data_kegiatan($id_data_kegiatan_duk)
    {
        try {
            $data_kegiatan_duk = DataKegiatanDuk::findOrFail($id_data_kegiatan_duk);
            $data_kegiatan_duk->delete();

            return response()->json([
                'error' => false,
                'message' => 'Seleksi Satgas Deleted!',
                'table' => '#hasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function edit($id_data_kegiatan_duk)
    {
        return DataKegiatanDuk::findOrFail($id_data_kegiatan_duk);
    }

    public function update(DataKegiatanDukRequest $request, $id_data_kegiatan_duk)
    {
        try {
            $data_kegiatan_duk = DataKegiatanDuk::findOrFail($id_data_kegiatan_duk);
            $data_kegiatan_duk->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Data Kegiatan Duk Updated!',
                'modal' => '#edit',
                'table' => '#hasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}

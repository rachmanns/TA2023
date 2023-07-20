<?php

namespace App\Http\Controllers\dukkesops\rikujikkes;

use App\Http\Controllers\Controller;
use App\Http\Requests\DataKegiatanDukRequest;
use App\Http\Requests\KegiatanDukRequest;
use App\Models\DataKegiatanDuk;
use App\Models\JenisKegDuk;
use App\Models\KategoriDuk;
use App\Models\KegiatanDuk;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Yajra\DataTables\Facades\DataTables;

class WervingController extends Controller
{
    public function index()
    {
        $active_menu = 'werving';
        $kegiatan_duk = KategoriDuk::where('id_jenis_keg_duk', JenisKegDuk::WERVING)->get();
        return view('dukkesops.rikujikkes.werving.index', compact('active_menu', 'kegiatan_duk'));
    }

    public function create()
    {
        $active_menu = 'werving';
        $kategori_duk = KategoriDuk::select('id_kat_duk', 'nama_kategori')->where('id_jenis_keg_duk', JenisKegDuk::WERVING)->get();
        return view('dukkesops.rikujikkes.werving.create', compact('active_menu', 'kategori_duk'));
    }

    public function preview(KegiatanDukRequest $request)
    {

        $active_menu = 'werving';
        $kegiatan_duk = $request->validated();


        $path = public_path('dukkesops');
        $file_kegiatan = $request->file('file_kegiatan');
        $file_kegiatan_name =  rand() . '.' . $request->file('file_kegiatan')->getClientOriginalExtension();
        $file_kegiatan->move($path, $file_kegiatan_name);
        $kegiatan_duk['file_kegiatan'] = $file_kegiatan_name;
        $kegiatan_duk['tgl_upload'] = date('Y-m-d');

        $request->session()->put('kegiatan_duk', json_encode($kegiatan_duk));

        $data_kegiatan_duk = $this->get_import_data($path, $file_kegiatan_name);
        $request->session()->put('data_kegiatan_duk', json_encode($data_kegiatan_duk));

        return view('dukkesops.rikujikkes.werving.preview', compact('active_menu', 'data_kegiatan_duk'));
    }

    public function preview_update_data(Request $request, $id_kegiatan_duk)
    {
        $validatedData = $request->validate([
            'file_kegiatan' => 'required|mimes:xls,csv,xlsx|max:2000'
        ]);

        $active_menu = 'werving';

        $path = public_path('dukkesops');

        $file_kegiatan = $request->file('file_kegiatan');
        $file_kegiatan_name =  rand() . '.' . $request->file('file_kegiatan')->getClientOriginalExtension();
        $file_kegiatan->move($path, $file_kegiatan_name);
        $kegiatan_duk['file_kegiatan'] = $file_kegiatan_name;
        $kegiatan_duk['tgl_upload'] = date('Y-m-d');
        $kegiatan_duk['id_kegiatan_duk'] = $id_kegiatan_duk;

        $request->session()->put('kegiatan_duk', json_encode($kegiatan_duk));
        $data_kegiatan_duk = $this->get_import_data($path, $file_kegiatan_name, $id_kegiatan_duk);
        $request->session()->put('data_kegiatan_duk', json_encode($data_kegiatan_duk));

        return view('dukkesops.rikujikkes.werving.preview', compact('active_menu', 'data_kegiatan_duk', 'id_kegiatan_duk'));
    }

    public function get_import_data($path, $file_kegiatan_name, $id_kegiatan_duk = null)
    {
        $file_type = \PhpOffice\PhpSpreadsheet\IOFactory::identify($path . '/' . $file_kegiatan_name);
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($file_type);

        $spreadsheet = $reader->load($path . '/' . $file_kegiatan_name);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        for ($i = 5; $i < $count_rows; $i++) {
            $data_kegiatan_duk[] = [
                'id_kegiatan_duk' => $id_kegiatan_duk,
                'no_urt' => $rows[$i][0],
                'no_tes' => $rows[$i][1],
                'nama' => trim((string) $rows[$i][2]) ?? '-',
                'kelas' => trim((string) $rows[$i][3]) ?? '-',
                'prodi' => trim((string) $rows[$i][4]) ?? '-',
                'jenis_kelamin' => trim((string) $rows[$i][5]) ?? '-',
                'tb_bb' => preg_replace('/\s\s+/', '_', $rows[$i][6]),
                'imt' => preg_replace('/\s\s+/', '_', $rows[$i][7]),
                'tensi_nadi' => preg_replace('/\s\s+/', '_', $rows[$i][8]),
                'peny_dalam' => preg_replace('/\s\s+/', '_', $rows[$i][9]) ?? '-',
                'usg' => preg_replace('/\s\s+/', '_', $rows[$i][10]),
                'obgyn' => preg_replace('/\s\s+/', '_', $rows[$i][11]),
                'jantung' => preg_replace('/\s\s+/', '_', $rows[$i][12]),
                'ergometri' => preg_replace('/\s\s+/', '_', $rows[$i][13]),
                'paru' => preg_replace('/\s\s+/', '_', $rows[$i][14]),
                'ro' => preg_replace('/\s\s+/', '_', $rows[$i][15]),
                'lab' => preg_replace('/\s\s+/', '_', $rows[$i][16]),
                'tht' => preg_replace('/\s\s+/', '_', $rows[$i][17]),
                'kulit' => preg_replace('/\s\s+/', '_', $rows[$i][18]),
                'bedah' => preg_replace('/\s\s+/', '_', $rows[$i][19]),
                'atas' => preg_replace('/\s\s+/', '_', $rows[$i][20]),
                'bawah' => preg_replace('/\s\s+/', '_', $rows[$i][21]),
                'pendengaran_keseimbangan' => preg_replace('/\s\s+/', '_', $rows[$i][22]),
                'mata' => preg_replace('/\s\s+/', '_', $rows[$i][23]),
                'gigi' => preg_replace('/\s\s+/', '_', $rows[$i][24]),
                'jiwa' => preg_replace('/\s\s+/', '_', $rows[$i][25]),
                'hasil_um' => $rows[$i][26] ?? '-',
                'hasil_wa' => $rows[$i][27] ?? '-',
                'ket_nilai' => $rows[$i][28] ?? 0,
                'ket_hasil' => $rows[$i][29] ?? '-',
                'kesimpulan' => str_replace(';', '_', trim((string) $rows[$i][30])),
                'ekg' => null
            ];
        }

        return $data_kegiatan_duk;
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $kd_values = json_decode($request->session()->get('kegiatan_duk'), true);
                $kegiatan_duk = KegiatanDuk::create($kd_values);

                $data_kegiatan_duk = json_decode($request->session()->get('data_kegiatan_duk'), true);
                foreach ($data_kegiatan_duk as $key => $value) {
                    $value['id_kegiatan_duk'] = $kegiatan_duk->id_kegiatan_duk;
                    DataKegiatanDuk::create($value);
                }
            });

            $request->session()->forget(['kegiatan_duk', 'data_kegiatan_duk']);

            return redirect('dukkesops/werving');
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

            return redirect('dukkesops/werving');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function list(Request $request)
    {
        $kegiatan_duk = KegiatanDuk::with('kategori_duk')->whereHas('kategori_duk', function (Builder $query) {
            $query->where('id_jenis_keg_duk', JenisKegDuk::WERVING);
        })->when($request->id_kat_duk, function ($query) use ($request) {
            return $query->where('id_kat_duk', $request->id_kat_duk);
        })
            ->when($request->tahun, function ($query) use ($request) {
                return $query->where('tahun_anggaran', $request->tahun);
            })->get();

        return DataTables::of($kegiatan_duk)
            ->addIndexColumn()
            ->addColumn('tanggal', function ($row) {
                $date_locale = Carbon::parse($row->tanggal)->locale('id')->isoFormat('D MMMM YYYY');
                return "<div'>" . $date_locale . "</div>";
            })
            ->addColumn('action', function ($row) {
                return "<div'><a href='" . url('dukkesops/werving/' . $row->id_kegiatan_duk) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_kegiatan_duk . "' onclick='edit_data($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_kegiatan_duk . "' data-url='" . url('dukkesops/werving') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['tanggal', 'action'])
            ->toJson();
    }

    public function list_data_kegiatan($id_kegiatan_duk)
    {
        $data_kegiatan_duk = DataKegiatanDuk::where('id_kegiatan_duk', $id_kegiatan_duk)->get();

        return DataTables::of($data_kegiatan_duk)
            ->addColumn('nama', function ($row) {
                return $row->nama . "<br>" . $row->kelas . "<br>" . $row->prodi . "<br>" . $row->jenis_kelamin;
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
            ->addColumn('usg', function ($row) {
                return explode_data_kegiatan_duk($row->usg);
            })
            ->addColumn('obgyn', function ($row) {
                return explode_data_kegiatan_duk($row->obgyn);
            })
            ->addColumn('jantung', function ($row) {
                return explode_data_kegiatan_duk($row->jantung);
            })
            ->addColumn('ergometri', function ($row) {
                return explode_data_kegiatan_duk($row->ergometri);
            })
            ->addColumn('paru', function ($row) {
                return explode_data_kegiatan_duk($row->paru);
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
            ->addColumn('pendengaran_keseimbangan', function ($row) {
                return explode_data_kegiatan_duk($row->pendengaran_keseimbangan);
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
                return "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_data_kegiatan_duk . "' onclick='edit_data_kegiatan($(this))'><i data-feather='edit' class='font-medium-4'></i></button><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_data_kegiatan_duk . "' data-url='" . url('dukkesops/werving/delete-data') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns([
                'nama',
                'tb_bb',
                'imt',
                'tensi_nadi',
                'peny_dalam',
                'usg',
                'obgyn',
                'jantung',
                'ergometri',
                'paru',
                'ro',
                'lab',
                'tht',
                'kulit',
                'bedah',
                'atas',
                'bawah',
                'pendengaran_keseimbangan',
                'mata',
                'gigi',
                'jiwa',
                'action'
            ])
            ->toJson();
    }

    public function show(KegiatanDuk $werving)
    {
        $active_menu = 'werving';
        $data_kegiatan_duk = DataKegiatanDuk::where('id_kegiatan_duk', $werving->id_kegiatan_duk)->get();
        $ket_hasil = $data_kegiatan_duk->unique('ket_hasil')->pluck('ket_hasil');
        $jumlah_dokter = [];
        foreach ($ket_hasil as $key => $value) {
            $jumlah_dokter[] = $data_kegiatan_duk->where('ket_hasil', $value)->groupBy('prodi')->map->count();
            $jumlah_dokter[$key]['ket_hasil'] = $value;
        }

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

        return view('dukkesops.rikujikkes.werving.hasil_rikkes', compact('active_menu', 'werving', 'chart', 'jumlah_dokter'));
    }

    public function edit($id_data_kegiatan_duk)
    {
        return DataKegiatanDuk::findOrFail($id_data_kegiatan_duk);
    }

    public function edit_werving($id_kegiatan_duk)
    {
        return KegiatanDuk::with('kategori_duk')->findOrFail($id_kegiatan_duk);
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

    public function update_werving(Request $request)
    {
        try {
            $kegiatan_duk = KegiatanDuk::findOrFail($request->id_kegiatan_duk);
            $kegiatan_duk->update($request->all());
            return response()->json([
                'error' => false,
                'message' => 'Data Rikkes Weving Updated!',
                'modal' => '#edit_werving',
                'table' => '#werving'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function destroy(KegiatanDuk $werving)
    {
        try {
            DB::transaction(function () use ($werving) {
                $path = public_path('dukkesops');
                if (($werving->file_kegiatan != null || $werving->file_kegiatan != '') && file_exists($path . '/' . $werving->file_kegiatan)) {
                    unlink($path . '/' . $werving->file_kegiatan);
                }
                DataKegiatanDuk::where('id_kegiatan_duk', $werving->id_kegiatan_duk)->delete();

                $werving->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Werving Deleted!',
                'table' => '#werving'
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
                'message' => 'Werving Deleted!',
                'table' => '#hasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

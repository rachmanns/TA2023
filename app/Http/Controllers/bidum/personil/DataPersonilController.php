<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonilRequest;
use App\Models\Bahasa;
use App\Models\ConfigModel;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\Keluarga;
use App\Models\Kesatuan;
use App\Models\Korps;
use App\Models\ListUkp;
use App\Models\Matra;
use App\Models\Pakaian;
use App\Models\Pangkat;
use App\Models\PendidikanUmum;
use App\Models\PendMiliterPers;
use App\Models\PendUmumPers;
use App\Models\Personil;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatKategori;
use App\Models\RiwayatPangkat;
use App\Models\TandaJasa;
use App\Models\TandaJasaPers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DataPersonilController extends Controller
{
    public function index()
    {
        $active_menu = 'data_personil';

        $riil = Personil::whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->count();

        $dsp = ConfigModel::sum('var_dsp');

        $personil = Personil::select('id_personil', 'nama')->whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->get();

        $kategori = Kategori::select('id_kategori', 'nama_kategori')->get();

        $config = ConfigModel::first();

        return view('bidum.personil.data_personil.index', compact(
            'active_menu',
            'riil',
            'personil',
            'dsp',
            'config',
            'kategori'
        ));
    }

    public function create()
    {
        $data = [
            'active_menu' => 'data_personil',
            'matra' => Matra::select('kode_matra', 'nama_matra')->whereNotIn('kode_matra', ['TNI', 'KB_TNI', 'KB_PNS', 'MABES'])->get(),
            'jabatan' => Jabatan::select('id_jabatan', 'nama_jabatan')->get()
        ];
        return view('bidum.personil.data_personil.create', $data);
    }

    public function store(PersonilRequest $request)
    {
        try {
            $requestData = $request->validated();
            $pangkat = Pangkat::where('id_pangkat', $request->id_pangkat)->first();
            $jabatan = Jabatan::where('id_jabatan', $request->id_jabatan)->first();
            $requestData['nama_pangkat_terakhir'] = $pangkat->nama_pangkat;
            $requestData['tmt_pangkat_terakhir'] = $request->tmt_pangkat;
            $requestData['nama_jabatan_terakhir'] = $jabatan->nama_jabatan;
            $requestData['tmt_jabatan_terakhir'] = $request->tmt_jabatan;
            $requestData['id_pangkat_terakhir'] = $request->id_pangkat;

            $file = $request->file('foto');
            $tujuan_upload = public_path('personil');
            $foto_name = $request->nik . '.' . $request->file('foto')->getClientOriginalExtension();
            $file->move($tujuan_upload, $foto_name);
            $requestData['foto'] = $foto_name;

            $check_pensiun = $this->check_pensiun($request->tgl_lahir, $request->id_pangkat, $request->tmt_tni);
            $requestData['id_kategori'] = $check_pensiun['id_kategori'];
            DB::transaction(
                function () use ($request, $requestData, $check_pensiun, $pangkat) {
                    $personil = Personil::create($requestData);

                    RiwayatPangkat::create([
                        'id_pangkat' => $request->id_pangkat,
                        'id_personil' => $personil->id_personil,
                        'tmt_pangkat' => $request->tmt_pangkat,
                        'no_skep_pangkat' => $request->no_skep_pangkat,
                        'tgl_skep_pangkat' => $request->tgl_skep_pangkat,
                        'no_sprin_pangkat' => $request->no_sprin_pangkat,
                        'tgl_sprin_pangkat' => $request->tgl_sprin_pangkat
                    ]);

                    RiwayatJabatan::create([
                        'id_jabatan' => $request->id_jabatan,
                        'id_personil' => $personil->id_personil,
                        'tmt_jabatan' => $request->tmt_jabatan,
                        'no_skep_jabatan' => $request->no_skep_jabatan,
                        'tgl_skep_jabatan' => $request->tgl_skep_jabatan,
                        'no_sprin_jabatan' => $request->no_sprin_jabatan,
                        'tgl_sprin_jabatan' => $request->tgl_sprin_jabatan
                    ]);

                    RiwayatKategori::create([
                        'id_kategori' => $check_pensiun['id_kategori'],
                        'id_personil' => $personil->id_personil,
                        'tmt_kategori' => $check_pensiun['tmt_kategori'],
                    ]);

                    if ($pangkat->masa_kenkat != 0 && $check_pensiun['pensiun'] == false) {

                        $check_ukp = $this->check_ukp($request->tmt_pangkat, $pangkat->masa_kenkat);

                        ListUkp::create([
                            'periode' => $check_ukp['periode'],
                            'id_personil' => $personil->id_personil,
                            'pangkat_terakhir' => $pangkat->nama_pangkat,
                            'tmt_pangkat_terakhir' => $check_ukp['tmt_pangkat_terakhir'],
                            'target_tmt_kenkat' => $check_ukp['target_tmt_kenkat']
                        ]);
                    }
                }
            );

            return response()->json([
                'error' => false,
                'message' => 'Personil Created!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(PersonilRequest $request, Personil $personil)
    {
        try {
            $requestData = $request->validated();
            if ($request->file('foto') != null) {
                $path = public_path('personil');
                unlink($path . '/' . $personil->foto);
                $file = $request->file('foto');
                $foto_name = $request->nik . '.' . $request->file('foto')->getClientOriginalExtension();
                $file->move($path, $foto_name);
                $requestData['foto'] = $foto_name;
            }
            $personil->update($requestData);
            return response()->json([
                'error' => false,
                'message' => 'Data Personil Updated!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id_personil)
    {
        $active_menu = 'data_personil';
        $perwira_tinggi = config('global.perwira_tinggi');

        $personil = Personil::with('korps.matra', 'kategori', 'pangkat')->where('id_personil', $id_personil)->first();
        if ($personil->korps->matra->kode_matra != 'PNS') {
            $kode_matra = 'TNI';
        } else {
            $kode_matra = 'PNS';
        }

        if ($personil->korps->kode_korps != 'MAR' && $personil->pangkat->jenis_pangkat == 'Perwira Tinggi') {
            $personil->nama_pangkat = $perwira_tinggi[$personil->korps->kode_matra][$personil->pangkat->nama_pangkat];
        } elseif ($personil->korps->kode_korps == 'MAR' && $personil->pangkat->jenis_pangkat == 'Perwira Tinggi') {
            $personil->nama_pangkat = $perwira_tinggi['AD'][$personil->pangkat->nama_pangkat];
        }

        $pangkat = Pangkat::where('kode_matra', $kode_matra)->orderByRaw('CONVERT(id_pangkat, SIGNED) asc')->get();
        $pendidikan_umum = PendidikanUmum::all();
        $pend_umum_pers = PendUmumPers::with('pendidikan_umum')->where('id_personil', $id_personil)->get();
        $jabatan = Jabatan::select('id_jabatan', 'nama_jabatan')->get();
        $tanda_jasa = TandaJasa::get();
        $kategori = Kategori::where('nama_kategori', '<>', Kategori::AKTIF)->get();

        $pakaian = Pakaian::select('pakaian.*', 'pakaian_personil.id_personil', 'pakaian_personil.id_pakaian_personil', 'pakaian_personil.ukuran')->leftJoin('pakaian_personil', function ($join) use ($id_personil) {
            $join->on('pakaian_personil.id_pakaian', '=', 'pakaian.id_pakaian')
                ->where('pakaian_personil.id_personil', '=', $id_personil);
        })->get();

        $matra = Matra::select('kode_matra', 'nama_matra')->whereNotIn('kode_matra', ['TNI', 'KB_TNI', 'KB_PNS', 'MABES'])->get();

        $url = [
            "data_keluarga" => route('bidum.personil.list_keluarga_data_personil', $id_personil),
            "data_pendidikan_umum" => route('bidum.personil.list_pendidikan_umum_data_personil', $id_personil),
            "data_pendidikan_militer" => route('bidum.personil.list_pendidikan_militer_data_personil', $id_personil),
            "data_riwayat_pangkat" => route('bidum.personil.list_riwayat_pangkat_data_personil', $id_personil),
            "data_riwayat_jabatan" => route('bidum.personil.list_riwayat_jabatan_data_personil', $id_personil),
            "data_penugasan_dn" => route('bidum.personil.list_penugasan_dn_data_personil', $id_personil),
            "data_penugasan_ln" => route('bidum.personil.list_penugasan_ln_data_personil', $id_personil),
            "data_bahasa" => route('bidum.personil.list_bahasa_data_personil', $id_personil),
            "data_tanda_jasa" => route('bidum.personil.list_tanda_jasa_data_personil', $id_personil)
        ];

        $target_data = [
            'data_keluarga' => '#data_keluarga',
            'data_pendidikan_umum' => '#data_pendidikan_umum',
            'data_pendidikan_militer' => '#data_pendidikan_militer',
            'data_riwayat_pangkat' => '#data_riwayat_pangkat',
            'data_riwayat_jabatan' => '#data_riwayat_jabatan',
            'data_penugasan_dn' => '#data_penugasan_dn',
            'data_penugasan_ln' => '#data_penugasan_ln',
            'data_bahasa' => '#data_bahasa',
            'data_tanda_jasa' => '#data_tanda_jasa'
        ];

        $tmt_kategori = RiwayatKategori::where('id_personil', $id_personil)->orderBy('created_at', 'DESC')->first()->tmt_kategori;
        $tmt_tni = Carbon::parse($personil->tmt_tni);
        $now = Carbon::now();

        $mkg = $tmt_tni->diffInYears($now);

        return view('bidum.personil.data_personil.show', ['active_menu' => 'data_personil'], compact('personil', 'pangkat', 'pendidikan_umum', 'pend_umum_pers', 'jabatan', 'url', 'target_data', 'tanda_jasa', 'pakaian', 'kategori', 'matra', 'tmt_kategori', 'mkg'));
    }

    public function list(Request $request)
    {
        $personil = Personil::with('korps', 'korps.matra', 'kategori', 'pangkat')
            ->when($request->id_kategori != 'all', function ($query) use ($request) {
                return $query->where('id_kategori', $request->id_kategori);
            })
            ->orderByRaw('CONVERT(id_pangkat_terakhir, SIGNED) ASC')
            ->get();

        $perwira_tinggi = config('global.perwira_tinggi');

        return DataTables::of($personil)
            ->addColumn('nama_pangkat', function ($q) use ($perwira_tinggi) {
                if ($q->korps->kode_korps != 'MAR' && $q->pangkat->jenis_pangkat == 'Perwira Tinggi') {
                    $q->nama_pangkat_terakhir = $perwira_tinggi[$q->korps->kode_matra][$q->nama_pangkat_terakhir];
                } elseif ($q->korps->kode_korps == 'MAR' && $q->pangkat->jenis_pangkat == 'Perwira Tinggi') {
                    $q->nama_pangkat_terakhir = $perwira_tinggi['AD'][$q->nama_pangkat_terakhir];
                }

                return $q->nama_pangkat_terakhir;
            })
            ->addColumn('kode_matra', function ($query) {
                if ($query->korps <> null) {
                    return $query->korps->kode_matra;
                }
                return '-';
            })
            ->addColumn('action', function ($query) {
                return '<div class="text-center" title="Detail"><a href="' . route('bidum.personil.show_data_personil', $query->id_personil)  . '"><i data-feather="file-text" class="font-medium-4"></i></a></div>';
            })
            ->rawColumns(['action', 'kode_matra'])
            ->toJson();
    }

    public function list_korps($kode_matra)
    {
        $list_all = Korps::where("kode_matra", $kode_matra)->when($kode_matra == 'PNS', function ($query, $role) {
            return $query->orderBy('created_at', 'desc');
        })->get();

        $select = [];

        if ($kode_matra != 'PNS') $select[] = ["id" => "", "text" => "Pilih Korps"];

        foreach ($list_all as $item) {
            $select[] = ["id" => $item->kode_korps, "text" => $item->nama_korps . ' - ' . $item->kode_korps];
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function list_pangkat($kode_matra)
    {
        $pangkat = Pangkat::when($kode_matra === 'PNS', function ($query) {
            return $query->where('kode_matra', 'PNS')->orderByRaw('CONVERT(id_pangkat, SIGNED) asc');
        }, function ($query) {
            return $query->where('kode_matra', '<>', 'PNS')->orderByRaw('CONVERT(id_pangkat, SIGNED) asc');
        })->get();

        $select = [];

        $select[] = ["id" => "", "text" => "Pilih Pangkat"];
        foreach ($pangkat as $item) {
            $select[] = ["id" => $item->id_pangkat, "text" => $item->nama_pangkat];
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function list_kesatuan($kode_matra)
    {
        $kesatuan = Kesatuan::where('kode_matra', $kode_matra)->get();

        $select = [];

        $select[] = ["id" => "", "text" => "Pilih Kesatuan"];
        foreach ($kesatuan as $item) {
            $select[] = ["id" => $item->nama_kesatuan, "text" => $item->nama_kesatuan];
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function store_config(Request $request)
    {
        $validated = $request->validate([
            'var_dsp' => 'nullable|numeric|min:0',
            'pensiun_bintara' => 'nullable|numeric|min:0|max:100',
            'pensiun_tamtama' => 'nullable|numeric|min:0|max:100',
            'pensiun_perwira' => 'nullable|numeric|min:0|max:100',
            'pensiun_pns' => 'nullable|numeric|min:0|max:100',
            'jabatan' => 'nullable'
        ]);

        try {
            ConfigModel::create([
                'var_dsp' => $request->var_dsp,
                'var_rh' => $request->var_rh,
                'pensiun_bintara' => $request->pensiun_bintara,
                'pensiun_tamtama' => $request->pensiun_tamtama,
                'pensiun_perwira' => $request->pensiun_perwira,
                'pensiun_pns' => $request->pensiun_pns,
                'jabatan' => $request->jabatan
            ]);
            return response()->json([
                'error' => false,
                'message' => 'DSP Created!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update_config(Request $request, ConfigModel $config)
    {
        $validated = $request->validate([
            'var_dsp' => 'nullable|numeric|min:0',
            'pensiun_bintara' => 'nullable|numeric|min:0|max:100',
            'pensiun_tamtama' => 'nullable|numeric|min:0|max:100',
            'pensiun_perwira' => 'nullable|numeric|min:0|max:100',
            'pensiun_pns' => 'nullable|numeric|min:0|max:100',
            'jabatan' => 'nullable'
        ]);

        try {
            $config->update([
                'var_dsp' => $request->var_dsp,
                'var_rh' => $request->var_rh,
                'pensiun_bintara' => $request->pensiun_bintara,
                'pensiun_tamtama' => $request->pensiun_tamtama,
                'pensiun_perwira' => $request->pensiun_perwira,
                'pensiun_pns' => $request->pensiun_pns,
                'jabatan' => $request->jabatan
            ]);
            return response()->json([
                'error' => false,
                'message' => 'DSP Updated!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function cetak_data_personil(Personil $personil)
    {
        $active_menu = 'data_personil';

        $pendidikan_umum = PendUmumPers::with('pendidikan_umum')->where('id_personil', $personil->id_personil)->get();

        $pend_militer_diktuk = PendMiliterPers::where('id_personil', $personil->id_personil)->whereRaw("LOWER(REPLACE(`kategori_pendidikan`,' ','') = ?)", strtolower(str_replace(' ', '', 'diktuk/dikbangum')))->get();

        $pend_militer_dikbangspes = PendMiliterPers::where('id_personil', $personil->id_personil)->whereRaw("LOWER(REPLACE(`kategori_pendidikan`,' ','') = ?)", strtolower(str_replace(' ', '', 'dikbangspes')))->get();

        $bahasa = Bahasa::select('bahasa', 'jenis', 'kompetensi')->where('id_personil', $personil->id_personil)->get();
        $asing = $bahasa->where('jenis', 'asing');
        $daerah = $bahasa->where('jenis', 'daerah');

        $tanda_jasa = TandaJasaPers::with('tanda_jasa')->where('id_personil', $personil->id_personil)->get();

        $riwayat_pangkat = RiwayatPangkat::with('pangkat')->where('id_personil', $personil->id_personil)->get();
        $riwayat_jabatan = RiwayatJabatan::with('jabatan')->where('id_personil', $personil->id_personil)->get();

        $keluarga = Keluarga::where('id_personil', $personil->id_personil)->get();
        $count_anak = $keluarga->where('hubungan', 'anak')->count();

        $config = ConfigModel::with('personil')->first();

        return view('bidum.personil.data_personil.cetak_rh', compact('active_menu', 'personil', 'pendidikan_umum', 'pend_militer_diktuk', 'pend_militer_dikbangspes', 'asing', 'daerah', 'tanda_jasa', 'riwayat_pangkat', 'riwayat_jabatan', 'keluarga', 'count_anak', 'config'));
    }

    public function cetak_nominatif()
    {
        $active_menu = 'data_personil';
        $month_year = date('Y-m');
        $bulan = Carbon::parse($month_year)->locale('id')->isoFormat('MMMM YYYY');

        $query = Personil::select('personil.*')
            ->join('kategori', 'personil.id_kategori', '=', 'kategori.id_kategori')
            ->join('korps', 'personil.kode_korps', '=', 'korps.kode_korps')
            ->where('kategori.nama_kategori', Kategori::AKTIF)
            // ->where('korps.kode_matra', '<>', 'PNS')
            ->get();

        $id_personil = $query->pluck('id_personil')->toArray();
        $count_id = count($id_personil);
        $placeholders = implode(",", array_fill(0, $count_id, '?'));

        $riwayat_jabatan = DB::select("SELECT
                    *
                FROM
                    `riwayat_jabatan`
                WHERE
                    (id_personil,
                    tmt_jabatan) IN(
                    SELECT
                        id_personil,
                        MAX(tmt_jabatan) AS tmt_jabatan
                    FROM
                        `riwayat_jabatan`
                    WHERE id_personil in ($placeholders)
                    GROUP BY
                        id_personil
                );
            ", $id_personil);

        $riwayat_jabatan = collect($riwayat_jabatan);

        foreach ($query as $k => $v) {
            $v->id_jabatan_terakhir = $riwayat_jabatan->where('id_personil', $v->id_personil)->first()->id_jabatan;
        }

        $tni = $query->where('korps.kode_matra', '<>', 'PNS')->sortBy('id_jabatan_terakhir');

        $pns = $query->where('korps.kode_matra', 'PNS')->sortBy('id_jabatan_terakhir');

        return view('bidum.personil.data_personil.cetak_nominatif', compact('active_menu', 'tni', 'bulan', 'pns'));
    }

    public function nonaktif_personil(Request $request, Personil $personil)
    {
        try {
            $nama_kategori = Kategori::where('id_kategori', $request->alasan)->first()->nama_kategori;
            DB::transaction(function () use ($personil, $request, $nama_kategori) {
                $personil->update(['id_kategori' => $request->alasan]);

                if ($nama_kategori == Kategori::PENSIUN) {
                    $day = date('d', strtotime($personil->tgl_lahir));
                    $month = date('m', strtotime($personil->tgl_lahir));
                    RiwayatKategori::create([
                        'id_kategori' => $request->alasan,
                        'id_personil' => $personil->id_personil,
                        'tmt_kategori' => date('Y-' . $month . '-' . $day)
                    ]);
                } else {
                    RiwayatKategori::create([
                        'id_kategori' => $request->alasan,
                        'id_personil' => $personil->id_personil,
                        'tmt_kategori' => date('Y-m-d')
                    ]);
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Succesfully Nonaktif',
                'url' => url('bidum/personil')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function aktif_personil(Request $request, Personil $personil)
    {
        try {
            $kategori = Kategori::where('nama_kategori', Kategori::AKTIF)->first();
            DB::transaction(function () use ($personil, $kategori) {
                $personil->update(['id_kategori' => $kategori->id_kategori]);
                RiwayatKategori::create([
                    'id_kategori' => $kategori->id_kategori,
                    'id_personil' => $personil->id_personil,
                    'tmt_kategori' => date('Y-m-d')
                ]);
            });

            return response()->json([
                'error' => false,
                'message' => 'Succesfully Aktif',
                'url' => url('bidum/personil')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function check_pensiun($tgl_lahir, $id_pangkat, $tmt_tni)
    {
        $kategori = Kategori::get();
        $pangkat = Pangkat::find($id_pangkat);
        $age = Carbon::parse($tgl_lahir)->age;

        $usia_pensiun = $pangkat->usia_pensiun;

        if ($age >= $usia_pensiun) {
            $tgl_lahir = date('m-d', strtotime($tgl_lahir));
            return [
                'id_kategori' => $kategori->where('nama_kategori', Kategori::PENSIUN)->first()->id_kategori,
                'tmt_kategori' => date('Y-' . $tgl_lahir),
                'pensiun' => true
            ];
        }

        return [
            'id_kategori' => $kategori->where('nama_kategori', Kategori::AKTIF)->first()->id_kategori,
            'tmt_kategori' => $tmt_tni,
            'pensiun' => false
        ];
    }

    public function check_ukp($tmt_pangkat, $masa_kenkat)
    {
        $month = date('n', strtotime($tmt_pangkat));

        if (in_array($month, range(5, 10))) {
            $target_tmt_kenkat = date('Y-10-01', strtotime("+" . $masa_kenkat . " years", strtotime($tmt_pangkat)));
            $periode = date('Y-04-d', strtotime($target_tmt_kenkat));
        } elseif (in_array($month, range(11, 12))) {
            $target_tmt_kenkat = date('Y-04-01', strtotime("+" . $masa_kenkat . " years", strtotime($tmt_pangkat)));
            $periode = date('Y-10-d', strtotime("-1 years", strtotime($target_tmt_kenkat)));
        } elseif (in_array($month, range(1, 4))) {
            $target_tmt_kenkat = date('Y-04-01', strtotime("+" . $masa_kenkat . " years", strtotime($tmt_pangkat)));
            $periode = date('Y-10-d', strtotime("-1 years", strtotime($target_tmt_kenkat)));
        }

        return [
            'periode' => $periode,
            'tmt_pangkat_terakhir' => $tmt_pangkat,
            'target_tmt_kenkat' => $target_tmt_kenkat
        ];
    }
}

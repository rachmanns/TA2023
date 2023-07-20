<?php

namespace App\Services;

use App\Http\Requests\PatubelRequest;
use App\Models\Dokter;
use App\Models\KategoriDokter;
use App\Models\Paramedis;
use App\Models\Patubel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PatubelService
{
    public static function get_nakes(): array
    {
        $dokter = Dokter::with(['jenis_spesialis' => function ($q) {
            return $q->select('id_kategori_dokter')->take(1);
        }])->whereHas('jenis_spesialis', function (Builder $query) {
            // $query->whereIn('id_kategori_dokter', [1, 3]);
        })->get();
        $kategori_dokter = KategoriDokter::select('id_kategori_dokter', 'nama_kategori')->get();
        $paramedis = Paramedis::with('jenis_paramedis')->get();

        $nakes = [];

        foreach ($dokter as $key => $value) {
            $id_kategori_dokter = $value->jenis_spesialis()->first()->id_kategori_dokter;
            $nakes[] = [
                'id_nakes' => $value->id_dokter,
                'nama' => $value->nama_dokter,
                'kategori' => $kategori_dokter->where('id_kategori_dokter', $id_kategori_dokter)->first()->nama_kategori,
                'id_kategori' => $kategori_dokter->where('id_kategori_dokter', $id_kategori_dokter)->first()->id_kategori_dokter,
                'satuan_asal' => $value->satuan_asal,
                'no_identitas' => $value->no_identitas,
                'pangkat' => $value->pangkat_korps,
                'jabatan_struktural' => $value->jabatan_struktural,
                'jabatan_fungsional' => $value->jabatan_fungsional,
                'ket_peserta' => 'dokter'
            ];
        }

        foreach ($paramedis as $key => $value) {
            $nakes[] = [
                'id_nakes' => $value->id_paramedis,
                'nama' => $value->nama_paramedis,
                'kategori' => $value->jenis_paramedis->nama_jenis_paramedis,
                'id_kategori' => $value->jenis_paramedis->id_jenis_paramedis,
                'satuan_asal' => $value->satuan_asal,
                'no_identitas' => $value->no_identitas,
                'pangkat' => $value->pangkat,
                'jabatan_struktural' => $value->jabatan_struktural,
                'jabatan_fungsional' => $value->jabatan_fungsional,
                'ket_peserta' => 'paramedis'
            ];
        }

        return $nakes;
    }

    public static function store_check(PatubelRequest $request)
    {
        if (Dokter::where('id_dokter', $request->id_nakes)->exists()) return self::store($request);
        else if (Paramedis::where('id_paramedis', $request->id_nakes)->exists()) return self::store($request);
        else return self::store_nakes_check($request);
    }

    private static function store_nakes_check(PatubelRequest $request)
    {
        if (KategoriDokter::where('id_kategori_dokter', $request->kategori)->exists()) {
            return self::store_dokter($request);
        } else {
            return self::store_paramedis($request);
        }
    }

    private static function store_dokter(PatubelRequest $request): Patubel
    {
        $patubel = DB::transaction(function () use ($request) {

            $dokter = Dokter::create([
                'nama_dokter' => $request->id_nakes,
                'satuan_asal' => $request->satuan_asal,
                'no_identitas' => $request->no_identitas,
                'pangkat_korps' => $request->pangkat,
                'jabatan_struktural' => $request->jabatan_struktural,
                'jabatan_fungsional' => $request->jabatan_fungsional,
                'matra' => $request->matra,
            ]);

            $requestData = $request->validated();
            $requestData['tahun_ajaran'] = $request->semester . ' - ' . $request->tahun;
            $requestData['status'] = 'calon';
            $requestData['id_nakes'] = $dokter->id_dokter;
            $requestData['ket_peserta'] = 'dokter';
            return Patubel::create($requestData);
        });

        return $patubel;
    }

    private static function store_paramedis(PatubelRequest $request): Patubel
    {
        $patubel = DB::transaction(function () use ($request) {

            $paramedis = Paramedis::create([
                'nama_paramedis' => $request->id_nakes,
                'satuan_asal' => $request->satuan_asal,
                'no_identitas' => $request->no_identitas,
                'pangkat' => $request->pangkat,
                'jabatan_struktural' => $request->jabatan_struktural,
                'jabatan_fungsional' => $request->jabatan_fungsional,
                'id_jenis_paramedis' => $request->kategori,
                'matra' => $request->matra,
            ]);

            $requestData = $request->validated();
            $requestData['tahun_ajaran'] = $request->semester . ' - ' . $request->tahun;
            $requestData['status'] = 'calon';
            $requestData['id_nakes'] = $paramedis->id_paramedis;
            $requestData['ket_peserta'] = 'paramedis';
            return Patubel::create($requestData);
        });

        return $patubel;
    }

    public static function store(PatubelRequest $request): Patubel
    {
        $requestData = $request->validated();
        $requestData['tahun_ajaran'] = $request->semester . ' - ' . $request->tahun;
        $requestData['status'] = 'calon';


        if ($request->ket_peserta == 'dokter') {
            $dokter = Dokter::find($request->id_nakes);
            $dokter->matra = $request->matra;
            $dokter->update();
        } else {
            $paramedis = Paramedis::find($request->id_nakes);
            $paramedis->matra = $request->matra;
            $paramedis->update();
        }

        return Patubel::create($requestData);
    }

    public static function calon_dataTable(Request $request): JsonResponse
    {
        $patubel = Patubel::with('dokter', 'paramedis')
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereRaw("substring_index(tahun_ajaran,' - ',-1) = ?", $request->tahun);
            })
            ->get();
        return DataTables::of($patubel)
            ->addColumn('matra', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->matra ?? '-';
                }
                return $row->paramedis->matra ?? '-';
            })
            ->addColumn('satuan_asal', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->satuan_asal ?? '-';
                }
                return $row->paramedis->satuan_asal ?? '-';
            })
            ->addColumn('nama', function ($row) use ($request) {
                if (!empty($row->dokter)) {
                    return '<a href="' . url('bangkes/calon-patubel/detail/' . $row->id_nakes . '/' . $row->ket_peserta) . '"><u> ' . $row->dokter->nama_dokter ?? '-' . ' </u></a>';
                }
                $nama_paramedis = $row->paramedis->nama_paramedis ?? '-';
                return '<a href="' . url('bangkes/calon-patubel/detail/' . $row->id_nakes . '/' . $row->ket_peserta) . '"><u> ' .  $nama_paramedis . ' </u></a>';
            })
            ->addColumn('pangkat', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->pangkat_korps;
                }
                return $row->paramedis->pangkat ?? '-';
            })
            ->addColumn('no_identitas', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->no_identitas ?? '-';
                }
                return $row->paramedis->no_identitas ?? '-';
            })
            ->addColumn('jabatan_struktural', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->jabatan_struktural ?? '-';
                }
                return $row->paramedis->jabatan_struktural ?? '-';
            })
            ->addColumn('jabatan_fungsional', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->jabatan_fungsional ?? '-';
                }
                return $row->paramedis->jabatan_fungsional ?? '-';
            })
            ->addColumn('peminatan_kampus', function ($row) {
                return '<span class="font-weight-bolder"> ' . $row->peminatan . ' </span> <br> ' . $row->kampus;
            })
            ->addColumn('status', function ($row) use ($request) {
                if ($row->status == 'calon') $status = '<div class="badge badge-light-warning font-small-4 mt-50"> Diajukan </div>';
                else $status = '<div class="badge badge-light-success font-small-4 mt-50"> Disetujui </div>';
                return $status;
            })
            ->addColumn('action', function ($row) use ($request) {
                return '<div class="text-center"><a href="' . url('bangkes/calon-patubel/' . $row->id_patubel . '/edit') . '"title="Edit" class="btn pr-0 text-primary"><i data-feather="edit" class="font-medium-4"></i></a>
                <button title="Delete" type="button" class="delete-data btn p-0" data-id=' . $row->id_patubel . ' data-url=' . url('bangkes/calon-patubel') . '><i data-feather="trash" class="font-medium-4 text-danger"></i></button>
                </div>';
            })
            ->rawColumns(['action', 'peminatan_kampus', 'status', 'nama', 'file_sprin', 'file_sprin2', 'alih_jurusan'])
            ->toJson();
    }

    public static function peserta_dataTable(Request $request): JsonResponse
    {
        $patubel = Patubel::with('dokter', 'paramedis')->where('status', '!=', 'calon')
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereRaw("substring_index(tahun_ajaran,' - ',-1) = ?", $request->tahun);
            })
            ->when($request->status, function ($query) use ($request) {
                return $query->where("status", $request->status);
            })
            ->get();
        return DataTables::of($patubel)
            ->addColumn('tahun', function ($row) {
                $tahun = tahun_patubel($row->tahun_ajaran);
                return $tahun;
            })
            ->addColumn('file_sprin', function ($row) {
                if (!empty($row->file_sprin) || $row->file_sprin != null)
                    return "<a href='" . asset('storage/' . $row->file_sprin) . "' target='_blank'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a>";
                else
                    return "<div class='badge badge-light-danger font-small-4 mb-50'>Belum Upload Dokumen</div>";
            })
            ->addColumn('file_sprin2', function ($row) {
                if (!empty($row->file_sprin2)) return "<a href='" . asset('storage/' . $row->file_sprin2) . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a>";
            })
            ->addColumn('tmt', function ($row) {
                return indonesian_date_format($row->tmt_awal) . ' sd ' . indonesian_date_format($row->tmt_akhir);
            })
            ->addColumn('alih_jurusan', function ($row) {
                if (!empty($row->file_sprin2)) return "<div class='badge badge-light-success font-small-4 mb-50'>Ya</div>";
                return "<div class='badge badge-light-danger font-small-4 mb-50'>Tidak</div>";
            })
            ->addColumn('matra', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->matra;
                }
                return $row->paramedis->matra;
            })
            ->addColumn('satuan_asal', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->satuan_asal;
                }
                return $row->paramedis->satuan_asal;
            })
            ->addColumn('nama', function ($row) use ($request) {
                return  $row->dokter->nama_dokter ?? $row->paramedis->nama_paramedis;
            })
            ->addColumn('pangkat', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->pangkat_korps;
                }
                return $row->paramedis->pangkat;
            })
            ->addColumn('no_identitas', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->no_identitas;
                }
                return $row->paramedis->no_identitas;
            })
            ->addColumn('jabatan_struktural', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->jabatan_struktural;
                }
                return $row->paramedis->jabatan_struktural;
            })
            ->addColumn('jabatan_fungsional', function ($row) {
                if (!empty($row->dokter)) {
                    return $row->dokter->jabatan_fungsional;
                }
                return $row->paramedis->jabatan_fungsional;
            })
            ->addColumn('peminatan_kampus', function ($row) {
                return '<span class="font-weight-bolder"> ' . $row->peminatan . ' </span> <br> ' . $row->kampus;
            })
            ->addColumn('status', function ($row) use ($request) {
                if ($row->status == 'lulus')
                    return "<div class='badge badge-light-success font-small-4 mb-50'>Lulus</div> <br> " . indonesian_date_format($row->tgl_lulus);
                else return "<div class='badge badge-light-success font-small-4 mb-50'>" . $row->status . "</div>";
            })
            ->addColumn('action', function ($row) use ($request) {
                return  "<div class='text-center'><a href='" . url('bangkes/peserta-patubel/' . $row->id_patubel . '/edit') . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0'  data-id='" . $row->id_patubel . "' data-url='" . url('bangkes/peserta-patubel') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action', 'peminatan_kampus', 'status', 'nama', 'file_sprin', 'file_sprin2', 'alih_jurusan'])
            ->toJson();
    }

    public static function update_status_calon(PatubelRequest $request, Patubel $patubel): Patubel
    {
        $validated = $request->safe()->except(['tmt']);
        if ($request->has('file_sprin')) {
            $validated['file_sprin'] = $request->file_sprin->store('patubel');
        }
        $validated['status'] = 'belum lulus';
        $validated['tahun_ajaran'] = $request->semester . ' - ' . $request->tahun;

        if ($patubel->ket_peserta == 'dokter') {
            $dokter = Dokter::find($patubel->id_nakes);
            $dokter->matra = $request->matra;
            $dokter->update();
        } else {
            $paramedis = Paramedis::find($patubel->id_nakes);
            $paramedis->matra = $request->matra;
            $paramedis->update();
        }

        $patubel->update($validated);
        return $patubel;
    }

    public static function destroy(Patubel $patubel): Bool
    {
        if (!empty($patubel->file_sprin)) Storage::delete($patubel->file_sprin);
        if (!empty($patubel->file_sprin2)) Storage::delete($patubel->file_sprin2);
        return $patubel->deleteOrFail();
    }

    public static function detail_nakes($id_nakes, $ket_peserta): Model
    {
        if ($ket_peserta == 'dokter') $nakes = Dokter::with('jenis_spesialis.kategori_dokter')->find($id_nakes);
        else $nakes = Paramedis::with('jenis_paramedis')->find($id_nakes);

        $rumah_sakit = $nakes->rumah_sakit()->orderBy('created_at', 'desc')->first();
        $nakes['rumah_sakit'] = $rumah_sakit;

        return $nakes;
    }

    public static function dataTable_patubel_nakes($id_nakes): JsonResponse
    {
        $patubel = Patubel::where('id_nakes', $id_nakes)->get();
        return DataTables::of($patubel)
            ->addColumn('tmt', function ($row) {
                return indonesian_date_format($row->tmt_awal) . ' sd ' . indonesian_date_format($row->tmt_akhir);
            })
            ->addColumn('file_sprin', function ($row) {
                if (!empty($row->file_sprin))
                    return "<a href='" . asset('storage/' . $row->file_sprin)  . "'><u><i data-feather='paperclip' class='mr-50'></i>Lihat Dokumen</u></a>";
            })
            ->addColumn('status', function ($row) {
                return "<div class='badge badge-light-success font-small-4 mb-50'>" . $row->status . "</div>";
            })

            ->editColumn('tgl_lulus', function ($row) {
                if (!empty($row->tgl_lulus)) return indonesian_date_format($row->tgl_lulus);
            })
            ->rawColumns(['tmt', 'file_sprin', 'status'])
            ->toJson();
    }

    public static function update(PatubelRequest $request, Patubel $patubel): Patubel
    {
        $validated = $request->safe()->except(['tmt']);

        if ($request->status == 'tidak lulus') {
            $validated['tgl_lulus'] = null;
            $validated['ipk'] = null;
        } elseif ($request->status == 'lulus') {
            $validated['keterangan'] = null;
        } else {
            $validated['keterangan'] = null;
            $validated['tgl_lulus'] = null;
            $validated['ipk'] = null;
        }

        if ($request->has('file_sprin')) {
            if (!empty($patubel->file_sprin)) Storage::delete($patubel->file_sprin);
            $validated['file_sprin'] =  $request->file_sprin->store('patubel');
        }

        if ($request->has('file_sprin2')) {
            if (!empty($patubel->file_sprin2)) {
                Storage::delete($patubel->file_sprin2);
            }
            $validated['file_sprin2'] =  $request->file_sprin2->store('patubel');
        }

        $patubel->update($validated);

        return $patubel;
    }

    public static function count_patubel(Request $request): array
    {
        $patubel = Patubel::when($request->tahun_ajaran, function ($query) use ($request) {
            return $query->where('tahun_ajaran', $request->tahun_ajaran);
        })->get();
        return [
            'calon' => $patubel->where('status', 'calon')->count(),
            'belum_lulus' => $patubel->where('status', 'belum lulus')->count(),
            'lulus' => $patubel->where('status', 'lulus')->count(),
            'alih_jurusan' => $patubel->where('file_sprin2', '<>', null)->count(),
        ];
    }
}

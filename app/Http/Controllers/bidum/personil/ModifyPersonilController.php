<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Models\Bahasa;
use App\Models\Keluarga;
use App\Models\PakaianPersonil;
use App\Models\PendidikanUmum;
use App\Models\PendMiliterPers;
use App\Models\PendUmumPers;
use App\Models\Penugasan;
use App\Models\Personil;
use App\Models\RiwayatJabatan;
use App\Models\RiwayatPangkat;
use App\Models\TandaJasa;
use App\Models\TandaJasaPers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ModifyPersonilController extends Controller
{
    public function store_pendidikan_umum(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'id_pend_umum' => 'required',
            'tahun_lulus' => 'required',
            'nama_sekolah' => 'required'
        ]);

        try {
            $id_pend_umum = PendidikanUmum::where('tingkat_pendidikan', 'SD')->first()->id_pend_umum;
            $riwayat = PendUmumPers::where('id_personil', $request->id_personil)->where('id_pend_umum', $id_pend_umum)->first();
            if ($riwayat) throw new \Exception("SD udah diinput");

            PendUmumPers::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Pendidikan Umum Personil Created!',
                'modal' => '#umum',
                'table' => '#data_pendidikan_umum'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store_keluarga(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'hubungan' => 'required',
        ]);

        try {
            Keluarga::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Keluarga Personil Created!',
                'modal' => '#anggota-keluarga',
                'table' => '#data_keluarga'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function get_keluarga(Keluarga $keluarga)
    {
        return $keluarga;
    }

    public function update_keluarga(Request $request)
    {
        $keluarga = Keluarga::find($request->id_keluarga);
        $validatedData = $request->validate([
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'hubungan' => 'required',
        ]);

        try {
            $keluarga->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Keluarga Personil Created!',
                'modal' => '#edit_keluarga',
                'table' => '#data_keluarga'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function store_pend_militer_pers(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'nama_sekolah' => ['required', Rule::unique('pend_militer_pers')->where(function ($query) use ($request) {
                return $query->where('nama_sekolah', $request->nama_sekolah)
                    ->where('id_personil', $request->id_personil);
            })],
            'kategori_pendidikan' => 'required',
            'tahun_lulus' => 'required',
            'kriteria_tingkat' => 'required',
        ]);

        try {
            PendMiliterPers::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Pendidikan Militer Created!',
                'modal' => '#militer',
                'table' => '#data_pendidikan_militer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function store_riwayat_pangkat(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'id_pangkat' => 'required',
            'tmt_pangkat' => 'required',
            'no_skep_pangkat' => 'nullable',
            'no_sprin_pangkat' => 'nullable',
            'tgl_skep_pangkat' => 'nullable',
            'tgl_sprin_pangkat' => 'nullable',
        ]);

        try {
            DB::transaction(function () use ($request, $validatedData) {
                $riwayat_pangkat = RiwayatPangkat::create($validatedData);
                $old_rp = RiwayatPangkat::with('pangkat')->where('id_personil', $request->id_personil)->orderBy('tmt_pangkat', 'desc')->first();
                Personil::where('id_personil', $request->id_personil)->update([
                    'id_pangkat_terakhir' => $old_rp->id_pangkat,
                    'tmt_pangkat_terakhir' => $old_rp->tmt_pangkat,
                    'nama_pangkat_terakhir' => $old_rp->pangkat->nama_pangkat
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Riwayat Pangkat Created!',
            'modal' => '#pangkat',
            'table' => '#data_riwayat_pangkat'
        ]);
    }

    public function get_riwayat_pangkat(RiwayatPangkat $riwayat_pangkat)
    {
        return $riwayat_pangkat;
    }

    public function update_riwayat_pangkat(Request $request)
    {
        $riwayat_pangkat = RiwayatPangkat::where('id_riwayat_pangkat', $request->id_riwayat_pangkat)->first();
        $validatedData = $request->validate([
            'id_pangkat' => 'required',
            'tmt_pangkat' => 'required',
            'no_skep_pangkat' => 'nullable',
            'no_sprin_pangkat' => 'nullable',
            'tgl_skep_pangkat' => 'nullable',
            'tgl_sprin_pangkat' => 'nullable',
        ]);

        try {
            DB::transaction(function () use ($validatedData, $riwayat_pangkat) {
                $riwayat_pangkat->update($validatedData);
                $old_rp = RiwayatPangkat::with('pangkat')->where('id_personil', $riwayat_pangkat->id_personil)->orderBy('tmt_pangkat', 'desc')->first();
                Personil::where('id_personil', $riwayat_pangkat->id_personil)->update([
                    'id_pangkat_terakhir' => $old_rp->id_pangkat,
                    'tmt_pangkat_terakhir' => $old_rp->tmt_pangkat,
                    'nama_pangkat_terakhir' => $old_rp->pangkat->nama_pangkat
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Riwayat Pangkat Updated!',
            'modal' => '#edit_riwayat_pangkat',
            'table' => '#data_riwayat_pangkat'
        ]);
    }

    public function store_riwayat_jabatan(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'id_jabatan' => 'required',
            'tmt_jabatan' => 'required',
            'no_skep_jabatan' => 'nullable',
            'no_sprin_jabatan' => 'nullable',
            'tgl_skep_jabatan' => 'nullable',
            'tgl_sprin_jabatan' => 'nullable',
        ]);

        try {
            DB::transaction(function () use ($request, $validatedData) {
                $riwayat_jabatan = RiwayatJabatan::create($validatedData);
                $old_rj = RiwayatJabatan::with('jabatan')->where('id_personil', $request->id_personil)->orderBy('tmt_jabatan', 'desc')->first();
                Personil::where('id_personil', $request->id_personil)->update([
                    'tmt_jabatan_terakhir' => $old_rj->tmt_jabatan,
                    'nama_jabatan_terakhir' => $old_rj->jabatan->nama_jabatan
                ]);
            });
            return response()->json([
                'error' => false,
                'message' => 'Riwayat Jabatan Created!',
                'modal' => '#jabatan',
                'table' => '#data_riwayat_jabatan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function get_riwayat_jabatan(RiwayatJabatan $riwayat_jabatan)
    {
        return $riwayat_jabatan;
    }

    public function update_riwayat_jabatan(Request $request)
    {
        $riwayat_jabatan = RiwayatJabatan::where('id_riwayat_jabatan', $request->id_riwayat_jabatan)->first();
        $validatedData = $request->validate([
            'id_jabatan' => 'required',
            'tmt_jabatan' => 'required',
            'no_skep_jabatan' => 'nullable',
            'no_sprin_jabatan' => 'nullable',
            'tgl_skep_jabatan' => 'nullable',
            'tgl_sprin_jabatan' => 'nullable',
        ]);

        try {
            DB::transaction(function () use ($validatedData, $riwayat_jabatan) {
                $riwayat_jabatan->update($validatedData);
                $old_rj = RiwayatJabatan::with('jabatan')->where('id_personil', $riwayat_jabatan->id_personil)->orderBy('tmt_jabatan', 'desc')->first();
                Personil::where('id_personil', $riwayat_jabatan->id_personil)->update([
                    'tmt_jabatan_terakhir' => $old_rj->tmt_jabatan,
                    'nama_jabatan_terakhir' => $old_rj->jabatan->nama_jabatan
                ]);
            });
            return response()->json([
                'error' => false,
                'message' => 'Riwayat Jabatan Updated!',
                'modal' => '#edit_riwayat_jabatan',
                'table' => '#data_riwayat_jabatan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function store_penugasan(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'tugas' => 'required',
            'jenis' => 'required',
            'tahun' => 'required',
            'lokasi' => 'required',
        ]);
        if ($request->jenis == 'dn') {
            $modal = 'operasi';
            $table = 'dn';
        } else {
            $modal = 'ln';
            $table = 'ln';
        }
        try {
            Penugasan::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Penugasan Created!',
                'modal' => '#' . $modal,
                'table' => '#data_penugasan_' . $table
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function get_penugasan(Penugasan $penugasan)
    {
        return $penugasan;
    }

    public function update_penugasan(Request $request)
    {
        $penugasan = Penugasan::find($request->id_penugasan);
        $validatedData = $request->validate([
            'tugas' => 'required',
            'tahun' => 'required',
            'lokasi' => 'required',
        ]);
        $modal = '#edit_penugasan_' . $penugasan->jenis;
        $table = '#data_penugasan_' . $penugasan->jenis;

        try {
            $penugasan->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Penugasan Updated!',
                'modal' => $modal,
                'table' => $table
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function store_bahasa(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'kompetensi' => 'required',
            'bahasa' => 'required',
            'jenis' => 'required'
        ]);
        try {
            Bahasa::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Bahasa Created!',
                'modal' => '#bahasa',
                'table' => '#data_bahasa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function get_bahasa(Bahasa $bahasa)
    {
        return $bahasa;
    }

    public function update_bahasa(Request $request)
    {
        $bahasa = Bahasa::find($request->id_bahasa);
        $validatedData = $request->validate([
            'kompetensi' => 'required',
            'bahasa' => 'required',
            'jenis' => 'required'
        ]);
        try {
            $bahasa->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Bahasa Updated!',
                'modal' => '#edit_bahasa_modal',
                'table' => '#data_bahasa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function store_tanda_jasa(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'id_jasa' => 'required',
            'tahun' => 'required',
        ]);
        try {
            TandaJasaPers::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Tanda Jasa Personil Created!',
                'modal' => '#jasa',
                'table' => '#data_tanda_jasa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function get_tanda_jasa_pers(TandaJasaPers $tanda_jasa_pers)
    {
        return $tanda_jasa_pers;
    }

    public function update_tanda_jasa_pers(Request $request)
    {
        $tanda_jasa_pers = TandaJasaPers::find($request->id_jasa_pers);
        $validatedData = $request->validate([
            'id_jasa' => 'required',
            'tahun' => 'required',
        ]);
        try {
            $tanda_jasa_pers->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Tanda Jasa Personil Update!',
                'modal' => '#edit_tanda_jasa_pers',
                'table' => '#data_tanda_jasa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function delete_keluarga($id_keluarga)
    {
        try {
            Keluarga::where('id_keluarga', $id_keluarga)->delete();
            return response()->json([
                'error' => false,
                'message' => 'Keluarga Deleted!',
                'table' => '#data_keluarga'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
    public function delete_pendidikan_umum($id_pend_umum_pers)
    {
        try {
            PendUmumPers::where('id_pend_umum_pers', $id_pend_umum_pers)->delete();
            return response()->json([
                'error' => false,
                'message' => 'Pendidikan Umum Personil Deleted!',
                'table' => '#data_pendidikan_umum'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
    public function delete_pendidikan_militer($id_pend_militer_pers)
    {
        try {
            PendMiliterPers::where('id_pend_militer_pers', $id_pend_militer_pers)->delete();
            return response()->json([
                'error' => false,
                'message' => 'Pendidikan Militer Personil Deleted!',
                'table' => '#data_pendidikan_militer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_riwayat_pangkat($id_riwayat_pangkat)
    {
        try {
            DB::transaction(function () use ($id_riwayat_pangkat) {
                $riwayat_pangkat = RiwayatPangkat::where('id_riwayat_pangkat', $id_riwayat_pangkat)->first();
                $id_personil = $riwayat_pangkat->id_personil;
                $riwayat_pangkat->delete();

                $old_rp = RiwayatPangkat::with('pangkat')->where('id_personil', $id_personil)->orderBy('tmt_pangkat', 'desc')->first();
                Personil::where('id_personil', $id_personil)->update([
                    'id_pangkat_terakhir' => $old_rp->id_pangkat,
                    'tmt_pangkat_terakhir' => $old_rp->tmt_pangkat,
                    'nama_pangkat_terakhir' => $old_rp->pangkat->nama_pangkat
                ]);
            });
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Riwayat Pangkat Deleted!',
            'table' => '#data_riwayat_pangkat'
        ]);
    }

    public function delete_riwayat_jabatan($id_riwayat_jabatan)
    {
        try {
            DB::transaction(function () use ($id_riwayat_jabatan) {
                $riwayat_jabatan = RiwayatJabatan::where('id_riwayat_jabatan', $id_riwayat_jabatan)->first();
                $id_personil = $riwayat_jabatan->id_personil;
                $riwayat_jabatan->delete();

                $old_rj = RiwayatJabatan::with('jabatan')->where('id_personil', $id_personil)->orderBy('tmt_jabatan', 'desc')->first();
                Personil::where('id_personil', $id_personil)->update([
                    'tmt_jabatan_terakhir' => $old_rj->tmt_jabatan,
                    'nama_jabatan_terakhir' => $old_rj->jabatan->nama_jabatan
                ]);
            });
            return response()->json([
                'error' => false,
                'message' => 'Riwayat Jabatan Deleted!',
                'table' => '#data_riwayat_jabatan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_penugasan($id_penugasan)
    {
        try {
            $penugasan = Penugasan::where('id_penugasan', $id_penugasan)->first();
            if ($penugasan->jenis == 'dn') {
                $table = 'dn';
            } else {
                $table = 'ln';
            }

            $penugasan->delete();
            return response()->json([
                'error' => false,
                'message' => 'Penugasan Deleted!',
                'table' => '#data_penugasan_' . $table
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function delete_bahasa($id_bahasa)
    {
        try {
            Bahasa::where('id_bahasa', $id_bahasa)->delete();
            return response()->json([
                'error' => false,
                'message' => 'Bahasa Deleted!',
                'table' => '#data_bahasa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_tanda_jasa($id_jasa_pers)
    {
        try {
            TandaJasaPers::where('id_jasa_pers', $id_jasa_pers)->delete();
            return response()->json([
                'error' => false,
                'message' => 'Tanda Jasa Personil Deleted!',
                'table' => '#data_tanda_jasa'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function store_pakaian_personil(Request $request)
    {
        try {
            $pakaian_personil = PakaianPersonil::where('id_personil', $request->id_personil)->get();

            $data = $request->except('_token', 'id_personil');

            foreach ($data as $key => $value) {
                if ($data[$key] != null) {
                    $query = $pakaian_personil->where('id_pakaian', $key)->first();
                    if (!$query) {
                        PakaianPersonil::create([
                            'id_personil' => $request->id_personil,
                            'id_pakaian' => $key,
                            'ukuran' => $data[$key]
                        ]);
                    } else {
                        $query->update(['ukuran' => $data[$key]]);
                    }
                }
            }
            return response()->json([
                'error' => false,
                'message' => 'Pakaian Updated!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function get_pend_militer_pers(PendMiliterPers $pend_militer_pers)
    {
        return $pend_militer_pers;
    }

    public function update_pend_militer_pers(Request $request)
    {
        $pend_militer_pers = PendMiliterPers::where('id_pend_militer_pers', $request->id_pend_militer_pers)->first();
        $validatedData = $request->validate([
            'nama_sekolah' => 'required',
            'kategori_pendidikan' => 'required',
            'tahun_lulus' => 'required',
            'kriteria_tingkat' => 'required',
        ]);

        try {
            $pend_militer_pers->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Pendidikan Militer Updated!',
                'modal' => '#edit-pend-militer-pers',
                'table' => '#data_pendidikan_militer'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function get_pend_umum_pers(PendUmumPers $pend_umum_pers)
    {
        return $pend_umum_pers;
    }

    public function update_pend_umum_pers(Request $request)
    {
        $pend_umum_pers = PendUmumPers::where('id_pend_umum_pers', $request->id_pend_umum_pers)->first();
        $validatedData = $request->validate([
            'id_pend_umum' => 'required',
            'tahun_lulus' => 'required',
            'nama_sekolah' => 'required'
        ]);

        try {
            $pend_umum_pers->update($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'Pendidikan Umum Personil Updated!',
                'modal' => '#edit-pend-umum-pers',
                'table' => '#data_pendidikan_umum'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
}

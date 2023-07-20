<?php

namespace App\Http\Controllers\bangkes\sistoda;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupervisiRequest;
use App\Models\Kategori;
use App\Models\PanitiaSupervisi;
use App\Models\PanitiaSupervisiDetail;
use App\Models\Personil;
use App\Models\Provinsi;
use App\Models\Supervisi;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SupervisiController extends Controller
{
    public function index()
    {
        $active_menu = 'jadwal_supervisi';
        return view('bangkes.subbid_sistoda.jadwal_supervisi.index', compact('active_menu'));
    }

    public function create()
    {
        $active_menu = 'jadwal_supervisi';

        $personil = Personil::select('nrp', 'nama')->whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->get();

        $provinsi = Provinsi::get();

        $panitia_internal = [];

        return view('bangkes.subbid_sistoda.jadwal_supervisi.create', compact('active_menu', 'personil', 'provinsi', 'panitia_internal'));
    }

    public function store(SupervisiRequest $request)
    {
        try {
            $requestData = $request->validated();

            DB::transaction(function () use ($request, $requestData) {
                $personil = Personil::get();
                if ($request->has('file_lap_keg')) $requestData['file_lap_keg'] = $request->file_lap_keg->store('supervisi');
                $supervisi = Supervisi::create($requestData);

                if ($request->has('panitia_internal')) {
                    foreach ($request->panitia_internal as $k => $pi) {
                        $personil = $personil->where('nrp', $pi)->first();
                        $panitia_int = PanitiaSupervisi::firstOrNew(['nrp' =>  $pi]);

                        $panitia_int->nama = $personil->nama;
                        $panitia_int->nrp = $pi;
                        $panitia_int->pangkat = $personil->nama_pangkat_terakhir;
                        $panitia_int->jabatan = $personil->nama_jabatan_terakhir;
                        $panitia_int->satuan = $personil->nama_kesatuan;
                        $panitia_int->status = 'INT';

                        $panitia_int->save();

                        PanitiaSupervisiDetail::create([
                            'id_supervisi' => $supervisi->id_supervisi,
                            'id_panitia_supervisi' => $panitia_int->id_panitia_supervisi
                        ]);
                    }
                }

                if ($request->has('panitia_eksternal')) {
                    foreach ($request->panitia_eksternal as $k => $v) {

                        $panitia_ext = PanitiaSupervisi::firstOrNew(['nrp' => $v['nrp_panitia_eksternal']]);

                        $panitia_ext->nama = $v['nama_panitia_eksternal'];
                        $panitia_ext->nrp = $v['nrp_panitia_eksternal'];
                        $panitia_ext->pangkat = $v['pangkat_panitia_eksternal'];
                        $panitia_ext->jabatan = $v['jabatan_panitia_eksternal'];
                        $panitia_ext->satuan = $v['satuan_panitia_eksternal'];
                        $panitia_ext->status = 'EXT';

                        $panitia_ext->save();

                        PanitiaSupervisiDetail::create([
                            'id_supervisi' => $supervisi->id_supervisi,
                            'id_panitia_supervisi' => $panitia_ext->id_panitia_supervisi
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Jadwal Supervisi Created!',
                'url' => url('bangkes/jadwal-supervisi')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list()
    {
        $supervisi = Supervisi::with('kota_kab')->withCount('panitia_supervisi')->latest()->get();
        return DataTables::of($supervisi)
            ->addColumn('tgl', function ($row) {
                return "<div>" . indonesian_date_format($row->tgl) . "</div>";
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.jadwal-supervisi.show', $row->id_supervisi) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><a href='" . route('bangkes.jadwal-supervisi.edit', $row->id_supervisi) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_supervisi . "' data-url='" . url('bangkes/jadwal-supervisi') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['action', 'tgl'])
            ->toJson();
    }

    public function edit(Supervisi $supervisi)
    {
        $supervisi = $supervisi->load('kota_kab', 'panitia_supervisi');
        // return $supervisi;
        $active_menu = 'jadwal_supervisi';

        $personil = Personil::select('nrp', 'nama')->whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->get();

        $provinsi = Provinsi::get();

        $panitia_eksternal = $supervisi->panitia_supervisi->where('status', 'EXT')->flatten();
        $panitia_internal = $supervisi->panitia_supervisi->where('status', 'INT')->flatten()->pluck('nrp')->toArray();

        return view('bangkes.subbid_sistoda.jadwal_supervisi.create', compact('active_menu', 'personil', 'provinsi', 'supervisi', 'panitia_eksternal', 'panitia_internal'));
    }

    public function show(Supervisi $supervisi)
    {
        $active_menu = 'jadwal_supervisi';
        $upervisi = $supervisi->load('panitia_supervisi');
        return view('bangkes.subbid_sistoda.jadwal_supervisi.detail_supervisi', compact('active_menu', 'supervisi'));
    }

    public function update(SupervisiRequest $request, Supervisi $supervisi)
    {
        try {
            $requestData = $request->validated();

            DB::transaction(function () use ($request, $requestData, $supervisi) {
                $personil = Personil::get();

                if ($request->has('file_lap_keg')) {
                    $requestData['file_lap_keg'] = $request->file_lap_keg->store('supervisi');
                    Storage::delete($supervisi->file_lap_keg);
                }

                $supervisi->update($requestData);

                PanitiaSupervisiDetail::where('id_supervisi', $supervisi->id_supervisi)->delete();

                if ($request->has('panitia_internal')) {
                    foreach ($request->panitia_internal as $k => $pi) {
                        $personil = $personil->where('nrp', $pi)->first();
                        $panitia_int = PanitiaSupervisi::firstOrNew(['nrp' =>  $pi]);

                        $panitia_int->nama = $personil->nama;
                        $panitia_int->nrp = $pi;
                        $panitia_int->pangkat = $personil->nama_pangkat_terakhir;
                        $panitia_int->jabatan = $personil->nama_jabatan_terakhir;
                        $panitia_int->satuan = $personil->nama_kesatuan;
                        $panitia_int->status = 'INT';

                        $panitia_int->save();

                        PanitiaSupervisiDetail::create([
                            'id_supervisi' => $supervisi->id_supervisi,
                            'id_panitia_supervisi' => $panitia_int->id_panitia_supervisi
                        ]);
                    }
                }

                if ($request->has('panitia_eksternal')) {
                    foreach ($request->panitia_eksternal as $k => $v) {


                        $panitia_ext = PanitiaSupervisi::firstOrNew(['nrp' => $v['nrp_panitia_eksternal']]);

                        $panitia_ext->nama = $v['nama_panitia_eksternal'];
                        $panitia_ext->nrp = $v['nrp_panitia_eksternal'];
                        $panitia_ext->pangkat = $v['pangkat_panitia_eksternal'];
                        $panitia_ext->jabatan = $v['jabatan_panitia_eksternal'];
                        $panitia_ext->satuan = $v['satuan_panitia_eksternal'];
                        $panitia_ext->status = 'EXT';

                        $panitia_ext->save();

                        PanitiaSupervisiDetail::create([
                            'id_supervisi' => $supervisi->id_supervisi,
                            'id_panitia_supervisi' => $panitia_ext->id_panitia_supervisi
                        ]);
                    }
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Jadwal Supervisi Updated!',
                'url' => url('bangkes/jadwal-supervisi')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(Supervisi $supervisi)
    {
        try {
            DB::transaction(function () use ($supervisi) {
                PanitiaSupervisiDetail::where('id_supervisi', $supervisi->id_supervisi)->delete();
                Storage::delete($supervisi->file_lap_keg);
                $supervisi->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Jadwal Supervisi Deleted!',
                'table' => '#supervisi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

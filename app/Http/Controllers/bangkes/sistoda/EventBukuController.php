<?php

namespace App\Http\Controllers\bangkes\sistoda;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventBukuRequest;
use App\Models\Buku;
use App\Models\EventBuku;
use App\Models\Kategori;
use App\Models\KotaKab;
use App\Models\PanitiaBuku;
use App\Models\Personil;
use App\Models\Provinsi;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EventBukuController extends Controller
{
    public function index()
    {
        $active_menu = 'jadwal_sosialisasi';
        return view('bangkes.subbid_sistoda.jadwal_sosialisasi.index', compact('active_menu'));
    }

    public function create()
    {
        $active_menu = 'jadwal_sosialisasi';

        $buku = Buku::get();
        $id_personil = [];

        $provinsi = Provinsi::get();

        $personil = Personil::select('id_personil', 'nama')->where('id_kategori', Kategori::ID_AKTIF)->get();

        $status_keg = [
            'Rencana',
            'Terlaksana',
            'Batal',
        ];

        return view('bangkes.subbid_sistoda.jadwal_sosialisasi.create', compact('active_menu', 'buku', 'provinsi', 'personil', 'status_keg', 'id_personil'));
    }

    public function kota_kab_list(Request $request)
    {
        $kota_kab = KotaKab::where('id_provinsi', $request->id_provinsi)->get();
        $data = [];
        $data[] = ['id' => '', 'text' => "Pilih Kota/Kab"];
        foreach ($kota_kab as $key => $value) {
            $data[] = ['id' => $value->id_kotakab, 'text' => $value->nama_kotakab];
        }
        return response()->json([
            'error' => false,
            'data' => $data
        ]);
    }

    public function store(EventBukuRequest $request)
    {
        try {
            $requestData = $request->validated();

            DB::transaction(function () use ($request, $requestData) {
                if ($request->has('file_lap_keg')) $requestData['file_lap_keg'] = $request->file_lap_keg->store('event_buku');
                $event_buku = EventBuku::create($requestData);

                foreach ($request->id_personil as $key => $value) {
                    PanitiaBuku::create([
                        'id_event_buku' => $event_buku->id_event_buku,
                        'id_personil' => $value
                    ]);
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Jadwal Sosialisasi Created!',
                'url' => url('bangkes/jadwal-sosialisasi')
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
        $event_buku = EventBuku::with('buku', 'kota_kab')->withCount('personil')->latest()->get();

        return DataTables::of($event_buku)
            ->addColumn('id_personil', function ($row) {
                return $row->personil_count;
            })
            // ->addColumn('id_personil', function ($row) {
            //     $nama = '';
            //     foreach ($row->personil as $personil) {
            //         $nama .= $personil->nama . "<br>";
            //     }
            //     return $nama;
            // })
            ->addColumn('tgl_event', function ($row) {
                return "<div class='text-center'>" . indonesian_date_format($row->tgl_event) . "</div>";
            })
            ->addColumn('no_buku', function ($row) {
                if (!empty($row->buku))
                    return "<div class='text-center'>" . $row->buku->no_buku . "</div>";
            })
            ->addColumn('nama_buku', function ($row) {
                if (!empty($row->buku))
                    return  $row->buku->nama_buku;
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . route('bangkes.jadwal-sosialisasi.show', $row->id_event_buku) . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a><a href='" . route('bangkes.jadwal-sosialisasi.edit', $row->id_event_buku) . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_event_buku . "' data-url='" . url('bangkes/jadwal-sosialisasi') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['id_personil', 'action', 'tgl_event', 'no_buku'])
            ->toJson();
    }

    public function edit(EventBuku $event_buku)
    {
        $active_menu = 'jadwal_sosialisasi';

        $id_personil = [];

        $event_buku = $event_buku->load('kota_kab', 'personil');

        foreach ($event_buku->personil as $key => $value) {
            $id_personil[] = $value->id_personil;
        }

        $buku = Buku::get();

        $provinsi = Provinsi::get();

        $personil = Personil::select('id_personil', 'nama')->whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->get();

        $status_keg = [
            'Rencana',
            'Terlaksana',
            'Batal',
        ];

        return view('bangkes.subbid_sistoda.jadwal_sosialisasi.create', compact('active_menu', 'buku', 'provinsi', 'personil', 'status_keg', 'event_buku', 'id_personil'));
    }

    public function update(EventBukuRequest $request, EventBuku $event_buku)
    {
        try {
            $requestData = $request->validated();

            DB::transaction(function () use ($request, $requestData, $event_buku) {
                if ($request->file_lap_keg != null) {
                    $requestData['file_lap_keg'] = $request->file_lap_keg->store('event_buku');
                    Storage::delete($event_buku->file_lap_keg);
                }
                $event_buku->update($requestData);
                PanitiaBuku::where('id_event_buku', $event_buku->id_event_buku)->delete();

                foreach ($request->id_personil as $key => $value) {
                    PanitiaBuku::create([
                        'id_event_buku' => $event_buku->id_event_buku,
                        'id_personil' => $value
                    ]);
                }
            });

            return response()->json([
                'error' => false,
                'message' => 'Jadwal Sosialisasi Updated!',
                'url' => url('bangkes/jadwal-sosialisasi')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(EventBuku $event_buku)
    {
        try {
            DB::transaction(function () use ($event_buku) {
                PanitiaBuku::where('id_event_buku', $event_buku->id_event_buku)->delete();
                Storage::delete($event_buku->file_lap_keg);
                $event_buku->delete();
            });

            return response()->json([
                'error' => false,
                'message' => 'Jadwal Sosialisasi Deleted!',
                'table' => '#sosialisasi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function show(EventBuku $event_buku)
    {
        $active_menu = 'jadwal_sosialisasi';
        $event_buku = $event_buku->load('personil', 'buku');
        return view('bangkes.subbid_sistoda.jadwal_sosialisasi.detail_sosialisasi', compact('active_menu', 'event_buku'));
    }
}

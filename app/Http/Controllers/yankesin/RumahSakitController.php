<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Models\Matra;
use App\Models\RumahSakit;
use App\Models\TingkatRS;
use App\Models\ConfigModel;
use App\Models\Fasilitas;
use App\Models\FasilitasRS;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RumahSakitController extends Controller
{
    public function index(Request $request)
    {
        $active_menu = 'yankesin_rs';
        $matra = Matra::whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        $tingkat_rs = TingkatRS::get();
        $covid_report = ConfigModel::select('covid_report')->first()->covid_report;
        return view('yankesin.rumah_sakit.index', compact('active_menu', 'matra', 'covid_report', 'tingkat_rs'));
    }

    public function list(Request $request)
    {
        $rumah_sakit = RumahSakit::with('angkatan.parent_.parent_')->orderBy('nama_rs');
        if (isset($request->matra)) $rumah_sakit->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->where('kode_matra', $request->matra);
        if (isset($request->tipe)) $rumah_sakit->whereRaw("jenis_rs like '" . $request->tipe . "%'");
        $rumah_sakit = $rumah_sakit->get();
        $rs = array();
        foreach ($rumah_sakit as $d) {
            $d->matra = $d->angkatan->kode_matra;
            if ($d->angkatan->level == 'sub') {
                $d->satker = $d->angkatan->nama_angkatan;
                $d->kotama = $d->angkatan->parent_->parent_->nama_angkatan;
                $idk = $d->angkatan->parent_->parent;
            } else if ($d->angkatan->level == 'sat') {
                $d->satker = $d->angkatan->nama_angkatan;
                $d->kotama = $d->angkatan->parent_->nama_angkatan;
                $idk = $d->angkatan->parent;
            } else {
                $d->satker = '-';
                $d->kotama = $d->angkatan->nama_angkatan;
                $idk = $d->id_angkatan;
            }
            unset($d->angkatan);
            if (!isset($request->kotama) || (isset($request->kotama) && $request->kotama == $idk)) $rs[] = $d;
        }
        return DataTables::of($rs)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '
                <div class="text-center">
                    <div class="btn-group">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Aksi
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="/yankesin/kelola_fasilitas/' .  $row->id_rs . '" >Kelola Fasilitas</a>
                            <a class="dropdown-item" href="/yankesin/kelola_nakes/' .  $row->id_rs . '">Kelola Nakes Lainnya & Honorer</a>
                            <a class="dropdown-item" href="/yankesin/kelola_bor/' .  $row->id_rs . '">Kelola BOR</a>
                            <a class="dropdown-item" href="/yankesin/kelola_data_covid/' .  $row->id_rs . '">Kelola Data Covid</a>
                            <a class="dropdown-item" data-url="' . route('yankesin.rumah_sakit.update', $row->id_rs) . '" data-id="' .  $row->id_rs . '" onclick="edit_rs($(this))">Edit Data Faskes</a>
                            <a class="dropdown-item delete-data" data-id="' . $row->id_rs . '" data-url="' . url('yankesin/rumah-sakit/delete/') . '">Delete Data Faskes</a>
                        </div>
                    </div>
                </div>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'id_angkatan' => 'required',
                'nama_rs' => 'required',
                'id_kotakab' => 'required',
            ]);
            $data = $request->all();
            if (isset($data["rss"])) $data["jenis_rs"] .= ' RSS';
            unset($data["kode_matra"], $data["rss"]);

            $rumah_sakit = RumahSakit::create($data);

            $user_rs = User::create([
                'name' => $data['nama_rs'],
                'email' => strtolower(str_replace([' ', '/', '.', '-'], '', $data['nama_rs'])) . '@puskes-tni.mil.id',
                'password' => '$2y$10$6yo0FeAm1E46uhNncPdL/.hxE0n/.oAznlvN26RTvUs0PCTe1i5l6',
                'id_faskes' => $rumah_sakit->id_rs,
            ]);
            $user_rs->assignRole('RUMAH SAKIT');

            $fasilitas = Fasilitas::get();
            for ($i = 1; $i <= 97; $i++) {
                $get_fasilitas = $fasilitas->where('id_fasilitas', $i)->first();
                if (!blank($get_fasilitas)) {
                    FasilitasRS::create([
                        'id_rs' => $rumah_sakit->id_rs,
                        'id_fasilitas' => $i,
                        'jumlah' => 0,
                        'keterangan' => '',
                    ]);
                }
            }
            $fasB = Fasilitas::whereIn('id_fasilitas', ['PU', 'PGU'])->get();
            foreach ($fasB as $f) {
                FasilitasRS::create([
                    'id_rs' => $rumah_sakit->id_rs,
                    'id_fasilitas' => $f->id_fasilitas,
                    'jumlah' => 0,
                    'keterangan' => '',
                ]);
            }

            return response()->json([
                "error" => false,
                "message" => "Successfuly Added Rumah Sakit!",
                'modal' => '#rumah_sakit_modal',
                'table' => '#table-rs'
            ]);
        } catch (Exception $e) {
            return response()->json([
                "error" => true,
                "message" => json_encode($e),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // $role = Role::findOrFail($id);

        // return view('roles.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = RumahSakit::where("id_rs", $id)->with("angkatan.parent_", 'kotakab')->first();

        if ($role) {

            return response()->json(["error" => false, "data" => $role]);
        } else {

            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }


        // return view('roles.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, RumahSakit $rumah_sakit)
    {

        $this->validate($request, [
            'id_angkatan' => 'required',
            'nama_rs' => 'required',
            'id_kotakab' => 'required',
        ]);
        $data = $request->all();
        if (isset($data["rss"])) $data["jenis_rs"] .= ' RSS';
        unset($data["kode_matra"], $data["rss"]);

        $rumah_sakit->update($data);
        return response()->json([
            "error" => false,
            "message" => "Successfuly Update Rumah Sakit!",
            'modal' => '#rumah_sakit_modal',
            'table' => '#table-rs'
        ]);

        // return redirect()->route('roles.index')->with('flash_message', 'Role updated!');
    }

    public function destroy(RumahSakit $rumah_sakit)
    {
        try {
            $rumah_sakit->delete();
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Rumah Sakit!", 'table' => '#table-rs']);
    }

    public function select()
    {
        $list_all = RumahSakit::select('id_rs', 'nama_rs')->get();

        $select = [];

        foreach ($list_all as $item) {
            $select[] = ["id" => $item->id_rs, "text" => $item->nama_rs];
        }
        return response()->json(["error" => false, "data" => $select]);
    }
}

<?php

namespace App\Http\Controllers\matfaskes;

use App\Http\Controllers\Controller;
use App\Models\RumahSakit;
use App\Models\Matra;
use App\Models\FasilitasRS;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaskesController extends Controller
{
    public function index()
    {
        $active_menu = 'faskes';
        $matra = Matra::whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        return view('matfaskes.faskes.index', compact('active_menu', 'matra'));
    }

    public function list(Request $request)
    {
        $rumah_sakit = RumahSakit::with('angkatan.parent_.parent_')->orderBy('rs.created_at');
        if (isset($request->matra)) $rumah_sakit = $rumah_sakit->join('angkatan', 'angkatan.id_angkatan', 'rs.id_angkatan')->where('kode_matra', $request->matra);
        if (isset($request->tipe)) $rumah_sakit = $rumah_sakit->where('jenis_rs', $request->tipe);
        $rumah_sakit = $rumah_sakit->get();
        $rs = array();
        foreach($rumah_sakit as $d) {
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
                $actionBtn = "<div class='text-center' title='Kelola Fasilitas'><a href='" . route('matfaskes.faskes.kelola', $row->id_rs) . "'><i data-feather='edit' class='font-medium-4 mr-75'></i></a></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function update_keterangan(Request $request, $id)
    {
        $fasrs = FasilitasRS::find($id);
        $fasrs->keterangan = $request->keterangan;
        $fasrs->save();
        return response()->json(["error" => false, "message" => 'Fasilitas berhasil di-update']);
    }
}

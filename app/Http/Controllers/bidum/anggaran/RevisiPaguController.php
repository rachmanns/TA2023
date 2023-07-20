<?php

namespace App\Http\Controllers\bidum\anggaran;

use App\Http\Controllers\Controller;
use App\Models\RevisiPagu;
use App\Models\Uraian;
use Exception;
use Illuminate\Http\Request;

class RevisiPaguController extends Controller
{
    public function get_pagu($id_uraian)
    {
        try {
            $uraian = Uraian::find($id_uraian);
            $revisi = RevisiPagu::where('id_uraian', $id_uraian)->get();
            $sum_tambah = $revisi->sum('tambah');
            $sum_kurang = $revisi->sum('kurang');
            $uraian->pagu_terakhir = $uraian->pagu_awal + $sum_tambah - $sum_kurang;
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        return response()->json([
            'error' => false,
            'data' => $uraian
        ]);
    }

    public function store(Request $request)
    {
        try {
            $kode_dipa = Uraian::find($request->id_uraian)->kode_dipa;
            $nilai = str_replace(array('Rp', '.'), '', $request->nilai);
            if ($request->operator == 'tambah') {
                RevisiPagu::create([
                    'id_uraian' => $request->id_uraian,
                    'tambah' => $nilai,
                ]);
            } else {
                RevisiPagu::create([
                    'id_uraian' => $request->id_uraian,
                    'kurang' => $nilai,
                ]);
            }

            $table = 'pusat';
            if ($kode_dipa == 'DIPDAR') $table = 'daerah';

            return response()->json([
                'error' => false,
                'message' => 'Successfully Store Revisi',
                'modal' => '#revisi-modal',
                'table' => '#table-' . $table
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }
    public function history($id_uraian)
    {
        $active_menu = 'daftar_pagu';
        $revisi = RevisiPagu::where('id_uraian', $id_uraian)->latest()->paginate(10);
        return view('bidum.anggaran.pagu_anggaran.history_revisi', compact(
            'active_menu',
            'revisi'
        ));
    }
}

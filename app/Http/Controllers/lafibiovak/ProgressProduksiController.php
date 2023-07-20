<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kemasan;
use App\Models\ProgressProduksi;
use App\Models\Renprod;
use App\Models\DetilRenprod;

class ProgressProduksiController extends Controller
{
    public function list_produk(Request $request)
    {
        if (isset(Auth::user()->id_faskes)) $lafi = Auth::user()->id_faskes;
        else if (isset($request->lafi)) $lafi = $request->lafi;
        $data = Kemasan::selectRaw("kemasan.id_kemasan AS id, CONCAT(nama_produk, ' / ', nama_satuan, ' / ', nama_kemasan) AS title")
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
                ->join('renprod', 'renprod.id_kemasan', 'kemasan.id_kemasan')
                ->join('detil_renprod', 'detil_renprod.id_renprod', 'renprod.id_renprod')
                ->whereRaw("(SUBSTR(tgl_rencana_mulai, 1, 7) = '" . $request->periode . "' OR SUBSTR(tgl_rencana_selesai, 1, 7) = '" . $request->periode . "')")
                ->leftJoin('progress_produksi', 'progress_produksi.id_detil_renprod', 'detil_renprod.id_detil_renprod');
		if (isset($lafi)) $data->where('id_pelaksana', $lafi);
		if (isset($request->prod)) $data->where('kemasan.id_kemasan', $request->prod);

        return response()->json([
            'data' => $data->distinct()->get()
        ], 201);
    }

    public function list(Request $request)
    {
        if (isset(Auth::user()->id_faskes)) $lafi = Auth::user()->id_faskes;
        else if (isset($request->lafi)) $lafi = $request->lafi;
        $data = ProgressProduksi::selectRaw('kemasan.id_kemasan AS resourceId, no_bets, nama_tahap, id_pelaksana AS lafi, status, tgl_rencana_mulai AS start, tgl_rencana_selesai AS end, id_progress')
                ->whereRaw("(SUBSTR(tgl_rencana_mulai, 1, 7) = '" . $request->periode . "' OR SUBSTR(tgl_rencana_selesai, 1, 7) = '" . $request->periode . "')")
                ->join('tahap_produksi', 'progress_produksi.id_tahap', 'tahap_produksi.id_tahap')
                ->join('detil_renprod', 'progress_produksi.id_detil_renprod', 'detil_renprod.id_detil_renprod')
                ->join('renprod', 'detil_renprod.id_renprod', 'renprod.id_renprod')
                ->join('kemasan', 'renprod.id_kemasan', 'kemasan.id_kemasan');
		if (isset($lafi)) $data->where('id_pelaksana', $lafi);
		if (isset($request->prod)) $data->where('kemasan.id_kemasan', $request->prod);
        $data = $data->get();
        foreach($data as $d) {
            if ($d->lafi == 'Lafiad') $d->lafi = 'Lafi Puskesad';
            $d->title = '<div style="padding:5px;">' . $d->no_bets . ' : ' . $d->nama_tahap . '<br>' . $d->lafi . ' | ' . $d->status . '</div>';
            $end = date_create($d->end);
            date_add($end, date_interval_create_from_date_string("1 days"));
            $d->end = date_format($end, 'Y-m-d');
        }

        return response()->json([
            'data' => $data
        ], 201);
    }

    public function timeline()
    {
        $k = Kemasan::with('produk', 'satuan_produk')->get();
        return view('lafibiovak.manage_produksi.timeline_produksi.index', ['active_menu' => 'timeline_produksi', 'prods' => $k]);
    }

    public function edit_timeline(Request $request, $id)
    {
        if (isset(Auth::user()->id_faskes)) $lafi = Auth::user()->id_faskes;
        else if (isset($request->lafi)) $lafi = $request->lafi;
        if (isset($lafi)) {
            $data = Renprod::with(['kemasan.satuan_produk.tahap_produksi', 'detil_renprod' => function ($query) use ($lafi) {
                $query->where('id_pelaksana', $lafi);
            }])->find($id);
            if ($lafi == 'Lafiad') $lafi = 'Lafi Puskesad';
            $data->lafi = $lafi;
            $data->bets = count($data->detil_renprod);
            $data->renprod = number_format($data->bets*$data->kemasan->bets, 0, '', '.');
            $data->kemasan->bets = number_format($data->kemasan->bets, 0, '', '.');
        }
        return view('lafibiovak.manage_produksi.timeline_produksi.create', ['active_menu' => 'timeline_produksi', 'data' => $data ?? null]);
    }

    public function input_timeline(Request $request)
    {
        if (!isset($request->_id)) return response()->json([
            "error" => true,
            "message" => "Input bets produksi gagal",
        ]);
        $d = DetilRenprod::find($request->_id);
        $d->no_bets = $request->nobets;
        $d->save();
        Renprod::where('id_renprod', $d->id_renprod)->update(['status_produksi' => 'START']);
        foreach($request->progress as $tahap => $tgl) {
            $p = ProgressProduksi::firstOrNew([
                'id_detil_renprod' => $request->_id,
                'id_tahap' => $tahap,
            ]);
            $p->tgl_rencana_mulai = substr($tgl, 0, 10);
            $p->tgl_rencana_selesai = substr($tgl, 13);
            $p->save();
        }
        return response()->json([
            "error" => false,
            "message" => "Input bets produksi berhasil",
        ]);
    }

    public function update_status(Request $request)
    {
        if (!isset($request->_id)) return response()->json([
            "error" => true,
            "message" => "Update status produksi gagal",
        ]);
        $d = ProgressProduksi::find($request->_id);
        $d->status = $request->status;
        if ($request->status == 'Berlangsung') $d->tgl_aktual_mulai = date('Y-m-d');
        else if ($request->status == 'Selesai') {
            $d->tgl_aktual_selesai = date('Y-m-d');
            $semuaSelesai = true;
            $pp = ProgressProduksi::select('status')->where('id_detil_renprod', $d->id_detil_renprod)->where('id_progress', '<>', $request->_id)->get();
            foreach($pp as $p) {
                if ($p->status != 'Selesai') {
                    $semuaSelesai = false;
                    break;
                }
            }
            if ($semuaSelesai) DetilRenprod::where('id_detil_renprod', $d->id_detil_renprod)->update(['tgl_selesai_prod' => $d->tgl_aktual_selesai]);
        }
        $d->save();
        return response()->json([
            "error" => false,
            "message" => "Input bets produksi berhasil",
        ]);
    }
}

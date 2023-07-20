<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Renprod;
use App\Models\DetilRenprod;
use App\Models\Kemasan;

class PersediaanController extends Controller
{
    public function list(Request $request)
    {
        $data = Renprod::with('detil_renprod')->selectRaw("id_renprod, kemasan.id_kemasan, CONCAT(nama_produk, ' / ', nama_satuan, ' / ', nama_kemasan) AS nama, (bets*jml_spp) AS renprod")
            ->join('kemasan', 'kemasan.id_kemasan', 'renprod.id_kemasan')
            ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
            ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
            ->where('periode_produksi', $request->tahun ?? date('Y'))
            ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $d->Lafiad = 0;
            $d->Lafial = 0;
            $d->Lafiau = 0;
            $d->Labiomed = 0;
            $d->Labiovak = 0;
            $d->keluar = 0;
            foreach($d->detil_renprod as $dr) {
                $pel = $dr->id_pelaksana;
                $d->$pel += ($dr->jml_hasil_produksi ?? 0);
                $d->keluar += ($dr->jml_keluar ?? 0);
            }
            unset($d->detil_renprod);
            $d->persediaan = $this->_persediaan($d->id_kemasan, $request->tahun);
            $d->total = $d->Lafiad + $d->Lafial + $d->Lafiau + $d->Labiomed + $d->Labiovak;
            $d->prosentase = $d->total * 100 / $d->renprod;
            $d->prosentase = number_format($d->prosentase, fmod($d->prosentase, 1) !== 0.0 ? 1 : 0, ',', '') . ' %';
            $d->renprod = number_format($d->renprod, 0, '', '.');
            $d->sisa = number_format($d->total - $d->keluar, 0, '', '.');
            $d->total = number_format($d->total, 0, '', '.');
            $d->keluar = number_format($d->keluar, 0, '', '.');
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($request) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/persediaan/detail/" . $row->id_renprod . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function _persediaan($id, $tahun)
    {
        $k = Kemasan::selectRaw('COALESCE(SUM(jml_hasil_produksi), 0) AS jmlp, COALESCE(SUM(jml_keluar), 0) AS jmlk')
                    ->join('renprod', 'renprod.id_kemasan', 'kemasan.id_kemasan')
                    ->join('detil_renprod', 'detil_renprod.id_renprod', 'renprod.id_renprod')
                    ->where('kemasan.id_kemasan', $id)
                    ->where('periode_produksi', intval($tahun)-1)
                    ->first();
        return (isset($k) ? number_format($k->jmlp - $k->jmlk, 0, '', '.') : 0);
    }

    public function detail($id)
    {
        if (isset(Auth::user()->id_faskes)) $lafi = [Auth::user()->id_faskes];
        else $lafi = [];
        $data = Renprod::with(['kemasan.produk', 'kemasan.satuan_produk', 'detil_renprod:id_pelaksana,id_renprod'])->find($id);
        $bets = 0;
        foreach($data->detil_renprod as $dr) {
            if (isset(Auth::user()->id_faskes) && $dr->id_pelaksana == Auth::user()->id_faskes) $bets++;
            else if (!isset(Auth::user()->id_faskes)) {
                if (!in_array($dr->id_pelaksana, $lafi)) $lafi[] = $dr->id_pelaksana;
                $bets++;
            }
        }
        if ($lafi[0] == 'Lafiad') $lafi[0] = 'Lafi Puskesad';
        $data->lafi = $lafi;
        $data->bets = $bets;
        $data->renprod = number_format($data->bets*$data->kemasan->bets, 0, '', '.');
        $data->kemasan->bets = number_format($data->kemasan->bets, 0, '', '.');
        return view('lafibiovak.manage_produksi.persediaan_produk_jadi.detail', ['active_menu' => 'persediaan_produk_jadi', 'data' => $data]);
    }

    public function list_detail($id)
    {
        $data = DetilRenprod::where('id_renprod', $id);
        if (isset(Auth::user()->id_faskes)) $data->where('id_pelaksana', Auth::user()->id_faskes);
        $data = $data->orderByRaw('tgl_selesai_prod DESC')->get();
        
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (!isset(Auth::user()->id_faskes) || !isset($row->tgl_selesai_prod)) return '';
                $actionBtn = "<div class='text-center'><button title='Edit' class='btn text-primary p-0 pr-50' data-id='" . $row->id_detil_renprod . "' data-jml='" . $row->jml_hasil_produksi . "' data-exp='" . $row->tgl_expired . "' onclick='edit_prod($(this))'><i data-feather='edit' class='font-medium-4'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function input(Request $request)
    {
        if (!isset($request->_id)) return response()->json([
            "error" => true,
            "message" => "Input hasil produksi gagal",
        ]);
        DetilRenprod::where('id_detil_renprod', $request->_id)->update(['jml_hasil_produksi' => $request->jml, 'tgl_expired' => $request->tgl]);
        
        return response()->json([
            "error" => false,
            "message" => "Input hasil produksi berhasil",
        ]);
    }

    public function report_masuk(Request $request)
    {
        $data = DetilRenprod::selectRaw('id_pelaksana, no_bets, jml_hasil_produksi, tgl_selesai_prod, tgl_expired, nama_kemasan, nama_produk, nama_satuan')
                ->join('renprod', 'renprod.id_renprod', 'detil_renprod.id_renprod')
                ->join('kemasan', 'kemasan.id_kemasan', 'renprod.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
                ->where('periode_produksi', $request->tahun)
                ->whereNotNull('tgl_selesai_prod')
                ->orderBy('tgl_selesai_prod');
        if (isset(Auth::user()->id_faskes)) $data->where('id_pelaksana', Auth::user()->id_faskes);
        $data = $data->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}

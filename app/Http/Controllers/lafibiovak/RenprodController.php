<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Renprod;
use App\Models\DetilRenprod;
use App\Models\Kemasan;
use App\Models\KategoriBahanProduksi;
use App\Models\DetilBahanRenprod;
use App\Models\BahanProduksi;

class RenprodController extends Controller
{
    public function list(Request $request)
    {
        $data = Renprod::with('detil_renprod')->selectRaw("id_renprod, status_produksi, kemasan.id_kemasan, CONCAT(nama_produk, ' / ', nama_satuan, ' / ', nama_kemasan) AS nama, bets, jml_spp AS ssp, (bets*jml_spp) AS jml_renprod")
            ->join('kemasan', 'kemasan.id_kemasan', 'renprod.id_kemasan')
            ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
            ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
            ->where('periode_produksi', $request->tahun ?? date('Y'))
            ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $d->bets = number_format($d->bets, 0, '', '.');
            $d->ssp = number_format($d->ssp, 0, '', '.');
            $d->jml_renprod = number_format($d->jml_renprod, 0, '', '.');
            $d->Lafiad = 0;
            $d->Lafial = 0;
            $d->Lafiau = 0;
            $d->Labiomed = 0;
            $d->Labiovak = 0;
            foreach($d->detil_renprod as $dr) {
                $pel = $dr->id_pelaksana;
                $d->$pel++;
            }
            $k = $this->_persediaan($d->id_kemasan, $request->tahun);
            $d->persediaan = $k['persediaan'];
            $d->jml_renbut = $k['jml'];
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($request) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/renprod/detail/" . $row->id_renprod . "'><button title='Detail' class='btn text-primary p-0 pr-50'><i data-feather='file-text' class='font-medium-4'></i></button></a>";
                if (isset(Auth::user()->id_faskes)) $actionBtn .= "<a href='/lafibiovak/produksi/timeline/" . $row->id_renprod . "'><button title='Timeline Produksi' class='btn text-sucess p-0 pr-50'><i data-feather='calendar' class='font-medium-4'></i></button></a>";
                if (!isset($row->status_produksi) && !isset($request->produksi) && !isset(Auth::user()->id_faskes)) $actionBtn .= "<a href='/lafibiovak/renprod/form/" . $row->id_renprod . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_renprod . "' data-url='/lafibiovak/renprod'><i data-feather='trash' class='font-medium-4 text-danger'></i></button>";
				$actionBtn .= "</div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function list_bahan_produksi($id)
    {
        $kat = array();
        $kbp = KategoriBahanProduksi::all();
        foreach($kbp as $k) {
            $kat[] = $k->id_kategori;
        }
        $data = DetilRenprod::selectRaw('id_pelaksana AS nama_lafi, COUNT(*) AS jumlah_bets')->where('id_renprod', $id)->groupBy('id_pelaksana')->get();
        foreach($data as $d) {
            $c = array();
            foreach($kat as $k) {
                $c[$k] = '';
            }
            $bps = DetilBahanRenprod::with('bahan_produksi')
                  ->where('id_pelaksana', $d->nama_lafi)
                  ->where('id_renprod', $id)
                  ->get();
            foreach($bps as $bp) {
                $c[$bp->bahan_produksi->id_kategori] .= $bp->bahan_produksi->nama_bahan_produksi . ' : ' . $bp->jumlah . ' ' . $bp->bahan_produksi->satuan . '<br />';
            }
            foreach($kat as $k) {
                $d->$k = $c[$k] == '' ? '<div class="text-center">-</div>' : $c[$k];
            }
        }
        return DataTables::of($data)
            ->rawColumns($kat)
            ->make(true);
    }

    public function form($id='')
    {
        $bps = array();
        if ($id != '') {
            $data = Renprod::with('kemasan')->find($id);
            $data->renprod = $data->jml_spp*$data->kemasan->bets;
            $data->lafi = DetilRenprod::selectRaw('id_pelaksana AS pel, COUNT(*) AS jml')->where('id_renprod', $id)->groupBy('id_pelaksana')->get();
            $bahan = array();
            $bhn = DetilBahanRenprod::selectRaw('id_bahan_produksi, id_pelaksana AS pel, jumlah')->where('id_renprod', $id)->get();
            foreach($bhn as $b) {
                $bahan[$b->id_bahan_produksi][$b->pel] = $b->jumlah;
                $bps[] = $b->id_bahan_produksi;
            }
            $data->bahan = $bahan;
            $data->bp = $bps;
        }
        $kat = KategoriBahanProduksi::with(['bahan_produksi' => function ($query) use ($bps) {
            $query->whereRaw('stok + jumlah_awal > 0')->orWhereIn('id_bahan_produksi', $bps);
        }])->get();
        $cat = array();
        $bp = array();
        foreach ($kat as $k) {
            $cat[] = $k->id_kategori;
            foreach($k->bahan_produksi as $d) $bp[$d->id_bahan_produksi] = array(
                'nama' => $d->nama_bahan_produksi,
                'satuan' => $d->satuan,
                'stok' => $d->stok + $d->jumlah_awal);
        }
        $k = Kemasan::with('produk', 'satuan_produk')->get();
        return view('lafibiovak.manage_renprod.create', ['active_menu' => 'manage_renprod', 'prods' => $k, 'data' => $data ?? null, 'kat' => $kat, 'bahan' => json_encode($bp), 'cat' => json_encode($cat)]);
    }

    public function detail($id)
    {
        $kat = KategoriBahanProduksi::all();
        $data = Renprod::with('kemasan.produk', 'kemasan.satuan_produk')->find($id);
        $data->renprod = number_format($data->jml_spp*$data->kemasan->bets, 0, '', '.');
        $data->kemasan->bets = number_format($data->kemasan->bets, 0, '', '.');
        $data->lafi = DetilRenprod::selectRaw('DISTINCT(id_pelaksana) AS pel')->where('id_renprod', $id)->get();
        $d = $this->_persediaan($data->id_kemasan, $data->periode_produksi);
        $data->persediaan = $d['persediaan'];
        $data->rko = $d['jml'];
        return view('lafibiovak.manage_renprod.detail', ['active_menu' => 'manage_renprod', 'kat' => $kat, 'data' => $data]);
    }

    public function _persediaan($id, $tahun)
    {
        $k = Kemasan::selectRaw('COALESCE(SUM(jml_hasil_produksi), 0) AS jmlp, COALESCE(SUM(jml_keluar), 0) AS jmlk')
                    ->join('renprod', 'renprod.id_kemasan', 'kemasan.id_kemasan')
                    ->join('detil_renprod', 'detil_renprod.id_renprod', 'renprod.id_renprod')
                    ->where('kemasan.id_kemasan', $id)
                    ->where('periode_produksi', intval($tahun)-1)
                    ->first();
        $p = Kemasan::selectRaw('COALESCE(SUM(jml_penggunaan_per_tahun), 0) AS jml')
                    ->join('detil_rko', 'detil_rko.id_kemasan', 'kemasan.id_kemasan')
                    ->join('rko', 'rko.id_rko', 'detil_rko.id_rko')
                    ->where('kemasan.id_kemasan', $id)
                    ->where('periode_pengajuan', $tahun)
                    ->where('status', 'Disetujui')
                    ->groupBy('kemasan.id_kemasan')
                    ->first();
        return array(
                'persediaan' => isset($k) ? number_format($k->jmlp - $k->jmlk, 0, '', '.') : 0,
                'jml' => isset($p) ? number_format($p->jml, 0, '', '.') : 0,
            );
    }

    public function get_persediaan(Request $request)
    {
        $data = $this->_persediaan($request->id, $request->tahun);
        return response()->json([
            "error" => false,
            "data" => $data
        ]);
    }

    public function input(Request $request)
    {
      DB::transaction(function() use ($request) {
        if (isset($request->id)) {
            $r = Renprod::find($request->id);
            if (isset($r->status_produksi)) return response()->json([
                "error" => true,
                "message" => 'Renprod tidak bisa diubah karena produksi sudah berjalan'
            ]);
        } else $r = new Renprod;
        $r->id_kemasan = $request->produk;
        $r->periode_produksi = $request->tahun;
        $r->jml_spp = $request->spp;
        $r->save();
        $pel = '';
        if (isset($request->id)) {
            DetilRenprod::where('id_renprod', $request->id)->delete();
            $dbr = DetilBahanRenprod::selectRaw('id_bahan_produksi, jumlah')->where('id_renprod', $request->id)->get();
            foreach($dbr as $d) {
                BahanProduksi::where('id_bahan_produksi', $d->id_bahan_produksi)->increment('stok', $d->jumlah);
            }
            DetilBahanRenprod::where('id_renprod', $request->id)->delete();
        }
        foreach($request->lafi as $b) {
            for($j=0; $j<$request->betslafi[$b]; $j++) {
                $d = new DetilRenprod;
                $d->id_pelaksana = $b;
                $d->id_renprod = $r->id_renprod;
                $d->save();
            }
        }
        foreach($request->bhn as $idb => $b) {
            foreach($b as $la => $jml) {
                $d = new DetilBahanRenprod;
                $d->id_bahan_produksi = $idb;
                $d->id_pelaksana = $la;
                $d->jumlah = $jml;
                $d->id_renprod = $r->id_renprod;
                $d->save();
                BahanProduksi::where('id_bahan_produksi', $idb)->decrement('stok', $jml);
            }
        }
      });
        return response()->json([
            "error" => false,
            "message" => 'Renprod berhasil disimpan'
        ]);
    }

    public function destroy($id)
    {
        $r = Renprod::find($id);
        if (isset($r->status_produksi)) return response()->json([
            "error" => false,
            "message" => 'Renprod tidak bisa dihapus karena produksi sudah berjalan'
        ]);
        DetilRenprod::where('id_renprod', $id)->delete();
        $dbr = DetilBahanRenprod::selectRaw('id_bahan_produksi, jumlah')->where('id_renprod', $id)->get();
        foreach($dbr as $d) {
            BahanProduksi::where('id_bahan_produksi', $d->id_bahan_produksi)->increment('stok', $d->jumlah);
        }
        DetilBahanRenprod::where('id_renprod', $id)->delete();
        $r->delete();
        return response()->json([
            "error" => false,
            "message" => "Renprod berhasil dihapus",
            'table' => '#renprod',
        ]);
    }
}

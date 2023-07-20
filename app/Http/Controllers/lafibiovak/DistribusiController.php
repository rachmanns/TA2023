<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Kemasan;
use App\Models\Distribusi;
use App\Models\DetilDistribusi;
use App\Models\DetilRenprod;
use App\Models\RumahSakit;

class DistribusiController extends Controller
{
    public function list(Request $request)
    {
        $data = Distribusi::whereYear('tgl_distribusi', $request->tahun)
                ->selectRaw("distribusi.*, CONCAT(nama_produk, ' / ', nama_kemasan) AS nama_produk, nama_satuan, produsen, kode_produksi, exp_date, no_bets")
                ->join('kemasan', 'kemasan.id_kemasan', 'distribusi.id_kemasan')
                ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
                ->leftJoin('detil_renprod', 'id_detil_renprod', 'kode_produksi')
                ->orderByRaw('tgl_distribusi DESC')->get();
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a href='/lafibiovak/distribusi/form/" . $row->id_distribusi . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_distribusi . "' data-url='/lafibiovak/distribusi'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function get_bets($id)
    {
        $dr = DetilRenprod::selectRaw('id_detil_renprod, id_pelaksana, no_bets, (jml_hasil_produksi - COALESCE(jml_keluar, 0)) AS jumlah, tgl_expired')
              ->join('renprod', 'detil_renprod.id_renprod', 'renprod.id_renprod')
              ->join('kemasan', 'renprod.id_kemasan', 'kemasan.id_kemasan')
              ->where('kemasan.id_kemasan', $id)
              ->whereNotNull('tgl_selesai_prod')
              ->whereRaw('(jml_hasil_produksi - COALESCE(jml_keluar, 0)) > 0')
              ->get();
        $bets = array();
        $max = array();
        $exp = array();
        foreach($dr as $d) {
            $bets[] = ["id" => $d->id_detil_renprod, "text" => $d->no_bets . ' (' . $d->id_pelaksana . ')'];
            $max[$d->id_detil_renprod] = $d->jumlah;
            $exp[$d->id_detil_renprod] = $d->tgl_expired;
        }
        return response()->json([
            "error" => false,
            "bets" => $bets,
            "max" => $max,
            "exp" => $exp,
        ]);
    }

    public function form($id='')
    {
        $k = Kemasan::selectRaw("id_kemasan as id, CONCAT(nama_produk, ' / ', nama_satuan, ' / ', nama_kemasan) AS nama_produk")
             ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
             ->join('satuan_produk', 'satuan_produk.id_satuan_produk', 'kemasan.id_satuan_produk')
             ->get();
        $faskes = array('FKTP' => [], 'FKTL' => [], 'RSS' => []);
        /*
        $rs = RumahSakit::selectRaw('id_rs, nama_rs, jenis_rs')->get();
        foreach($rs as $d) {
            $faskes[$d->jenis_rs][] = ["id" => $d->id_rs, "text" => $d->nama_rs];
        }
        */
        if ($id != '') {
            $data = Distribusi::with('detil_distribusi')->find($id);
        }
        return view('lafibiovak.distribusi.create', ['active_menu' => 'distribusi', 'prods' => $k, 'faskes' => $faskes, 'data' => $data ?? null]);
    }

    public function input(Request $request)
    {
        DB::transaction(function() use ($request) {
            if (isset($request->_id)) $r = Distribusi::find($request->_id);
            else $r = new Distribusi;
            $r->id_kemasan = $request->produk;
            $r->tgl_distribusi = $request->tgl;
            $r->kode_produksi = $request->bets;
            $r->produsen = $request->produsen;
            $r->exp_date = $request->expdate;
            $r->dobek_masuk = $request->dbmsk;
            $r->dobek_keluar = $request->dbkel;
            $r->dobek_ket = $request->dbket;
            $r->dist_masuk = $request->dimsk;
            $r->dist_keluar = $request->dikel;
            $r->dist_ket = $request->diket;
            if ($request->file('file_dist') !== null) {
                $file = $request->file('file_dist');
                $filename = $r->id_kemasan . $file->getClientOriginalName();
                $file->move(public_path('uploads/distribusi'), $filename);
                $r->laporan = $filename;
            }
            $r->save();
            /*
            $r->kategori = $request->kategori;
            if ($r->kategori == 'Distributor') $r->tujuan = $request->tujuan;
            else {
                $rs = RumahSakit::find($request->faskes);
                $r->id_rs = $rs->id_rs;
                $r->tujuan = $rs->nama_rs;
            }
            $r->save();
            if (isset($request->_id)) {
                $dbr = DetilDistribusi::selectRaw('id_detil_renprod, jumlah')->where('id_distribusi', $request->_id)->get();
                foreach($dbr as $d) {
                    DetilRenprod::where('id_detil_renprod', $d->id_detil_renprod)->decrement('jml_keluar', $d->jumlah);
                }
                DetilDistribusi::where('id_distribusi', $request->_id)->delete();
            }
            foreach($request->lafi as $b) {
                $d = new DetilDistribusi;
                $d->id_detil_renprod = $b['bets'];
                $d->jumlah = $b['jml'];
                $d->id_distribusi = $r->id_distribusi;
                $d->save();
                DetilRenprod::where('id_detil_renprod', $d->id_detil_renprod)->increment('jml_keluar', $d->jumlah);
            }
            */
        });
        return response()->json([
            "error" => false,
            "message" => 'Distribusi berhasil disimpan'
        ]);
    }

    public function destroy($id)
    {
        $r = Distribusi::find($id);
        $dbr = DetilDistribusi::selectRaw('id_detil_renprod, jumlah')->where('id_distribusi', $id)->get();
        foreach($dbr as $d) {
            DetilRenprod::where('id_detil_renprod', $d->id_detil_renprod)->decrement('jml_keluar', $d->jumlah);
        }
        DetilDistribusi::where('id_distribusi', $id)->delete();
        $r->delete();
        return response()->json([
            "error" => false,
            "message" => "Distribusi berhasil dihapus",
            'table' => '#distribusi',
        ]);
    }

    public function report()
    {
        $p = Kemasan::selectRaw("id_kemasan as id, CONCAT(nama_produk, ' / ', nama_kemasan) AS nama_produk")
                      ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                      ->orderByRaw('kategori_produk, nama_produk')->get();
        return view('lafibiovak.produk_jadi.report_keluar', ['active_menu' => 'report_keluar', 'prods' => $p]);
    }

    public function report_keluar(Request $request)
    {
        $data = Distribusi::selectRaw('tujuan')->distinct()
                ->whereYear('tgl_distribusi', $request->tahun)->get();
        $prods = Kemasan::selectRaw('id_kemasan')
                 ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                 ->orderByRaw('kategori_produk, nama_produk')->get();
        foreach($data as $d) {
            $r = DetilDistribusi::selectRaw('kemasan.id_kemasan, SUM(jumlah) AS jumlah')
                 ->join('distribusi', 'distribusi.id_distribusi', 'detil_distribusi.id_distribusi')
                 ->join('kemasan', 'kemasan.id_kemasan', 'distribusi.id_kemasan')
                 ->join('produk', 'produk.id_produk', 'kemasan.id_produk')
                 ->where('tujuan', $d->tujuan)
                 ->groupBy('kemasan.id_kemasan')
                 ->orderByRaw('kategori_produk, nama_produk')->get();
            foreach($r as $p) {
                $prod = 'jml' . $p->id_kemasan;
                $d->$prod = number_format($p->jumlah, 0, '', '.');
            }
            foreach($prods as $p) {
                $prod = 'jml' . $p->id_kemasan;
                if (!isset($d->$prod)) $d->$prod = 0;
            }
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function viewFile($file)
    {
        $pathToFile = public_path('uploads/distribusi') . '/' . $file;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

<?php

namespace App\Http\Controllers\lafibiovak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Litbang;
use App\Models\JenisLitbang;
use App\Models\ChecklistLitbang;
use App\Models\JalurCompany;
use App\Models\Produk;

class LitbangController extends Controller
{
    public function index()
    {
        return view('lafibiovak.litbang.index', ['active_menu' => 'litbang']);
    }

    public function list()
    {
        $litbang = Litbang::with('jalur_company', 'checklist')->latest()->get();
        $jenis = JenisLitbang::with('tahap')->get();
        $data = [];
        $no = 0;
        foreach($litbang as $d) {
            $no++;
            $cek = [];
            foreach($d->checklist as $c) {
                $cek[$c->id_tahap] = (object)['status' => $c->status, 'laporan' => $c->laporan];
            }
            foreach($jenis as $j) {
                $ceks = '';
                $lap = '';
                $fin = 0;
                foreach($j->tahap as $t) {
                    if ($cek[$t->id_tahap]->status) {
                        $fin++;
                        $ceks .= '<li>' . $t->tahap_pelaksanaan . '</li>';
                        $lap .= '<li>' . (isset($cek[$t->id_tahap]->laporan) ? '<a href="/uploads/litbang/' . $cek[$t->id_tahap]->laporan . '" target="_blank">Hasil Laporan</a>' : '-') . '</li>';
                    }
                }
                if ($ceks != '') {
                    $ceks = "<ol type='a'>$ceks</ol>";
                    $lap = "<ol type='a'>$lap</ol>";
                }
                $persen = (100*$fin/count($j->tahap)) . '%';
                $data[] = [
                    $no, '<div class="text-center"><a href="/lafibiovak/litbang/' . $d->id_litbang . '/edit"><button title="Edit" class="btn text-primary p-0 pr-75"><i data-feather="edit" class="font-medium-4"></i></button></a><button title="Delete" type="button" class="delete-data btn p-0" data-id="' . $d->id_litbang . '" data-url="/lafibiovak/litbang"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>', $d->judul, $d->pj, $d->jalur_company->nama_jalur, $d->jalur_company->nama_jalur, $j->deskripsi, $ceks, "<div class='text-center'>$persen</div>", $lap,
                ];
            }
        }
        return $data;
    }

    public function create()
    {
        $active_menu = 'litbang';
        $comps = JalurCompany::selectRaw('id_jalur_company, nama_jalur, alamat')->get();
        $jenis = JenisLitbang::with('tahap')->get();
        $prods = Produk::select('nama_produk')->pluck('nama_produk');
        return view('lafibiovak.litbang.create', compact('active_menu', 'comps', 'jenis', 'prods'));
    }

    public function store(Request $request)
    {
        $ceks = [];
        foreach($request->checks as $key => $stat) {
            $ceks[$key] = $stat;
        }
        DB::beginTransaction();
        $d = new Litbang;
        $d->judul = $request->judul;
        $d->pj = $request->pj;
        $d->id_jalur_company = $request->id_jalur;
        $d->save();
        $jenis = JenisLitbang::with('tahap')->get();
        foreach($jenis as $j) {
            foreach($j->tahap as $t) {
                $cek = new ChecklistLitbang;
                $cek->id_litbang = $d->id_litbang;
                $cek->id_tahap = $t->id_tahap;
                $cek->status = isset($ceks[$t->id_tahap]) ? 1 : 0;
                if ($cek->status && $request->file('files' . $t->id_tahap) !== null) {
                    $file = $request->file('files' . $t->id_tahap);
                    $filename = rand() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/litbang'), $filename);
                    $cek->laporan = $filename;
                }
                $cek->save();
            }
        }
        DB::commit();
        return response()->json(["error" => false, "message" => 'Litbang berhasil disimpan']);
    }

    public function show(Request $request, $id)
    {
        $data = Litbang::find($id);
        if ($data) {
            return response()->json(["error" => false, "data" => $data]);
        } else {
            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }
    }

    public function edit($id)
    {
        $active_menu = 'litbang';
        $comps = JalurCompany::selectRaw('id_jalur_company, nama_jalur, alamat')->get();
        $jenis = JenisLitbang::with('tahap')->get();
        $prods = Produk::select('nama_produk')->pluck('nama_produk');
        $data = Litbang::find($id);
        $cek = $data->checklist()->get();
        $checks = [];
        foreach($cek as $c) {
            $checks[$c->id_tahap] = (object)['status' => $c->status, 'laporan' => $c->laporan];
        }
        $persen = [];
        $jenis = JenisLitbang::with('tahap')->get();
        foreach($jenis as $j) {
            $fin = 0;
            foreach($j->tahap as $t) {
                if ($checks[$t->id_tahap]->status) $fin++;
            }
            $persen[$j->id_jenis] = (100*$fin/count($j->tahap)) . '%';
        }
        return view('lafibiovak.litbang.create', compact('active_menu', 'comps', 'jenis', 'data', 'checks', 'persen', 'prods'));
    }

    public function update($id, Request $request)
    {
        $ceks = [];
        foreach($request->checks as $key => $stat) {
            $ceks[$key] = $stat;
        }
        DB::beginTransaction();
        $d = Litbang::find($id);
        $d->judul = $request->judul;
        $d->pj = $request->pj;
        $d->id_jalur_company = $request->id_jalur;
        $d->save();
        $jenis = JenisLitbang::with('tahap')->get();
        foreach($jenis as $j) {
            foreach($j->tahap as $t) {
                $cek = ChecklistLitbang::where('id_litbang', $id)->where('id_tahap', $t->id_tahap)->first();
                $cek->status = isset($ceks[$t->id_tahap]) ? 1 : 0;
                if ($cek->status && $request->file('files' . $t->id_tahap) !== null) {
                    $file = $request->file('files' . $t->id_tahap);
                    $filename = rand() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/litbang'), $filename);
                    $cek->laporan = $filename;
                }
                $cek->save();
            }
        }
        DB::commit();
        return response()->json(["error" => false, "message" => 'Litbang berhasil disimpan']);
    }

    public function destroy($id)
    {
        $d = Litbang::find($id);
        $d->delete();
        return response()->json([
            "error" => false,
            "message" => "Litbang berhasil dihapus",
            'reload_page' => '1',
        ]);
    }
}

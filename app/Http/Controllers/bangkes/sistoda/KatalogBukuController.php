<?php

namespace App\Http\Controllers\bangkes\sistoda;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\KatBuku;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KatalogBukuController extends Controller
{
    public function index()
    {
        $active_menu = 'katalog_buku';
        $kategori_buku = KatBuku::select('id_kat_buku', 'nama_kat_buku')->get();
        $count_buku = Buku::count();
        return view('bangkes.subbid_sistoda.katalog_buku.index', compact('active_menu', 'kategori_buku', 'count_buku'));
    }
    public function list(Request $request)
    {
        $buku = Buku::with('kategori_buku')->when($request->id_kat_buku, function ($query) use ($request) {
            return $query->where('id_kat_buku', $request->id_kat_buku);
        })->latest()->get();
        return DataTables::of($buku)
            ->addColumn('row_buku', function ($row) {
                $image = url('/cover_buku')  . '/' . basename($row->file_buku) . '.jpeg';
                return '<a href="' . route('bangkes.katalog-buku.show', $row->id_buku) . '">
                <div class="card bg-light-secondary mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 col-12">
                                <img src="' . $image . '" alt="img-placeholder" height="170px"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="item-options">
                                    <div class="item-wrapper">
                                        <div class="item-cost">
                                            <h5>' . $row->nama_buku . '</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12 text-center">
                                <div class="item-options">
                                    <div class="item-wrapper">
                                        <div class="item-cost">
                                            <h5>' . $row->kategori_buku->nama_kat_buku . '</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 col-12 text-center">
                                <div class="item-options">
                                    <div class="item-wrapper">
                                        <div class="item-cost">
                                            <h5>' . $row->tahun_terbit . '</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>';
            })
            ->rawColumns(['row_buku'])
            ->toJson();
    }

    public function show(Buku $buku)
    {
        $active_menu = 'katalog_buku';
        $buku = $buku->load('kategori_buku');
        $image = url('/cover_buku')  . '/' . basename($buku->file_buku) . '.jpeg';
        return view('bangkes.subbid_sistoda.katalog_buku.detail', compact('active_menu', 'buku', 'image'));
    }
}

<?php

namespace App\Http\Controllers\yankesin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PosyanduRequest;
use App\Models\Matra;
use App\Models\Posyandu;
use App\Models\Provinsi;
use App\Services\PosyanduService;

use App\Models\BrgOut;
use App\Models\DetailBrgMatkesM;
use App\Models\InTktm;
use App\Models\KategoriBrg;
use App\Models\RencanaPengeluaran;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yajra\DataTables\Facades\DataTables;

class PosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'data_posyandu';
        return view('yankesin.data_posyandu.index', compact('active_menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'data_posyandu';
        $matra = Matra::select('id_matra', 'kode_matra', 'nama_matra')->get();
        $provinsi = Provinsi::select('id_provinsi', 'nama_provinsi')->get();
        return view('yankesin.data_posyandu.form', compact('active_menu', 'matra', 'provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PosyanduRequest $request)
    {
        PosyanduService::store($request);
        return response()->json([
            'error' => false,
            'message' => 'Posyandu Created!',
            'url' => url('yankesin/posyandu')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Posyandu $posyandu)
    {
        $active_menu = 'data_posyandu';
        $matra = Matra::select('id_matra', 'kode_matra', 'nama_matra')->get();
        $provinsi = Provinsi::select('id_provinsi', 'nama_provinsi')->get();
        $posyandu = $posyandu->load('kota_kab');
        return view('yankesin.data_posyandu.form', compact('active_menu', 'matra', 'provinsi', 'posyandu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PosyanduRequest $request, Posyandu $posyandu)
    {
        PosyanduService::update($request, $posyandu);
        return response()->json([
            'error' => false,
            'message' => 'Posyandu Updated!',
            'url' => url('yankesin/posyandu')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posyandu $posyandu)
    {
        PosyanduService::destroy($posyandu);
        return response()->json([
            'error' => false,
            'message' => 'Posyandu Deleted!',
            'table' => '#posyandu'
        ]);
    }

    public function get()
    {
        return PosyanduService::dataTable();
    }

    public function download_template()
    {
        return PosyanduService::download_template();
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');
        $filename = date('YmdHis') . '.xlsx';
        $file->move(base_path() . '/uploads/', $filename);
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(base_path() . '/uploads/' . $filename);

        unlink(base_path() . '/uploads/' . $filename);

        $rows = $spreadsheet->getActiveSheet()->toArray();
        $count_rows = count($rows);

        $ps = [];

        for ($i = 3; $i < $count_rows; $i++) {
            if ($rows[$i][1] != null) {
                switch (strtolower($rows[$i][1])) {
                    case 'angkatan darat':
                        $matra = "AD";
                        break;
                    case 'angkatan laut':
                        $matra = "AL";
                        break;
                    case 'angkatan udara':
                        $matra = "AU";
                        break;
                    case 'ad':
                        $matra = "AD";
                        break;
                    case 'al':
                        $matra = "AL";
                        break;
                    case 'au':
                        $matra = "AU";
                        break;
                    default:
                        $matra = null;
                        break;
                }
                if ($matra != null) {
                    $ps[] = [
                        'nama_posy' => $rows[$i][0],
                        'matra' => $matra,
                        'alamat_posy' => $rows[$i][2],
                        'prog_germas' => $rows[$i][3],
                        'prog_posy' => $rows[$i][4],
                        'hub_sektoral' => $rows[$i][5],
                        'jml_kader_germas' => $rows[$i][6],
                        'jml_kader_posy' => $rows[$i][7],
                        'latitude' => $rows[$i][8],
                        'longitude' => $rows[$i][9],
                    ];
                }
            }
        }

        $request->session()->put('ps', json_encode($ps));

        $active_menu = 'data_posyandu';

        return view('yankesin.data_posyandu.preview', compact(
            'active_menu',
            'ps'
        ));
    }

    public function import(Request $request)
    {
        $ps = json_decode($request->session()->get('ps'));

        foreach ($ps as $p) {
            $posyandu = new Posyandu();
            $posyandu->nama_posy = $p->nama_posy;
            $posyandu->id_matra = $p->matra;
            $posyandu->alamat_posy = $p->alamat_posy;
            $posyandu->prog_germas = $p->prog_germas;
            $posyandu->prog_posy = $p->prog_posy;
            $posyandu->hub_sektoral = $p->hub_sektoral;
            $posyandu->jml_kader_germas = $p->jml_kader_germas;
            $posyandu->jml_kader_posy = $p->jml_kader_posy;
            $posyandu->latitude = $p->latitude;
            $posyandu->longitude = $p->longitude;
            $posyandu->save();
        }

        $request->session()->forget('ps');

        return redirect('/yankesin/posyandu');
    }
}

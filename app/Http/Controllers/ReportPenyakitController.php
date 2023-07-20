<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Penyakit;
use App\Models\ReportPenyakit;
use App\Models\Periode;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ReportPenyakitController extends Controller
{
    public function index()
    {
        $active_menu = 'report_penyakit';
        $list = ReportPenyakit::all();
        $periode = Periode::all();
        $kat = Penyakit::selectRaw('DISTINCT kategori')->pluck('kategori');
        return view('yankesin.report_penyakit.index', compact(
            'active_menu',
            'list',
            'periode',
            'kat',
        ));
    }

    public function get_detail($id_penyakit, $satker, Request $request){

        
        $let = ReportPenyakit::with(["angkatan","penyakit"])->where("report_penyakit.id_penyakit",$id_penyakit)->whereHas('angkatan', function (Builder $query) use($satker){
            $query->where('kode_matra',$satker);
        });
        if (isset($request->periode)) $let->where('id_periode', $request->periode);
        if (isset($request->tahun)) $let->where('tahun', $request->tahun);
        $let = $let->get();

        $data = $let->where("angkatan","!=",null);
        return datatables()::of($data->all())
            ->addColumn('action', function ($row) {
                $actionBtn = "<div class='text-center'><a title='Edit' class='btn text-primary p-0 pr-50' target='_blank' href='/yankesin/report-penyakit/edit/" . $row->id . "'><i data-feather='edit' class='font-medium-4'></i></a></div>";
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()->make(true);
    }

    public function get_list(Request $request)
    {
        $angkatan = ['AD','AU','AL'];
        $penyakit = Penyakit::get();
        $data=array();

        $empty = new stdClass;
        $empty->sebelumnya_count= 0;
        $empty->baru_count= 0;
        $empty->sembuh_count= 0;
        $empty->meninggal_count= 0;
        
        $report_count = DB::table('angkatan') 
            ->join('report_penyakit', 'angkatan.id_angkatan', '=', 'report_penyakit.id_angkatan')
            ->select(DB::raw('
            sum(report_penyakit.sebelumnya) as sebelumnya_count,
            sum(report_penyakit.baru) as baru_count,
            sum(report_penyakit.sembuh) as sembuh_count,
            sum(report_penyakit.meninggal) as meninggal_count,
            angkatan.kode_matra,
            report_penyakit.id_penyakit'))
            ->where("angkatan.kode_matra","!=","MABES")
            ->groupBy(["angkatan.kode_matra","report_penyakit.id_penyakit"]);
        if (isset($request->periode)) $report_count->where('id_periode', $request->periode);
        if (isset($request->tahun)) $report_count->where('tahun', $request->tahun);
        $report_count = $report_count->get();
        
        foreach ($penyakit as $peny) {
            
            $temporary=['sebelumnya'=>[],"baru"=>[],"sembuh"=>[],"meninggal"=>[]];
            foreach ($angkatan as $ang) {

                $data[$peny->id_penyakit]=$peny;
                $temp = $report_count->where('id_penyakit',$peny->id_penyakit)->where("kode_matra",$ang)->first();
                $data[$peny->id_penyakit][$ang]=(empty($temp)) ? $empty : $temp;

                $temporary['sebelumnya'][]= $data[$peny->id_penyakit][$ang]->sebelumnya_count;
                $temporary['baru'][]= $data[$peny->id_penyakit][$ang]->baru_count;
                $temporary['sembuh'][]= $data[$peny->id_penyakit][$ang]->sembuh_count;
                $temporary['meninggal'][]= $data[$peny->id_penyakit][$ang]->meninggal_count;
                $data[$peny->id_penyakit][$ang]->total=$data[$peny->id_penyakit][$ang]->sebelumnya_count+$data[$peny->id_penyakit][$ang]->baru_count;

            }
            // $data[$peny->id_penyakit]->count=$temporary;

            $data[$peny->id_penyakit]['pengobatan']=array_sum($temporary['sebelumnya']) + array_sum($temporary['baru'])-array_sum($temporary['sembuh'])-array_sum($temporary['meninggal']);
            $data[$peny->id_penyakit]['total']=array_sum($temporary['sebelumnya']) + array_sum($temporary['baru']);

            unset($temporary);
        }
    
        return datatables()::of($data)
            ->addIndexColumn()
            // ->addColumn('AD', function ($row) {
            //     return 0;
            // })
            // ->addColumn('AU', function ($row) {
            //     return 0;
            // })
            // ->addColumn('AL', function ($row) {
            //     return 0;
            // })
            // ->addColumn('action', function ($row) {
            //     $actionBtn = '<a onclick=edit_data($(this)) data-id="' . $row->id . '"  class="edit btn btn-success btn-sm">Edit</a> 
            //         <a data-id="' . $row->id . '" onclick=delete_data($(this)) class="btn btn-sm btn-danger" >Delete</a>
            //         ';
            //     return $actionBtn;
            // })
            // ->addColumn('total', function ($row) {
            //     // return ($row->sembuh+$row->meninggal+$row->baru+$row->sebelunya+$row->berobat+$row->sebelumnya);
            //     return ($row->sebelumnya + $row->baru);
            // })
            // ->addColumn('pengobatan', function ($row) {
            //     return ($row->sebelumnya + $row->baru - $row->sembuh - $row->meninggal);
            // })
            // ->rawColumns(['action', 'total', 'pengobatan'])
            ->make(true);
    }

    public function store(Request $request)
    {

        $requestData = $request->all();
        $requestData['berobat'] = 0;
        ReportPenyakit::create($requestData);
        return response()->json(["error" => false, "message" => "Successfuly Added Data Penyakit!"]);
    }

    public function edit($id = null)
    {
        $active_menu = 'report_penyakit';
        $matra = ['AD', 'AU', 'AL'];
        $penyakit = Penyakit::get();
        $status = ['Militer', 'PNS', 'Keluarga'];
        $periode = Periode::all();

        $report = null;
        if (isset($id)) {
            $report = ReportPenyakit::with('angkatan')->where("id", $id)->first();
            if (!isset($report)) return redirect('/yankesin/report-penyakit');
        }

        return view('yankesin.report_penyakit.form', compact(
            'active_menu',
            'matra',
            'penyakit',
            'status',
            'periode',
            'report',
        ));
    }

    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        unset($requestData['_token']);
        unset($requestData['id']);
        $role = ReportPenyakit::findOrFail($id);
        $role->update($requestData);

        if ($role) {

            return response()->json(["error" => false, "message" => "Successfully Update Data Penyakit"]);
        } else {

            return response()->json(["error" => true, "message" => "Data Not Found"]);
        }


        // return redirect()->route('roles.index')->with('flash_message', 'Role updated!');
    }

    public function destroy($id)
    {
        try {

            ReportPenyakit::destroy($id);
        } catch (Exception $e) {

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Data Penyakit!"]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BidangStruktur;
use App\Models\BidangStrukturDetail;
use App\Models\Jabatan;
use App\Models\Personil;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        return view('bidum.master_struktur.personil', ['active_menu' => 'org_personil']);
    }

    public function personil()
    {
        $list_all = Personil::all();
        foreach ($list_all as $item) {
            $select[$item->id_personil] = $item->nama;
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function jabatan()
    {
        $list_all = Jabatan::all();
        foreach ($list_all as $item) {
            $select[$item->id_jabatan] = $item->nama_jabatan;
        }
        return response()->json(["error" => false, "data" => $select]);
    }

    public function store(Request $req)
    {
        $detail = new BidangStrukturDetail();

        $detail->bidang_id = $req->org_id;
        $detail->parent = $req->id;

        $detail->save();

        $html = '<button type="button" node-id="' . $detail->id . '" data-id="' . $detail->id . '" data-bidang="' . $detail->parent . '" data-personil="" class="btn btn-outline-warning waves-effect">Unknown</button>';
        return response()->json(["error" => false, "message" => "created", "data" => $detail, "html" => $html]);
    }

    public function delete($id)
    {
        $detail = BidangStrukturDetail::with("children")->where("id", $id)->first()->toArray();

        if (empty($detail)) return response()->json(["error" => true, "message" => "Data Tidak Ditemukan"]);
        $ids = array();

        $update_parent = false;
        $update_id = 0;

        array_walk_recursive($detail, function ($value, $index) use (&$ids) {
            if ($index == "id") $ids[] = $value;
        });

        if ($detail['parent']==0){
            $update_parent = true;
            $update_id = $detail['id'];
            $key = array_search($update_id, $ids);
            unset($ids[$key]);
            unset($key);
        }

        if($update_parent){
            $parent = BidangStrukturDetail::find($update_id);
            $parent->jabatan="unknown";
            $parent->personil_id=NULL;
            $parent->jabatan_id=NULL;
            $parent->save();
        }
        BidangStrukturDetail::whereIn("id", $ids)->delete();
        return response()->json(["error" => false, "message" => "Berhasil Delete!"]);
    }

    private function check_children($children)
    {

        if ($children->children->isNotEmpty()) {
        }
    }
    public function update($id, Request $req)
    {
        // return BidangStrukturDetail::with("riwayat_jabatan_latest.person:id_personil,nama","riwayat_jabatan_latest.jabatan:id_jabatan,nama_jabatan")->find($id);
        $detail = BidangStrukturDetail::find($id);
        if (empty($detail)) return response()->json(["error" => true, "message" => "Data Tidak Ditemukan"]);

        if (!empty($req->name)) $detail->jabatan = $req->name;

        if (!empty($req->personil)) $detail->jabatan_id = $req->personil;

        $detail->save();
        
        $detail = BidangStrukturDetail::with("riwayat_jabatan_latest.person:id_personil,nama","riwayat_jabatan_latest.jabatan:id_jabatan,nama_jabatan")->find($id);

        $parent = BidangStruktur::find($detail->bidang_id);
        $parent->updated_at = date("Y-m-d H:i:s");
        $parent->save();

        $html = '<button type="button" node-id="' . $detail->id . '" data-id="' . $detail->id . '" data-bidang="' . $detail->parent . '" data-personil="" class="btn btn-outline-warning waves-effect">Unknown</button>';

        $jabatan='unknown';
        

        if (count($detail->riwayat_jabatan_latest)) {
            $html = '<button type="button" node-id="' . $detail->id . '" data-id="' . $detail->id . '" data-bidang="' . $detail->parent . '" data-personil="" class="btn btn-outline-primary waves-effect">' . $detail->riwayat_jabatan_latest[0]->person->nama . '</button>';
            $jabatan=$detail->riwayat_jabatan_latest[0]->jabatan->nama_jabatan;
            return response()->json(["error" => false, "message" => "Updated", "html" => $html,"jabatan"=>$jabatan]);

        }else{

            $html = '<button type="button" node-id="' . $detail->id . '" data-id="' . $detail->id . '" data-bidang="' . $detail->parent . '" data-personil="" class="btn btn-outline-primary waves-effect">Unknown</button>';

            $jabatan=Jabatan::find($req->personil)->nama_jabatan;

            return response()->json(["error" => false, "message" => "Jabatan ", "html" => $html,"jabatan"=>$jabatan]);

        }
    }

    public function edit($id_)
    {
        $id = base64_decode($id_);
        $orgdata = [];
        $data = BidangStruktur::with("detail.riwayat_jabatan_latest.person","detail.riwayat_jabatan_latest.jabatan")->find($id);

        if ($data->detail->isEmpty()) {

            $temp = new BidangStrukturDetail();
            $temp->parent = 0;
            $temp->jabatan = "unknown";
            $temp->bidang_id = $id;
            $temp->created_at = date("Y-m-d H:i:s");
            $temp->updated_at = date("Y-m-d H:i:s");
            $temp->save();

            $orgdata[0] = array(
                "id" => $temp->id,
                "name" => 'unknown',
                "org_id" => $data->id,
                "description" => '<button type="button" data-id="' . $temp->id . '" node-id="' . $temp->id . '" data-bidang="' . $data->id . '" data-personil="" class="btn btn-outline-warning waves-effect">Unknown</button>',
                "parent" => 0
            );
        } else {
            foreach ($data->detail as $key => $value) {
                $person ="Unknown";
                $jabatan ="Unknown";
                if(!empty($value->riwayat_jabatan_latest[0])){
                    $person = $value->riwayat_jabatan_latest[0]->person->nama ?? 'Unknown';
                    $jabatan = $value->riwayat_jabatan_latest[0]->jabatan->nama_jabatan ?? 'Unknown';
                }else{
                    $jabatan=Jabatan::find($value->jabatan_id)->nama_jabatan ?? 'Unknown';
                }
                $orgdata[] = array(
                    "id" => $value->id,
                    "name" => $jabatan,
                    "org_id" => $data->id,
                    "description" => ($person=="Unknown") ? '<button type="button" node-id="' . $value->id . '" data-bidang="' . $data->id . '"  data-id="' . $value->id . '" data-personil="" class="btn btn-outline-warning waves-effect">Unknown</button>' : '<button type="button"  data-bidang="' . $data->id . '"  data-id="' . $value->id . '" node-id="' . $value->id . '"data-personil="' . $value->jabatan_id . '" class="btn btn-outline-primary waves-effect">' . $person . '<br/><br/></button>',
                    "parent" => $value->parent
                );
            }
        }
        // return $orgdata;
        $orgdata = json_encode($orgdata);

        $active_menu = 'org_personil';
        return view('bidum.master_struktur.edit', compact('active_menu', 'data', 'orgdata', 'id_'));
    }


    public function struktur_organisasi($kode)
    {
        $kode = base64_decode($kode);
        $orgdata = [];

       $data = BidangStruktur::with("detail.riwayat_jabatan_latest.person","detail.riwayat_jabatan_latest.jabatan:id_jabatan,nama_jabatan")->where('kode', $kode)->first();

        foreach ($data->detail as $key => $value) {

            $person ="Unknown";
            $jabatan ="Unknown";
            $src='';

            if(!empty($value->riwayat_jabatan_latest[0])){
                $person = $value->riwayat_jabatan_latest[0]->person->nama ?? 'Unknown';
                $jabatan = $value->riwayat_jabatan_latest[0]->jabatan->nama_jabatan ?? 'Unknown';
                $src = ($value->riwayat_jabatan_latest[0]->person->foto) ? asset('personil/' . $value->riwayat_jabatan_latest[0]->person->foto) : '';
            }else{

                if(!empty($value->jabatan_id)){
                    // echo json_encode($value)."<hr/>";
                     $jabatan=Jabatan::find($value->jabatan_id)->nama_jabatan ?? "Unknown";
                }
            }
            
            $orgdata[] = array(
                "id" => $value->id,
                "name" => $jabatan,
                "org_id" => $data->id,
                "description" => ($person=="Unknown") ? '-' : '<div>
                    <table>
                    <tr>
                        <td width="50"><img class="img-fluid rounded-circle" src="' . $src . '"></td>    
                        <td class="pl-1 pt-2">' . $person . ' </td>
                    </tr>
                    </table>
                </div>',
                "parent" => $value->parent
            );
        }
        
        $orgdata = json_encode($orgdata);
        // $active_menu = 'org_personil';
        return view('struktur_organisasi_bidang', compact('data', 'orgdata'));
    }

    public function list(Request $request)
    {
        $list = BidangStruktur::get();
        return DataTables::of($list)
            ->addIndexColumn()
            ->editColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->locale('id')->format('j F Y | H:i');
            })
            ->addColumn('action', function ($row) {
                $id = base64_encode($row->id);
                $actionBtn = "<div class='text-center'><a href='" . url('/org_personil/edit') . "/{$id}'><button title='Edit' class='btn text-primary p-0'><i data-feather='edit' class='font-medium-4'></i></button></a></div>";
                return $actionBtn;
            })
            ->addColumn('status', function ($row) {
                return "-";
            })
            ->rawColumns(['action', "status"])
            ->make(true);
    }

    public function preview($id)
    {
        $id = base64_decode($id);

        $structure =  BidangStrukturDetail::with("person:nama,id_personil,foto", "children")->where("bidang_id", $id)->orderBy("parent", "asc")->get();
        $nodes = [];
        $datas = [];


        $count = $structure->count();

        $child_checking = [];
        $child_nested = [];

        foreach ($structure as $key => $value) {
            $child_checking[$value->parent] = $structure->where("parent", $value->parent)->count();
            $temp = $value->parent;
            array_walk_recursive($value, function ($val, $index) use (&$child_nested, $temp) {
                if ($index == "id") $child_nested[$temp][] = $val;
            });
        }
        // return  $child_nested;

        $state_column = [];
        $col_counter = 0;
        foreach ($structure as $key => $value) {
            if ($key > 0 && $count > 1) $datas[] = array($value->parent, $value->id);
            if ($count == 1) $datas[] = array($value->id);


            $temp = array(
                "id" => $value->id,
                "title" => $value->jabatan,
                "name" => $value->person->nama ?? '-',
            );

            if ($child_checking[$value->parent] > 1) {

                if (empty($state_column[$value->parent])) {
                    $state_column[$value->parent] = 1;
                } else {
                    $state_column[$value->parent] += 1;
                }

                $temp["column"] = $col_counter;
                if ($state_column[$value->parent] > 2) {
                    $col_counter += 1;
                    $state_column[$value->parent] = 0;
                }
            } else {
                if (count($child_nested[$value->parent]) > 1) {
                    $temp["column"] = $col_counter;
                }
                $col_counter += 1;
            }
            // echo count($child_nested[$value->parent])."<br/>";


            if (!empty($value->person->foto)) $temp["image"] = asset('personil/' . $value->person->foto);

            $nodes[] = $temp;
        }

        return response()->json(["error" => false, "data" => array("nodes" => $nodes, "datas" => $datas)]);
    }

    public function chart($id)
    {
        $id = base64_decode($id);
        $org = BidangStruktur::where("kode", $id)->first();

        $structure =  BidangStrukturDetail::with("person:nama,id_personil,foto")->where("bidang_id", $org->id)->orderBy("parent", "asc")->get();
        $nodes = [];
        $datas = [];

        if ($structure->isEmpty()) return response()->json(["error" => true, "data" => array("nodes" => $nodes, "datas" => $datas, "struktur_name" => ($org->nama_struktur == "STRUKTUR ORGANISASI") ? '' : $org->nama_struktur)]);

        $count = $structure->count();
        $child_checking = [];
        $child_nested = [];

        foreach ($structure as $key => $value) {
            $child_checking[$value->parent] = $structure->where("parent", $value->parent)->count();
            $temp = $value->parent;
            array_walk_recursive($value, function ($val, $index) use (&$child_nested, $temp) {
                if ($index == "id") $child_nested[$temp][] = $val;
            });
        }

        $state_column = [];
        $col_counter = 0;

        foreach ($structure as $key => $value) {
            if ($key > 0 && $count > 1) $datas[] = array($value->parent, $value->id);
            if ($count == 1) $datas[] = array($value->id);

            $temp = array(
                "id" => $value->id,
                "title" => $value->jabatan,
                "name" => $value->person->nama ?? '-',
            );


            if ($child_checking[$value->parent] > 1) {

                if (empty($state_column[$value->parent])) {
                    $state_column[$value->parent] = 1;
                } else {
                    $state_column[$value->parent] += 1;
                }

                $temp["column"] = $col_counter;
                if ($state_column[$value->parent] > 2) {
                    $col_counter += 1;
                    $state_column[$value->parent] = 0;
                }
            } else {
                if (count($child_nested[$value->parent]) > 1) {
                    $temp["column"] = $col_counter;
                }
                $col_counter += 1;
            }

            if (!empty($value->person->foto)) $temp["image"] = asset('personil/' . $value->person->foto);

            $nodes[] = $temp;
        }

        return response()->json(["error" => false, "data" => array("nodes" => $nodes, "datas" => $datas, "struktur_name" => ($org->nama_struktur == "STRUKTUR ORGANISASI") ? '' : $org->nama_struktur)]);
    }
}

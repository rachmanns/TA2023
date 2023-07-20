<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Angkatan;
use App\Models\SubKomando;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class SubKomandoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $active_menu = 'subkomando';
        return view('master.subkomando.index', compact(
            'active_menu'
        ));
    }

    public function get_list(Request $request){
        $angkatan = Angkatan::selectRaw('id_angkatan, kode_matra, nama_angkatan, level, parent')->whereIn("level", ["sat", "sub"])->with('parent_.parent_')->latest()->get();
        foreach($angkatan as $d) {
            if ($d->level == 'sub') {
                $d->sub = $d->nama_angkatan;
                $d->satker = $d->parent_->nama_angkatan;
                $d->kotama = $d->parent_->parent_->nama_angkatan ?? "";
            } else {
                $d->sub = '-';
                $d->satker = $d->nama_angkatan;
                $d->kotama = $d->parent_->nama_angkatan ?? "";
            }
            unset($d->parent_);
        }
        return Datatables::of($angkatan)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<div class="text-center"><a title="Edit" class="text-primary" onclick="edit_data($(this))" data-id="'.$row->id_angkatan.'"><i class="font-medium-4 mr-50" data-feather="edit"></i></a> 
                    <a class="text-danger" data-id="'.$row->id_angkatan.'" onclick="delete_data($(this))"><i class="font-medium-4" data-feather="trash"></i></a></div>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('roles.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all(); 
        if ($requestData["level"] == "sub") {
            $requestData["nama_angkatan"] = $requestData["subsatker"];
            $requestData["parent"] = $requestData["satker"];
        }
        unset($requestData["subsatker"], $requestData["satker"]);
        $requestData["code_angkatan"] = $requestData["nama_angkatan"];
        Angkatan::create($requestData);
        return response()->json(["error"=>false,"message"=>"Successfuly Added"]);
        // return redirect()->route('roles.index')->with('flash_message', 'Role added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // $role = Role::findOrFail($id);

        // return view('roles.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $role = Angkatan::with('parent_')->where('id_angkatan', $id)->first();

        if($role){

            return response()->json(["error"=>false,"data"=>$role]);
        
        }else{

            return response()->json(["error"=>true,"message"=>"Data Not Found"]);

        }


        // return view('roles.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $role = Angkatan::findOrFail($id);
        if ($requestData["level"] == "sub") {
            $requestData["nama_angkatan"] = $requestData["subsatker"];
            $requestData["parent"] = $requestData["satker"];
        }
        unset($requestData["subsatker"], $requestData["satker"]);
        $requestData["code_angkatan"] = $requestData["nama_angkatan"];
        $role->update($requestData);

        if($role){

            return response()->json(["error"=>false,"message"=>"Successfully Update"]);
        
        }else{

            return response()->json(["error"=>true,"message"=>"Data Not Found"]);

        }


        // return redirect()->route('roles.index')->with('flash_message', 'Role updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

            Angkatan::destroy($id);

        } catch (Exception $e) {
     
            return response()->json(["error"=>true,"message"=>$e->getMessage()]);

        }

        return response()->json(["error"=>false,"message"=>"Successfuly Deleted"]);

    }

    public function select($parent=null)
    {
        $list_all = ($parent) ? Angkatan::whereIn("level", ["sat", "sub"])->where("parent",$parent)->withCount("children")->get() : Angkatan::where("level","sub")->withCount("children")->get();
        $label = 'Satker';
        if ($parent) {
            $p = Angkatan::find($parent);
            $matra = $p->kode_matra;
            if ($p->level == 'sat') $label = "Sub $label";
        }
        $select=[];
        $select[] = ["id" => "-", "text" => "Pilih $label", "count" => "", "disabled" => true, "selected" => true];

        foreach ($list_all as $item) {
            $select[]=["id"=>$item->id_angkatan,"text"=>$item->nama_angkatan, "count" => $item->children_count];
        }
        return response()->json(["error"=>false,"data"=>$select,"matra"=>$matra??'']);

    }

  }

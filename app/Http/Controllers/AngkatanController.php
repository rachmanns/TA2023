<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Angkatan;
use App\Models\Matra;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleHas;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $keyword = $request->get('search');
        // $perPage = 25;

        // if (!empty($keyword)) {
        //     $role = Role::latest()->paginate($perPage);
        // } else {
        //     $role = Role::latest()->paginate($perPage);
        // }


        
        return view('master.angkatan.index');
    }

    public function get_list(Request $request){
        $angkatan = Matra::latest()->get();
        return Datatables::of($angkatan)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a onclick=edit_data($(this)) data-id="'.$row->id_matra.'"  class="edit btn btn-success btn-sm">Edit</a>
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
        
        // $requestData = $request->all(); 
        // $requestData["level"]="ang";
        // Angkatan::create($requestData);
        // return response()->json(["error"=>false,"message"=>"Successfuly Added Angkatan!"]);
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
        $role = Role::findOrFail($id);

        return view('roles.role.show', compact('role'));
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
        $role = Matra::find($id);

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
        
        $role = Matra::findOrFail($id);
        $role->update($requestData);

        if($role){

            return response()->json(["error"=>false,"message"=>"Successfully Update Matra"]);
        
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
        // try {

        //     Angkatan::destroy($id);

        // } catch (Exception $e) {
     
        //     return response()->json(["error"=>true,"message"=>$e->getMessage()]);

        // }

        // return response()->json(["error"=>false,"message"=>"Successfuly Deleted Angkatan!"]);

    }

    public function select(Request $request)
    {
        if (isset($request->faskes)) $list_all = Matra::whereIn('kode_matra', ['AD', 'AL', 'AU', 'MABES'])->get();
        else
        $list_all = Matra::get();

        $select=[];

        $select[]=["id"=>"","text"=>"Pilih Matra"];
        foreach ($list_all as $item) {
            $select[]=[
                "id"=>$item->kode_matra,
                "text"=>$item->nama_matra,
                // "count"=>$item->children_count
            ];
        }
        return response()->json(["error"=>false,"data"=>$select]);

    }

  }

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Angkatan;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class KomandoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $active_menu = 'komando';
        return view('master.komando.index', compact(
            'active_menu'
        ));
    }

    public function get_list(Request $request)
    {
        $angkatan = Angkatan::where("level", "kot")->latest()->get();
        return Datatables::of($angkatan)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $actionBtn = '<div class="text-center"><a title="Edit" class="text-primary" onclick="edit_data($(this))" data-id="' . $row->id_angkatan . '"><i class="font-medium-4 mr-50" data-feather="edit"></i></a> 
                    <a class="text-danger" data-id="' . $row->id_angkatan . '" onclick=delete_data($(this))"><i class="font-medium-4" data-feather="trash"></i></a></div>
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
        $requestData["level"] = "kot";
        $requestData["code_angkatan"] = $requestData["nama_angkatan"];
        Angkatan::create($requestData);
        return response()->json(["error" => false, "message" => "Successfuly Added Kotama"]);
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
        $role = Angkatan::find($id);

        if ($role) {

            return response()->json(["error" => false, "data" => $role]);
        } else {

            return response()->json(["error" => true, "message" => "Data Not Found"]);
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
        $role->update($requestData);

        if ($role) {

            return response()->json(["error" => false, "message" => "Successfully Update Kotama"]);
        } else {

            return response()->json(["error" => true, "message" => "Data Not Found"]);
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

            return response()->json(["error" => true, "message" => $e->getMessage()]);
        }

        return response()->json(["error" => false, "message" => "Successfuly Deleted Kotama"]);
    }

    public function select(Request $request, $parent = null)
    {
        if (isset($request->all)) $list_all = Angkatan::where("kode_matra", $parent)->orderBy('nama_angkatan')->get();
        else
        $list_all = ($parent) ? Angkatan::where("level", "kot")->where("kode_matra", $parent)->withCount("children")->get() : Angkatan::where("level", "kot")->withCount("children")->get();

        if (isset($request->all)) $lbl = 'Satker';
        else $lbl = 'Kotama';
        $select = [["id" => "", "text" => "Pilih $lbl", "count" => ""]];

        foreach ($list_all as $item) {
            $select[] = ["id" => $item->id_angkatan, "text" => $item->nama_angkatan, "count" => $item->children_count,"matra"=>$item->kode_matra];
        }
        return response()->json(["error" => false, "data" => $select]);
    }
}

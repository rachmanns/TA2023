<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\ModelHasRoles;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\RoleHas;
use DB;
use Hash;
// use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:users.list', ['only' => ['index','show']]);
        $this->middleware('permission:users.manage', ['only' => ['create','store','edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $role = json_encode(Auth::user()->hasPermissionTo('users.list'));
        if($role){

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $user = User::latest()->paginate($perPage);
        } else {
            $user = User::latest()->paginate($perPage);
        }
    }
        return view('users.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        // return $roles;
        return view('users.user.create', compact('roles'));
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
        $requestData['password'] = Hash::make($requestData['password']);
        
        $user = User::create($requestData);
        // $user = User::create($input);
        // $inputModelHas['role_id'] = $request->role_id;
        // $inputModelHas['model_type'] = "App\Models\User";
        // $inputModelHas['model_id'] = $user->id;
        // $modelHas = ModelHasRoles::create($inputModelHas);

        $mhr = new ModelHasRoles();
        $mhr->role_id = $request->role_id;
        $mhr->model_type = "App\Models\User";
        $mhr->model_id = $user->id;
        $mhr->save();
        // $user->assignRole($request->input('role_id'));

        return redirect()->route('users.index')->with('flash_message', 'User added!');
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
        $user = User::findOrFail($id);

        return view('users.user.show', compact('user'));
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
        $user = User::findOrFail($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.user.edit', compact('user','roles','userRole'));
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
        if(!empty($requestData['password'])){ 
            $requestData['password'] = Hash::make($requestData['password']);
        }else{
            $requestData = Arr::except($requestData,array('password'));    
        }

        $user = User::findOrFail($id);
        $user->update($requestData);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')->with('flash_message', 'User updated!');
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
        User::destroy($id);

        return redirect()->route('users.index')->with('flash_message', 'User deleted!');
    }

    public function update_profile(Request $request) {
        session()->flash('msg','Profil gagal diubah');
        $this->validate($request, [
            'nama' => 'required|min:4',
            'email' => ['required', 'email', Rule::unique('users')->ignore(Auth::user()->id)],
            //'password_old' => 'current_password',
            'password' => 'nullable|min:8',
            'password_confirmation' => 'same:password',
        ], [
            'required'=>':attribute tidak boleh kosong',
            'min'=>'panjang :attribute minimal :min',
            'unique'=>'email ini sudah terdaftar',
            'email'=>'format email salah',
            //'current_password'=>'password lama salah',
            'same'=>'password konfirmasi tidak sama',
        ]);
        $u = Auth::user();
        $u->name = trim($request->nama);
        $u->email = trim($request->email);
        if ($request->password != '') $u->password = Hash::make($request->password);
        if ($request->file('imgFile') !== null) {
            $file = $request->file('imgFile');
            $filename = base64_encode(Auth::user()->id) . '.png';
            $file->move(public_path('app-assets/images/profile/user-uploads'), $filename);
        }
        $u->save();
        return redirect('/profile')->with('msg', 'Profil berhasil diubah');
    }
}

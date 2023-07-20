<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRoles;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo json_encode(Auth::user());
        // echo json_encode(Auth::user()->hasRole('Administrator'));
        // echo json_encode(Auth::user()->hasPermissionTo('test_perm'));
        // exit();

        $user = Auth::user();
        $roleId = ModelHasRoles::where('model_id', $user->id)->first()->role_id;
        $roleName = Role::where('id', $roleId)->first()->name;
        // return $roleName;

        return redirect('struktur_umum');
        // return view('umum.dashboard', ['active_menu' => 'dashboard'], compact('user', 'roleName'));
    }

    public function main_dashboard()
    {
        return view('umum.dashboard', ['active_menu' => 'dashboard']);
    }
}

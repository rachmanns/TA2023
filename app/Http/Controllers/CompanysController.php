<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanysController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:company_list|company-create|company-edit|company-delete', ['only' => ['index','show']]);
        $this->middleware('permission:company_create', ['only' => ['create','store']]);
        $this->middleware('permission:company_edit', ['only' => ['edit','update']]);
        $this->middleware('permission:company_delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $role = json_encode(Auth::user()->hasPermissionTo('company_list'));
        if($role){

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $company = Company::latest()->paginate($perPage);
        } else {
            $company = Company::latest()->paginate($perPage);
        }
    }
        return view('companys/company/index', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('companys.company.create');
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
        
        Company::create($requestData);

        return redirect()->route('companys.index')->with('flash_message', 'Company added!');
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
        $company = Company::findOrFail($id);

        return view('companys.company.show', compact('company'));
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
        $company = Company::findOrFail($id);

        return view('companys.company.edit', compact('company'));
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
        
        $company = Company::findOrFail($id);
        $company->update($requestData);

        return redirect()->route('companys.index')->with('flash_message', 'Company updated!');
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
        Company::destroy($id);

        return redirect()->route('companys.index')->with('flash_message', 'Company deleted!');
    }
}

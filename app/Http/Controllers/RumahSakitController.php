<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\FaskesFasilitasRS;
use Illuminate\Http\Request;
use DataTables;
use Exception;

class RumahSakitController extends Controller
{
    public function get_list(Request $request) {
        $data = FaskesFasilitasRS::has('rs')->has('fasilitas')->latest();
        if (isset(Auth::user()->id_faskes)) $data->with('fasilitas')->where('id_rs', Auth::user()->id_faskes);
        else $data->with('fasilitas', 'rs');
        $data = $data->get();
        return datatables()::of($data)
                ->addIndexColumn()
                ->rawColumns(['status'])
                ->make(true);
    }

  }

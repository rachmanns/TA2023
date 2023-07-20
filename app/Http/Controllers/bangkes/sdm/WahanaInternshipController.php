<?php

namespace App\Http\Controllers\bangkes\sdm;

use App\Http\Controllers\Controller;
use App\Http\Requests\InternshipRequest;
use App\Models\Internship;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WahanaInternshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active_menu = 'wahana_internship';
        return view('bangkes.subbid_sdm.internship.wahana.index', compact('active_menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $active_menu = 'wahana_internship';
        return view('bangkes.subbid_sdm.internship.wahana.create', compact('active_menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InternshipRequest $request)
    {
        try {
            Internship::create($request->validated());

            return response()->json([
                'error' => false,
                'message' => 'Wahana Internship Created!',
                'url' => url('bangkes/wahana-internship')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
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
    public function edit(Internship $internship)
    {
        $active_menu = 'wahana_internship';
        return view('bangkes.subbid_sdm.internship.wahana.create', compact('active_menu', 'internship'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InternshipRequest $request, Internship $internship)
    {
        try {
            $internship->update($request->validated());

            return response()->json([
                'error' => false,
                'message' => 'Wahana Internship Updated!',
                'url' => url('bangkes/wahana-internship')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Internship $internship)
    {
        try {
            $internship->delete();

            return response()->json([
                'error' => false,
                'message' => 'Wahana Internship Updated!',
                'table' => '#wahana'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function list(Request $request)
    {
        $internship = Internship::whereNull('tgl_selesai')
            ->when($request->tahun, function ($query) use ($request) {
                return $query->whereYear('tgl_mulai', $request->tahun);
            })
            ->latest()->get();
        return DataTables::of($internship)
            ->editColumn('tgl_mulai', function ($row) {
                return indonesian_date_format($row->tgl_mulai);
            })
            ->editColumn('tgl_selesai', function ($row) {
                $tgl_selesai = date('Y-m-d', strtotime('+1 year', strtotime($row->tgl_mulai)));
                return indonesian_date_format($tgl_selesai);
            })
            ->addColumn('pangkat_korps', function ($row) {
                return $row->pangkat . '/' . $row->korps;
            })
            ->addColumn('jabatan_kesatuan', function ($row) {
                return $row->jabatan . '/' . $row->kesatuan;
            })
            ->addColumn('action', function ($row) {
                return "<div class='text-center'><a href='" . url('bangkes/wahana-internship/' . $row->id_internship . '/edit') . "'><button title='Edit' class='btn text-primary p-0 pr-50'><i data-feather='edit' class='font-medium-4'></i></button></a><button title='Delete' type='button' class='delete-data btn p-0' data-id='" . $row->id_internship . "' data-url='" . url('bangkes/wahana-internship') . "'><i data-feather='trash' class='font-medium-4 text-danger'></i></button></div>";
            })
            ->rawColumns(['pangkat_korps', 'action'])
            ->toJson();
    }
}

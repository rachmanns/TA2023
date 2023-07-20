<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\ListUkp;
use App\Models\Personil;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UkpController extends Controller
{
    public function index()
    {
        $active_menu = 'ukp';
        $personil = Personil::with('pangkat')->whereHas('pangkat', function (Builder $query) {
            $query->where('masa_kenkat', 0);
        })->whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })
            ->get();
        $tahun = date('Y');
        return view('bidum.personil.ukp.index', compact(
            'active_menu',
            'personil',
            'tahun'
        ));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_personil' => 'required',
            'periode' => 'required',
            'pangkat_terakhir' => 'required',
            'tmt_pangkat_terakhir' => 'required',
            'target_tmt_kenkat' => 'required',
        ]);

        try {
            ListUkp::create($validatedData);
            return response()->json([
                'error' => false,
                'message' => 'UKP Created!',
                'modal' => '#ukp',
                'table' => '#list-ukp'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }

    public function list_ukp(Request $request)
    {

        $ukp = ListUkp::select('list_ukp.*', 'personil.nama', 'pangkat.masa_kenkat')
            ->join('personil', 'personil.id_personil', 'list_ukp.id_personil')
            ->join('pangkat', 'pangkat.id_pangkat', 'personil.id_pangkat_terakhir')
            ->whereYear('list_ukp.periode', $request->tahun)
            ->get();

        return DataTables::of($ukp)
            ->addIndexColumn()
            ->editColumn('tmt_pangkat_terakhir', function ($query) {
                return date('d F Y', strtotime($query->tmt_pangkat_terakhir));
            })
            ->editColumn('periode', function ($query) {
                return date('d F Y', strtotime($query->periode));
            })
            ->addColumn('action', function ($r) {
                $edit = '<button title="Edit" class="btn pr-0 text-primary"><i data-feather="edit" class="font-medium-4"></i></button>';

                if ($r->masa_kenkat == 0) {
                    return '<div class="text-center"><button title="Delete" type="button" class="delete-data btn pl-75" data-id="' . $r->id_list_ukp . '" data-url="' . url('bidum/personil/ukp') . '"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
                }
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function generate()
    {
        // $month_now = date('n');
        $personil = Personil::with('pangkat')->whereHas('pangkat', function (Builder $query) {
            $query->where('masa_kenkat', '<>', 0);
        })->whereHas('kategori', function (Builder $query) {
            $query->where('nama_kategori', Kategori::AKTIF);
        })->get();

        // $data=[];
        foreach ($personil as $key => $value) {
            $month = date('n', strtotime($value->tmt_pangkat_terakhir));

            if (in_array($month, range(5, 10))) {
                $target_tmt_kenkat = date('Y-10-01', strtotime("+" . $value->pangkat->masa_kenkat . " years", strtotime($value->tmt_pangkat_terakhir)));
                $periode = date('Y-04-d', strtotime($target_tmt_kenkat));
            } elseif (in_array($month, range(11, 12))) {
                $target_tmt_kenkat = date('Y-04-01', strtotime("+" . $value->pangkat->masa_kenkat . " years", strtotime($value->tmt_pangkat_terakhir)));
                $periode = date('Y-10-d', strtotime("-1 years", strtotime($target_tmt_kenkat)));
            } elseif (in_array($month, range(1, 4))) {
                $target_tmt_kenkat = date('Y-04-01', strtotime("+" . $value->pangkat->masa_kenkat . " years", strtotime($value->tmt_pangkat_terakhir)));
                $periode = date('Y-10-d', strtotime("-1 years", strtotime($target_tmt_kenkat)));
            }

            $list_ukp = ListUkp::firstOrCreate([
                'periode' => $periode,
                'id_personil' => $value->id_personil,
                'pangkat_terakhir' => $value->nama_pangkat_terakhir,
                'tmt_pangkat_terakhir' => $value->tmt_pangkat_terakhir,
                'target_tmt_kenkat' => $target_tmt_kenkat
            ]);
        }
        // return $list_ukp;
        return redirect('bidum/personil/ukp');
    }

    public function get_personil(Personil $personil)
    {
        return $personil;
    }

    public function destroy(ListUkp $list_ukp)
    {
        $list_ukp->deleteOrFail();
        return response()->json([
            'error' => false,
            'message' => 'UKP Deleted!',
            'table' => '#list-ukp'
        ]);
    }
}

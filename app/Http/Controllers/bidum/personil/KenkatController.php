<?php

namespace App\Http\Controllers\bidum\personil;

use App\Http\Controllers\Controller;
use App\Models\ListUkp;
use App\Models\Pangkat;
use App\Models\Personil;
use App\Models\RiwayatPangkat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KenkatController extends Controller
{
    public function index()
    {
        $active_menu = 'kenkat';
        $month_now = date('n');
        $target_tmt_kenkat = ListUkp::select('target_tmt_kenkat')->whereYear('target_tmt_kenkat', '>=', date('Y'))->orderBy('target_tmt_kenkat', 'asc')->get()->unique('target_tmt_kenkat');

        if (in_array($month_now, range(5, 10))) {
            $date = date('Y-10');
        } elseif (in_array($month_now, range(11, 12))) {
            $date = date('Y-04', strtotime("+1 years"));
        } else {
            $date = date('Y-04');
        }

        return view('bidum.personil.kenkat.index', compact('active_menu', 'date', 'target_tmt_kenkat'));
    }

    public function list_kenkat($date)
    {
        $year_ukp = date('Y', strtotime($date));
        $month_ukp = date('m', strtotime($date));

        $kenkat = ListUkp::with('personil')->whereMonth('target_tmt_kenkat', $month_ukp)->whereYear('target_tmt_kenkat', $year_ukp)->get();
        return DataTables::of($kenkat)
            ->addIndexColumn()
            ->editColumn('tmt_pangkat_terakhir', function ($query) {
                return date('d F Y', strtotime($query->tmt_pangkat_terakhir));
            })
            ->editColumn('target_tmt_kenkat', function ($query) {
                return date('d F Y', strtotime($query->target_tmt_kenkat));
            })
            ->addColumn('action', function ($query) {
                if ($query->status == 'APPROVE') {
                    return '<div class="text-center"><div class="badge badge-light-success font-small-4">Disetujui</div></div>';
                } else if ($query->status == 'REJECT') {
                    return '<div class="text-center"><div class="badge badge-light-danger font-small-4 mb-50">Ditolak</div></div>';
                }
                return '<div class="text-center" title="Setujui"><button type="button" class="btn btn-icon btn-success mr-50" data-id="' . $query->id_list_ukp . '" onclick="disetujui($(this))"><i data-feather="check" class="font-medium-4"></i></button>
                <button class="btn btn-icon btn-danger" title="Tolak" type="button" data-id="' . $query->id_list_ukp . '" onclick="ditolak($(this))" btn"><i data-feather="x" class="font-medium-4"></i></button></div>
                
                ';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function get_kenkat(ListUkp $list_ukp)
    {
        return $list_ukp->load('personil.pangkat.parent');
    }

    public function approve(Request $request)
    {
        try {
            $pangkat = Pangkat::where('id_pangkat', $request->id_pangkat)->first();
            DB::transaction(
                function () use ($request, $pangkat) {
                    ListUkp::where('id_list_ukp', $request->id_list_ukp)->update(['status' => 'APPROVE']);

                    Personil::where('id_personil', $request->id_personil)->update(
                        [
                            'id_pangkat_terakhir' => $pangkat->id_pangkat,
                            'nama_pangkat_terakhir' => $pangkat->nama_pangkat,
                            'tmt_pangkat_terakhir' => $request->tmt_pangkat
                        ]
                    );

                    RiwayatPangkat::create([
                        'id_pangkat' => $pangkat->id_pangkat,
                        'id_personil' => $request->id_personil,
                        'tmt_pangkat' => $request->tmt_pangkat,
                        'no_skep_pangkat' => $request->no_skep_pangkat,
                        'tgl_skep_pangkat' => $request->tgl_skep_pangkat,
                        'no_sprin_pangkat' => $request->no_sprin_pangkat,
                        'tgl_sprin_pangkat' => $request->tgl_sprin_pangkat,
                    ]);
                }
            );

            return response()->json([
                'error' => false,
                'message' => 'Kenkat Approved!',
                'table' => '#list-kenkat',
                'modal' => '#disetujui'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function reject(Request $request)
    {
        $validated = $request->validate([
            'periode' => 'required'
        ]);

        try {
            
            $month = date('n', strtotime($request->periode));
            if ($month == 4) {
                $target_tmt_kenkat = date('Y-10-01 ', strtotime($request->periode));
            } elseif ($month == 10) {
                $target_tmt_kenkat = date('Y-04-01', strtotime("+1 years", strtotime($request->periode)));
            }else{
                throw new Exception("Kenkat yang diperbolehkan hanya bulan April dan Oktober");
            }

            
            $personil = Personil::where('id_personil', $request->id_personil)->first();
            DB::transaction(
                function () use ($request, $target_tmt_kenkat, $personil) {
                    ListUkp::where('id_list_ukp', $request->id_list_ukp)->update(['status' => 'REJECT', 'keterangan' => $request->keterangan]);

                    ListUkp::create([
                        'periode' => $request->periode,
                        'id_personil' => $personil->id_personil,
                        'pangkat_terakhir' => $personil->nama_pangkat_terakhir,
                        'tmt_pangkat_terakhir' => $personil->tmt_pangkat_terakhir,
                        'target_tmt_kenkat' => $target_tmt_kenkat
                    ]);
                }
            );

            return response()->json([
                'error' => false,
                'message' => 'Kenkat Rejected!',
                'table' => '#list-kenkat',
                'modal' => '#ditolak'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'line' => $e->getLine()
            ]);
        }
    }
}

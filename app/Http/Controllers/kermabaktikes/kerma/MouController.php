<?php

namespace App\Http\Controllers\kermabaktikes\kerma;

use App\Http\Controllers\Controller;
use App\Http\Requests\MouRequest;
use App\Models\DocKerma;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class MouController extends Controller
{
    public function index()
    {
        $active_menu = 'mou';
        $this->check_status();
        return view('kermabaktikes.kerma.dalam_negeri.mou.index', compact('active_menu'));
    }

    public function check_status()
    {
        $now = now();
        $doc_kermas = DocKerma::with('parent')->latest();
        $data_id = $doc_kermas->get()->pluck('id_doc_kerma')->toArray();


        $data_chain = [];
        $doc_kerma = $doc_kermas->get();

        foreach ($doc_kerma as $key => $value) {
            if (in_array($value->id_doc_kerma, $data_id)) {

                $status = 'aktif';

                if ($now > $value->tgl_berakhir) {
                    $value->update(['status_perjanjian' => 'nonaktif']);
                    $status = 'nonaktif';
                }
                $value = $value->parent;
                while ($value) {
                    $data_chain[] = $value->id_doc_kerma;
                    $value = $value->parent;
                }

                foreach ($data_chain as $k => $v) {
                    $doc = $doc_kerma->where('id_doc_kerma', $v)->first();

                    if (in_array($status, ['aktif', 'perpanjang'])) {
                        $status = 'perpanjang';
                        $doc->update(['status_perjanjian' => $status]);
                    } else {
                        $status = 'nonaktif';
                        $doc->update(['status_perjanjian' => $status]);
                    }
                }

                $data_id = array_diff($data_id, $data_chain);
            }
            $data_chain = [];
        }
    }


    public function create()
    {
        $active_menu = 'mou';
        $doc_kerma = DocKerma::select('id_doc_kerma', 'no_doc')->get();
        $jenis_doc_kerma = [
            'MoU',
            'PKS',
            'MoA'
        ];
        return view('kermabaktikes.kerma.dalam_negeri.mou.create', compact('active_menu', 'doc_kerma', 'jenis_doc_kerma'));
    }

    public function store(MouRequest $request)
    {
        try {
            $requestData = $request->validated();
            $requestData['status_perjanjian'] = 'aktif';

            if ($request->has('file_doc')) {
                $path = public_path('kermabaktikes/mou_files');
                $file_doc = $request->file('file_doc');
                $file_doc_name =  rand() . '.' . $request->file('file_doc')->getClientOriginalExtension();
                $file_doc->move($path, $file_doc_name);
                $requestData['file_doc'] = $file_doc_name;
            }

            DB::transaction(function () use ($requestData, $request) {
                if ($request->id_parent_doc != null) {
                    DocKerma::where('id_doc_kerma')->update(['status_perjanjian' => 'diperpanjang']);
                }
                DocKerma::create($requestData);
            });

            return response()->json([
                'error' => false,
                'message' => 'MoU Created!',
                'url' => url('kerma/mou')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit(DocKerma $mou)
    {
        $active_menu = 'mou';
        $doc_kerma = DocKerma::select('id_doc_kerma', 'no_doc')->get();
        $jenis_doc_kerma = [
            'MoU',
            'PKS',
            'MoA'
        ];
        return view('kermabaktikes.kerma.dalam_negeri.mou.create', compact('active_menu', 'doc_kerma', 'jenis_doc_kerma', 'mou'));
    }

    public function update(MouRequest $request, DocKerma $mou)
    {
        try {
            $requestData = $request->validated();
            $requestData['status_perjanjian'] = 'aktif';

            if ($request->file('file_doc') != null) {
                $path = public_path('kermabaktikes/mou_files');
                $file_doc = $request->file('file_doc');
                $file_doc_name =  rand() . '.' . $request->file('file_doc')->getClientOriginalExtension();
                $file_doc->move($path, $file_doc_name);
                $requestData['file_doc'] = $file_doc_name;
            }

            DB::transaction(function () use ($requestData, $request, $mou) {
                if ($request->id_parent_doc != null) {
                    DocKerma::where('id_doc_kerma')->update(['status_perjanjian' => 'diperpanjang']);
                }
                $mou->update($requestData);
            });

            return response()->json([
                'error' => false,
                'message' => 'MoU Updated!',
                'url' => url('kerma/mou')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy(DocKerma $mou)
    {
        try {
            $doc_kerma = DocKerma::where('id_parent_doc', $mou->id_doc_kerma)->first();
            if ($doc_kerma) throw new \Exception("Cannot delete this data, please check kerma first.");

            $path = public_path('kermabaktikes/mou_files');
            unlink($path . '/' . $mou->file_doc);

            $mou->delete();
            return response()->json([
                'error' => false,
                'message' => 'MOU Deleted!',
                'table' => '#mou-list'
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
        $doc_kermas = DocKerma::when($request->tahun, function ($query) use ($request) {
            return $query->whereYear('tgl_terbit', $request->tahun);
        })->latest()->get();
        return DataTables::of($doc_kermas)
            ->addIndexColumn()
            ->addColumn('file_doc', function ($row) {
                if (!empty($row->file_doc)) {
                    return "<div class='mt-50'><a href='" . url('kerma/mou/file_doc/' . $row->file_doc) . "' target='_BLANK'><i data-feather='file-text' class='font-medium-4 mr-75'></i>Lihat Dokumen</a></div>";
                }
            })
            ->addColumn('tgl_terbit', function ($row) {
                $tgl_terbit = Carbon::parse($row->tgl_terbit)->locale('id')->isoFormat('DD MMMM YYYY');
                $terbit = Carbon::parse($row->tgl_terbit);
                $berakhir = Carbon::parse($row->tgl_berakhir);
                return $tgl_terbit . " <br> <b> Masa Berlaku " . $terbit->diffInYears($berakhir) . " Tahun </b>";
            })
            ->addColumn('status_perjanjian', function ($row) {
                if (in_array($row->status_perjanjian, ['aktif', 'perpanjang'])) {
                    return "<div class='text-center'><div class='badge badge-light-success font-small-4'>Aktif</div></div>";
                }
                return "<div class='text-center'><div class='badge badge-light-danger font-small-4'>Habis Masa Berlaku</div></div>";
            })
            ->addColumn('action', function ($row) {
                return '<div class="text-center"><a href="' . route('kerma.mou.edit', $row->id_doc_kerma) . '"><button title="Edit" class="btn pr-0 text-primary"><i data-feather="edit" class="font-medium-4"></i></a></button><button title="Delete" type="button" data-id="' . $row->id_doc_kerma . '" data-url="' . url('kerma/mou') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['tgl_terbit', 'status_perjanjian', 'action', 'file_doc'])
            ->toJson();
    }

    public function file_doc($file_doc)
    {
        $pathToFile = public_path('kermabaktikes/mou_files') . '/' . $file_doc;
        if (!file_exists($pathToFile)) {
            return redirect('document_not_found');
        }
        return response()->file($pathToFile);
    }
}

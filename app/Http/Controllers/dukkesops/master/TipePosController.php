<?php

namespace App\Http\Controllers\dukkesops\master;

use App\Models\TipePos;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TipePosService;
use App\Http\Requests\TipePosRequest;

class TipePosController extends Controller
{
    public function list()
    {
        $tipe = TipePos::get();
        return DataTables::of($tipe)
            ->addIndexColumn()
            ->addColumn('tipe_pos', function ($row) {
                return strtoupper($row->tipe);
            })
            ->addColumn('image', function ($row) {
                $filePath = url("app-assets/images/ico/" . ($row->image == "" ? ($row->tipe == 'darat' ? $row->tipe . ".png" : "pos-" . $row->tipe . ".png") : $row->image));
                return '<img src="' . $filePath . '" alt="users avatar" class="user-avatar users-avatar-shadow rounded mr-2 my-25 cursor-pointer" height="50" width="50" />';
            })
            ->addColumn('action', function ($query) {
                $button = '<div class="text-center">';

                $button .= '<div class="text-center"><button title="Edit" class="btn pr-0 text-primary" data-id="' . $query->id_tipe_pos . '" onclick="edit_data($(this))"><i data-feather="edit" class="font-medium-4"></i></button>';

                if ($query->image != "") {
                    $button .= '<button title="Delete" type="button" data-id="' . $query->id_tipe_pos . '" data-url="' . url('dukkesops/tipe-pos') . '" class="delete-data btn pl-75"><i data-feather="refresh-ccw" class="font-medium-4 text-danger"></i></button>';
                }

                $button .= '</div>';

                return $button;
            })
            ->rawColumns(['action', 'image', 'tipe_pos'])
            ->toJson();
    }

    public function edit($id)
    {
        $tipe_pos = TipePos::find($id);
        return $tipe_pos;
    }

    public function update(TipePosRequest $request)
    {
        $imageName = $request->tipe . time() . '.' . $request->image->extension();

        $tp = TipePos::find($request->id);

        if (file_exists(public_path('app-assets/images/ico/') . $tp->image) && $tp->image != "") {
            unlink(public_path('app-assets/images/ico/' . $tp->image));
        }

        $request->image->move(public_path('app-assets/images/ico'), $imageName);

        $tp->update([
            'image' => $imageName,
        ]);

        return response()->json([
            'error' => false,
            'message' => 'Tipe Pos Updated!',
            'modal' => '#add',
            'table' => '#rs'
        ]);
    }

    public function destroy($id)
    {
        try {
            $tipe = TipePos::find($id);
            $pathToFile = public_path('app-assets/images/ico') . '/' . $tipe->image;
            if (file_exists($pathToFile)) {
                unlink($pathToFile);
            }
            $tipe->update(['image' => ""]);
        } catch (\Exception $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()]);
        }

        return response()->json([
            'error' => false,
            'message' => 'Image Reseted!',
            'table' => '#rs'
        ]);
    }
}

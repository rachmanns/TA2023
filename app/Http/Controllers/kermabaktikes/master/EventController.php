<?php

namespace App\Http\Controllers\kermabaktikes\master;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\JenisKerma;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        $active_menu = 'master_event';
        $jenis_kerma = JenisKerma::where('id_jenis_kerma', JenisKerma::BILATERAL_LN)->get();
        return view('kermabaktikes.master_data.event', compact('active_menu', 'jenis_kerma'));
    }

    public function list()
    {
        $event = Event::with('jenis_kerma')->get();
        return DataTables::of($event)
            ->addColumn('action', function ($query) {
                return '<div class="text-center"><button title="Detail" class="btn pr-0 text-primary" data-id="' . $query->id_event . '" onclick="edit_event($(this))"><i data-feather="file-text" class="font-medium-4"></i></button><button title="Delete" type="button" data-id="' . $query->id_event . '" data-url="' . url('kerma/event') . '" class="delete-data btn pl-75"><i data-feather="trash" class="font-medium-4 text-danger"></i></button></div>';
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function store(EventRequest $request)
    {
        try {
            Event::create($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Event Created!',
                'modal' => '#tambah',
                'table' => '#event-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function show(Event $event)
    {
        return $event;
    }

    public function update(EventRequest $request, Event $event)
    {
        try {
            $event->update($request->validated());
            return response()->json([
                'error' => false,
                'message' => 'Event Updated!',
                'modal' => '#tambah',
                'table' => '#event-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function destroy(Event $event)
    {
        try {
            $event->delete();
            return response()->json([
                'error' => false,
                'message' => 'Event Deleted!',
                'table' => '#event-table'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'Failed!'
            ]);
        }
    }
}

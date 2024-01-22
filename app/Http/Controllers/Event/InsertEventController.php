<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Services\EventService;

class InsertEventController extends Controller
{

    public function index(){

        return view('event.add_update');
    }

    public function insert(\Illuminate\Http\Request $request, EventService $eventService){
        $data = $request->validate([
            'title' => ['required', 'string', 'max:10'],
            'notes' => ['required', 'string'],
            'dt_start' => ['required', 'date', 'after_or_equal:today'],
            'dt_end' => ['required', 'date', 'after:dt_start'],
            'user' => ['numeric']
        ]);
        if($eventService->createEvent($data)){
            $events = Event::get();
            return view('event.index', ['events' => $events]);
        }
    }
}

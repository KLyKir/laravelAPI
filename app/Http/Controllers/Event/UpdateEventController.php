<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\User;
use App\Services\EventService;
use Illuminate\Http\Request;

class UpdateEventController extends Controller
{
    public function index($id){
        $event = Event::findOrFail($id);
        return view('event.add_update', ['event' => $event]);
    }
    public function update(Request $request, EventService $eventService){
        $data = $request->validate([
            'title' => ['required', 'string', 'max:10'],
            'notes' => ['required', 'string'],
            'dt_start' => ['required', 'date', 'after_or_equal:today'],
            'dt_end' => ['required', 'date', 'after:dt_start'],
            'user' => ['numeric']
        ]);
        if($eventService->updateEvent($data, $request->id)){
            $events = Event::get();
            return view('event.index', ['events' => $events]);
        }

    }
}

<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvent($id){
        return new EventResource(Event::findOrFail($id));
    }
    public function getAll(){
        return new EventCollection(Event::all());
    }

    public function deleteEvent($id, EventService $eventService){
        return new EventCollection($eventService->deleteEvent($id));
    }

    public function updateEvent(Request $request, EventService $eventService){
        $data = $request->validate([
            'title' => ['required', 'string', 'max:10'],
            'notes' => ['required', 'string'],
            'dt_start' => ['required', 'date', 'after_or_equal:today'],
            'dt_end' => ['required', 'date', 'after:dt_start'],
            'user' => ['numeric']
        ]);
        if($eventService->updateEvent($data, $request->id)){
            $events = Event::get();
            return new EventCollection($events);
        }
        else{
            return [
                'error' => 'Something goes wrong'
            ];
        }
    }
    public function insertEvent(\Illuminate\Http\Request $request, EventService $eventService){
        $data = $request->validate([
            'title' => ['required', 'string', 'max:10'],
            'notes' => ['required', 'string'],
            'dt_start' => ['required', 'date', 'after_or_equal:today'],
            'dt_end' => ['required', 'date', 'after:dt_start'],
            'user' => ['numeric']
        ]);
        if($eventService->createEvent($data)){
            $events = Event::get();
            return new EventCollection($events);
        }
        else{
            return [
                'error' => 'Something goes wrong'
            ];
        }
    }
}

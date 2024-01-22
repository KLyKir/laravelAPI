<?php

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Services\EventService;

class DeleteEventController extends Controller
{
    public function __invoke($id, EventService $eventService){
        return view('event.index', ['events' => $eventService->deleteEvent($id)]);
    }
}

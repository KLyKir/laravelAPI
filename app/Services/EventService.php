<?php

namespace App\Services;

use App\Models\Event;

class EventService
{
    public function createEvent($data){
        $event = new Event();
        $event->title = $data['title'];
        $event->notes = $data['notes'];
        $event->dt_start = $data['dt_start'];
        $event->dt_end = $data['dt_end'];
        $event->user_id =$data['user'];
        $event->save();
        return $event;
    }
    public function deleteEvent($id){
        $event = Event::findOrFail($id);
        $event->delete();
        return Event::get();
    }

    public function updateEvent($data, $id){
        $event = Event::query()->find($id);
        $event->title = $data['title'];
        $event->notes = $data['notes'];
        $event->dt_start = $data['dt_start'];
        $event->dt_end= $data['dt_end'];
        $event->user_id = $data['user'];
        $event->save();
        return $event;
    }
}

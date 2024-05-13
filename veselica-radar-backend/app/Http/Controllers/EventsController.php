<?php

namespace App\Http\Controllers;

use App\Models\Event;
use http\Client\Request;
use Laravel\Prompts\Concerns\Events;

class EventsController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    public function getById($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        return response()->json($event);
    }


}

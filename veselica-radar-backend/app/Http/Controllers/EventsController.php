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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'is_entrance_fee' => 'required|boolean',
            'entrance_fee' => 'required|numeric',
            'event_date' => 'required|date',
            'starting_hour' => 'required|date_format:H:i:s',
            'ending_hour' => 'required|date_format:H:i:s',
        ]);

        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $request->validate([
            'name' => 'string',
            'location' => 'string',
            'is_entrance_fee' => 'boolean',
            'entrance_fee' => 'numeric',
            'event_date' => 'date',
            'starting_hour' => 'date_format:H:i:s',
            'ending_hour' => 'date_format:H:i:s',
        ]);

        $event->update($request->all());

        return response()->json($event, 200);
    }
    public function destroy($id) {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();

        return response()->json(['message' => 'Event deleted'], 200);
    }


}

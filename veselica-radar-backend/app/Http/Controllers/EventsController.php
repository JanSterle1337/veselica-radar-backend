<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        /*$validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' => 'required|string',
            'is_entrance_fee' => 'required|boolean',
            'entrance_fee' => 'required|numeric',
            'event_date' => 'required|date',
            'starting_hour' => 'required|date_format:H:i:s',
            'ending_hour' => 'required|date_format:H:i:s',
        ]);



        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid data provided'], 404);
        }*/

        $event = Event::create($request->all());

        return response()->json($event, 201);
    }

    public function update(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        /*$request->validate([
            'name' => 'string',
            'location' => 'string',
            'is_entrance_fee' => 'boolean',
            'entrance_fee' => 'numeric',
            'event_date' => 'date',
            'starting_hour' => 'date_format:H:i:s',
            'ending_hour' => 'date_format:H:i:s',
        ]);*/

        if ($request->has('name')) {
            $event->name = $request->name;
        }
        if ($request->has('location')) {
            $event->location = $request->location;
        }
        if ($request->has('is_entrance_fee')) {
            $event->is_entrance_fee = $request->is_entrance_fee;
        }
        if ($request->has('event_date')) {
            $event->event_date = $request->event_date;
        }
        if ($request->has('starting_hour')) {
            $event->starting_hour = $request->starting_hour;
        }
        if ($request->has('ending_hour')) {
            $event->ending_hour = $request->ending_hour;
        }
        if ($request->has('entrance_fee')) {
            $event->entrance_fee = $request->entrance_fee;
        }

        $event->save();

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

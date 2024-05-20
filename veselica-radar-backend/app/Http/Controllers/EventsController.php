<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
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

        $request->merge([
            'starting_hour' => \Carbon\Carbon::parse($request->input('starting_hour'))->format('H:i'),
            'ending_hour' => \Carbon\Carbon::parse($request->input('ending_hour'))->format('H:i'),
        ]);

        Log::info($request->all());

        $rules = [
            'name' => 'required|string',
            'location' => 'required|string',
            'is_entrance_fee' => 'required|boolean',
            'entrance_fee' => 'required_if:is_entrance_fee,1|numeric',
            'event_date' => 'required|date',
            'starting_hour' => 'required|date_format:H:i',
            'ending_hour' => 'required|date_format:H:i|after:starting_hour',
            'is_confirmed' => 'required|boolean',
            'user_id' => 'required|exists:users,id'
        ];

        try {
            $validatedData = $request->validate($rules);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation error',
                'errors' => $e->errors(),
            ], 422);
        }

        // Debug: Log validated data
        Log::info('Validated Data before create:', $validatedData);

        // Create the event
        $event = Event::create($validatedData);

        // Debug: Log created event
        Log::info('Created Event:', $event->toArray());

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

<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return response()->json($statuses);
    }

    public function getById($user_Id, $event_Id)
    {
        $status = Status::where('user_id', $user_Id)->where('event_id', $event_Id)->first();


        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        return response()->json($status);
    }

    public function getAllByUserId($userId)
    {

        //$statuses = Status::where('user_id', $userId)->get();
        $results = DB::select('SELECT * FROM statuses WHERE user_id = ?', [$userId]);

        if ($results->isEmpty()) {
            return response()->json(['message' => 'No statuses found for the user'], 404);
        }

        return response()->json(json_encode($results));
    }


    public function getAllByEventId($eventId)
    {
        $statuses = Status::where('event_id', $eventId)->get();

        if ($statuses->isEmpty()) {
            return response()->json(['message' => 'No statusees found for the event'], 404);
        }

        return response()->json($statuses);
    }




    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'event_id' => 'required|exists:events,id',
            'status' => 'required|string',
        ]);

        $status = Status::create($request->all());

        return response()->json($status, 201);
    }

    public function update(Request $request, $userId, $eventId)
    {
        $status = Status::where('user_id', $userId)->where('event_id', $eventId)->first();

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        $request->validate([
            'status' => 'string',
        ]);

        $status->update($request->all());

        return response()->json($status, 200);
    }

    public function destroy($userId, $eventId)
    {
        $status = Status::where('user_id', $userId)->where('event_id', $eventId)->first();

        if (!$status) {
            return response()->json(['message' => 'Status not found'], 404);
        }

        $status->delete();

        return response()->json(['message' => 'Status deleted'], 200);
    }
}

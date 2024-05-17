<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }


    public function store(Request $request)
    {

        $order = Order::create($request->all());

        return response()->json($order, 201);
    }



    public function getById($id)
    {
        $order = Order::where('table_id', $id);

        if (!$order) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json($order, 201);
    }
    public function getByEventId($id)
    {
        $order = Order::where('event_id', $id);

        if (!$order) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json($order);
    }


    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        if($request->has('table_id'))
            $order->table_id = $request->table_id;
        if($request->has('event_id'))
            $order->event_id = $request->event_id;
        if($request->has('user_id'))
            $order->user_id = $request->user_id;
        if($request->has('drinks'))
            $order->drinks = $request->drinks;

        $order->save();

        return response()->json($order, 200);
    }


    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        $order->delete();

        return response()->json(['message' => 'Order deleted'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Drink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DrinkController extends Controller
{
    public function index()
    {
        $drinks = Drink::all();
        return response()->json($drinks);
    }

    public function getById($id)
    {
        $drink = Drink::find($id);

        if (!$drink) {
            return response()->json(['message' => 'Drink not found'], 404);
        }

        return response()->json($drink);
    }

    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'volume' => 'required|numeric',
        ]);*/

        $drink = Drink::create($request->all());

        return response()->json($drink, 201);
    }

    public function update(Request $request, $id)
    {
        $drink = Drink::find($id);

        if (!$drink) {
            return response()->json(['message' => 'Drink not found'], 404);
        }


        if ($request->has('name')) {
            $drink->name = $request->name;
        }
        if ($request->has('description')) {
            $drink->description = $request->description;
        }
        if ($request->has('volume')) {
            $drink->volume = $request->volume;
        }

        $drink->save();

        return response()->json($drink, 200);
    }

    public function destroy($id)
    {
        $drink = Drink::find($id);

        if (!$drink) {
            return response()->json(['message' => 'Drink not found'], 404);
        }

        $drink->delete();

        return response()->json(['message' => 'Drink deleted'], 200);
    }
}

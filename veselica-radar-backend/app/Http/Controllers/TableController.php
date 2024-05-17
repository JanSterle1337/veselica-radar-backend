<?php




namespace App\Http\Controllers;


use App\Models\Drink;
use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\table;

class TableController
{
    public function index()
    {
        $tables = Table::all();
        return response()->json($tables);
    }

    public function store(Request $request)
    {
        /*$request->validate([
            'name' => 'required|string',
            'event_id' => 'required|exists:events,id',
        ]);*/

        $table = Table::create($request->all());

        return response()->json($table, 201);
    }

    public function getById(Request $request, $id)
    {
        $table = Table::find($id);
        if (!$table) {
            return response()->json(['message' => 'Drink not found'], 404);
        }

        return response()->json($table, 200);
    }

    public function update(Request $request, $id)
    {
        $table = Table::find($id);

        if ($request->has('name')) {
            $table->name = $request->name;
        }
        if ($request->has('event_id')) {
            $table->event_id = $request->event_id;
        }

        $table->save();

        return response()->json($table, 200);
    }

    public function destroy($id)
    {
        $table = Table::find($id);

        if (!$table) {
            return response()->json(['message' => 'Drink not found'], 404);
        }

        $table->delete();

        return response()->json(['message' => 'Table deleted'], 200);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return Todo::with(["user" => function ($query) {
                $query->select(['name', 'email', "id"]);
            }])->get();
        } catch (\Throwable $th) {
            throw $th;
        }
        // return Todo::with('user:id,name,email')->get();
    }

    public function getAllTodoWithUser(Request $request, $userId)
    {
        try {
            $todo = Todo::where(['user_id' => $userId])->get();
            return response()->json($todo, 200);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id'
        ]);

        $todo = new Todo;
        $todo->name = $request->name;
        $todo->user_id = $request->user_id;
        $todo->save();

        return response()->json($todo, 201);
    }

    public function changeCompleteStatus(Request $request, $id)
    {
        $todo = Todo::findOrFail($id);
        if (!$todo) {
            return response()->json(['message' => 'Todo not found'], 404);
        }
        $todo->completed = !$todo->completed;
        $todo->save();
        return response()->json($todo, 200);
    }
}

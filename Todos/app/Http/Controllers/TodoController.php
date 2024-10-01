<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        // $todos = Todo::with('user')->get();
        $user = auth()->user();
        $todos = Todo::with('user')->where('user_id', $user->id)->get();
        return response()->json([
            'success' => true,
            'messgae' => "كل ال Todos ال عندك ياعبود ",
            'data' => $todos
        ], 200);
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::create($request->validated());
        return response()->json([
            'success' => true,
            'messgae' => "اضفت تمام يا عبوووود ",
            'data' => $todo
        ], 200);
    }
    public function show(string $id)
    {
        $todo = Todo::with('user')->findOrFail($id);
        return response()->json([
            'success' => true,
            'messgae' => "هو ده تمام ! ",
            'data' => $todo
        ], 200);
    }
    public function update(TodoRequest $request, string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->validated());
        return response()->json([
            'success' => true,
            'messgae' => "عدلته ي باشا الله ينور !",
            'data' => $todo
        ], 200);
    }
    public function destroy(string $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->delete();
        return response()->json([
            'success' => true,
            'messgae' => "عاااش ي صديقي مسحته تمام ! ",
        ], 200);
    }
}

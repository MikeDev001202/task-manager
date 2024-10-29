<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(ScheduleTaskRequest $request)
    {
        $validatedFields = $request->validated();

        $task = Tasks::scheduleTask($validatedFields);
        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        // Validate request
        $validatedFields = $request->validated();

        $task = Tasks::updateTask($validatedFields);
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}

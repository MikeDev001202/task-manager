<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Tasks;
use App\Http\Requests\ScheduleTaskRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskAssigned;

class TaskController extends Controller
{
    protected $root = 'task-manager';

    /**
     * Return schedule task view 
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
    */
    public function schedule()
    {
        $userSelect = User::getStandardUsers()
        ->pluck('name', 'id') 
        ->map(function ($name, $id) {
            $user = User::find($id); 
            return $user->name . ' ' . $user->surname;
        })
        ->toArray();
        return view('schedule', )->with(['userSelect' => $userSelect]);
    }

    /**
     * Store task details to database
     * 
     * @param ScheduleTaskRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function storeTask(ScheduleTaskRequest $request)
    {
        $validatedFields = $request->validated();
        $loggedInUser = Auth::user();
        $task = Tasks::scheduleTask($validatedFields, $loggedInUser->id);

        $lastTask = Tasks::getLatestTask()->get();
        Tasks::LogActivity($lastTask[0] -> id, 'Created');
        $user = User::getUserDetails($request->input('assigned_to'));
        if ($user) {
            Mail::to($user->email)->send(new TaskAssigned($task));
        }
        return redirect("$this->root/home")->with(['message' => 'Task successfully scheduled.']);
    }

    /**
     * Return view all tasks view 
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
    */
    public function viewAllTasks()
    {
        $tasks = Tasks::with(['assignedTo', 'assignedBy'])->get();
        $taskActivities = Tasks::getTasksActivity();
        return view('viewTasks', ['tasks' => $tasks, 'taskLogs' => $taskActivities]);
    }

    /**
     * Return view for task
     * 
     * @param $taskId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function viewTask($taskId)
    {
        $taskDetails = Tasks::getTask($taskId);
        return view('viewTask', ['task' => $taskDetails]);
    }

    /**
     * Return edit task view
     * 
     * @param $taskId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function editTask($taskId)
    {
        $taskDetails = Tasks::getTask($taskId);
        $userSelect = User::getStandardUsers()
        ->pluck('name', 'id') 
        ->map(function ($name, $id) {
            $user = User::find($id); 
            return $user->name . ' ' . $user->surname;
        })
        ->toArray();
        return view('editTask', ['task' => $taskDetails, 'userSelect' => $userSelect]);
    }

    public function updateTask(ScheduleTaskRequest $request, $taskId)
    {
        $validatedFields = $request->validated();
        $validatedFields['id'] = $taskId;
        $loggedInUser = Auth::user();
        Tasks::updateTask($validatedFields, $loggedInUser);

        Tasks::LogActivity($taskId, 'Updated');

        return redirect()->route('viewTasks')->with('message', 'Task updated successfully.');
    }

    public function deleteTask($taskId)
    {
        $task = Tasks::findOrFail($taskId);
        $task->delete();

        return redirect()->route('viewTasks')->with('message', 'Task deleted successfully.');
    }
}

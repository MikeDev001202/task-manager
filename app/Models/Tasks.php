<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Tasks extends Model
{

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'due_date',
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public static function getLatestTask()
    {
        return self::orderBy('created_at', 'desc')->first();
    }

    /**
     * Return task data
     * 
     * @param $taskId
     * @return
     */
    public static function getTask($taskId)
    {
        return self::where('id', $taskId)->first();
    }

    public static function getTasksActivity()
    {
        return \DB::table('activity_logs')->get();
    }

    /**
     * Populate the task schedular fields
     * 
     * @param $task
     * @param $title
     * @param $description
     * @param $due_date
     * @param $assignee
     * @param $assignedTo
     */
    private static function populateScheduleTaskFields($task, $title, $description, $due_date, $assignee, $assignedTo)
    {
        if($title !== '') {
            $task->title = $title;
        }
        if($description !== '') {
            $task->description = $description;
        }
        if($due_date !== '') {
            $task->due_date = $due_date;
        }
        if($assignee !== 0) {
            $task->assigned_by = $assignee;
        }
        if($assignedTo !== 0) {
            $task->assigned_to = $assignedTo;
        }
        
        return $task;
    }

    /**
     * Save the form fields to the database.
     *
     * @param $data
     * @param $assignee
     * @return mixed
     */
    public static function scheduleTask($data, $assignee)
    {
        $task = new Tasks();
        $task = self::populateScheduleTaskFields($task, $data['title'], $data['description'], $data['due_date'], $assignee, $data['assigned_to']);
        $task->save();

        return $task;
    }

    public static function updateTask($data, $loggedInUser)
    {
        $task = self::findOrFail($data['id']);

        $task->title = $data['title'];
        $task->description = $data['description'];
        $task->due_date = $data['due_date'];
        $task->assigned_to = $data['assigned_to'];
        
        $task->save();

        return $task;
    }

    public static function LogActivity($taskId, $action)
    {
        \DB::table('activity_logs')->insert([
            'task_id' => $taskId,
            'action' => $action,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

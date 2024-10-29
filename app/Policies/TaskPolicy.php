<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tasks;

class TaskPolicy
{
    public function editTasks(User $user, Tasks $task)
    {
        // check if user is the assignee or admin user
        return $user->isAdmin() || $user->id === $task->assigned_to;
    }

    public function deleteTasks(User $user, Tasks $task)
    {
        // check if user is the assignee or admin user
        return $user->isAdmin() || $user->id === $task->assigned_to;
    }
}

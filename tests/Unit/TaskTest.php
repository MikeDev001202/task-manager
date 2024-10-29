<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Tasks;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_task()
    {
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description',
            'due_date' => now()->addDays(5),
            'assigned_to' => 1,
        ];

        $loggedInUser = Auth::user()->id;

        $task = Tasks::scheduleTask($taskData, $loggedInUser);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
        ]);
    }
}

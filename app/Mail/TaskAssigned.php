<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    /**
     * Create a new message instance.
     *
     * @param $task
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.taskAssignEmail')
                    ->with([
                        'taskName' => $this->task->title,
                        'taskDescription' => $this->task->description,
                        'taskDue' => $this->task->due_date
                    ])
                    ->subject('New Task Assigned: ' . $this->task->name);
    }
}

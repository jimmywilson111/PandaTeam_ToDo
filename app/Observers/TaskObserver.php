<?php

namespace App\Observers;

use App\Events\UpdateTaskList;
use App\Mail\NotifyAdminTaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\Mail;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     *
     * @param Task $task
     * @return void
     */
    public function created(Task $task)
    {
        //
    }

    /**
     * Handle the Task "updated" event.
     *
     * @param Task $task
     * @return void
     */
    public function updated(Task $task)
    {
        if ($task->isDirty('status')) {
            Mail::to(env('ADMIN_EMAIL'))->send(new NotifyAdminTaskStatus($task));
//            event(new UpdateTaskList($task));
        }
    }

    /**
     * Handle the Task "deleted" event.
     *
     * @param Task $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the Task "restored" event.
     *
     * @param Task $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the Task "force deleted" event.
     *
     * @param Task $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    /**
     * Determine whether the user can view any Task.
     */
    public function viewAny(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can view the Task.
     */
    public function view(User $user, Task $task): Response
    {
        //
        return $user->id === $task->user_id 
                            ? Response::allow()
                            // : Response::deny("No Task assigned currently");
                            : Response::denyAsNotFound("No task assigned");
    }

    /**
     * Determine whether the user can create Task.
     */
    public function create(User $user): bool
    {
        //
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): Response
    {
        //
        return $user->id === $task->user_id 
                            ? Response::allow()
                            : Response::deny("You have no permission to update this Task");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): Response
    {
        //
        return $user->id === $task->user_id 
        ? Response::allow()
        : Response::deny("You have no permission to Delete this Task");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        return false;
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        //
        return false;
    }
}

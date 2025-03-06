<?php

namespace App\Policies;

use App\Models\User;
use App\Models\WorkExperience;
use Illuminate\Auth\Access\Response;

class WorkExperiencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, WorkExperience $workExperience): bool
    {
        return $user->id === $workExperience->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, WorkExperience $workExperience): bool
    {
        return $user->id === $workExperience->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, WorkExperience $workExperience): bool
    {
        return $user->id === $workExperience->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, WorkExperience $workExperience): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, WorkExperience $workExperience): bool
    {
        return false;
    }
}

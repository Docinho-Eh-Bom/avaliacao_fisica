<?php

namespace App\Policies;

use App\Models\TestBattery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestBatteryPolicy
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
    public function view(User $user, TestBattery $testBattery): bool
    {
        return $testBattery->student->user_id === $user->id;
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
    public function update(User $user, TestBattery $testBattery): bool
    {
        return $testBattery->student->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TestBattery $testBattery): bool
    {
        return $testBattery->student->user_id === $user->id;
    }
}

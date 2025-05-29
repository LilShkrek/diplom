<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Facility;

class FacilityPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['operator', 'manager']);
    }

    public function view(User $user, Facility $facility): bool
    {
        return $user->hasRole(['operator', 'manager']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('operator');
    }

    public function update(User $user, Facility $facility): bool
    {
        return $user->hasRole('operator');
    }

    public function delete(User $user, Facility $facility): bool
    {
        return $user->hasRole('operator');
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Licence;

class LicencePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole(['operator', 'manager']);
    }

    public function view(User $user, Licence $licence): bool
    {
        return $user->hasRole(['operator', 'manager']);
    }

    public function create(User $user): bool
    {
        return $user->hasRole('operator');
    }

    public function update(User $user, Licence $licence): bool
    {
        return $user->hasRole('operator');
    }

    public function delete(User $user, Licence $licence): bool
    {
        return $user->hasRole('operator');
    }

    public function export(User $user): bool
    {
        return $user->hasRole(['operator', 'manager']);
    }
}

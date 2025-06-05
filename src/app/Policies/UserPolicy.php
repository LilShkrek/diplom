<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function view(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }

    public function create(User $user): bool
    {
        return $user->hasRole('admin');
    }

    public function update(User $user, User $model): bool
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, User $model): bool
    {
        // Админ не может удалить самого себя
        return $user->hasRole('admin') && $user->id !== $model->id;
    }

    public function export(User $user): bool
    {
        return $user->hasRole('admin');
    }
}

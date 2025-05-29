<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', User::class);

        return Inertia::render('User/Index', [
            'users' => User::with('roles')
                ->latest()
                ->paginate(10)
                ->through(fn($user) => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->getRoleNames(),
                    'created_at' => $user->created_at->format('d.m.Y'),
                ])
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return Inertia::render('User/Create', [
            'roles' => Role::pluck('name')
        ]);
    }

    public function store(UserRequest $request)
    {
        $this->authorize('create', User::class);

        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);

            $user = User::create($data);
            $user->assignRole($request->input('role'));
        });

        return redirect()->route('user.index')->with('success', 'Пользователь создан!');
    }

    public function show(User $user)
    {
        $this->authorize('view', $user);

        return Inertia::render('User/Show', [
            'user' => $user->load('roles'),
            'permissions' => $user->getAllPermissions()->pluck('name')
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return Inertia::render('User/Edit', [
            'user' => $user->load('roles'),
            'allRoles' => Role::pluck('name'),
            'currentRoles' => $user->getRoleNames()
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);

        DB::transaction(function () use ($request, $user) {
            $data = $request->validated();

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']); // чтобы не затирался старый
            }

            $user->update($data);

            $user->syncRoles($request->input('role'));
        });

        return redirect()->route('user.index')->with('success', 'Пользователь обновлен!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        abort_if($user->id === auth()->id(), 403, 'Нельзя удалить свой аккаунт');

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Пользователь удален!');
    }
}

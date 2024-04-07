<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Jobs\StoreUserJob;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create() {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $storeUserJob = new StoreUserJob($data);
        $storeUserJob->handle();
        return redirect()->route('admin.user.index');
    }

    public function show(User $user) {
        return view('admin.user.show', compact('user'));
    }

    public function edit(User $user) {
        $roles = Role::all();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user){
        $data = $request->validated();
        $role = $data['role'];
        unset($data['role']);
        $user->update($data);
        $user->syncRoles($role);
        return redirect()->route('admin.user.index');

    }

    public function destroy(User $user) {
        $user->removeRole($user->getRoleNames()->first());
        $user->delete();
        return redirect()->route('admin.user.index' );
    }
}

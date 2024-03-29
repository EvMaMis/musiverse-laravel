<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::withCount('users')->withCount('permissions')->get();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        if (isset($data['permissions'])) {
            $permissions = $data['permissions'];
            unset($data['permissions']);

        }
        $role = Role::firstOrCreate($data);
        if (isset($permissions)) {
            $role->syncPermissions($permissions);
        }
        return redirect()->route('admin.role.index');
    }

    public function show(Role $role) {
        $users = User::role($role->name)->get();
        return view('admin.role.show', compact('role', 'users'));
    }

    public function edit(Role $role) {
        dd(2222);
    }

    public function update() {
        dd(3333);
    }

    public function destroy(Role $role) {
        dd('delete');
    }
}

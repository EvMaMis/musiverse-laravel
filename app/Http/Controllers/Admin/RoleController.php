<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\StoreRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        dd($data);
    }
}

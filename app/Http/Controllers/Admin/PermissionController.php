<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index() {
        $permissions = Permission::all();
        return view('admin.permission.index', compact('permissions'));
    }

    public function create() {
        return view('admin.permission.create');
    }

    public function store() {
        dd(1);
    }
}

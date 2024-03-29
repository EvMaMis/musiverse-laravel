<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Jobs\StoreUserJob;
use App\Models\User;
use Illuminate\Http\Request;
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

    public function show() {

    }

    public function edit() {

    }

    public function update(){

    }

    public function destroy() {

    }
}

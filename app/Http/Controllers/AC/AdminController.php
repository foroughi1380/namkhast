<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcAdminEditRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return Inertia::render('AC/admins', [
            'admins' => $admins
        ]);
    }

    public function edit($id)
    {
        $admin = Admin::query()->find($id);
        return Inertia::render('AC/adminEdit', [
            'admin' => $admin
        ]);
    }

    public function update($id , Request $request)
    {
        $request->validate([
            "name" => "required|max:50",
            "family" => "required|max:70",
            "phone" => "required|digits:11|regex:/^09\d{9}$/|unique:admin,phone,". $id,
            "email" => "required|unique:admin,email,". $id,
        ]);

        $admin = Admin::query()->find($id);
        $admin->update($request->all());

        return Inertia::render('AC/admins');
    }
}

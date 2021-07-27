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

    public function update($id , AcAdminEditRequest $request)
    {
        dd($request);
        $admin = Admin::query()->find($id);
        return Inertia::render('AC/adminEdit', [
            'admin' => $admin
        ]);

    }

}

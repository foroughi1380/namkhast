<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
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
}

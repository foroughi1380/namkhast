<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    function index()
    {
        return Inertia::render("AC/Users");
    }
}

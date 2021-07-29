<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Models\AuthRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthRequestController extends Controller
{
    public function index(){
        $authRequests = AuthRequest::all()->makeVisible(['try' , 'nc_picture' , 'user_id']);

        return Inertia::render("AC/authRequests" , [
            'authRequests' => $authRequests
        ]);
    }

    public function edit($id){

    }

    public function update($id){

    }
}

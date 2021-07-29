<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcAuthRequestEditRequest;
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
        $authRequest = AuthRequest::query()->find($id)->makeVisible(['try' , 'nc_picture' , 'user_id']);

        return Inertia::render("AC/authRequestEdit" , [
            'authRequest' => $authRequest
        ]);
    }

    public function update($id , AcAuthRequestEditRequest $request){
        $authRequest = AuthRequest::query()->find($id);
        $authRequest->update($request->all());

        return Inertia::render('AC/authRequestEdit');
    }
}

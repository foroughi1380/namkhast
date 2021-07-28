<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthRequestRequest;
use App\Models\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthRequestController extends Controller
{
    public function store(UserAuthRequestRequest $request)
    {
        $id = Auth::user()->id;

        $auth = AuthRequest::query()->find($id);
        if ($auth){
            $auth->national_code = $request->get("nationalCode");
            Storage::delete($auth->ncPicture);
            $auth->nc_picture = $request->file("ncPicture")->store("nc" , "private");
            $auth->status = "pending";
            $auth->try += 1;
        }else{
            $auth = new AuthRequest();
            $auth->user_id = $id;
            $auth->national_code = $request->get("nationalCode");
            $auth->nc_picture = $request->file("ncPicture")->store("nc" , "private");
            $auth->try += 1;
        }

        if ($auth->save()){
            return Inertia::render("Web/profileEdit");
        }

        throw  ValidationException::withMessages([
            "token" => "خطای غیر منطزره ای در سرور رخ داده است."
        ]);

    }
}

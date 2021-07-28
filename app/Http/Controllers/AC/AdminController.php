<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Http\Requests\AcAdminCreateRequest;
use App\Http\Requests\AcAdminEditRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function create(){
        return Inertia::render('AC/adminCreate');
    }

    public function store(AcAdminCreateRequest $request){

        if(DB::table('admin')->insert(['name'=>$request->get('name'),'family'=>$request->get('family'),'phone'=>$request->get('phone'),'email'=>$request->get('email'),'password'=>Hash::make($request->get('password'))])){
            return Inertia::render("AC/adminCreate");
        }else{
            return Inertia::render("AC/adminCreate" , [
                'errors' => ['term' => 'متاسفانه خطایی در سامانه رخ داده است.']
            ]);
        }
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
            "email" => "required|email|unique:admin,email,". $id,
        ]);

        $admin = Admin::query()->find($id);
        $admin->update($request->all());

        return Inertia::render('AC/admins');
    }
}

<?php

namespace App\Http\Controllers\AC;

use App\Http\Controllers\Controller;
use App\Http\Requests\configAddRequest;
use App\Http\Requests\UpdateConfigureRequest;
use App\Models\Config;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render("AC/configs" , [
            "configs" => Config::all()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create(configAddRequest $request)
    {
        $defaultValue = ['value'=>""];
        switch ($request->get("type")){
            case "array": $defaultValue['value'] = []; break;
            case "boolean": $defaultValue['value'] = false; break;
            case "float": $defaultValue['value'] = 0; break;
        }
        if(Config::create(array_merge($request->only(['name' , 'key' , 'type']) , $defaultValue))){
            return $this->index();
        }else{
            throw ValidationException::withMessages(["unknown"=>"خطای ناشناخته ای رخ داده است"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Inertia\Response
     */
    public function store(UpdateConfigureRequest $request)
    {
        $modified = $request->get("modified");
        $deleted = $request->get("deleted");
        foreach ($modified as $modify){
            if (is_array($modify['value'])){
                $data = [];
                foreach($modify['value'] as $item){
                    $data[] = $item['value'];
                }
                Config::setWithId($modify['id'] , $data);
            }else{
                Config::setWithId($modify['id'] , $modify['value']);
            }
        }

        foreach ($deleted as $del) {
            Config::deleteWithId($del);
        }

        return $this->index();
    }
}

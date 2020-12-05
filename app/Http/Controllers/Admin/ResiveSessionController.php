<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\SessionResource;
use App\SessionResive;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResiveSessionController extends Controller
{
    public function index(){
        return view('admin.sessions.index');
    }

    public function getAll(){
        $sessions= SessionResive::where('type','!=','no')->latest()->paginate();
        return SessionResource::collection($sessions);
    }

    public function store(Request $request){
        SessionResive::find($request->id)->update([
            'resive_time'=>Carbon::parse($request->date),
            'type'=>'ok'
        ]);
    }
}

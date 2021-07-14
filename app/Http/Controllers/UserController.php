<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        return Inertia::render('User/Index');
    }

    public function list(Request $request){
        // Ajax
        if(!$request->ajax()){
            abort(404);
        }
        $user_list = User::all();
        return $user_list;
    }
}

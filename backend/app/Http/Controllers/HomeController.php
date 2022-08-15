<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['user_total'] = User::count();
        $data['group_total'] = Group::count();
        return view('home',$data);
    }
}

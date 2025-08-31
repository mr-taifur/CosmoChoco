<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // User dashboard
    public function index()
    {
        return view('user.dashboard');
    }

}

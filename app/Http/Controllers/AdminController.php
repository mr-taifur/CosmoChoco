<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin dashboard
    public function index()
    {
        return view('admin.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return redirect()->route('dashboard');
    }
    public function dashboard(){
        return view('dashboard');
    }
}

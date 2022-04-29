<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function patient(){
        return view('pages.patient');
    }
    
    public function login(){
        return view('pages.login');
    }
}

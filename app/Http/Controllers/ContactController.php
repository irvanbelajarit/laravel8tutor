<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
       //echo "ini test controller";
       return view('contact');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){

        return view('student.home');
    }
    public function about(){

        return view('student.about');

    }

    public function contact(){
        return view('student.contact');
    }

}

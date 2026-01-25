<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function checklogin(Request $request) {
        $name = $request -> input('name');
        $pass = $request -> input('pass');
        if ($name === 'NguyenDacDien' && $pass === '0004667'){
            return view('Auth.Login', ['success' => 'Login successful!']);
        } else {
            return view('Auth.Login', ['error' => 'Invalid username or password.']);
        }
    }

    public function login() {
        return view('Auth.Login');
    }

    public function register() {
        return view('Auth.Register');
    }

    public function checkregister( Request $request) {
        $name= $request -> input('name');
        $pass= $request -> input('pass');
        if($name == "NguyenDacDien" && $pass == "0004667"){
            return view('Auth.Login', ['success' => 'Registration successful! Please log in.']);
        } else {
            return view('Auth.Register', ['error' => 'Information does not match']);
        }
    }
}

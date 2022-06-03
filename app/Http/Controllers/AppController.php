<?php

namespace App\Http\Controllers;

class AppController extends Controller
{
    public function app() {
        return view("welcome");
    }

    public function register() {
        return view("layouts.register");
    }

    public function login() {
        return view("layouts.login");
    }

    public function adminLogin() {
        return view("layouts.admin.login");
    }

    public function adminRegister() {
        return view("layouts.admin.register");
    }
}

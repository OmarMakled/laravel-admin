<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        return view('admin.auth');
    }

    public function home(Request $request)
    {
        return view('admin.home');
    }

    public function index(string $model)
    {
        return view('admin.index', compact('model'));
    }

    public function form(string $model, string $id = null, Request $request)
    {
        return view('admin.form', compact('model', 'id'));
    }

    public function upload(string $model, string $id, Request $request)
    {
        return view('admin.upload', compact('model', 'id'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\ListingRepository;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $repo = new ListingRepository;

        $repo->search($request->locale, $request->all());

        return view('pages/home');
    }
}

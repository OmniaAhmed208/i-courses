<?php

namespace App\Http\Controllers;

class BannedController extends Controller
{
    public function index()
    {
        return view('website.banned');
    }
}

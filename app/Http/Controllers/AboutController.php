<?php

namespace App\Http\Controllers;


class AboutController extends Controller
{
    public function index()
    {
        return view('website.about');
    }

    public function about_teacher()
    {
        return view('website.about_teacher');
    }
}

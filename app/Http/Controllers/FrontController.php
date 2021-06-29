<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontController extends Controller
{
    //
    public function index()
    {
        return view('frontend.index');
    }

    public function getnews()
    {
        return view('frontend.news');
    }

    public function newsdetails($id, $slug)
    {
        return view('frontend.news-details');
    }
}

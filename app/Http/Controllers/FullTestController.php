<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullTestController extends Controller
{
    public function index()
    {
        return view('backend.fulltest.index');
    }

    public function create()
    {
        return view('backend.fulltest.create');
    }

    public function results()
    {
        return view('backend.fulltest.results');
    }
}

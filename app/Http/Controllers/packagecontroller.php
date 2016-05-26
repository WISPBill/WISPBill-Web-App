<?php

namespace App\Http\Controllers;

class packagecontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('package.new');
    }


}

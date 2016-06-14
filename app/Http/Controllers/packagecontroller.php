<?php

namespace App\Http\Controllers;

class packagecontroller extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    public function create()
    {
        return view('package.new');
    }


}

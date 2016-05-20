<?php

namespace App\Http\Controllers;

use Gate;

use Illuminate\Http\Request;

use App\Http\Requests;

class settingscontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function main()
    {
        if (Gate::denies('admin')) {
            abort(403,'Unauthorized action.');
        }

    }
}

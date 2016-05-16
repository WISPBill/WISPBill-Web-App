<?php

namespace App\Http\Controllers;

use View;
use Redirect;
use Illuminate\Http\Request;
use App\Models\Tower;

class TowerController extends Controller {

    public function showTowers() {
        $towers = Tower::all();
        return View::make('towers')->with(compact('towers'));
    }

    public function updateTowers(Request $request) {
        $tower = Tower::find($request->tower_id);
        $tower->name = $request->tower_name;
        $tower->street_address_1 = $request->tower_staddr1;
        $tower->street_address_2 = $request->tower_staddr2;
        $tower->city = $request->tower_city;
        $tower->state = $request->tower_state;
        $tower->zip = $request->tower_zip;
        $tower->save();
        
        return Redirect::route('towers');
    }

}

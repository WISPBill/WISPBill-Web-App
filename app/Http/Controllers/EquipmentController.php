<?php
    
    namespace App\Http\Controllers;

    use Input;
    use Redirect;
    use View;
    use App\Models\Antenna;
    use App\Models\ConnectorizedRadio;
    use App\Models\IntegratedRadio;
    use App\Models\Poe;
    use App\Models\RadioCard;
    use App\Models\Router;
    use App\Http\Controllers\Controller;

class EquipmentController extends Controller {

    public function showEquipment(){
        
        $antennas = Antenna::all();
        $radio_cards = RadioCard::all();
        $routers = Router::all();
        $poes = Poe::all();
        $connectorized_radios = ConnectorizedRadio::all();
        $integrated_radios = IntegratedRadio::all();
        
        return View::make('equipment')->with(compact('antennas', 'radio_cards', 'routers', 'poes', 'connectorized_radios', 'integrated_radios'));
    }
    
    public function updateEquipment(){
        if(Input::get('antenna_id') != ''){
            $antenna = Antenna::find(Input::get('antenna_id'));
            $antenna->mfg = Input::get('antenna_mfg');
            $antenna->model = Input::get('antenna_model');
            $antenna->total = Input::get('antenna_total');
            $antenna->save();
        }
        if(Input::get('new_antenna_model') != ''){
            $new_antenna = new Antenna;
            $new_antenna->mfg = Input::get('new_antenna_mfg');
            $new_antenna->model = Input::get('new_antenna_model');
            $new_antenna->total = Input::get('new_antenna_total');
            $new_antenna->save();
        }
        if(Input::get('radio_card_id') != ''){
            $radio_card = RadioCard::find(Input::get('radio_card_id'));
            $radio_card->mfg = Input::get('radio_card_mfg');
            $radio_card->model = Input::get('radio_card_model');
            $radio_card->total = Input::get('radio_card_total');
            $radio_card->save();
        }
        if(Input::get('new_radio_card_model') != ''){
            $new_radio_card = new RadioCard;
            $new_radio_card->mfg = Input::get('new_radio_card_mfg');
            $new_radio_card->model = Input::get('new_radio_card_model');
            $new_radio_card->total = Input::get('new_radio_card_total');
            $new_radio_card->save();
        }
        if(Input::get('poe_id') != ''){
            $poe = Poe::find(Input::get('poe_id'));
            $poe->mfg = Input::get('poe_mfg');
            $poe->model = Input::get('poe_model');
            $poe->total = Input::get('poe_total');
            $poe->save();
        }
        if(Input::get('new_poe_model') != ''){
            $new_poe = new Poe;
            $new_poe->mfg = Input::get('new_poe_mfg');
            $new_poe->model = Input::get('new_poe_model');
            $new_poe->total = Input::get('new_poe_total');
            $new_poe->save();
        }
        if(Input::get('router_id') != ''){
            $router = Router::find(Input::get('router_id'));
            $router->mfg = Input::get('router_mfg');
            $router->model = Input::get('router_model');
            $router->total = Input::get('router_total');
            $router->save();
        }
        if(Input::get('new_router_model') != ''){
            $new_router = new Router;
            $new_router->mfg = Input::get('new_router_mfg');
            $new_router->model = Input::get('new_router_model');
            $new_router->total = Input::get('new_router_total');
            $new_router->save();
        }
        if(Input::get('integrated_radio_id') != ''){
            $integrated_radio = IntegratedRadio::find(Input::get('integrated_radio_id'));
            $integrated_radio->mfg = Input::get('integrated_radio_mfg');
            $integrated_radio->model = Input::get('integrated_radio_model');
            $integrated_radio->total = Input::get('integrated_radio_total');
            $integrated_radio->save();
        }
        if(Input::get('new_integrated_radio_model') != ''){
            $new_integrated_radio = new IntegratedRadio;
            $new_integrated_radio->mfg = Input::get('new_integrated_radio_mfg');
            $new_integrated_radio->model = Input::get('new_integrated_radio_model');
            $new_integrated_radio->total = Input::get('new_integrated_radio_total');
            $new_integrated_radio->save();
        }
        if(Input::get('connectorized_radio_id') != ''){
            $connectorized_radio = ConnectorizedRadio::find(Input::get('connectorized_radio_id'));
            $connectorized_radio->mfg = Input::get('connectorized_radio_mfg');
            $connectorized_radio->model = Input::get('connectorized_radio_model');
            $connectorized_radio->total = Input::get('connectorized_radio_total');
            $connectorized_radio->save();
        }
        if(Input::get('new_connectorized_radio_model') != ''){
            $new_connectorized_radio = new ConnectorizedRadio;
            $new_connectorized_radio->mfg = Input::get('new_connectorized_radio_mfg');
            $new_connectorized_radio->model = Input::get('new_connectorized_radio_model');
            $new_connectorized_radio->total = Input::get('new_connectorized_radio_total');
            $new_connectorized_radio->save();
        }
        
        return Redirect::route('equipment');
    }

}

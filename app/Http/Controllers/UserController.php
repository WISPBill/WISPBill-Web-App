<?php

    namespace App\Http\Controllers;

    use DB;
    use Input;
    use Redirect;
    use View;
    use Illuminate\Http\Request;
    use App\User;
    use App\Models\Antenna;
    use App\Models\Company;
    use App\Models\ConnectorizedRadio;
    use App\Models\Device;
    use App\Models\IntegratedRadio;
    use App\Models\PaymentType;
    use App\Models\Poe;
    use App\Models\RadioCard;
    use App\Models\Router;
    use App\Models\Service;
    use App\Models\ServiceLocation;
    use App\Http\Controllers\Controller;

class UserController extends Controller {

    public function showActiveUsers() {
        $users = User::where('active', '=', 1)->get();
        return view('users')->with(compact('users'));
    }

    public function userDetails() {
        /*
         *
          Display all SQL executed in Eloquent


          Event::listen('illuminate.query', function($query) {
          var_dump($query);
          });
         *
         */

        $u_id = Input::get('id');
        $user = User::find($u_id);
        $service_locations = ServiceLocation::where('user_id', '=', $u_id)->get();
        $devices = Device::leftJoin('service_locations', 'devices.service_location_id', '=', 'service_locations.id')
                ->where('service_locations.user_id', '=', $u_id)
                ->select('devices.id', 'devices.service_location_id', 'devices.antenna_id', 'devices.radio_card_id', 'devices.router_id', 'devices.poe_id', 'devices.connectorized_radio_id', 'devices.integrated_radio_id', 'devices.mac_address', 'devices.notes')
                ->get();
        $currentIps = array();
        foreach ($devices as $device) {
            $currentIps[] = DB::table('ips')
                    ->select(DB::raw('id , INET_NTOA(address)'))
                    ->where('device_id', '=', $device->id)
                    ->lists('INET_NTOA(address)', 'INET_NTOA(address)');
        }

        $antenna_list = Antenna::all()->lists('model', 'id');
        $radio_card_list = RadioCard::all()->lists('model', 'id');
        $router_list = Router::all()->lists('model', 'id');
        $poe_list = Poe::all()->lists('model', 'id');
        $connectorized_radio_list = ConnectorizedRadio::all()->lists('model', 'id');
        $integrated_radio_list = IntegratedRadio::all()->lists('model', 'id');
        $service_list = Service::all()->groupBy('name')->lists('name', 'id');
        $company_list = Company::all()->lists('name', 'id');
        $payment_type_list = PaymentType::all()->lists('name', 'id');
        $device_location_list = ServiceLocation::where('user_id', '=', $u_id)->lists('street_address_1', 'id');

        return View::make('userDetails')->with(compact('user', 'service_locations', 'devices', 'currentIps', 'oldIps', 'antenna_list', 'radio_card_list', 'router_list', 'poe_list', 'connectorized_radio_list', 'integrated_radio_list', 'service_list', 'company_list', 'payment_type_list', 'device_location_list'));
    }

    public function updateUserDetails(Request $request) {

        /* Display all SQL executed in Eloquent
          Event::listen('illuminate.query', function($query) {
          var_dump($query);
          });
         *
         */

        $user = User::find(Input::get('id'));
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->name = Input::get('last_name').', '.Input::get('first_name');
        $user->business_name = Input::get('business_name');
        $user->notes = Input::get('notes');
        $user->billing_street_address_1 = Input::get('billing_street_address_1');
        $user->billing_street_address_2 = Input::get('billing_street_address_2');
        $user->billing_city = Input::get('billing_city');
        $user->billing_state = Input::get('billing_state');
        $user->billing_zip = Input::get('billing_zip');
        if (Input::get('email') != ''){
        $user->email = Input::get('email');
        }
        $user->phone_1 = Input::get('phone_1');
        $user->phone_2 = Input::get('phone_2');
        $user->payment_type_id = Input::get('payment_type_id');
        $user->save();

        $service_locations = ServiceLocation::where('user_id', '=', Input::get('id'))->get();
        for ($i = 0; $i < $service_locations->count(); $i++) {
            $service_locations[$i]->business_name = Input::get($i . 'business_name');
            $service_locations[$i]->street_address_1 = Input::get($i . 'street_address_1');
            $service_locations[$i]->street_address_2 = Input::get($i . 'street_address_2');
            $service_locations[$i]->city = Input::get($i . 'city');
            $service_locations[$i]->state = Input::get($i . 'state');
            $service_locations[$i]->zip = Input::get($i . 'zip');
            $service_locations[$i]->company_id = (Input::get($i . 'company') != '') ? Input::get($i . 'company') : Null;
            $service_locations[$i]->service_id = (Input::get($i . 'service') != '') ? Input::get($i . 'service') : Null;
            $service_locations[$i]->install_date = Input::get($i . 'install_date');
            $service_locations[$i]->termination_date = Input::get($i . 'termination_date');
            $service_locations[$i]->notes = Input::get($i . 'notes');
            $service_locations[$i]->active = Input::get($i . 'active');
            $service_locations[$i]->blocked = Input::get($i . 'blocked');
            $service_locations[$i]->save();
        }
        if (Input::get('new_active') == '1') {
            $new_service_location = new ServiceLocation;
            $new_service_location->user_id = Input::get('id');
            if (Input::get('new_main_location') == 'true') {
                $new_service_location->business_name = Input::get('business_name');
                $new_service_location->street_address_1 = Input::get('billing_street_address_1');
                $new_service_location->street_address_2 = Input::get('billing_street_address_2');
                $new_service_location->city = Input::get('billing_city');
                $new_service_location->state = Input::get('billing_state');
                $new_service_location->zip = Input::get('billing_zip');
            } else {
                $new_service_location->business_name = Input::get('new_business_name');
                $new_service_location->street_address_1 = Input::get('new_street_address_1');
                $new_service_location->street_address_2 = Input::get('new_street_address_2');
                $new_service_location->city = Input::get('new_city');
                $new_service_location->state = Input::get('new_state');
                $new_service_location->zip = Input::get('new_zip');
            }
            $new_service_location->company_id = (Input::get('new_company') != '') ? Input::get('new_company') : Null;
            $new_service_location->service_id = (Input::get('new_service') != '') ? Input::get('new_service') : Null;
            $new_service_location->install_date = Input::get('new_install_date');
            $new_service_location->termination_date = Input::get('new_termination_date');
            $new_service_location->notes = Input::get('new_notes');
            $new_service_location->save();
        }


        return Redirect::route('userDetails', array('id'=>Input::get('id')));
        //print_r(Input::all());
    }

    public function newUser() {
        $service_list = Service::all()->groupBy('name')->lists('name', 'id');
        $company_list = Company::all()->lists('name', 'id');
        $payment_type_list = PaymentType::all()->lists('name', 'id');

        return View::make('userNew')->with(compact('service_list', 'company_list', 'payment_type_list'));
    }

    public function addUser() {

        $user = new User;
        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->name = Input::get('last_name').', '.Input::get('first_name');
        $user->business_name = Input::get('business_name');
        $user->notes = Input::get('notes');
        $user->billing_street_address_1 = Input::get('billing_street_address_1');
        $user->billing_street_address_2 = Input::get('billing_street_address_2');
        $user->billing_city = Input::get('billing_city');
        $user->billing_state = Input::get('billing_state');
        $user->billing_zip = Input::get('billing_zip');
        $user->email = Input::get('email');
        $user->phone_1 = Input::get('phone_1');
        $user->phone_2 = Input::get('phone_2');
        $user->payment_type_id = Input::get('payment_type_id');
        $user->save();
        $u_id = $user->id;


        $new_service_location = new ServiceLocation;
        $new_service_location->user_id = $u_id;
        if (Input::get('new_main_location') == 'true') {
            $new_service_location->business_name = Input::get('business_name');
            $new_service_location->street_address_1 = Input::get('billing_street_address_1');
            $new_service_location->street_address_2 = Input::get('billing_street_address_2');
            $new_service_location->city = Input::get('billing_city');
            $new_service_location->state = Input::get('billing_state');
            $new_service_location->zip = Input::get('billing_zip');
        } else {
            $new_service_location->business_name = Input::get('new_business_name');
            $new_service_location->street_address_1 = Input::get('new_street_address_1');
            $new_service_location->street_address_2 = Input::get('new_street_address_2');
            $new_service_location->city = Input::get('new_city');
            $new_service_location->state = Input::get('new_state');
            $new_service_location->zip = Input::get('new_zip');
        }
        $new_service_location->company_id = (Input::get('new_company') != '') ? Input::get('new_company') : Null;
        $new_service_location->service_id = (Input::get('new_service') != '') ? Input::get('new_service') : Null;
        $new_service_location->install_date = Input::get('new_install_date');
        $new_service_location->termination_date = Input::get('new_termination_date');
        $new_service_location->notes = Input::get('new_notes');
        $new_service_location->save();
        $s_id = $new_service_location->id;

        return Redirect::route('userDetails', array('id' => $u_id));
        //print_r(Input::all());
    }

}

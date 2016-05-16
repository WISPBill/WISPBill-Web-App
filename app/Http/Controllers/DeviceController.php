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

class DeviceController extends Controller {

    public function updateDevice(Request $request) {
        $device = Device::find($request->device_id);
        $user = User::find($request->id);
        $macro = '{$IP}';

        $current_ip = $request->current_ip;
        if ($request->ip == '' || $request->ip == $current_ip) {
            $new_ip = null;
            $newHost_id = null;
        }
        $device->service_location_id = (Input::get('device_location') != '') ? Input::get('device_location') : Null;
        $device->mac_address = Input::get('mac_address');
        $device->poe_id = (Input::get('poe') != '') ? Input::get('poe') : Null;
        $device->radio_card_id = (Input::get('radio_card') != '') ? Input::get('radio_card') : Null;
        $device->antenna_id = (Input::get('antenna') != '') ? Input::get('antenna') : Null;
        $device->router_id = (Input::get('router') != '') ? Input::get('router') : Null;
        $device->integrated_radio_id = (Input::get('integrated_radio') != '') ? Input::get('integrated_radio') : Null;
        $device->notes = Input::get('device_notes');
        $device->save();

        if ($request->ip != $current_ip) {
        DB::table('ips')
                ->where('address', '=', ip2long($new_ip))
                ->update(array('device_id' => Input::get('device_id'), 'used' => '1'));
        DB::table('ips')
                ->where('address', '=', ip2long($current_ip))
                ->update(array('device_id' => Null, 'used' => '0'));
        } else {
            return Redirect::route('userDetails', array('id' => $request->id));
        }
    }

    public function newDevice(Request $request) {
        $user = User::find($request->id);
        $macro = '{$IP}';

        $new_device = new Device;
        $new_device->service_location_id = Input::get('new_device_location');
        $new_device->mac_address = Input::get('new_mac_address');
        $new_device->poe_id = (Input::get('new_poe') != '') ? Input::get('new_poe') : Null;
        $new_device->radio_card_id = (Input::get('new_radio_card') != '') ? Input::get('new_radio_card') : Null;
        $new_device->antenna_id = (Input::get('new_antenna') != '') ? Input::get('new_antenna') : Null;
        $new_device->router_id = (Input::get('new_router') != '') ? Input::get('new_router') : Null;
        $new_device->integrated_radio_id = (Input::get('new_integrated_radio') != '') ? Input::get('new_integrated_radio') : Null;
        $new_device->notes = Input::get('new_device_notes');
        $new_device->save();

        DB::table('ips')
                ->where('address', '=', ip2long($new_ip))
                ->update(array('device_id' => $new_device->id, 'used' => '1'));
    }

}

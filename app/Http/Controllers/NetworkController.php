<?php

namespace App\Http\Controllers;

use View;
use App\Http\Requests\PrepareNetworkStoreRequest;
use App\Models\Network;
use App\Models\IP;
use App\Models\Tower;

class NetworkController extends Controller {

    public function showNetworks() {
        $networks = Network::orderBy('address')->get();
        $towers = Tower::lists('name', 'id');
        return View::make('networks')->with(compact('networks', 'towers'));
    }

    public function updateNetworks(PrepareNetworkStoreRequest $request) {
        if (IP::where('network_id', '=', $request->network_id)->where('used', '=', '1')->count() != 0) {
            return redirect()->route('networks', ['error' => 'ip']);
        }

        $netAddress = $this->getIpRange($request);

        $network = Network::find($request->network_id);
        $network->address = $netAddress['netAddress'];
        $network->cidr = $request->network_cidr;
        $network->tower_id = $request->network_twrid;
        $network->save();

        $this->removeIps($network);
        $this->addIps($network, $request);

        return redirect()->route('networks');
    }

    public function addNetworks(PrepareNetworkStoreRequest $request) {
        $netAddress = $this->getIpRange($request);

        $network = new Network;
        $network->address = $netAddress['netAddress'];
        $network->cidr = $request->network_cidr;
        $network->tower_id = $request->network_twrid;
        $network->save();

        $this->addIps($network, $request);
        return redirect()->route('networks');
    }

    public function getIpRange($request) {

        $maskBinStr = str_repeat("1", $request->network_cidr) . str_repeat("0", 32 - $request->network_cidr);      //net mask binary string
        $inverseMaskBinStr = str_repeat("0", $request->network_cidr) . str_repeat("1", 32 - $request->network_cidr); //inverse mask

        $ipLong = ip2long($request->network_address);
        $ipMaskLong = bindec($maskBinStr);
        $inverseIpMaskLong = bindec($inverseMaskBinStr);
        $netAddress = $ipLong & $ipMaskLong;

        $start = $netAddress + 1; //ignore network ID(eg: 192.168.1.0)

        $end = ($netAddress | $inverseIpMaskLong) - 1; //ignore brocast IP(eg: 192.168.1.255)
        return array('netAddress' => $netAddress, 'firstIP' => $start, 'lastIP' => $end);
    }

    public function getEachIpInRange($request) {
        $ips = array();
        $range = $this->getIpRange($request);
        for ($ip = $range['firstIP']; $ip <= $range['lastIP']; $ip++) {
            $ips[] = $ip;
        }
        return $ips;
    }

    public function addIps($network, $request) {
        $ips = $this->getEachIpInRange($request);
        foreach ($ips as $ip) {
            $newIP = new IP;
            $newIP->address = $ip;
            $newIP->network_id = $network->id;
            $newIP->device_id = null;
            $newIP->used = 0;
            $newIP->save();
        }
    }

    public function removeIps($network) {
        $ips = IP::where('network_id', '=', $network->id);
        $ips->delete();
    }

}

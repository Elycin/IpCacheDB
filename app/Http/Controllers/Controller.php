<?php

namespace App\Http\Controllers;

use App\IpAddress;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function welcome()
    {
        return view("welcome")
            ->with("count", IpAddress::count());
    }

    public function address($address)
    {
        // Check to see if the address is valid, if not, error.
        if (!$this->isValidAddress($address)) {
            return response("Invalid IP Address", 500);
        }

        // Return the data in formatted json, in text format.
        return response(
            json_encode(IpAddress::getByAddress($address)->toArray(), JSON_PRETTY_PRINT),
            200,
            [
                "Content-Type" => "text/plain"
            ]);
    }

    public function randomAddress()
    {
        return $this->address($this->randomAddressGenerator());
    }

    private function isValidAddress($address)
    {
        return filter_var($address, FILTER_VALIDATE_IP);
    }

    private function randomAddressGenerator()
    {
        return long2ip(rand(0, "4294967295"));
    }
}

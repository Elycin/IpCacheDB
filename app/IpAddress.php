<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class IpAddress extends Model
{
    protected $table = "ip_addresses";

    protected $fillable = [
        'id',
        'ip',
        'hostname',
        'city',
        'region',
        'country',
        'loc',
        'org',
        'postal',
        'bogon'
    ];

    public static function getByAddress($address)
    {
        return Cache::tags('ip_addreses')->remember($address, 60, function () use ($address) {

            // check to see if the result already exists in the database.
            if ($result = self::where('ip', $address)->first()) {

                // Check to see if the result needs updated.
                if (Carbon::now()->subMonths(1)->gt(Carbon::parse($result->updated_at))) {

                    // The data is old, download new data.
                    $new_data = self::downloadAddressData($address);

                    // Get an array of the keys.
                    $keys = array_keys($new_data);

                    // Iterate over each individual key to see what specifically updated.
                    foreach ($keys as $key) if ($result->{$key} != $new_data[$key]) $result->{$key} = $new_data[$key];

                    // Save the changes.
                    $result->save();

                }

                // Return the result regardless if the checking procedure occurred.
                return $result;

            } else {

                // The result does not exist in the database, we will download the data and store it in the database.
                return self::create(self::downloadAddressData($address));

            }
        });
    }

    public static function count()
    {
        return Cache::remember('address-count', 1, function () {
            return self::all()->count();
        });
    }

    private static function downloadAddressData($address)
    {
        return json_decode(file_get_contents(sprintf("https://ipinfo.io/%s/json", $address)), true);
    }
}

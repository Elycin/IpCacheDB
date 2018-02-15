<?php

namespace App\Console\Commands;

use App\IpAddress;
use Illuminate\Console\Command;

class CheckAddress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:address {address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets information about the address';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $address = $this->argument("address");
        $address_data = IpAddress::getByAddress($address)->toArray();
        foreach ($address_data as $key => $val) echo sprintf((strlen($key) > 6) ? "%s:\t\t%s\n" : "%s:\t\t\t%s\n", $key, $val);
    }
}

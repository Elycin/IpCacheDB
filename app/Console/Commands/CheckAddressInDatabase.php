<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckAddressInDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:address-in-database {address}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks to see if the address is stored in the database.';

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
        //
    }
}

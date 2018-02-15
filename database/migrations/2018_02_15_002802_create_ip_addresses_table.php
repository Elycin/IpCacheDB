<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_addresses', function (Blueprint $table) {
            $table->increments("id");
            $table->string("ip")->unique();
            $table->string("hostname")->nullable();
            $table->string("city")->nullable();
            $table->string("region")->nullable();
            $table->string("country")->nullable();
            $table->string("loc")->nullable();
            $table->string("org")->nullable();
            $table->string("postal")->nullable();
            $table->boolean("bogon")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ip_addresses');
    }
}

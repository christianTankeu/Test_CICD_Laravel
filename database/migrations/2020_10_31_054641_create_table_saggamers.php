<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSaggamers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saggamers', function (Blueprint $table) {
            $table->integer('siteandgo_id');
            $table->integer('player_id');
            $table->integer('party_id');
            $table->integer('bet');
            $table->integer('coins');
            $table->integer('state');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('saggamers');
    }
}

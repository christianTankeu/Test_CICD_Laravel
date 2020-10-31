<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteandgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteandgos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state')->default(0);
            $table->integer('init_coins');
            $table->integer('init_bet');
            $table->integer('bet_duration');
            $table->integer('number_of_winners')->default(1);
            $table->integer('share_type')->default(1);
            $table->string('players');
            $table->text('results');
            $table->integer('is_active')->default('1');
            $table->timestamp('created_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siteandgos');
    }
}

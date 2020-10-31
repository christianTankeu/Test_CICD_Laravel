<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFapfapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fapfap', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type')->default('cg');
            $table->string('slug');
            $table->integer('bet');
            $table->integer('time_to_thing');
            $table->integer('number_of_players');
            $table->integer('korat');
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
        Schema::dropIfExists('fapfap');
    }
}

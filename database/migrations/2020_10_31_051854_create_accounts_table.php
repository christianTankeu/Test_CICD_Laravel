<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('player_id');
            $table->string('type')->nullable();
            $table->string('momo_number')->nullable();
            $table->string('om_number')->nullable();
            $table->string('cni_number')->nullable();
            $table->string('cni_font')->nullable();
            $table->string('cni_back')->nullable();
            $table->string('pic_with_cni')->nullable();
            $table->integer('is_active')->default(1);
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
        Schema::dropIfExists('accounts');
    }
}

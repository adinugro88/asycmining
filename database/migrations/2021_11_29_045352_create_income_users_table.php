<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_users', function (Blueprint $table) {
            $table->id();
            $table->timestamp('tgl');
            $table->string('coin');
            $table->double('income');
            $table->double('rate')->nullable();
            $table->double('idr')->nullable();
            $table->double('incomefee')->nullable();
            $table->double('ratefee')->nullable();
            $table->double('idrfee')->nullable();
            $table->integer('users_id');
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
        Schema::dropIfExists('income_users');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('coin');
            $table->double('saldoawal')->nullable();
            $table->double('saldoakhir')->nullable();
            $table->double('wallet');
            $table->double('networkfee');
            $table->double('walletcompany');
            $table->double('listrik');
            $table->double('investor');
            $table->double('management');
            $table->double('ratecointousd');
            $table->double('feecointousd');
            $table->double('totalusd');
            $table->double('rateusdtobidr');
            $table->double('feebidr');
            $table->double('feecointoidr');
            $table->double('total');
            $table->text('tgl transfer');
            $table->text('catatan');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
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
        Schema::dropIfExists('payments');
    }
}

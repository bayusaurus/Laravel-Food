<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('meja_id');
            $table->foreign('meja_id')->references('id')->on('meja');

            $table->unsignedBigInteger('status_transaksi_id')->nullable();
            $table->foreign('status_transaksi_id')->references('id')->on('status_transaksi');

            $table->string('nama');
            
            $table->integer('no_order');
            $table->string('faktur');

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
        Schema::dropIfExists('transaksi');
    }
}

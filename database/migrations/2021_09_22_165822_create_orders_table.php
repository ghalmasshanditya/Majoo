<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id_order');
            $table->bigInteger('id_produk')->unsigned();
            $table->foreign('id_produk')->references('id_produk')->on('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->string('first_name', 20);
            $table->string('last_name', 35);
            $table->string('email');
            $table->string('telp', 12);
            $table->string('provinsi', 35);
            $table->string('kabupaten', 25);
            $table->string('alamat');
            $table->string('kode_pos', 7);
            $table->string('total', 10);
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
        Schema::dropIfExists('orders');
    }
}

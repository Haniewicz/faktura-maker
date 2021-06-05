<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vat', function (Blueprint $table) {
            $table->id();
            $table->string('seller');
            $table->integer('seller_nip')->nullable();
            $table->string('seller_street');
            $table->string('seller_city');
            $table->string('seller_postcode');
            $table->string('client');
            $table->integer('client_nip')->nullable();
            $table->string('client_street');
            $table->string('client_city');
            $table->string('client_postcode');
            $table->string('final_price', 255);
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
        Schema::dropIfExists('vat');
    }
}

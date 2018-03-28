<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCustomerSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_customer_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->index()->unsigned();
            $table->string('DIN1')->nullable()->default('DIN1');
            $table->string('DIN2')->nullable()->default('DIN2');
            $table->string('DIN3')->nullable()->default('DIN3');
            $table->string('DIN4')->nullable()->default('DIN4');
            $table->string('DIN5')->nullable()->default('DIN5');
            $table->string('DIN6')->nullable()->default('DIN6');
            $table->string('DIN7')->nullable()->default('DIN7');
            $table->string('DIN8')->nullable()->default('DIN8');
            $table->string('DOUT1')->nullable()->default('DOUT1');
            $table->string('DOUT2')->nullable()->default('DOUT2');
            $table->string('DOUT3')->nullable()->default('DOUT3');
            $table->string('DOUT4')->nullable()->default('DOUT4');
            $table->string('DOUT5')->nullable()->default('DOUT5');
            $table->string('DOUT6')->nullable()->default('DOUT6');
            $table->string('DOUT7')->nullable()->default('DOUT7');
            $table->string('DOUT8')->nullable()->default('DOUT8');
            $table->string('HIN1')->nullable()->default('HIN1');
            $table->string('HIN2')->nullable()->default('HIN2');
            $table->string('HIN3')->nullable()->default('HIN3');
            $table->string('HIN4')->nullable()->default('HIN4');
            $table->string('HIN5')->nullable()->default('HIN5');
            $table->string('HIN6')->nullable()->default('HIN6');
            $table->string('HIN7')->nullable()->default('HIN7');
            $table->string('HIN8')->nullable()->default('HIN8');
            $table->string('HOUT1')->nullable()->default('HOUT1');
            $table->string('HOUT2')->nullable()->default('HOUT2');
            $table->string('HOUT3')->nullable()->default('HOUT3');
            $table->string('HOUT4')->nullable()->default('HOUT4');
            $table->string('HOUT5')->nullable()->default('HOUT5');
            $table->string('HOUT6')->nullable()->default('HOUT6');
            $table->string('HOUT7')->nullable()->default('HOUT7');
            $table->string('HOUT8')->nullable()->default('HOUT8');
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
        Schema::dropIfExists('product_customer_settings');
    }
}

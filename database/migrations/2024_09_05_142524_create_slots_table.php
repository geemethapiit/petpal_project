<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slots', function (Blueprint $table) {
            $table->id('slot_id');
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('service_type_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->integer('slot_duration'); 
            $table->integer('slot_count'); 
            $table->timestamps();

            // foreign key constraints
            $table->foreign('service_provider_id')->references('provider_id')->on('service_providers');
            $table->foreign('service_type_id')->references('service_type_id')->on('servicetypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slots');
    }
};

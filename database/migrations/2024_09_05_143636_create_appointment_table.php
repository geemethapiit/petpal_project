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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('service_type_id');
            $table->unsignedBigInteger('petowner_id');
            $table->unsignedBigInteger('pet_id');
            $table->date('date');
            $table->time('start_time');
            $table->enum('status', ['pending', 'completed', 'cancelled', 'not show up']);
            $table->timestamps();

            // foreign key constraints
            $table->foreign('service_provider_id')->references('provider_id')->on('service_providers');
            $table->foreign('service_type_id')->references('service_type_id')->on('servicetypes');
            $table->foreign('petowner_id')->references('petowner_id')->on('petowners');
            $table->foreign('pet_id')->references('pet_id')->on('pets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointment');
    }
};

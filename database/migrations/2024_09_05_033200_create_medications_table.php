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
        Schema::create('medications', function (Blueprint $table) {
            $table->id('medication_id');
            $table->string('medication_name');
            $table->string('medication_dosage');
            $table->string('medication_frequency');
            $table->string('medication_duration');
            $table->string('medication_notes')->nullable();
            $table->string('medication_file_url')->nullable();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('veterinarian_id')->nullable();
            $table->unsignedBigInteger('service_provider_id');
            $table->timestamps();

            //foreign keys
            $table->foreign('pet_id')->references('pet_id')->on('pets')->onDelete('cascade');
            $table->foreign('veterinarian_id')->references('person_id')->on('person');
            $table->foreign('service_provider_id')->references('provider_id')->on('service_providers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medications');
    }
};

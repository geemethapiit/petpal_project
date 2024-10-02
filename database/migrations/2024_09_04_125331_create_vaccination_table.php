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
        Schema::create('vaccination', function (Blueprint $table) {
            $table->id('vaccination_id');
            $table->string('vaccine_name');
            $table->date('vaccination_date');
            $table->date('next_vaccination_date')->nullable();
            $table->string('vaccination_chart')->nullable();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('veterinary_id')->nullable();
            $table->timestamps();

            //foreign keys
            $table->foreign('pet_id')->references('pet_id')->on('pets')->onDelete('cascade');
            $table->foreign('provider_id')->references('provider_id')->on('service_providers');
            $table->foreign('veterinary_id')->references('person_id')->on('person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vaccination');
    }
};

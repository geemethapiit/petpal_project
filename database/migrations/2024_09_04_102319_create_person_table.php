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
        Schema::create('person', function (Blueprint $table) {
            $table->id('person_id');
            $table->string('name'); 
            $table->string('email')->unique(); 
            $table->string('contact_no')->unique(); 
            $table->string('role'); 
            $table->unsignedBigInteger('service_provider_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('service_provider_id')->references('provider_id')->on('service_providers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
};

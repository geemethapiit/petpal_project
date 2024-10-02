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
        Schema::create('lab_results', function (Blueprint $table) {
            $table->id('lab_id');
            $table->string('test_name');
            $table->text('results');
            $table->date('test_date');
            $table->text('reference_result');
            $table->text('veterinarian_notes')->nullable();
            $table->string('result_file_url')->nullable();
            $table->unsignedBigInteger('pet_id');
            $table->unsignedBigInteger('veterinarian_id')->nullable(); 
            $table->unsignedBigInteger('service_provider_id');
            $table->timestamps();

            // Foreign key constraints
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
        Schema::dropIfExists('lab_results');
    }
};

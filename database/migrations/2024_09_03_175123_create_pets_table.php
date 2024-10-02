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
        Schema::create('pets', function (Blueprint $table) {
            $table->id('pet_id');
            $table->string('registration_number');
            $table->string('name');
            $table->string('type');
            $table->string('breed');
            $table->string('age');
            $table->string('color');
            $table->string('gender');
            $table->string('special_notes')->nullable();
            $table->unsignedBigInteger('petowner_id'); // Ensure this column type matches the referenced column type
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('petowner_id')->references('petowner_id')->on('petowners')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
};

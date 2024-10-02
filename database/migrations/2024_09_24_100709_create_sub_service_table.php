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
        Schema::create('subservices', function (Blueprint $table) {
            $table->id('subservice_id');
            $table->unsignedBigInteger('service_type_id'); 
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2)->nullable(); 
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('service_type_id')->references('service_type_id')->on('servicetypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_service');
    }
};

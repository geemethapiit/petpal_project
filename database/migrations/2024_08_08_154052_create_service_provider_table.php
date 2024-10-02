<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('service_providers', function (Blueprint $table) {
            $table->id('provider_id');
            $table->string('business_name');
            $table->string('business_license_no')->unique();
            $table->string('contact_no')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->default('pending');
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('service_providers');
    }
};

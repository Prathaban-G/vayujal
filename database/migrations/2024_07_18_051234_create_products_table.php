<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('productname', 30)->unique();
            $table->string('producttype', 20);
            $table->string('contactperson', 50);
            $table->string('mobileno', 20);
            $table->string('email', 50);
            $table->string('address', 200);
            $table->string('city', 50);
            $table->string('zipcode', 20);
            $table->string('state', 30);
            $table->string('info', 200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

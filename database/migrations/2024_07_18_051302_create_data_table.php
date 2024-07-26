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
        Schema::create('data', function (Blueprint $table) {
            $table->string('hw_id', 20);
            $table->timestamp('datetime');
            $table->string('temperature', 20);
            $table->string('humidity', 20);
            $table->string('waterlevel', 20);
            
            $table->string('waterflow', 20);
            $table->string('airflow', 20);
            
            $table->string('pressure_lowswitch', 20);
            $table->string('pressurehighswitch', 20);
            $table->string('pressureoutswitch', 20);
           
            $table->string('tds', 20);
           
            $table->string('voltager', 20);
            $table->string('voltagey', 20);
            $table->string('voltageb', 20);
            $table->string('currentr', 20);
            $table->string('currenty', 20);
            $table->string('currentb', 20);
            $table->string('avgvoltage', 20);
            $table->string('avgcurrent', 20);
            $table->string('frequency', 20);
            $table->string('kwh', 20);
            $table->string('fan', 20);
            
            $table->string('compressor', 20);
            $table->string('dispensor', 20);
           
            $table->string('ozonizer', 20);
            $table->string('buzzer', 20);
            $table->string('external', 20);
            $table->string('power_status', 20);
            $table->string('battery_per', 20);
            $table->string('humiditybg', 20);
            $table->string('temperaturebg', 20);
            $table->string('waterlevelbg', 20);
            $table->string('airflowbg', 20);
            $table->string('pressurebg', 20);
            $table->string('tdsbg', 20);
            $table->string('fanbg', 20);
            $table->string('compressorbg', 20);
            $table->string('dispensorbg', 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};

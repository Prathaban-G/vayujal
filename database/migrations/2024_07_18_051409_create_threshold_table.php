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
        Schema::create('threshold', function (Blueprint $table) {
            $table->string('hw_id', 10);
            $table->timestamp('datetime');
            $table->string('temp_limit_from', 10);
            $table->string('temp_limit_till', 10);
            $table->string('temp_set_point_ls', 10);
            $table->string('temp_set_point_hs', 10);
            $table->string('temp_cutoff_point_ls', 10);
            $table->string('temp_cutoff_point_hs', 10);
            $table->string('temp_differ_cutoff_ls', 10);
            $table->string('temp_differ_cutoff_hs', 10);
            $table->string('hum_limit_from', 10);
            $table->string('hum_limit_till', 10);
            $table->string('hum_set_point_ls', 10);
            $table->string('hum_set_point_hs', 10);
            $table->string('hum_cutoff_point_ls', 10);
            $table->string('hum_cutoff_point_hs', 10);
            $table->string('hum_differ_cutoff_ls', 10);
            $table->string('hum_differ_cutoff_hs', 10);
            $table->string('ultra_tank_height', 10);
            $table->string('ultra_sensing_range_min', 10);
            $table->string('ultra_sensing_range_max', 10);
            $table->string('water_level_low', 10);
            $table->string('water_level_mid', 10);
            $table->string('water_level_high', 10);
            $table->string('air_flow_low', 10);
            $table->string('air_flow_high', 10);
            $table->string('tds_set_point_low', 10);
            $table->string('tds_set_point_high', 10);
            $table->string('tds_range_low', 10);
            $table->string('tds_range_high', 10);
            $table->string('power_under_voltage_low', 10);
            $table->string('power_under_voltage_high', 10);
            $table->string('power_over_voltage_low', 10);
            $table->string('power_over_voltage_high', 10);
            $table->string('power_over_current', 10);
            $table->string('power_ct_pri', 10);
            $table->string('power_ct_sec', 10);
            $table->string('tim_ozonizer_on', 10);
            $table->string('tim_ozonizer_off', 10);
            $table->string('tim_compressor_on_delay', 10);
            $table->string('tim_machine_rest_on', 10);
            $table->string('tim_machine_rest_off', 10);
            $table->string('tim_maintenance', 10);
            $table->string('bypass_temphum', 10);
            $table->string('bypass_airflow', 10);
            $table->string('bypass_tds', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('threshold');
    }
};

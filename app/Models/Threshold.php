<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Threshold extends Model
{
    // Specify the table name if it doesn't follow Laravel's convention
    protected $table = 'threshold';

    // Specify the primary key
    protected $primaryKey = 'hw_id';

    // Indicate that the primary key is not an auto-incrementing integer
    public $incrementing = false;

    // Indicate that the primary key is a string
    protected $keyType = 'string';

    // Disable timestamps if you are not using created_at and updated_at
    public $timestamps = true; // Set to false if you don't want to use timestamps

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'hw_id',
        'datetime',
        'temp_limit_from',
        'temp_limit_till',
        'temp_set_point_ls',
        'temp_set_point_hs',
        'temp_cutoff_point_ls',
        'temp_cutoff_point_hs',
        'temp_differ_cutoff_ls',
        'temp_differ_cutoff_hs',
        'hum_limit_from',
        'hum_limit_till',
        'hum_set_point_ls',
        'hum_set_point_hs',
        'hum_cutoff_point_ls',
        'hum_cutoff_point_hs',
        'hum_differ_cutoff_ls',
        'hum_differ_cutoff_hs',
        'ultra_tank_height',
        'ultra_sensing_range_min',
        'ultra_sensing_range_max',
        'water_level_low',
        'water_level_mid',
        'water_level_high',
        'air_flow_low',
        'air_flow_high',
        'tds_set_point_low',
        'tds_set_point_high',
        'tds_range_low',
        'tds_range_high',
        'power_under_voltage_low',
        'power_under_voltage_high',
        'power_over_voltage_low',
        'power_over_voltage_high',
        'power_over_current',
        'power_ct_pri',
        'power_ct_sec',
        'tim_ozonizer_on',
        'tim_ozonizer_off',
        'tim_compressor_on_delay',
        'tim_machine_rest_on',
        'tim_machine_rest_off',
        'tim_maintenance',
        'bypass_temphum',
        'bypass_airflow',
        'bypass_tds',
    ];
}

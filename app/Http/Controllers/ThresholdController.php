<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Threshold;
use Bluerhinos\phpMQTT;

use Illuminate\Support\Facades\Log;

class ThresholdController extends Controller
{
    public function show($productname)
    {
        $products = Product::all();  // Fetch all products for the dropdown
        $threshold = Threshold::where('hw_id', $productname)->first();
    
        return view('superadmin.parameter', [
            'products' => $products,
            'threshold' => $threshold,
            'projectName' => $productname,  // Pass the parameter to the view
        ]);
    }


    public function publishToMqtt($data)
    {
        $host = 'mqtt-dashboard.com';
        $port = 1883; // default MQTT port
        $username = 'prathab-lara'; // if required
        $password = 'laravel'; // if required
        $clientId = 'clientId-Gcjm185xXv' . uniqid(); // unique client ID

        $mqtt = new phpMQTT($host, $port, $clientId);

        if ($mqtt->connect(true, null, $username, $password)) {
            $mqtt->publish('threshold', json_encode($data), 0);
            $mqtt->close();
        } else {
            // Handle connection failure
            \Log::error('MQTT connection failed');
        }
    }
    public function store(Request $request)
    {
        try {
            // Validate and save the data to the threshold table
            $validatedData = $request->validate([
                'hw_id' => 'required|string|max:10',
                'temp_limit_from' => 'required|string|max:10',
                'temp_limit_till' => 'required|string|max:10',
                'temp_set_point_ls' => 'required|string|max:10',
                'temp_set_point_hs' => 'required|string|max:10',
                'temp_cutoff_point_ls' => 'required|string|max:10',
                'temp_cutoff_point_hs' => 'required|string|max:10',
                'temp_differ_cutoff_ls' => 'required|string|max:10',
                'temp_differ_cutoff_hs' => 'required|string|max:10',
                'hum_limit_from' => 'required|string|max:10',
                'hum_limit_till' => 'required|string|max:10',
                'hum_set_point_ls' => 'required|string|max:10',
                'hum_set_point_hs' => 'required|string|max:10',
                'hum_cutoff_point_ls' => 'required|string|max:10',
                'hum_cutoff_point_hs' => 'required|string|max:10',
                'hum_differ_cutoff_ls' => 'required|string|max:10',
                'hum_differ_cutoff_hs' => 'required|string|max:10',
                'ultra_tank_height' => 'required|string|max:10',
                'ultra_sensing_range_min' => 'required|string|max:10',
                'ultra_sensing_range_max' => 'required|string|max:10',
                'water_level_low' => 'required|string|max:10',
                'water_level_mid' => 'required|string|max:10',
                'water_level_high' => 'required|string|max:10',
                'air_flow_low' => 'required|string|max:10',
                'air_flow_high' => 'required|string|max:10',
                'tds_set_point_low' => 'required|string|max:10',
                'tds_set_point_high' => 'required|string|max:10',
                'tds_range_low' => 'required|string|max:10',
                'tds_range_high' => 'required|string|max:10',
                'power_under_voltage_low' => 'required|string|max:10',
                'power_under_voltage_high' => 'required|string|max:10',
                'power_over_voltage_low' => 'required|string|max:10',
                'power_over_voltage_high' => 'required|string|max:10',
                'power_over_current' => 'required|string|max:10',
                'power_ct_pri' => 'required|string|max:10',
                'power_ct_sec' => 'required|string|max:10',
                'tim_ozonizer_on' => 'required|string|max:10',
                'tim_ozonizer_off' => 'required|string|max:10',
                'tim_compressor_on_delay' => 'required|string|max:10',
                'tim_machine_rest_on' => 'required|string|max:10',
                'tim_machine_rest_off' => 'required|string|max:10',
                'tim_maintenance' => 'required|string|max:10',
                'bypass_temphum' => 'nullable|string|max:10',
                'bypass_airflow' => 'nullable|string|max:10',
                'bypass_tds' => 'nullable|string|max:10',
            ]);
    
            // Add current timestamp
            $validatedData['datetime'] = now();
    
            // Update or create new threshold using hw_id as the unique key
            Threshold::updateOrCreate(
                ['hw_id' => $request->hw_id],  // Conditions to find the existing record
                $validatedData  // Data to update or create
            );
            $this->publishToMqtt($validatedData);
            return redirect()->route('parameter.show', ['productname' => $request->hw_id])
                ->with('success', 'Threshold parameters saved successfully.');
    
        }catch (\Exception $e) {
            Log::error('Error Adding THreshold: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to add threshold.']);
        }
    }
    public function copyParameters(Request $request)
    {
        try {
            // Log the request data
            \Log::info('Form data received', $request->all());
    
            $hw_id = $request->input('hw_id');
            $source_hw_id = $request->input('source_hw_id');
    
            $sourceThreshold = Threshold::where('hw_id', $source_hw_id)->first();
    
            if (!$sourceThreshold) {
                \Log::error('Source threshold not found', ['source_hw_id' => $source_hw_id]);
                return redirect()->route('parameter.show', ['productname' => $hw_id])
                    ->with('error', 'Source parameters not found.');
            }
    
            $newThreshold = $sourceThreshold->replicate();
            $newThreshold->hw_id = $hw_id;
            $newThreshold->save();
    
            return redirect()->route('parameter.show', ['productname' => $hw_id])
                ->with('success', 'Parameters copied successfully.');
    
        } catch (\Exception $e) {
            \Log::error('Error copying parameters', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
}
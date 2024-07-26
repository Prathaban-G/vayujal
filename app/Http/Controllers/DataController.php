<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Data;
use Laracsv\Export;
use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
class DataController extends Controller
{
    public function showForm()
    {
        $products = Product::all();
        return view('superadmin/data', compact('products'));
    }
    public function showDashboard($hw_id)
    {
        $latestData = Data::where('hw_id', $hw_id)
            ->orderBy('datetime', 'desc')
            ->first();
        
        $projectName = $hw_id;
    
        return view('superadmin.dashboard.index', compact('latestData', 'projectName'));
    }
    public function showthreeDashboard($hw_id)
    {
        $latestData = Data::where('hw_id', $hw_id)
            ->orderBy('datetime', 'desc')
            ->first();
        
        $projectName = $hw_id;
    
        return view('superadmin.dashboard.threeindex', compact('latestData', 'projectName'));
    }
    
    public function fetchLatestData($hw_id)
    {
        $latestData = Data::where('hw_id', $hw_id)
            ->orderBy('datetime', 'desc')
            ->first();
    
        if ($latestData) {
            return response()->json($latestData);
        } else {
            return response()->json(['error' => 'No data found'], 404);
        }
    }
    public function retrieveData(Request $request)
{
    try {
        $startdate = Carbon::parse($request->input('startdate'));
        $enddate = Carbon::parse($request->input('enddate'));
        $products = $request->input('products');
        $parameter = $request->input('parameter');

        // Log to verify the received values
        Log::info('Received Products: ', $products);

        $query = Data::query();

        if ($startdate && $enddate) {
            $query->whereBetween('datetime', [$startdate, $enddate]);
        }

        if ($products) {
            // Ensure the products array is properly handled as strings
            $products = array_map('trim', $products); // Optional: Trim whitespace if needed
            $query->whereIn('hw_id', $products);
        }

        if ($parameter && $parameter != 'all') {
            $query->select('hw_id', 'datetime', $parameter);
        } else {
            $query->select('hw_id', 'datetime', 'temperature', 'humidity', 'waterlevel', 'waterflow', 'airflow', 'pressure_lowswitch', 'pressurehighswitch', 'pressureoutswitch', 'tds', 'voltager', 'voltagey', 'voltageb', 'currentr', 'currenty', 'currentb', 'avgvoltage', 'avgcurrent', 'frequency', 'kwh', 'fan', 'compressor', 'dispensor', 'ozonizer', 'buzzer', 'external', 'power_status', 'battery_per', 'humiditybg', 'temperaturebg', 'waterlevelbg', 'airflowbg', 'pressurebg', 'tdsbg', 'fanbg', 'compressorbg', 'dispensorbg');
        }

        $data = $query->get();
        $products = Product::all(); // Fetch all products

    } catch (\Exception $e) {
        Log::error('Error Retrieving data: ' . $e->getMessage());
        return back()->withInput()->withErrors(['error' => 'Failed to retrieve data.']);
    }

    return view('superadmin.data', compact('data', 'products', 'parameter'));
}
public function downloadCsv(Request $request)
{
    try {
        // Parse and validate inputs
        $startdate = Carbon::parse($request->input('startdate'))->format('Y-m-d H:i:s');
        $enddate = Carbon::parse($request->input('enddate'))->format('Y-m-d H:i:s');
        $products = $request->input('products');
        $parameter = $request->input('parameter');

        // Build the query
        $query = Data::query();

        if ($startdate && $enddate) {
            $query->whereBetween('datetime', [$startdate, $enddate]);
        }

        if ($products && is_array($products)) {
            $query->whereIn('hw_id', $products);
        }

        if ($parameter && $parameter != 'all') {
            $query->select('hw_id', 'datetime', $parameter);
        } else {
            $query->select('hw_id', 'datetime', 'temperature', 'humidity', 'waterlevel', 'waterflow', 'airflow', 'pressure_lowswitch', 'pressurehighswitch', 'pressureoutswitch', 'tds', 'voltager', 'voltagey', 'voltageb', 'currentr', 'currenty', 'currentb', 'avgvoltage', 'avgcurrent', 'frequency', 'kwh', 'fan', 'compressor', 'dispensor', 'ozonizer', 'buzzer', 'external', 'power_status', 'battery_per', 'humiditybg', 'temperaturebg', 'waterlevelbg', 'airflowbg', 'pressurebg', 'tdsbg', 'fanbg', 'compressorbg', 'dispensorbg');
        }

        $data = $query->get();

        if ($data->isEmpty()) {
            return back()->withErrors(['error' => 'No data found for the given criteria.']);
        }

        $filename = 'data-' . now()->format('Ymd-His') . '.csv';

        // Stream the CSV file
        return response()->stream(
            function () use ($data) {
                $handle = fopen('php://output', 'w');
                if ($handle === false) {
                    throw new \Exception('Failed to open output stream.');
                }

                // Output CSV header
                fputcsv($handle, array_keys($data->first()->toArray()));

                // Output CSV data rows
                foreach ($data as $row) {
                    fputcsv($handle, $row->toArray());
                }

                fclose($handle); // Close the handle
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]
        );

    } catch (\Exception $e) {
        Log::error('Error Generating CSV: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Failed to generate CSV.']);
    }
}


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logs;
use App\Models\Product;
use Laracsv\Export;
use Carbon\Carbon;

class LogsController extends Controller
{
    //
    public function showForm()
    {
        $products = Product::all();
        return view('superadmin.alarmlog', compact('products'));
    }

    public function retrieveData(Request $request)
    {
        $startdate = Carbon::parse($request->input('startdate'));
        $enddate = Carbon::parse($request->input('enddate'));
        $producttype = $request->input('producttype');
        $products = $request->input('products');

        $logs = Logs::whereBetween('datetime', [$startdate, $enddate])
            ->where('producttype', $producttype)
            ->whereIn('product_id', $products)
            ->get();

        return view('superadmin.alarmlog', compact('logs'));
    }

    public function downloadCsv()
    {
        $logs = Logs::all();
        $csvExporter = new Export();
        $csvExporter->build($logs, ['id', 'datetime', 'producttype', 'logs'])->download();
    }

}

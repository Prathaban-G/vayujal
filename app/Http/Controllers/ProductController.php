<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    public function index()
    {
        // Fetch and sort products by productname in alphabetical order
        $products = Product::orderBy('productname', 'asc')->get();
        return view('superadmin.products.index', compact('products'));
    }
    public function edit($id)
{
    $product = Product::findOrFail($id);
    return view('superadmin.addProducts', compact('product'));
}

public function destroy($id)
{
    try {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    } catch (\Exception $e) {
        Log::error('Error deleting product: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Failed to delete product.']);
    }
}
public function update(Request $request, $id)
{
    try {
        $request->validate([
            'productname' => 'required|string|max:30|unique:products,productname,' . $id,
            'producttype' => 'required|string|max:20',
            'serialnumber' => 'required|string|max:200',
            'contactperson' => 'required|string|max:50',
            'mobileno' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:50',
            'address' => 'nullable|string|max:200',
            'city' => 'required|string|max:50',
            'zipcode' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:30',
            'info' => 'nullable|string|max:200',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('superadmin.products.index')->with('success', 'Product updated successfully.');
    } catch (\Exception $e) {
        Log::error('Error updating product: ' . $e->getMessage());
        return back()->withInput()->withErrors(['error' => 'Failed to update product.']);
    }
}

    public function homeindex()
    {
        
        
        $singlePhaseProducts = Product::where('producttype', 'Single Phase')->orderBy('productname', 'asc')->get();
        $threePhaseProducts = Product::where('producttype', 'Three Phase')->orderBy('productname', 'asc')->get();
        return view('superadmin.home', compact('singlePhaseProducts', 'threePhaseProducts'));
    }

    public function create()
    {
        return view('superadmin.addProducts');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'productname' => 'required|string|max:30|unique:products,productname,' . $request->product_id,
               'producttype' => 'required|string|max:20',
            'serialnumber' => 'required|string|max:200',
            'contactperson' => 'required|string|max:50',
            'mobileno' => 'nullable|string|max:20',
            'email' => 'nullable|string|email|max:50',
            'address' => 'nullable|string|max:200',
            'city' => 'required|string|max:50',
            'zipcode' => 'nullable|string|max:20',
            'state' => 'nullable|string|max:30',
            'info' => 'nullable|string|max:200',
            ]);

            $productData = [
                'productname' => $request->productname,
                'producttype' => $request->producttype,
                'serialnumber' => $request->serialnumber,
                'contactperson' => $request->contactperson,
                'mobileno' => $request->mobileno,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'zipcode' => $request->zipcode,
                'state' => $request->state,
                'info' => $request->info,
            ];

            if ($request->has('product_id') && $request->product_id) {
                // Update existing product
                $product = Product::findOrFail($request->product_id);
                $product->update($productData);
                $message = 'Product updated successfully.';
            } else {
                // Create new product
                Product::create($productData);
                $message = 'Product created successfully.';
            }

            return redirect()->route('superadmin.products.index')->with('success', $message);
        } catch (\Exception $e) {
            Log::error('Error creating/updating product: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to save product.']);
        }
    }
}

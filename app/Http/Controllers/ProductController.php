<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // Add product form
    public function create()
    {
        $categories = Categories::all();
        $brands = Brands::all();
        return view('admin.product.add', compact('categories', 'brands'));
    }

     //show all data
     public function index()
     {
    $products = Product::with(['category', 'brand'])->paginate(2);
    return view('admin.product.index', compact('products'));
    }

   // Insert product data
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|numeric',
            'cost' => 'required|numeric',
            'code' => 'required|unique:products,code',
            'unit' => 'required|numeric|min:1',
            'details' => 'nullable',
            'img_url' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
            'status' => 'required|in:1,0',
        ]);

        $image_rename = '';
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $ext = $image->getClientOriginalExtension();
            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('productImage'), $image_rename);
        }

        try {
            $product = Product::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'price' => $request->price,
                'cost' => $request->cost,
                'code' => $request->code,
                'unit' => $request->unit,
                'details' => $request->details,
                'img_url' => $image_rename,
                'creator' => Auth::user()->id,
                'slug' => uniqid() . rand(10000, 10000000),
                'status' => $request->status,  // Status field
            ]);
            if (!$product) {
            session()->flash('success', 'Product added successfully.');
            return redirect()->back();
            }
        } catch (\Exception $e) {
            return back()->with('fail', 'Failed to add product: ' . $e->getMessage());
        }
    }

    public function edit($id){
        $product = Product::find($id);
        $categories = Categories::all();
        $brands = Brands::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|max:100',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'price' => 'required|numeric',
        'cost' => 'required|numeric',
        'code' => 'required',
        'unit' => 'required|numeric|min:1',
        'details' => 'nullable',
        'img_url' => 'nullable|image|mimes:jpeg,png,gif|max:2048',
    ]);

    // Find the product by ID
    $product = Product::find($id);

    if (!$product) {
        return back()->with('fail', 'Product not found.');
    }

    // Handle the image upload
    $image_rename = $product->img_url; // Keep the old image if not updated
    if ($request->hasFile('img_url')) {
        // Delete the old image if it exists
        if ($product->img_url && file_exists(public_path('productImage/' . $product->img_url))) {
            unlink(public_path('productImage/' . $product->img_url));
        }

        $image = $request->file('img_url');
        $ext = $image->getClientOriginalExtension();
        $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
        $image->move(public_path('productImage'), $image_rename);
    }

    // Update the product
    $product->update([
        'name' => $request['name'],
        'category_id' => $request['category_id'],
        'brand_id' => $request['brand_id'],
        'price' => $request['price'],
        'cost' => $request['cost'],
        'code' => $request['code'],
        'unit' => $request['unit'],
        'details' => $request['details'],
        'img_url' => $image_rename,
        'status' => $request['status'],
    ]);

    // Return success response
    return redirect()->back()->with('success', 'Product updated successfully.');
}

public function destroy($id)
{
    // Find the product by ID
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('fail', 'Product not found.');
    }

    // Delete the product image if it exists
    if ($product->img_url && file_exists(public_path('productImage/' . $product->img_url))) {
        unlink(public_path('productImage/' . $product->img_url));
    }

    // Delete the product
    $product->delete();

    // Return success response
    return redirect()->back()->with('success', 'Product deleted successfully.');
}


}

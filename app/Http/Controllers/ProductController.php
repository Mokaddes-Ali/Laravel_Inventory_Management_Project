<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Product;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

        public function index()
        {
            $products = Product::with('category', 'brand')->paginate(10);
            return view('products.index', compact('products'));
        }

        public function create(Request $request)
        {
            // Debugging the request data (can be removed later)
            // dd($request->all());

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
                'img_url' => 'required|image|mimes:jpeg,png,gif|max:2048',
            ]);

            // Handle the image upload
            $image_rename = '';
            if ($request->hasFile('img_url')) {
                $image = $request->file('img_url');
                $ext = $image->getClientOriginalExtension();
                $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
                $image->move(public_path('productImage'), $image_rename);
            }

            // Insert product data into the 'products' table (assuming Product model)
            $insert = Product::insertGetId([
                'name' => $request['name'],
                'category_id' => $request['category_id'],
                'brand_id' => $request['brand_id'],
                'price' => $request['price'],
                'cost' => $request['cost'],
                'code' => $request['code'],
                'unit' => $request['unit'],
                'details' => $request['details'],
                'img_url' => $image_rename,
                'creator' => Auth::user()->id,
                'slug' => uniqid() . rand(10000, 10000000),
            ]);

            // Check if insertion was successful
            if ($insert) {
                // Display success message
                session()->flash('success', 'Product added successfully.');
                return redirect()->back();
            } else {
                // Display failure message
                return back()->with('fail', 'Data insertion failed');
            }
        }

        // public function edit(Request $request)
        // {
        //     $categories = Categories::all();
        //     $brands = Brands::all();
        //     return view('products.edit', compact('product', 'categories', 'brands'));
        // }

        // public function update(Request $request)
        // {
        //     $request->validate([
        //         'name' => 'required|max:100',
        //         'category_id' => 'required|exists:categories,id',
        //         'brand_id' => 'required|exists:brands,id',
        //         'price' => 'required',
        //         'cost' => 'required',
        //         'unit' => 'required',
        //         'img_url' => 'nullable|url',
        //         'details' => 'nullable',
        //     ]);

        //     $product->update($request->all());
        //     return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        // }

        // public function destroy(Product $product)
        // {
        //     $product->delete();
        //     return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        // }
    }

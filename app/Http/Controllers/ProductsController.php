<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    // Show the product list
    public function index()
    {
        $products = Products::with('category', 'brand')->get();
        return view('admin.product.show', compact('products'));
    }

    // Show the form to add a new product
    public function add()
    {
        $categories = Categories::all();
        $brands = Brands::all();
        return view('admin.product.show', compact('categories', 'brands'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'nullable|string|unique:products,code',
            'price' => 'required|string|max:50',
            'cost' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'img_url' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        $imagePath = $request->file('img_url')->store('product_images', 'public');

        Products::create([
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'cost' => $request->cost,
            'unit' => $request->unit,
            'img_url' => $imagePath,
            'details' => $request->details,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'creator' => Auth::user()->id,
        ]);

        return redirect()->route('product.list')->with('success', 'Product added successfully.');
    }

    // Show the form to edit a product
    public function edit($id)
    {
        $product = Products::findOrFail($id);
        $categories = Categories::all();
        $brands = Brands::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    // Update an existing product
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'code' => 'nullable|string|unique:products,code,' . $request->id,
            'price' => 'required|string|max:50',
            'cost' => 'required|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = Products::findOrFail($request->id);

        // Handle image upload
        if ($request->hasFile('img_url')) {
            $imagePath = $request->file('img_url')->store('product_images', 'public');
            $product->img_url = $imagePath;
        }

        $product->update([
            'name' => $request->name,
            'code' => $request->code,
            'price' => $request->price,
            'cost' => $request->cost,
            'unit' => $request->unit,
            'details' => $request->details,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'editor' => Auth::user()->id,
        ]);

        return redirect()->route('product.list')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function delete($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();

        return redirect()->route('product.list')->with('success', 'Product deleted successfully.');
    }
}


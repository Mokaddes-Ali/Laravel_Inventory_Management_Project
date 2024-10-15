<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('admin.product.add');
    }

    public function index()
    {
        $products = Product::with(['category', 'brand'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|string|max:50',
            'cost' => 'required|string|max:50',
            'unit' => 'required|string|max:50',
            'img_url' => 'required|string|max:100',
            'details' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        Product::create([
            'creator' => Auth::id(),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'code' => uniqid(),
            'price' => $request->price,
            'cost' => $request->cost,
            'unit' => $request->unit,
            'img_url' => $request->img_url,
            'details' => $request->details,
            'slug' => uniqid(),
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'price' => 'required|string|max:50',
            'cost' => 'required|string|max:50',
            'unit' => 'required|string|max:50',
            'img_url' => 'required|string|max:100',
            'details' => 'nullable|string',
            'status' => 'required|integer',
        ]);

        $product->update([
            'editor' => Auth::id(),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'price' => $request->price,
            'cost' => $request->cost,
            'unit' => $request->unit,
            'img_url' => $request->img_url,
            'details' => $request->details,
            'status' => $request->status,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}

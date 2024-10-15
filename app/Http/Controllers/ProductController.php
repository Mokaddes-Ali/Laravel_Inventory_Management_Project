<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

        public function index()
        {
            $products = Product::with('category', 'brand')->paginate(10);
            return view('products.index', compact('products'));
        }

        public function create()
        {
            $categories = Categories::all();
            $brands = Brands::all();
            return view('admin.product.add', compact('categories', 'brands'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|max:100',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'price' => 'required',
                'cost' => 'required',
                'unit' => 'required',
                'img_url' => 'nullable|url',
                'details' => 'nullable',
            ]);

            Product::create($request->all());
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        }

        public function edit(Request $request)
        {
            $categories = Categories::all();
            $brands = Brands::all();
            return view('products.edit', compact('product', 'categories', 'brands'));
        }

        public function update(Request $request)
        {
            $request->validate([
                'name' => 'required|max:100',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'price' => 'required',
                'cost' => 'required',
                'unit' => 'required',
                'img_url' => 'nullable|url',
                'details' => 'nullable',
            ]);

            $product->update($request->all());
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        }

        public function destroy(Product $product)
        {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        }
    }

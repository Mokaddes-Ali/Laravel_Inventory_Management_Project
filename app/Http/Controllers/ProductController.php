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

        public function create()
        {
            $categories = Categories::all();
            $brands = Brands::all();
            return view('admin.product.add', compact('categories', 'brands'));
        }

        public function store(Request $request)
    {
        // Form data validation
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
            'status' => 'required|in:1,0', // Active/Inactive status
        ]);

        // Image upload handling
        $image_rename = '';
        if ($request->hasFile('img_url')) {
            $image = $request->file('img_url');
            $ext = $image->getClientOriginalExtension();
            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('productImage'), $image_rename);
        }

        // Insert product data into database
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

            session()->flash('success', 'Product added successfully.');
            return redirect()->back();
        } catch (\Exception $e) {
            return back()->with('fail', 'Failed to add product: ' . $e->getMessage());
        }
    }
}

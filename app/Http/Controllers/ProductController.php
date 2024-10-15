<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

        // public function index()
        // {
        //     $products = Product::with('category', 'brand')->paginate(10);
        //     return view('products.index', compact('products'));
        // }

        public function create()
        {
            $categories = Categories::all();
            $brands = Brands::all();
            return view('admin.product.add', compact('categories', 'brands'));
        }

        public function store(Request $request, FlasherInterface $flasher)
        {
            $request->validate([
                'name' => 'required|max:100',
                'category_id' => 'required|exists:categories,id',
                'brand_id' => 'required|exists:brands,id',
                'price' => 'required',
                'cost' => 'required',
                'unit' => 'required',
                'img_url' => 'required|image|mimes:jpeg,png,gif|max:2048',
                'details' => 'nullable',
            ]);

            Product::create($request->all());
            return redirect()->route('products.index')->with('success', 'Product created successfully.');
        }



        $image_rename = '';
        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $ext = $image->getClientOriginalExtension();
            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('images'), $image_rename);
        }

        $insert = Customer::insertGetId([
            'name' => $request['name'],
            'email' => $request['email'],
            'number' => $request['number'],
            'address' => $request['address'],
            'pic' => $image_rename ,
        ]);

        if ($insert) {
            $flasher->addSuccess('Data Inserted Successfully.', [
                'position' => 'top-center',
                'timeout' => 3000,
                ]
            );
            return redirect()->back();

        } else {
            return back()->with('fail', 'Data insertion failed');
        }
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

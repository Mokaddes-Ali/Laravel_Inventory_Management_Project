<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Models\Brands;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    // Add product form
    public function create()
    {
        $categories = Category::all();
        $brands = Brands::all();
        return view('admin.product.add', compact('categories', 'brands'));
    }


     //show all data
     public function index()
     {
    $products = Product::with(['category', 'brand'])->orderBy('id', 'desc')->paginate(2);
    return view('admin.product.index', compact('products'));
    }


    // export

    public function export1()
{
    return Excel::download(new ProductsExport, 'products.xlsx');
}
public function export2()
{
    return Excel::download(new ProductsExport, 'products.csv');
}

public function export3()
{
    return Excel::download(new ProductsExport, 'products.pdf');
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
                'status' => $request->status,
            ]);

            session()->flash('success', 'Product added successfully.');
            return redirect()->back();

        } catch (\Exception $e) {
            return back()->with('fail', 'Failed to add product: ' . $e->getMessage());
        }
    }

   //product list for api in invoice
   public function productList()
{

    $products = Product::all();

    return response()->json($products);
}

    //search product for api in invoice
    // Controller method
    public function searchProducts(Request $request)
    {
        $search = $request->query('search');
        $products = Product::where('name', 'LIKE', "%{$search}%")->get(); // Case-insensitive match
        return response()->json($products);
    }

    // edit product form

    public function edit($id){
        $product = Product::find($id);
        $categories = Category::all();
        $brands = Brands::all();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }

    // Update product data

    public function update(Request $request, $id)
    {
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
    $product = Product::find($id);

    if (!$product) {
        return back()->with('fail', 'Product not found.');
    }
    $image_rename = $product->img_url;
    if ($request->hasFile('img_url')) {
        if ($product->img_url && file_exists(public_path('productImage/' . $product->img_url))) {
            unlink(public_path('productImage/' . $product->img_url));
        }

        $image = $request->file('img_url');
        $ext = $image->getClientOriginalExtension();
        $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
        $image->move(public_path('productImage'), $image_rename);
    }
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

    if ($product) {
        return redirect()->back()->with('success', 'Product updated successfully.');
    } else {
        return back()->with('fail', 'Failed to update product.');
    }
}

// Show product details
public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('fail', 'Product not found.');
    }
    if ($product->img_url && file_exists(public_path('productImage/' . $product->img_url))) {
        unlink(public_path('productImage/' . $product->img_url));
    }
    $product->delete();
    return redirect()->back()->with('success', 'Product deleted successfully.');
}

}

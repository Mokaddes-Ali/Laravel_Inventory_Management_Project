<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;

class BrandsController extends Controller

{
    // Display a listing of the brands
    public function index() {
        $brands = Brands::all();
        return view('admin.brands.add', compact('brands'));
    }

    // Show the form for creating a new brand
    public function create() {
        return view('brands.create');
    }

    // Display the specified brand by ID
    public function show($id) {
        $brand = Brands::findOrFail($id);
        return view('brands.show', compact('brand'));
    }



    public function store(Request $request)
{
    $request->validate([
        'brandName' => 'required|max:50',
        'brandImg' => 'nullable|string|max:300',
        'creator' => 1,
    ]);

    Brands::create($request->all());
    return redirect()->route('brands.index')->with('success', 'Brand created successfully');
}



    // Show the form for editing the specified brand by ID
    public function edit($id) {
        $brand = Brands::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    // Update the specified brand in storage by ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'brandName' => 'required|max:50',
            'brandImg' => 'nullable|string|max:300',
            'editor' => 'nullable|exists:users,id',
        ]);

        $brand = Brands::findOrFail($id);
        $brand->update($request->all());

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully');
    }

    // Remove the specified brand from storage by ID
    public function destroy($id) {
        $brand = Brands::findOrFail($id);
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully');
    }
}

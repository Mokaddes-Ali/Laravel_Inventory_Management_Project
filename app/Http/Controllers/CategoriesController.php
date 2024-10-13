<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;

class CategoriesController extends Controller

{


    public function index()
    {
        $all = Categories::all();
        return view('admin.category.add', compact('all'));
    }

    public function show()
    {
        $all = Categories::all();
        return view('admin.category.show', compact('all'));
    }




    public function store(Request $request, FlasherInterface $flasher)
    //  dd($request->all());
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:200',
        ]);

        $insert = Categories::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'slug' => uniqid().rand(10000, 10000000),
            'status'=> 1,
            'creator' =>Auth:: user()->id,
        ]);

        if ($insert) {
            $flasher->addSuccess('Data Inserted Successfully.', [
                'position' => 'top-center',  // Set the position (e.g., top-right, bottom-left, etc.)
                'timeout' => 2000,
                'important' => true,
                'css' => [
                    'z-index' => 1050,  // Add z-index here
                ]
            ]);
            return redirect()->back();
        } else {
            return back()->with('fail', 'Data insertion failed');
        }
    }





    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
           'remarks' => 'nullable|string|max:200',
           'slug' => 'nullable|string|max:50|unique:categories,slug,' . $id,
           'status' => 'required|integer|in:0,1',
        ]);

        $category->update([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'slug' => $request->slug,
            'status' => $request->status,
            'editor' => auth()->id(),
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Request $request)
    {
        $request->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}

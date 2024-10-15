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
        $all = Categories::orderBy('id', 'asc')->paginate(9);
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
                'position' => 'top-center',
                'timeout' => 3000,
                ]
            );
            return redirect()->back();
        } else {
            return back()->with('fail', 'Data insertion failed');
        }
    }


    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }



    public function update(Request $request)
    {
        // dd($request->all());
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:200',
        ]);

        $update = Categories::where('id',$id)->update([
            'name' => $request->name,
            'remarks' => $request->remarks,

            'editor' =>Auth:: user()->id,
        ]);


        if ($update) {
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } else {
            return back()->with('fail', 'Failed to update category.');
        }
    }


    public function destroy(Request $request)
    {
        $request->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    // Add category form
    public function index()
    {
        $all = Category::all();
        return view('admin.category.add', compact('all'));
    }



    // Show all categories
    public function show()
    {
        $all = Category::orderBy('id', 'desc')->paginate(6);
        return view('admin.category.show', compact('all'));
    }


  // Show category data
    public function dataShow($id)
{
    $category= Category::with(['creatorUser', 'editorUser'])->findOrFail($id);
    return view('admin.category.index', compact('category'));
}


    public function export1()
{
    return Excel::download(new CategoryExport, 'category.xlsx');
}
public function export2()
{
    return Excel::download(new CategoryExport, 'category.csv');
}

public function export3()
{
    return Excel::download(new CategoryExport, 'category.pdf');
}


    // Insert category data
    public function store(Request $request, FlasherInterface $flasher)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:200',
        ]);
        $randomNumber = uniqid().rand(10000, 100000);
        $randomLetters = Str::lower(Str::random(4));
       $randomSlug =  $randomLetters . $randomNumber;

        $insert = Category::create([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'slug' => $randomSlug,
            'status' => 1,
            'creator' => Auth::user()->id,
        ]);

        if ($insert) {
            $flasher->addSuccess('Data Inserted Successfully.', [
                'position' => 'top-center',
                'timeout' => 3000,
            ]);
            return redirect()->back();
        } else {
            return back()->with('fail', 'Data insertion failed');
        }
    }


    // Edit category form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|max:50',
            'remarks' => 'nullable|string|max:200',
        ]);

        $randomNumber = uniqid().rand(10000, 100000);
        $randomLetters = Str::lower(Str::random(4));
       $randomSlug =  $randomLetters . $randomNumber;

        $update = Category::where('id', $id)->update([
            'name' => $request->name,
            'remarks' => $request->remarks,
            'slug' => $randomSlug,
            'editor' => Auth::user()->id,
        ]);

        if ($update) {
            return redirect()->route('category.show')->with('success', 'Category updated successfully.');
        } else {
            return back()->with('fail', 'Failed to update category.');
        }
    }


    // Delete category data
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}

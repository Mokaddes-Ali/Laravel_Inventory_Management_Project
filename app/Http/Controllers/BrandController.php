<?php

namespace App\Http\Controllers;

use App\Exports\BrandsExport;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class BrandController extends Controller
{
//add form
public function index(){
    return view('admin.brands.add');
}

   //show all data
public function show(){
    $all = Brand::orderBy('id', 'desc')->paginate(4);
    return view('admin.brands.show', compact('all'));
}


public function dataShow($id)
{
    $brand = Brand::findOrFail($id); // Find the brand by its ID
    return view('admin.brands.index', compact('brand'));
}

//export data

public function export1()
{
    return Excel::download(new BrandsExport, 'brands.xlsx');
}
public function export2()
{
    return Excel::download(new BrandsExport, 'brands.csv');
}

public function export3()
{
    return Excel::download(new BrandsExport, 'brands.pdf');
}

//insert data
public function create(Request $request) {
    //dd($request->all());

    $request->validate([
        'brandName' => 'required|max:40',
        'brandImg' => 'required|image|mimes:jpeg,png,gif|max:2048',
    ]);

    $image_rename = '';

    if ($request->hasFile('brandImg')) {
        $image = $request->file('brandImg');
        $ext = $image->getClientOriginalExtension();
        $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
        $image->move(public_path('BrandImage'), $image_rename);
    }

    $insert = Brand::create([
        'brandName' => $request->brandName,
        'brandImg' => $image_rename,
        'creator' => Auth::user()->id,
    ]);

    if ($insert) {
        return redirect()->back()->with('success', 'Data inserted successfully');
    } else {
        return back()->with('fail', 'Data insertion failed');
    }
}


public function edit($id){
    $record = Brand::findOrFail($id);
    return view('admin.brands.edit', compact('record'));
}

public function update(Request $request){
     //dd($request->all());
    $id = $request->id;
     $request->validate([
        'brandName' => 'required|max:40',
        'brandImg' => 'nullable|mimes:jpeg,png,gif|max:2048',
    ]);

    $oldimg = Brand::findOrFail($id);
    $deleteimg=public_path('BrandImage/'.$oldimg['brandImg']);
    $image_rename = '';

    if ($request->hasFile('brandImg')) {
        $image = $request->file('brandImg');
        $ext = $image->getClientOriginalExtension();

        if(file_exists($deleteimg)){
            unlink($deleteimg);
          }

        $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
        $image->move(public_path('BrandImage'), $image_rename);
        }
        else{
            $image_rename=$oldimg['brandImg'];
        }

    $update = Brand::where('id',$id)->update([
        'brandName' => $request->brandName,
        'brandImg' => $image_rename,
        'editor' => Auth::user()->id,
    ]);

    if ($update) {
        return back()->with('success', 'Data updated successfully');
    } else {
        return back()->with('fail', 'Data update failed');
    }
}


public function destroy($id){
    $id=intval($id);
    $brand =Brand::find($id);
    if ($brand) {
        $imagePath = public_path('BrandImage/' . $brand->brandImg);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $brand->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}
}


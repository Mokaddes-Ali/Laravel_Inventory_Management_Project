<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandsController extends Controller
{
public function index(){
    return view('admin.brands.add');
}

public function show(){
    $all = Brands::orderBy('id', 'asc')->paginate(20);
    return view('admin.brands.show', compact('all'));
}


public function create(Request $request){
    // dd($request->all());
        $request->validate([
        'name' => 'required|max:40',
        'brandImg' => 'required|image|mimes:jpeg,png,gif|max:2048',
        'creator' => Auth::user()->id,
    ]);

    $image_rename = '';
    if ($request->hasFile('brandImg')) {
        $image = $request->file('brandImg');
        $ext = $image->getClientOriginalExtension();
        $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
        $image->move(public_path('BrandImage'), $image_rename);
    }

    $insert = Brands::insertGetId([
        'name' => $request['name'],
        'brandImg' => $image_rename ,
    ]);

    if ($insert) {
        return redirect()-> route('show')->with('success', 'Data inserted successfully');

    } else {
        return back()->with('fail', 'Data insertion failed');
    }
}

public function edit($id){
    $record = Brands::findOrFail($id);
    return view('admin.brands.edit', compact('record'));
}

public function update(Request $request){
     //dd($request->all());
    $id = $request->id;
     $request->validate([
        'name' => 'required|max:40',
        'brandImg' => 'nullable|mimes:jpeg,png,gif|max:2048',
    ]);

    $oldimg = Brands::findOrFail($id);
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

    $update = Brands::where('id',$id)->update([
        'name' => $request->name,
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
    $customer =Brands::find($id);
    if ($customer) {
        $imagePath = public_path('BrandImage/' . $customer->pic);
        if (file_exists($imagePath)) { // Check if it's a file
            unlink($imagePath);
        }
        $customer->delete();
        return back()->with('success', 'Data deleted successfully');
    }
}
}


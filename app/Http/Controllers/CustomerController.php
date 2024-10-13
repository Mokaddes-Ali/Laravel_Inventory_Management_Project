<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        return view('admin.customer.add');
    }

    public function show(){
        $all = Customer::all();
        return view('admin.customer.show', compact('all'));
    }


    public function create(Request $request){
            $request->validate([
            'name' => 'required|max:40',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'pic' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ]);

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
            return redirect()-> route('show')->with('success', 'Data inserted successfully');

        } else {
            return back()->with('fail', 'Data insertion failed');
        }
    }

    public function edit($id){
        $record = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('record'));
    }

    public function update(Request $request){
         //dd($request->all());
        $id = $request->id;
         $request->validate([
            'name' => 'required|max:40',
            'email' => 'required',
            'number' => 'required',
            'address' => 'required',
            'pic' => 'nullable|mimes:jpeg,png,gif|max:2048',
        ]);

        $oldimg = Customer::findOrFail($id);
        $deleteimg=public_path('images/'.$oldimg['pic']);
        $image_rename = '';

        if ($request->hasFile('pic')) {
            $image = $request->file('pic');
            $ext = $image->getClientOriginalExtension();

            if(file_exists($deleteimg)){
                unlink($deleteimg);
              }

            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('images'), $image_rename);
            }
            else{
                $image_rename=$oldimg['pic'];
            }

        $update = Customer::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'pic' => $image_rename,
        ]);

        if ($update) {
            return back()->with('success', 'Data updated successfully');
        } else {
            return back()->with('fail', 'Data update failed');
        }
    }
    public function destroy($id){
        $id=intval($id);
        $customer = Customer::find($id);
        if ($customer) {
            $imagePath = public_path('images/' . $customer->pic);
            if (file_exists($imagePath)) { // Check if it's a file
                unlink($imagePath);
            }
            $customer->delete();
            return back()->with('success', 'Data deleted successfully');
        }
    }
}

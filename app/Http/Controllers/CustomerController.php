<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Add customer form
    public function index(){
        return view('admin.customer.add');
    }

    // Show all customers

    public function show(){
        $all = Customer::orderBy('id', 'asc')->paginate(3);
        return view('admin.customer.show', compact('all'));
    }

     // Insert customer data
    public function create(Request $request, FlasherInterface $flasher){
          //dd($request->all());

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

    // Edit customer form
    public function edit($id){
        $record = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('record'));
    }


    public function customertList(){
        $all = Customer::all();
        return response()->json($all);

    }

    // Update customer data

    public function update(Request $request, FlasherInterface $flasher){
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
            'creator' => Auth::user()->id,
            'slug' => uniqid().rand(10000, 10000000),
        ]);

        if ($update) {
            $flasher->addSuccess('Update Successfully.', [
                'position' => 'top-center',
                'timeout' => 3000,
                ]
            );
            return redirect()->route('customer.show');
        } else {
            return back()->with('fail', 'Data update failed');
        }
    }

    // Delete customer data
    public function destroy($id, FlasherInterface $flasher)
    {
        $id = intval($id);
        $customer = Customer::find($id);
        if ($customer) {
            $imagePath = public_path('images/' . $customer->pic);
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $customer->delete();
            $flasher->addSuccess('Deleted successfully.', [
                'position' => 'top-center',
                'timeout' => 3000,
            ]);

            return redirect()->back();
        }
        $flasher->addError('Customer not found.', [
            'position' => 'top-center',
            'timeout' => 3000,
        ]);

        return redirect()->back();
    }
}

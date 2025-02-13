<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Models\Customer;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CustomerController extends Controller
{
    // Add customer form
    public function index(){
        return view('admin.customer.add');
    }

    // Show all customers

    public function show(){
        $all = Customer::orderBy('id', 'desc')->paginate(3);
        return view('admin.customer.show', compact('all'));
    }

     // Insert customer data
//     public function create(Request $request, FlasherInterface $flasher){
//         //   dd($request->all());

//             $request->validate([
//             'name' => 'required|max:40',
//             'email' => 'required|email|unique:customers,email',
//             // 'slug' => 'required|unique:customers,slug',
//             'number' => 'required',
//             'address' => 'required',
//             // 'slug' => 'required|unique exists:customers,slug',
//             'pic' => 'required|image|mimes:jpeg,png,gif|max:2048',
//         ]);


// //        // Slug Generate
// //   $randomLetters = Str::upper(Str::random(1)) . Str::lower(Str::random(1)) . Str::upper(Str::random(1));
// //    $datePart = Carbon::now()->format('dmy');
// //     $slug = '#' . $randomLetters . $datePart;

//         $image_rename = '';
//         if ($request->hasFile('pic')) {
//             $image = $request->file('pic');
//             $ext = $image->getClientOriginalExtension();
//             $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
//             $image->move(public_path('images'), $image_rename);
//         }

//         $insert = Customer::insertGetId([
//             'name' => $request['name'],
//             'email' => $request['email'],
//             'number' => $request['number'],
//             'address' => $request['address'],
//             'pic' => $image_rename ,
//             // 'slug' => $slug,
//         ]);

//         // dd($insert);

//         if ($insert) {
//             $flasher->addSuccess('Data Inserted Successfully.', [
//                 'position' => 'top-center',
//                 'timeout' => 3000,
//                 ]
//             );
//             return redirect()->back();

//         } else {
//             return back()->with('fail', 'Data insertion failed');
//         }
//     }


public function create(Request $request, FlasherInterface $flasher){
    $request->validate([
        'name' => 'required|max:40',
        'email' => 'required|email|unique:customers,email',
        'number' => 'required',
        'address' => 'required',
        'pic' => 'required|image|mimes:jpeg,png,gif|max:2048',
        'status' => 'required|in:0,1',
    ]);


   $randomLetters = Str::upper(Str::random(1)) . Str::lower(Str::random(2)) . Str::upper(Str::random(2));
   $datePart = Carbon::now()->format('dmy');
   $randomSlug = '#' . $randomLetters . $datePart;

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
        'pic' => $image_rename,
        'slug' => $randomSlug,
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



// public function create(Request $request, FlasherInterface $flasher) {
//     dd($request->all());

//     $request->validate([
//         'name' => 'required|max:40',
//         'email' => 'required|email|unique:customers,email',
//         'slug' => 'required|unique:customers,slug',
//         'number' => 'required',
//         'address' => 'required',
//         'pic' => 'required|image|mimes:jpeg,png,gif|max:2048',
//         // 'status' => 'required|in:0,1',
//     ]);

//    // Slug Generate
//    $randomLetters = Str::upper(Str::random(1)) . Str::lower(Str::random(1)) . Str::upper(Str::random(1));
//    $datePart = Carbon::now()->format('dmy');
//    $slug = '#' . $randomLetters . $datePart;


//     $image_rename = '';
//     if ($request->hasFile('pic')) {
//         $image = $request->file('pic');
//         $ext = $image->getClientOriginalExtension();
//         $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
//         $image->move(public_path('images'), $image_rename);
//     }

//     $insert = Customer::create([
//         'name' => $request->name,
//         'email' => $request->email,
//         'number' => $request->number,
//         'address' => $request->address,
//         'pic' => $image_rename,
//         'slug' => $slug,
//         // 'status' => $request->status,
//     ]);

//     if ($insert) {
//         $flasher->addSuccess('Data Inserted Successfully.', [
//             'position' => 'top-center',
//             'timeout' => 3000,
//         ]);
//         return redirect()->back();
//     } else {
//         return back()->with('fail', 'Data insertion failed');
//     }
// }


    // Edit customer form
    public function edit($id){
        $record = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('record'));
    }


  // paginated customer list
public function customerList()
{
    $customers = Customer::orderBy('id', 'desc')->get();

    return response()->json( $customers);
}


    //Search Customer


// paginated customer search results
public function searchCustomers(Request $request)
{
    $searchTerm = $request->input('search');

    $customers = Customer::where('name', 'LIKE', "%{$searchTerm}%")
                         ->orWhere('address', 'LIKE', "%{$searchTerm}%")
                         ->orderBy('name', 'asc') // Sort by name or another column if needed
                         ->get();

    return response()->json($customers);
}


public function dataShow($id)
{
    $customer = Customer::with(['creatorUser', 'editorUser'])->findOrFail($id);
    return view('admin.customer.index', compact('customer'));
}


public function export1()
{
    return Excel::download(new CustomersExport, 'customers.xlsx');
}
public function export2()
{
    return Excel::download(new CustomersExport, 'customers.csv');
}

public function export3()
{
    return Excel::download(new CustomersExport, 'customers.pdf');
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

            $randomLetters = Str::upper(Str::random(1)) . Str::lower(Str::random(2)) . Str::upper(Str::random(2));
          $datePart = Carbon::now()->format('dmy');
          $randomSlug = '#' . $randomLetters . $datePart;

        $update = Customer::where('id',$id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'pic' => $image_rename,
            'creator' => Auth::user()->id,
            'slug' => $randomSlug,
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

<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index(){
        $all = Project::where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.expense.add', compact('all'));
      }


    public function show(){
         $all = Expense::where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.expense.show', compact('all'));
      }

    public function store(Request $request){
        // dd($request->all());
        $request->validate([

            'project_id' => 'required',
            'expense_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account_id' => 'required',

        ]);

        DB::beginTransaction();

        try {

        $insert=Expense::insertGetId([
           'project_id' => $request->project_id,
           'expense_amount' => $request->expense_amount,
           'date' => $request->date,
           'note' => $request->note,
           'bank_account_id' => $request->bank_account_id,
           'creator' => Auth::user()->id,
           'slug' => $request->project_id . rand(10000,10000000),

        ]);

        if( $insert){

                DB::commit();

         return redirect()->back()->with('success','Expense Inserted successfully');

        }
    } catch (\Exception $e) {
    DB::rollback();
    }
 }



 public function edit($id){
    $all=Project::where('status',0)->get();
    $data=Expense::where('id',$id)->firstOrFail();
    return view('admin.expense.edit',compact('data','all'));
  }



    public function update(Request $request){
        // dd($request->all());
        $request->validate([

            'project_id' => 'required',
            'expense_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account' => 'required',

        ]);

        $update=Expense::where('id', $request->id)->update([
            'project_id' => $request->project_id,
            'expense_amount' => $request->expense_amount,
            'date' => $request->date,
            'note' => $request->note,
            'bank_account_id' => $request->bank_account,
            'editor' => Auth::user()->id,

         ]);

         if( $update){

            return redirect()->back()->with('success','Data updated successfully');

    }
 }


   public function destroy($id){
    $delete = Expense::where('id', $id)->delete();
    if($delete){
        return redirect()->back()->with('success','Data deleted successfully');
    }
}

}

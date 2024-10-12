<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IncomeController extends Controller
{
    public function incomeindex(){
        $all = Project::where('status', 0)->orderBy('id', 'ASC')->get();
        return view('admin.Income.add', compact('all'));
    }

    public function incomeshow(){
        $all = Income::where('status', 1)->orderBy('id', 'ASC')->get();
        return view('admin.Income.show', compact('all'));
    }


    public function filter(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $all = Income::whereDate('date', '>=', $start_date)->whereDate('date', '<=', $end_date)->get();
        return view('admin.Income.show', compact('all'));
    }

    public function search(Request $request)
{
    $searchTerm = $request->input('search');

    $all = Income::where(function($query) use ($searchTerm) {
        $query->whereRaw('LOWER(income.project_name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
              ->orWhereRaw('LOWER(note) LIKE ?', ['%' . strtolower($searchTerm) . '%']);
    })->get();

    return view('your.view.name', compact('all'));
}


    public function incomestore(Request $request){
        $request->validate([
            'project_id' => 'required',
            'income_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $insert = Income::insertGetId([
                'project_id' => $request->project_id,
                'income_amount' => $request->income_amount,
                'date' => $request->date,
                'note' => $request->note,
                'bank_account_id' => $request->bank_account_id,
                'creator' => Auth::user()->id,
                'slug' => $request->project_id . rand(10000, 10000000),
            ]);

            $data = Project::where('id', $request->project_id)->firstOrFail();

            $paid_amount = (float) $request->income_amount + (float) $data->paid_amount;
            $due_amount = (float) $data->project_value - (float) $paid_amount;

            if ($insert) {
                Project::where('id', $request->project_id)->update([
                    'paid_amount' => $paid_amount,
                    'due_amount' => $due_amount,
                ]);
                DB::commit();

                return redirect()->back()->with('success', 'Data inserted successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function edit($id){
        $all = Project::where('status', 0)->get();
        $data = Income::where('id', $id)->firstOrFail();
        return view('admin.Income.edit', compact('data', 'all'));
    }

    public function update(Request $request){
        $request->validate([
            'project_id' => 'required',
            'income_amount' => 'required',
            'date' => 'required',
            'note' => 'required',
            'bank_account' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $oldincome = Income::where('id', $request->id)->firstOrFail();

            $update = Income::where('id', $request->id)->update([
                'project_id' => $request->project_id,
                'income_amount' => $request->income_amount,
                'date' => $request->date,
                'note' => $request->note,
                'bank_account_id' => $request->bank_account,
                'editor' => Auth::user()->id,
            ]);

            $data = Project::where('id', $request->project_id)->firstOrFail();

            $paid_amount = (float) $request->income_amount + (float) $data->paid_amount - (float) $oldincome->income_amount;
            $due_amount = (float) $data->project_value - (float) $paid_amount;

            if ($update) {
                Project::where('id', $request->project_id)->update([
                    'paid_amount' => $paid_amount,
                    'due_amount' => $due_amount,
                ]);
                DB::commit();

                return redirect()->back()->with('success', 'Data updated successfully');
            }
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    // Delete functionality
    public function destroy($id){
        DB::beginTransaction();

        try {
            $income = Income::where('id', $id)->firstOrFail();
            $project = Project::where('id', $income->project_id)->firstOrFail();

            $paid_amount = (float) $project->paid_amount - (float) $income->income_amount;
            $due_amount = (float) $project->project_value - (float) $paid_amount;

            Income::where('id', $id)->delete();

            Project::where('id', $project->id)->update([
                'paid_amount' => $paid_amount,
                'due_amount' => $due_amount,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Income record deleted successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete the income record');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProjectController extends Controller
{


      public function index(){
        $all = Client::all();
        return view('admin.projects.add', compact('all'));
      }

      public function projectshow(){
        $all=Project::all();
        return view('admin.projects.show',compact('all'));
        }


      public function store(Request $request){
        //  dd($request->all());

        $request->validate([
            'project_name' => 'required|max:40',
            'client_id' => 'required',
            'date' => 'required',
            'project_value' => 'required',
            'description' => 'required',
        ]);

        $insert = Project::insertGetId([
            'project_name' => $request['project_name'],
            'client_id' => $request['client_id'],
            'date' => $request['date'],
            'project_value' => $request['project_value'],
            'description' => $request['description'],
            'creator' => Auth::user()->id,
            'slug' => uniqid().rand(10000, 10000000),
        ]);

        if ($insert) {
            return back()->with('success', 'Data inserted successfully');
        } else {
            return back()->with('fail', 'Data insertion failed');
        }

      }

      public function projectedit ($id){
        $all=Client::all();
        $data=Project::where('id',$id)->firstOrFail();
        return view('admin.projects.edit',compact('data','all'));
        }

        public function projectupdate(Request $request){
            // dd($request->all());

             $request->validate([
              'project_name' => 'required|max:45',
              'client_id' => 'required',
              'project_value' => 'required',
              'description' => 'required',
              'date' => 'required',

          ]);

          $id=$request->id;

          $update = Project::where('id',$id)->update([
          'project_name' =>$request->project_name,
          'client_id' =>$request->client_id,
          'project_value' =>$request->project_value,
          'description' =>$request->description,
          'date' =>$request->date,
          'editor'=> Auth::user()->id,

          ]);

          if($update){
              return back()->with('success', 'Data Updated Successfully');
          } else {
              return back()->with('error', 'Query Failed');
          }
     }

     public function projectdestroy($id){
        $id=intval($id);
        $projectdelete = Project::find($id);
        $projectdelete->delete();
            return back()->with('success', 'Data deleted successfully');
        }
 }



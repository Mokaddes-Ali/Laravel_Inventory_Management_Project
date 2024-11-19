<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $roles = Role::orderBy('id','DESC')->get();
        return view('admin.roles.index',compact('roles'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permission = Permission::get();
        return view('admin.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
           'name' => 'required|unique:roles,name',
            'permission' => 'required',

        ]);

$permissionsID=array_map(
function($value){return (int) $value;}
, $request->input('permission')

);

$role = Role::create(['name' => $request->input('name')]);
$role->syncPermissions($permissionsID);

return redirect()->back()->with('success','Role Added successfully');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
$role=Role::findOrFail($id);
$permission = Permission::get();
$rolePermissions =$role->permissions()->pluck('id')->toArray();

return view('admin.roles.edit',compact('role','permission','rolePermissions'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
             'permission' => 'required',

         ]);
         $role=Role::find($id);
         $role->name=$request->input('name');
         $role->update();


         $permissionsID=array_map(
         function($value){return (int) $value;}
        , $request->input('permission'));

        $role->syncPermissions($permissionsID);

        return redirect()->back()->with('success','Role update successfully');


    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->back()
                        ->with('success','Role deleted successfully');
    }
}

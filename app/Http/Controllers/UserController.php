<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $data = User::orderBy('id','asc')->paginate(5);

        return view('admin.users.index',compact('data'));
    }

    public function create()
    {   // one column from the roles table
        $roles = Role::pluck('name','name')->all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string', 'email','max:255'],
            'password' => ['required','string','min:8'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->roles);

        return redirect()->route('users.index')
            ->with('success','User created successfully');

    }


    public function edit($id): View
    {
        $user = User::findOrFail($id);  // Get the user by ID
        $roles = Role::pluck('name', 'name')->all();  // Get all roles
        $userRoles = $user->roles->pluck('name')->toArray();  // Get current user's roles

        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    // Update the specified user in the database
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8'],
            'roles' => ['required', 'array'],
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;


        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();


        $user->syncRoles($request->roles);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}

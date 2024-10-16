<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Edit settings
    public function edit(){
        $data = Settings::firstOrFail();
        return view('admin.setting.edit', compact('data'));
    }

    // Update settings
    public function update(Request $request){
        $request->validate([
            'company_name' => 'required|max:45',
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:100000',
        ]);
        $oldimg = Settings::findOrFail($request->id);
        $deleteimg = public_path('logo/'.$oldimg['logo']);
        $image_rename = $oldimg['logo'];
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $ext = $image->getClientOriginalExtension();

            if (file_exists($deleteimg)) {
                unlink($deleteimg);
            }
            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('logo'), $image_rename);
        }

        $update = Settings::where('id', $request->id)->update([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'logo' => $image_rename,
        ]);
        if($update){
            return back()->with('success', 'Data updated Successfully');
        } else {
            return back()->with('error', 'Query Failed');
        }
    }
}

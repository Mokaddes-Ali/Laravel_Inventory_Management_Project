<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(){
        $data = Settings::firstOrFail();
        return view('admin.setting.edit', compact('data'));
    }

    public function update(Request $request){
        // Validate the request
        $request->validate([
            'company_name' => 'required|max:45', // Corrected typo
            'email' => 'required|email',
            'mobile' => 'required',
            'address' => 'required',
            'logo' => 'nullable|mimes:jpeg,jpg,png,gif,webp|max:100000',
        ]);

        // Retrieve old data and initialize variables
        $oldimg = Settings::findOrFail($request->id); // Use $request->id instead of hardcoded 1
        $deleteimg = public_path('logo/'.$oldimg['logo']);
        $image_rename = $oldimg['logo'];

        // Check and upload new logo
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $ext = $image->getClientOriginalExtension();

            if (file_exists($deleteimg)) {
                unlink($deleteimg); // Delete old image if exists
            }

            $image_rename = time() . '_' . rand(100000, 10000000) . '.' . $ext;
            $image->move(public_path('logo'), $image_rename);
        }

        // Update settings
        $update = Settings::where('id', $request->id)->update([
            'company_name' => $request->company_name, // Corrected typo
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'logo' => $image_rename,
        ]);

        // Return with success or error message
        if($update){
            return back()->with('success', 'Data updated Successfully');
        } else {
            return back()->with('error', 'Query Failed');
        }
    }
}

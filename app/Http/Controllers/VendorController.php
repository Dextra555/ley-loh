<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vendor;

class VendorController extends Controller
{
    public function vendor_form(){
       return view('pages.vendor');
    //    return view('pages.vendor',compact('states','city','apartment'));

      }


      public function store(Request $request)
      {
          // Validate the form data
         $request->validate([
              'username' => 'required|string|max:255',
              'password' => 'required|string|min:8',
              'confirm_password' => 'required|same:password',
              'email' => 'required|email|max:255',
              'mobile_number' => 'required|string|max:15',
              'location' => 'nullable|string|max:255',
              'industry_type' => 'required|string|max:255',
              'icon_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          ]);
  
       


          $user = Vendor::create([
                    'username' => $validatedData['username'],
                    'password' => bcrypt($validatedData['password']),
                    'email' => $validatedData['email'],
                    'mobile_number' => $validatedData['mobile_number'],
                    'location' => $validatedData['location'],
                    'industry_type' => $validatedData['industry_type'],
                  
                ]);


if($user){
  return redirect()->route('pages.location_state')->with('success', 'Post created successfully.');
}else{
  return redirect()->route('pages.dashboard')->with('success', 'Post created successfully.');
}

return redirect()->route('pages.dashboard')->with('success', 'Post created successfully.');


          // Save the vendor
        //   // Upload icon images
        //   if ($request->hasFile('icon_images')) {
        //       foreach ($request->file('icon_images') as $file) {
        //           $filename = $file->getClientOriginalName();
        //           $file->storeAs('public/icon_images', $filename);
        //           // Save the file path to the database if needed
        //           // $vendor->icon_images()->create(['path' => $filename]);
        //       }
        //   }
  
          // Redirect back with success message
          // return redirect()->back()->with('success', 'Vendor registered successfully.');
      }
}
   
<?php
namespace App\Http\Controllers\ApiControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\Area;
use App\Models\Apartment;
use App\Models\Customer;
use App\Models\Products;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\Vendor;

class UserController extends Controller
{


    public function store_vendor(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'mobile_number' => 'required',
            'location' => 'required',
            'industry_type' => 'required',
    
        ]);

        try {
            $vendor = new Vendor;
            $vendor->username = $request->username;
            $vendor->password = Hash::make($request->password);
            $vendor->email = $request->email;
            $vendor->mobile_number = $request->mobile_number;
            $vendor->location = $request->location;
            $vendor->industry_type = $request->industry_type;
            $vendor->save();

            return redirect()->route('vendor_list')->with('success', 'Apartment Added Successfully');
        
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the customer',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    


    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'apartment' => 'required',
            'area' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);
    
        try {
            $customer = new Customer;
            $customer->username = $request->username;
            $customer->password = Hash::make($request->password);
            $customer->email = $request->email;
            $customer->apartment = $request->apartment;
            $customer->area = $request->area;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->country = $request->country;
            $customer->save();
    
            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully',
                'data' => $customer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the customer',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




public function singlesignup(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        try {
            $customer = new Customer;
            $customer->username = $request->username;
            $customer->password = Hash::make($request->password);
            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully',
                'data' => $customer,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the customer',
                'error' => $e->getMessage(),
            ], 500);
        }
    }




    public function login(Request $request)
    {
        if ($request->username != '' && $request->password != '') {
            $user = Customer::where('email', $request->username)->get();
            if ($user->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'User Not Exits',
                ], 404);
            } else {
                if (Hash::check($request->password, $user[0]->password)) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Login successfully',
                        'data' => $user,

                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'User Not Exits',

                    ]);
                }
            }

        } else if (empty($request->username)) {
            return response()->json([
                'success' => false,
                'message' => 'Username is required',
            ], 404);
        } else if (empty($request->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Password is required',
            ], 404);
        } else if (($request->username) == '' && $request->password) {
            return response()->json([
                'success' => false,
                'message' => 'username & Password is required',
            ], 404);
        }


    }

    
    public function get_countries()
    {
        try {
            $countries = Country::select('id', 'name')->get();
            return response()->json([
                'success' => true,
                'message' => 'Countries retrieved successfully',
                'data' => $countries,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while retrieving countries',
            ], 500);
        }
    }

    public function get_states(Request $request)
    {
        if ($request->country_id) {
            $states = State::select('id', 'name')
                ->where('country', $request->country_id)
                ->get();

            if ($states->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'State not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'State retrieved successfully',
                'data' => $states,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing ID parameter',
            ], 400);
        }


    }

    public function get_cities(Request $request)
    {
        if ($request->state_id) {
            $cities = City::select('id', 'name')
                ->where('state', $request->state_id)
                ->get();

            if ($cities->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cities not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Cities retrieved successfully',
                'data' => $cities,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing ID parameter',
            ], 400);
        }
    }

    public function get_areas(Request $request)
    {
        if ($request->area_id) {
            $areas = Area::select('id', 'name')
                ->where('city', $request->area_id)
                ->get();

            if ($areas->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Areas not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Areas retrieved successfully',
                'data' => $areas,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing ID parameter',
            ], 400);
        }
    }

    public function get_apartments_insert(Request $request)
    {

        $validatedData = $request->validate([
            'city' => 'required',
            'apartmentname' => 'required',
        ]);
        $Apartmentment = new Apartment;
        $Apartmentment->area = $request->city;
        $Apartmentment->name = $request->apartmentname;
        $Apartmentment->save();
        return redirect('apartment')->with('success','Apartment Added Successfully');
        // return redirect()->back()->with('message', 'Apartment Added Successfully!');

    }


    public function get_apartments(Request $request)
    {
        if ($request->apartment_id) {
            $apartments = Apartment::select('id', 'name')
                ->where('area', $request->apartment_id)
                ->get();

            if ($apartments->isEmpty()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Apartmentments not found',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Apartmentments retrieved successfully',
                'data' => $apartments,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing ID parameter',
            ], 400);
        }


    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required',
            'password' => 'required',
            'apartment' => 'required',
            'area' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        try {
            $customer = new Customer;
            $customer->username = $request->username;
            $customer->password = Hash::make($request->password);
            $customer->apartment = $request->apartment;
            $customer->area = $request->area;
            $customer->city = $request->city;
            $customer->state = $request->state;
            $customer->country = $request->country;
            $customer->save();

            return response()->json([
                'success' => true,
                'message' => 'Customer created successfully',
                'data' => $customer,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the customer',
                'error' => $e->getMessage(),
            ], 500);
        }


    }
    public function search(Request $request)
    {
        if($request->search)
        {
            $keyword=$request->search;
            $ProductsData = Products::where('name', 'like', "%$keyword%")
                     ->get();
                     if ($ProductsData->isEmpty()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Products not found',
                        ], 404);
                    }
        
                    return response()->json([
                        'success' => true,
                        'message' => 'Products retrieved successfully',
                        'data' => $ProductsData,
                    ]);
        } 
        else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or missing ID parameter',
            ], 400);
        }    
    }

        public function uploadprofileimg(Request $request)
        {
            if ($request->hasFile('profileimg')) {
                $profileimg = $request->file('profileimg');
                $imagePath = $profileimg->store('images', 'public');
                print_r($profileimg);die();
            }
            
        }
        public function otp_send(Request $request)
        {
            //  $user = $request->user();
            $user='nanthini7596@gmail.com';
            $otpCode = rand(1000, 9999);
            $email = 'nanthini7596@gmail.com';
            $expirationTime = Carbon::now()->addMinutes(10);
            Mail::to($email)->send(new \App\Mail\OtpMail($otpCode));
            $otpVerification = new OtpVerification;
            $otpVerification->otp_code = $otpCode;
            $otpVerification->otp_expires_at =$expirationTime;
            $otpVerification->user = $user;
            $otpVerification->save();
            // $otpVerification = new OtpVerification([
            //     'otp_code' => $otpCode,
            //     'otp_expires_at' => $expirationTime,
            //     'user'=>$user,
            // ]);
            $otpVerification->save();
            return response()->json(['message' => 'OTP sent successfully']);
        }

        public function otpverfication(Request $request)
        {
            $otp=$request->username;
            $user = 'nanthini7596@gmail.com';
            if ($user!= '') {
                $otpverify = OtpVerification::where('user', $user)->get();
                foreach ($otpverify as $record) {
                    $otpCode = $record->otp_code;
                    $expiresAt = $record->otp_expires_at;
                    $user = $record->user;     
                    if($otpCode==$otp)
                    {
                        return response()->json(['message' => 'OTP Verified Sucessfully']);

                    }
                    else
                    {
                        return response()->json(['message' => 'OTP Mismatch']);
                    }
                }
            }

        }


}
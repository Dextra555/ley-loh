<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Myusers;



class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    //user register    
    public function create()
    {
        return view('users.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'location' => 'required',
            'mobile_number' => 'required',
            'password' => 'required|min:6',
        ]);

        Myusers::create([
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
        ]);

        return redirect('/login')->with('success', 'User registered successfully.');
    }

    public function user_list()
       {
           $users = Myusers::all();        
           return view('users.users_list', compact('users'));
   
       }



        public function storeStatus(Request $request)
    {
        try {
            $userId = $request->input('userId');
            $status = $request->input('status');

            $user = Myusers::findOrFail($userId);

            $user->status = $status;
            $user->save();

            echo json_encode(array('success' => true));
        } catch (\Exception $e) {
            echo json_encode(array('success' => false));
        }
    }
    
}

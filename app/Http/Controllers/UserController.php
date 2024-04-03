<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


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

    public function register(Request $request)
    {
        print_r("hi");
        // Validate the request data (e.g., name, email, password)
    //     $validatedData = $request->validate([
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|string|min:8',
    //     ]);
    
    //     // Create a new user
    //     $user = User::create([
    //         'email' => $validatedData['email'],
    //         'password' => bcrypt($validatedData['password']),
    //     ]);
    
    //     // Return a response (e.g., user data or a success message)
    //     return response()->json(['user' => $user, 'message' => 'User registered successfully'], 201);
     }
    
}

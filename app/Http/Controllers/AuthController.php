<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'middle_initial'=>'required',
            'student_No'=>'required',
            'age'=>'required|integer|min:0|max:100',
            'address'=>'required',
            'username' => 'required|unique:users|max:255',
            'password'=>'required|confirmed',
            'role'=>'required',

        ]);

        $user = User::create($validated);
        return $user;
    }

    public function adminLogin(Request $request){
        $validated = $request->validate([

            'username'=>'required|exists:users',
            'password'=>'required',
        ]);

        $user = User::where('username',$request->username)->first();

           // Check if the user exists and if the password is correct
        if (!$user || !Hash::check($request->password,$user->password)) {
            return response()->json(['message'=>'incorect credentials'],404);
        }

        // Check if the user's role is 'admin'
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized: User is not a teacher'], 403);
        }

        // creata a token if the user credentials is correct
        $token = $user->createToken($user->username);
        return ['token'=>$token->plainTextToken];
    }

    public function studentLogin(Request $request){
        $validated = $request->validate([

            'username'=>'required|exists:users',
            'password'=>'required',
        ]);

        $user = User::where('username',$request->username)->first();

           // Check if the user exists and if the password is correct
        if (!$user || !Hash::check($request->password,$user->password)) {
            return response()->json(['message'=>'incorect credentials'],404);
        }

        // Check if the user's role is 'student'
        if ($user->role !== 'student') {
            return response()->json(['message' => 'Unauthorized: User is not a teacher'], 403);
        }

        // creata a token if the user credentials is correct
        $token = $user->createToken($user->username);
        return ['token'=>$token->plainTextToken];
    }
}

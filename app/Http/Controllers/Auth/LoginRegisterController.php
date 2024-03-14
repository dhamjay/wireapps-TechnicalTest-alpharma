<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Laravel\Passport\Token;
use Illuminate\Support\Facades\Gate;
use Validator;

use App\Http\Controllers\Controller;
use App\Models\User;

class LoginRegisterController extends Controller
{
    /**
     * Register a new user.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->authorize('is-owner');
        $validate = Validator::make($request->all(), [
        'username' => 'required|string|max:250|unique:users,username',
        'email' => 'required|string|email:rfc,dns|max:250|unique:users,email',
        'password' => 'required|string',
        // 'password' => 'required|string|min:8|confirmed'
        ]);

        if($validate->fails()){
            return response()->json([
            'status' => 'failed',
            'message' => 'Validation Error!',
            'data' => $validate->errors(),
            ], 403);
        }

        $user = User::create([
        'username' => $request->username,
        'name' => $request->name,
        'email' => $request->email,
        'email_verified_at' => now(),
        'password' => Hash::make($request->password)
        ]);

        $data['token'] = $user->createToken($request->email)->accessToken;
        $data['user'] = $user;

        $response = [
        'status' => 'success',
        'message' => 'User is created successfully.',
        'data' => $data,
        ];

        return response()->json($response, 201);
    }

    /**
     * Authenticate the user.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validate = Validator::make($request->all(), [
        'username' => 'required|string',
        'password' => 'required|string'
        ]);

        if($validate->fails()){
            return response()->json([
            'status' => 'failed',
            'message' => 'Validation Error!',
            'data' => $validate->errors(),
            ], 403);  
        }
        // Check username exist
        $user = User::where('username', $request->username)->first();
        // Check password
        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
            'status' => 'failed',
            'message' => 'Invalid credentials'
            ], 401);
        }

        $data['token'] = $user->createToken($request->email)->accessToken;
        $data['user'] = $user;

        //$user->hasRole('manager')
        
        $response = [
        'status' => 'success',
        'message' => 'User is logged in successfully.',
        'role' => $user->hasRole('manager'),
        'data' => $data,
        ];
        return response()->json($response, 200);
    } 

    /**
     * Log out the user from application.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $usr = auth()->guard('api')->user();
        $user_id = auth()->guard('api')->user()->id;
        Token::where('user_id', $user_id)->update(['revoked' => true]);

        return response()->json([
        'status' => 'success',
        'user' => $usr,
        'message' => 'User is logged out successfully',
        ], 200);
    }   
}

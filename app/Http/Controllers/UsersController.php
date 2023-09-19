<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsersResource;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Register user.
     */
    public function register(UsersRequest $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(20);
        // dd($request['remember_token']);
        $user = User::create($request->toArray());
        // Generate an access token for the user
        $token = $user->createToken('AuthToken')->accessToken;

        $userResource = new UsersResource($user);

        return response()->json([
            'message' => 'User registered successful',
            'user' => $userResource,
            'role'=>$user->userType,
            'access_token' => $token,
        ]);
    }

    /**
     * Login User.
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 422);
            }

            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $user_type = $user->userType;

                // $accessToken = $user->createToken('AuthToken')->accessToken;
                $token = $request->user()->createToken('AuthToken');

                $userResource = new UsersResource($user);

                return response()->json([
                    'message' => 'Login success',
                    'user' => $userResource,
                    'role'=>$user_type,
                    'access_token' => $token,
                ]);
            } else {
                return response()->json(['error' => 'Unauthorized', 'message' => 'Invalid Credentials'], 401);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        try {
            if (Auth::check()) {
                $user = $request->user();

                if ($user->tokens()) {
                    $user->tokens->each(function ($token) {
                        $token->delete();
                    });
                }
                $user->token()->revoke();

                return response()->json(['message' => 'Logout successful']);
            }
            return response()->json(['message'=>'User is NOT authenticated']);
        } catch (\Throwable $th) {
            throw $th;
            
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

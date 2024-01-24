<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UsersResource;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Register user.,
     */
    public function register(UsersRequest $request)
    {
        $validator = Validator::make($request->all(),[]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $request['password'] = Hash::make($request['password']);
        $request['remember_token'] = Str::random(20);

        $user = User::create($request->toArray());
        // Generate an access token for the user
        $token = $user->createToken('AuthToken')->plainTextToken;

        $userResource = new UsersResource($user);

        event(new Registered($user));
        Auth::login($user);

        return response()->json([
            'message' => 'User registered successful',
            'user' => $userResource,
            'role'=>$user->userType,
            'token' => $token,
        ],201);
    }

    /**
     * Login User.
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();
   
        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Incorrect Credentials'
            ], 401);
        }

        $response = ( [
            'user' => $user,
            'role' => $user->userType,
            'remember_me' =>$user->remember_token,
            'token' => $user->createToken('AuthToken')->plainTextToken
        ]);

        return response($response, 200);
    }

    /**
     * Logout user
     */
    public function logout(Request $request):Response
    {

            $user = $request->user();
            if ($user) {         
                if ($request->user()->tokens()) {
                    $user->tokens->each(function ($token) {
                        $token->delete();
                    });
                }
                $request->user()->tokens()->delete();
                return response(['message' => 'Logout successful']);
            }else{
            return response()->json(['message'=>'User is NOT authenticated']);
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

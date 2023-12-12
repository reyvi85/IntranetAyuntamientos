<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $user =  User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'instance_id'=> $request->instancia
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'logged'=>true,
            'access_token'=>$token,
            'user_id'=>$user->id,
            'instanceKey'=>$user->instance->key,
            'instanceId'=>$user->instance->id,
            'message'=>'Registro completado con éxito!'
        ], 201);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'logged'=>false,
                'access_token'=>null,
                'user_id'=>null,
                'instanceKey'=>null,
                'instanceId'=>null,
                'message'=>'Credenciales inválidas'
            ],401);
        }
        $user =User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'logged'=>true,
            'access_token'=>$token,
            'user_id'=>$user->id,
            'instanceKey'=>$user->instance->key,
            'instanceId'=>$user->instance->id,
            'message'=>'Bienvenido '.$user->name,

        ]);
    }

    public function userInfo(Request $request){
        return $request->user();
    }
}

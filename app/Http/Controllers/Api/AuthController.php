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
                'instanciaDefault'=>[],
                'message'=>'Credenciales inválidas'
            ],401);
        }
        $user =User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        $otherOne = [];
        foreach ($user->instances as $row){
            $otherOne[] = $row->id;
        }
        return response()->json([
            'logged'=>true,
            'access_token'=>$token,
            'user_id'=>$user->id,
            'instanciaDefault'=> [
                'id'=>$user->instance->id,
                'key'=>$user->instance->key,
                'name'=>$user->instance->name,
                'description'=>$user->instance->description,
                'imagen'=> asset($user->instance->imagen),
                'color_title'=>$user->instance->color_title,
                'color_sub_title'=>$user->instance->color_sub_title,
                'background_color_dark'=>$user->instance->background_color_dark,
                'background_color_dark_plus'=>$user->instance->background_color_dark_plus,
                'background_color_light'=>$user->instance->background_color_light,
                'otherOne'=>$otherOne
            ],
            'message'=>'Bienvenido '.$user->name,
        ]);
    }

    public function userInfo(Request $request){
        return $request->user();
    }
}

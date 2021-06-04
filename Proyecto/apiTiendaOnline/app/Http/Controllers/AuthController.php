<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //Reglas de validación
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'name' => 'required|string|max:255',
            'nameUser' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:10',
            'rol_id' => 'required',
        ]);
        //Retornar mensajes de validación
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            //Formato de password
            $request['password'] = Hash::make($request['password']);
            $request['rememberToken'] = Str::random(10);
            //Agregar rol_id en Model User a la propiedad $fillable
            $user = User::create($request->toArray());
            //Login usuario creado
            Auth::login($user);
            $scope = $user->rol->description;
            $token = $user->createToken($user->email . '-' . now(), [$scope]);
            //Respuesta con token
            $response = [
                'user' => Auth::user(),
                'token' => $token->accessToken
            ];
            return
                response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }
    
    public function login(Request $request)
    {
        //Validar campos de login
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        //Retornar mensajes de validación
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            //Credenciales para el login
            $credentials = $request->only('email', 'password');
            //Verificar credenciales por medio de las funcionalidad de autenticación
            if (Auth::attempt($credentials)) {
                $user = User::where('email', $request->email)->with('rol')->first();
                $scope = $user->rol->description;
                $token = $user->createToken($user->email . '-' . now(), [$scope]);

                $response = [
                    'user' => Auth::user(),
                    'token' => $token->accessToken
                ];
                return
                    response()->json($response, 200);
            } else {
                $response = ["message" => 'El usuario no existe'];
                return
                    response()->json($response, 422);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }
    public function logout()
    {
        //Verificar que exista algún usuario logueado
        //Según el token proporcionado
        if (Auth::guard('api')->check()) {
            Auth::logout();
            $response = ['message' => 'Ha sido desconectado exitosamente!'];
            return response()->json($response, 200);
        } else {
            $response = ['message' => 'No existe usuario autenticado'];
            return response()->json($response, 422);
        }
    }
}

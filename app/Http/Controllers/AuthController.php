<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
/**
 * El fragmento de código contiene funciones PHP para el registro de usuarios, inicio de sesión,
 * búsqueda de usuarios con roles, actualización de detalles de usuarios y eliminación de usuarios.
 * 
 * @param Request request El código que proporcionó es un controlador Laravel con métodos para
 * registrar usuarios, iniciar sesión, enumerar usuarios con roles, actualizar información de usuarios
 * y eliminar usuarios.
 * 
 * @return El fragmento de código proporcionado contiene varias funciones relacionadas con la
 * autenticación y gestión de usuarios en una aplicación Laravel. Aquí hay un resumen de lo que
 * devuelve cada función:
 */
    public function register(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'idRol' => 'required|integer',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if($validator -> fails()){
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request ->name,
            'email' => $request ->email,
            'idRol' => $request -> idRol,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('auth_token') ->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }

    public function login (Request $request){
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request['email'])->firstOrFail();          
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 200,
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' =>$user
            ], 200);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function index()
    {
        $users = DB::table('users')  
        ->leftJoin('roles', 'users.idrol', '=', 'roles.id')
        ->select('users.*', 'roles.rol as Rol') 
        ->get();

        return response()->json(['data' => $users], 200);
    }

    public function update(Request $request)
    {
        $libro = User::findOrFail($request->id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'idRol' => 'required|integer',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $libro->update($request->all());
    
        return response()->json($libro, 200);
    }

    public function destroy(Request $request)
    {
        $id = str_split($request -> id);
        for ($i=0; $i < count($id) ; $i++) { 
            $user = User::find($id[$i]);
            if($user != null){
                $user->delete();
            }
        }       
        return response()->json(['message' => "se eliminaron correctamente"], 200);
    }
}

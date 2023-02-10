<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutenticarController extends Controller
{

    public function vistaRegistrar()
    {
        return view('autenticar.registrar');
    }

    public function registrar(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado'  => 400,
                'mensaje' => 'Llenar correctamente todos los campos',
            ]);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'estado'  => 200,
            'mensaje' => 'Usuario creado con éxito, por favor inicia sesión con el siguiente botón.',
        ]);

    }

    public function vistaLogin()
    {
        return view('autenticar.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado'  => 400,
                'mensaje' => 'Complete bien los campos.',
            ]);
        }

        $usuario = User::where('email', $request->email)->first();

        // Validandi si existe el usuario ó no para hacer el logueo
        if( isset($usuario->id) )
        {
            if(Hash::check($request->password,$usuario->password))
            {
                $token = $usuario->createToken('auth_token')->plainTextToken;
                
                return response()->json([
                    'estado' => 200,
                    'token' => $token,
                    'mensaje' => 'Bienvenido',
                ]);
            } else {
                return response()->json([
                    'estado' => 403,
                    'mensaje' => 'Contraseña incorrecta',
                ]);
            }
        } else {
            return response()->json([
                'estado' => 404,
                'mensaje' => 'Usuario no encontrado',
            ]);
        }

    }

    public function logout()
    {
        return response()->json([
            'estado' => 200,
            'mensaje' => 'Sesión cerrada',
        ]);
    }

    public function userProfile()
    {
        return response()->json([
            'estado' => 200,
            'mensaje' => 'Perfil del Usuario',
            'datosUsuario' => auth()->user(),
        ]);
    }
}

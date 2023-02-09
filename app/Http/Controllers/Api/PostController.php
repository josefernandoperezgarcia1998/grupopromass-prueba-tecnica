<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo'    => 'required|string',
            'contenido' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'estado'  => 400,
                'mensaje' => 'Todos los campos son requeridos',
            ]);
        }
        
        $datos['titulo'] = $request->titulo;
        $datos['contenido'] = $request->contenido;
        $datos['user_id'] = 1;

        Post::create($datos);

        return response()->json([
            'estado' => 200,
            'mensaje' => 'Post creado correctamente',
        ]);
    }
}

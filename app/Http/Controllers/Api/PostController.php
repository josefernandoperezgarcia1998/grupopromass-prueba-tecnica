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

    public function listadoPostsUsuario()
    {
        /*
            Obteniendo todos los post
            de forma descendiente 
            y con la relación user
        */
        $posts = Post::orderBy('created_at', 'DESC')
                    ->where('user_id', 1)
                    ->with('user')
                    ->get();

        return response()->json([
            'estado' => 200,
            'posts' => $posts,
        ]);
    }

    public function store(Request $request)
    {
        // Validación de entradas
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
            'estado'  => 200,
            'mensaje' => 'Post creado correctamente',
        ]);
    }

    public function show($id)
    {
        // Obteniendo el post por id con su relación
        $post = Post::with('user')->findOrFail($id);

        return response()->json([
            'estado' => 200,
            'post'   => $post,
        ]);
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function listadoPostGeneral()
    {
        $posts = Post::orderBy('created_at', 'DESC')
                    ->with('user')
                    ->get();

        return response()->json([
            'estado' => 200,
            'posts' => $posts,
        ]);
    }

    public function buscadorPost(Request $request)
    {
        if($request->ajax()){
            /* 
                Se busca en el modelo Post 
                dado el titulo, contenido ó nombre del autor
            */
            $posts = Post::with('user')
                            ->where('titulo', 'like', '%'. $request->post . '%')
                            ->orWhere('contenido', 'like', '%'. $request->post. '%')
                            ->orwhereHas('user',function($q) use ($request){
                                $q->where( function ($q) use ($request) {
                                    $q->where('name','like', '%'. $request->post . '%');
                                });
                            })
                            ->get();
            
            if(count($posts) > 0){
                $mensaje = 'Se han encontrado los siguientes registros:';
            } else {
                $mensaje = 'Sin registros';
            }
        }
        
        return response()->json([
            'estado'   => 200,
            'mensaje'  => $mensaje,
            'posts'    => $posts,
            'contador' => $posts->count(),
        ]);
    }

}

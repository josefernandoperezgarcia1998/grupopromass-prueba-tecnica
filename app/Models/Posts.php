<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

   // Asociando tabla al modelo
    protected $table = 'posts';

   // Carga masiva
    protected $fillable = [
        'titulo',
        'contenido',
        'user_id',
    ];

   // Relación 1 a Muchos Inversa (Varios post pertenecen a un usuario)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'user_id',
        'imagem',
        'video_trailer_url',
        'titulo',
        'progresso',
        'idioma',
        'tempo_curso',
        'quantidade_aulas',
        'descricao',
        'observacoes',
        'categoria_id',
    ];
}

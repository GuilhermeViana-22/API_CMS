<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:cursos,id', // Verifica se o ID é obrigatório e existe na tabela cursos
            'user_id' => 'nullable|integer',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video_trailer_url' => 'nullable|url',
            'titulo' => 'nullable|string|max:255',
            'progresso' => 'nullable|integer|min:0|max:100',
            'idioma' => 'nullable|string|max:50',
            'tempo_curso' => 'nullable|string|max:50',
            'quantidade_aulas' => 'nullable|integer',
            'descricao' => 'nullable|string',
            'observacoes' => 'nullable|string',
            'categoria_id' => 'nullable|integer|exists:categorias,id',
        ];
    }
}

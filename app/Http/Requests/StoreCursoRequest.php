<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|string',
            'imagem' => 'required|string',
            'video_trailer_url' => 'required|url',
            'titulo' => 'required|string|max:255',
            'progresso' => 'required|numeric|min:0|max:100',
            'idioma' => 'required|numeric',
            'tempo_curso' => 'required|integer|min:1',
            'quantidade_aulas' => 'required|integer|min:1',
            'descricao' => 'required|string',
            'observacoes' => 'nullable|string',
            'categoria_id' => 'required|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'user_id.required' => 'O campo user_id é obrigatório.',
            'imagem.required' => 'O campo imagem é obrigatório.',
            'video_trailer_url.required' => 'O campo video_trailer_url é obrigatório.',
            'video_trailer_url.url' => 'O campo video_trailer_url deve ser uma URL válida.',
            'titulo.required' => 'O campo titulo é obrigatório.',
            'titulo.max' => 'O campo titulo não pode exceder 255 caracteres.',
            'progresso.required' => 'O campo progresso é obrigatório.',
            'progresso.numeric' => 'O campo progresso deve ser numérico.',
            'progresso.min' => 'O campo progresso não pode ser menor que 0.',
            'progresso.max' => 'O campo progresso não pode ser maior que 100.',
            'idioma.required' => 'O campo idioma é obrigatório.',
            'idioma.numeric' => 'O campo idioma deve ser numérico.',
            'tempo_curso.required' => 'O campo tempo_curso é obrigatório.',
            'tempo_curso.integer' => 'O campo tempo_curso deve ser um número inteiro.',
            'tempo_curso.min' => 'O campo tempo_curso deve ser maior que 0.',
            'quantidade_aulas.required' => 'O campo quantidade_aulas é obrigatório.',
            'quantidade_aulas.integer' => 'O campo quantidade_aulas deve ser um número inteiro.',
            'quantidade_aulas.min' => 'O campo quantidade_aulas deve ser maior que 0.',
            'descricao.required' => 'O campo descricao é obrigatório.',
            'observacoes.string' => 'O campo observacoes deve ser uma string.',
            'categoria_id.required' => 'O campo categoria_id é obrigatório.',
        ];
    }
}

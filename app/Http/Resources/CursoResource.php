<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CursoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->user_id,
            'imagem' => $this->imagem,
            'video_trailer_url' => $this->video_trailer_url,
            'titulo' => $this->titulo,
            'progresso' => $this->progresso,
            'idioma' => $this->idioma,
            'tempo_curso' => $this->tempo_curso,
            'quantidade_aulas' => $this->quantidade_aulas,
            'descricao' => $this->descricao,
            'observacoes' => $this->observacoes,
            'categoria_id' => $this->categoria_id,
        ];

    }
}

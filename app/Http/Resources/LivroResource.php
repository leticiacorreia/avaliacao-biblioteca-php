<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'data_publicacao' => $this->data_publicacao,
            'sinopse' => $this->sinopse,
            'editora' => EditoraResource::make($this->whenLoaded('editora')),
            'autores' => AutorResource::collection($this->autores),
        ];
    }
}

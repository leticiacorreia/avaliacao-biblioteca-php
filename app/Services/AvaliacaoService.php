<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Avaliacao;

class AvaliacaoService
{
    public function list(
        ?int $usuario_id=null,
        ?int $livro_id=null,
        ?int $nota=null
    ) {
        return Avaliacao::orderBy('created_at', 'desc')
            ->when($usuario_id, function(Builder $query, int $usuario_id) {
                $query->where('usuario_id', '=', $usuario_id);
            })
            ->when($livro_id, function(Builder $query, int $livro_id) {
                $query->where('livro_id', '=', $livro_id);
            })
            ->when($nota, function(Builder $query, int $nota) {
                $query->where('nota', '=', $nota);
            })
            ->with('usuario')
            ->with('livro')
            ->paginate();
    }

    public function find(Avaliacao $avaliacao)
    {
        return Avaliacao::find($avaliacao)->with('usuario')->with('livro')->get();
    }

    public function create($request_validated)
    { 
        return Avaliacao::create([
            'usuario_id' => $request_validated['usuario_id'],
            'livro_id' => $request_validated['livro_id'],
            'nota' => $request_validated['nota'],
            'descricao' => $request_validated['descricao'] ?? '',
        ]);

    }

    public function update($request_validated, Avaliacao $avaliacao)
    {   
        $avaliacao->update([
            'usuario_id' => $request_validated['usuario_id'],
            'livro_id' => $request_validated['livro_id'],
            'nota' => $request_validated['nota'],
            'descricao' => $request_validated['descricao'] ?? '',
        ]);

        return $avaliacao;
    }

    public function destroy(Avaliacao $avaliacao)
    {   
        return $avaliacao->delete();
    }
}

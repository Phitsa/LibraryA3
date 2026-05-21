<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emprestimo extends Model
{
    use HasFactory;

    protected $fillable = [
        'livro_id', 'usuario_id', 'data_emprestimo',
        'data_devolucao_prevista', 'data_devolucao_real', 'status'
    ];

    protected $casts = [
        'data_emprestimo' => 'date',
        'data_devolucao_prevista' => 'date',
        'data_devolucao_real' => 'date',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }

    public function isAtrasado(): bool
    {
        return $this->status === 'ativo' && $this->data_devolucao_prevista->isPast();
    }
}

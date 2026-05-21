<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Livro extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'autor', 'isbn', 'quantidade_total', 'quantidade_disponivel', 'categoria'
    ];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class)->where('status', 'aguardando')->orderBy('created_at');
    }

    public function isDisponivel(): bool
    {
        return $this->quantidade_disponivel > 0;
    }
}

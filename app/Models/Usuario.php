<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'email', 'matricula'];

    public function emprestimos()
    {
        return $this->hasMany(Emprestimo::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}

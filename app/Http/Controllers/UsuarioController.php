<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::withCount(['emprestimos', 'reservas'])->orderBy('nome')->paginate(20);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'      => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios',
            'matricula' => 'required|string|unique:usuarios|max:20',
        ]);

        Usuario::create($request->only('nome', 'email', 'matricula'));

        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function show(Usuario $usuario)
    {
        $usuario->load([
            'emprestimos.livro',
            'reservas.livro',
        ]);
        return view('usuarios.show', compact('usuario'));
    }
}

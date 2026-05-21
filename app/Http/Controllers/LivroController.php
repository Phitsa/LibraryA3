<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Services\BibliotecaService;
use Illuminate\Http\Request;

class LivroController extends Controller
{
    public function __construct(protected BibliotecaService $service) {}

    public function index(Request $request)
    {
        $busca = $request->get('busca');
        $livros = Livro::all()->toArray();

        if ($busca) {
            // Usa Busca Binária — O(log n)
            $livrosEncontrados = $this->service->buscaBinaria($livros, $busca);
            $livros = collect($livrosEncontrados)->map(fn($l) => Livro::find($l['id']));
            $usouBuscaBinaria = true;
        } else {
            $livros = Livro::orderBy('titulo')->paginate(12);
            $usouBuscaBinaria = false;
        }

        return view('livros.index', compact('livros', 'busca', 'usouBuscaBinaria'));
    }

    public function create()
    {
        return view('livros.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'               => 'required|string|max:255',
            'autor'                => 'required|string|max:255',
            'isbn'                 => 'required|string|unique:livros',
            'quantidade_total'     => 'required|integer|min:1',
            'categoria'            => 'nullable|string|max:100',
        ]);

        $data['quantidade_disponivel'] = $data['quantidade_total'];
        Livro::create($data);

        return redirect()->route('livros.index')->with('success', 'Livro cadastrado com sucesso!');
    }

    public function show(Livro $livro)
    {
        $livro->load(['emprestimos.usuario', 'reservas.usuario']);
        return view('livros.show', compact('livro'));
    }
}

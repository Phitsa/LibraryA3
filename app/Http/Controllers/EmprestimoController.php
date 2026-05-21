<?php

namespace App\Http\Controllers;

use App\Models\Livro;
use App\Models\Usuario;
use App\Models\Emprestimo;
use App\Services\BibliotecaService;
use Illuminate\Http\Request;

class EmprestimoController extends Controller
{
    public function __construct(protected BibliotecaService $service) {}

    public function index()
    {
        $emprestimos = Emprestimo::with(['livro', 'usuario'])
            ->orderByRaw("CASE WHEN status = 'ativo' THEN 0 ELSE 1 END")
            ->orderBy('data_devolucao_prevista')
            ->paginate(15);

        return view('emprestimos.index', compact('emprestimos'));
    }

    public function create()
    {
        $livros    = Livro::where('quantidade_disponivel', '>', 0)->orderBy('titulo')->get();
        $usuarios  = Usuario::orderBy('nome')->get();
        return view('emprestimos.create', compact('livros', 'usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'livro_id'   => 'required|exists:livros,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        $resultado = $this->service->realizarEmprestimo($request->livro_id, $request->usuario_id);

        if (is_string($resultado)) {
            return back()->with('error', $resultado);
        }

        return redirect()->route('emprestimos.index')->with('success', 'Empréstimo realizado com sucesso! Devolução prevista em 14 dias.');
    }

    public function devolver(Emprestimo $emprestimo)
    {
        if ($emprestimo->status === 'devolvido') {
            return back()->with('error', 'Este livro já foi devolvido.');
        }

        $resultado = $this->service->realizarDevolucao($emprestimo->id);

        $msg = 'Livro devolvido com sucesso!';
        if ($resultado['proximo_reservado']) {
            $nome = $resultado['proximo_reservado']->usuario->nome ?? 'próximo da fila';
            $msg .= " O usuário {$nome} foi notificado (próximo da fila de reservas).";
        }

        return redirect()->route('emprestimos.index')->with('success', $msg);
    }

    public function reservar(Request $request)
    {
        $request->validate([
            'livro_id'   => 'required|exists:livros,id',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        // ENQUEUE — entra no final da fila (FIFO)
        $resultado = $this->service->entrarNaFila($request->livro_id, $request->usuario_id);

        if (is_string($resultado)) {
            return back()->with('error', $resultado);
        }

        return redirect()->route('livros.show', $request->livro_id)
            ->with('success', "Reserva realizada! Você está na posição {$resultado->posicao_fila} da fila.");
    }
}

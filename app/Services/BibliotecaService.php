<?php

namespace App\Services;

use App\Models\Livro;
use App\Models\Usuario;
use App\Models\Emprestimo;
use App\Models\Reserva;
use Carbon\Carbon;

class BibliotecaService
{
    // =========================================================
    // ALGORITMO 1: BUSCA BINÁRIA — O(log n)
    // =========================================================
    // Funciona em um array já ordenado pelo título.
    // A cada passo, compara o elemento do meio com o alvo.
    // Se o alvo é menor, descarta a metade direita. Se maior, descarta a esquerda.
    // Resultado: encontra o livro em O(log n) ao invés de O(n) da busca linear.
    // =========================================================
    public function buscaBinaria(array $livros, string $termoBusca): array
    {
        // Ordena os títulos (necessário para busca binária funcionar)
        usort($livros, fn($a, $b) => strtolower($a['titulo']) <=> strtolower($b['titulo']));

        $resultado = [];
        $termo = strtolower($termoBusca);
        $esquerda = 0;
        $direita = count($livros) - 1;

        // Busca binária por correspondência exata do início do título
        while ($esquerda <= $direita) {
            $meio = intdiv($esquerda + $direita, 2);
            $tituloMeio = strtolower($livros[$meio]['titulo']);

            if (str_starts_with($tituloMeio, $termo)) {
                // Encontrou! Expande para coletar todos os vizinhos que também batem
                $resultado[] = $livros[$meio];
                // Verifica para esquerda
                $i = $meio - 1;
                while ($i >= 0 && str_starts_with(strtolower($livros[$i]['titulo']), $termo)) {
                    $resultado[] = $livros[$i];
                    $i--;
                }
                // Verifica para direita
                $i = $meio + 1;
                while ($i < count($livros) && str_starts_with(strtolower($livros[$i]['titulo']), $termo)) {
                    $resultado[] = $livros[$i];
                    $i++;
                }
                break;
            } elseif ($tituloMeio < $termo) {
                $esquerda = $meio + 1;
            } else {
                $direita = $meio - 1;
            }
        }

        return $resultado;
    }

    // =========================================================
    // ALGORITMO 2: FILA (QUEUE) — FIFO — O(1) enqueue/dequeue
    // =========================================================
    // Implementa uma fila de reservas onde o primeiro a reservar
    // é o primeiro a ser atendido quando o livro é devolvido.
    // Operações: enqueue (entrar na fila) e dequeue (sair da fila)
    // são ambas O(1) — independente do tamanho da fila.
    // =========================================================

    /**
     * ENQUEUE: Adiciona usuário ao final da fila de reservas
     * Complexidade: O(1)
     */
    public function entrarNaFila(int $livroId, int $usuarioId): Reserva|string
    {
        // Verifica se já está na fila
        $jaNaFila = Reserva::where('livro_id', $livroId)
            ->where('usuario_id', $usuarioId)
            ->where('status', 'aguardando')
            ->exists();

        if ($jaNaFila) {
            return 'Usuário já está na fila para este livro.';
        }

        // Próxima posição na fila (tail)
        $ultimaPosicao = Reserva::where('livro_id', $livroId)
            ->where('status', 'aguardando')
            ->max('posicao_fila') ?? 0;

        return Reserva::create([
            'livro_id'     => $livroId,
            'usuario_id'   => $usuarioId,
            'posicao_fila' => $ultimaPosicao + 1,
            'status'       => 'aguardando',
        ]);
    }

    /**
     * DEQUEUE: Remove o primeiro da fila (head) e notifica
     * Complexidade: O(1)
     */
    public function processarFilaAposDevol­ucao(int $livroId): ?Reserva
    {
        // Pega o head da fila (menor posição = primeiro a entrar)
        $proximoDaFila = Reserva::where('livro_id', $livroId)
            ->where('status', 'aguardando')
            ->orderBy('posicao_fila')
            ->first();

        if ($proximoDaFila) {
            $proximoDaFila->update(['status' => 'notificado']);

            // Reordena posições restantes (decrementa todos)
            Reserva::where('livro_id', $livroId)
                ->where('status', 'aguardando')
                ->decrement('posicao_fila');
        }

        return $proximoDaFila;
    }

    // =========================================================
    // OPERAÇÕES DE EMPRÉSTIMO E DEVOLUÇÃO
    // =========================================================

    public function realizarEmprestimo(int $livroId, int $usuarioId): Emprestimo|string
    {
        $livro = Livro::findOrFail($livroId);

        if (!$livro->isDisponivel()) {
            return 'Livro não disponível para empréstimo.';
        }

        $emprestimo = Emprestimo::create([
            'livro_id'               => $livroId,
            'usuario_id'             => $usuarioId,
            'data_emprestimo'        => Carbon::today(),
            'data_devolucao_prevista' => Carbon::today()->addDays(14),
            'status'                 => 'ativo',
        ]);

        $livro->decrement('quantidade_disponivel');

        return $emprestimo;
    }

    public function realizarDevolucao(int $emprestimoId): array
    {
        $emprestimo = Emprestimo::with('livro')->findOrFail($emprestimoId);

        $emprestimo->update([
            'data_devolucao_real' => Carbon::today(),
            'status'              => 'devolvido',
        ]);

        $livro = $emprestimo->livro;
        $livro->increment('quantidade_disponivel');

        // Processa a fila de reservas automaticamente (DEQUEUE)
        $proximoReservado = $this->processarFilaAposDevol­ucao($livro->id);

        return [
            'emprestimo'       => $emprestimo,
            'proximo_reservado' => $proximoReservado,
        ];
    }
}

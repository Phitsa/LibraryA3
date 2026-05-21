@extends('layouts.app')
@section('title', $livro->titulo)

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('livros.index') }}" style="color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">← Voltar ao Acervo</a>
        <h1 style="margin-top: 0.4rem;">{{ $livro->titulo }}</h1>
        <p style="color: var(--text-muted); margin-top: 0.3rem;">{{ $livro->autor }} &nbsp;·&nbsp; ISBN: {{ $livro->isbn }}
            @if($livro->categoria)
                &nbsp;·&nbsp; <span class="badge badge-gray">{{ $livro->categoria }}</span>
            @endif
        </p>
    </div>
    <div style="display: flex; gap: 0.7rem; align-items: center; flex-wrap: wrap;">
        @if($livro->isDisponivel())
            <span class="badge badge-green" style="font-size: 0.9rem; padding: 0.4rem 1rem;">
                ✓ {{ $livro->quantidade_disponivel }} de {{ $livro->quantidade_total }} disponível(is)
            </span>
            <a href="{{ route('emprestimos.create') }}?livro_id={{ $livro->id }}" class="btn btn-primary">Emprestar</a>
        @else
            <span class="badge badge-red" style="font-size: 0.9rem; padding: 0.4rem 1rem;">
                ✗ Todos os exemplares estão emprestados
            </span>
        @endif
    </div>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; align-items: start;">

    {{-- Fila de Reservas (FIFO Queue) --}}
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem;">
            <div>
                <h2 style="font-family: 'Playfair Display', serif; font-size: 1.2rem;">Fila de Reservas</h2>
                <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.2rem;">Estrutura FIFO — primeiro a reservar, primeiro a ser atendido</p>
            </div>
            <span class="algo-tag">📋 Queue — O(1)</span>
        </div>

        @if($livro->reservas->count() > 0)
            @foreach($livro->reservas as $reserva)
                <div class="queue-item">
                    <div class="queue-pos">{{ $reserva->posicao_fila }}</div>
                    <div style="flex: 1;">
                        <div style="font-weight: 500;">{{ $reserva->usuario->nome }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-muted);">
                            Reservado em {{ $reserva->created_at->format('d/m/Y') }}
                        </div>
                    </div>
                    @if($reserva->posicao_fila === 1)
                        <span class="badge badge-gold">Próximo</span>
                    @endif
                </div>
            @endforeach
        @else
            <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; padding: 1.5rem 0;">
                Nenhuma reserva na fila.
            </p>
        @endif

        {{-- Formulário para entrar na fila --}}
        @if(!$livro->isDisponivel())
            <div style="margin-top: 1.5rem; padding-top: 1.2rem; border-top: 1px solid var(--border);">
                <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.8rem;">
                    Livro indisponível? Entre na fila de espera:
                </p>
                <form method="POST" action="{{ route('reservas.store') }}">
                    @csrf
                    <input type="hidden" name="livro_id" value="{{ $livro->id }}">
                    <div class="form-group">
                        <label>Usuário</label>
                        <select name="usuario_id" required>
                            <option value="">Selecione o usuário...</option>
                            @foreach(\App\Models\Usuario::orderBy('nome')->get() as $usuario)
                                <option value="{{ $usuario->id }}">{{ $usuario->nome }} ({{ $usuario->matricula }})</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline" style="width: 100%;">
                        + Entrar na Fila (ENQUEUE)
                    </button>
                </form>
            </div>
        @endif
    </div>

    {{-- Histórico de Empréstimos --}}
    <div class="card">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.2rem;">
            <div>
                <h2 style="font-family: 'Playfair Display', serif; font-size: 1.2rem;">Histórico de Empréstimos</h2>
                <p style="color: var(--text-muted); font-size: 0.8rem; margin-top: 0.2rem;">Todos os movimentos deste livro</p>
            </div>
        </div>

        @forelse($livro->emprestimos as $emp)
            <div style="padding: 0.8rem 0; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <div style="font-weight: 500; font-size: 0.9rem;">{{ $emp->usuario->nome }}</div>
                    <div style="font-size: 0.78rem; color: var(--text-muted);">
                        {{ $emp->data_emprestimo->format('d/m/Y') }}
                        → {{ $emp->data_devolucao_prevista->format('d/m/Y') }}
                    </div>
                </div>
                <div>
                    @if($emp->status === 'ativo')
                        @if($emp->isAtrasado())
                            <span class="badge badge-red">Atrasado</span>
                        @else
                            <span class="badge badge-gold">Em aberto</span>
                        @endif
                    @else
                        <span class="badge badge-green">Devolvido</span>
                    @endif
                </div>
            </div>
        @empty
            <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; padding: 1.5rem 0;">
                Nenhum empréstimo registrado.
            </p>
        @endforelse
    </div>

</div>
@endsection

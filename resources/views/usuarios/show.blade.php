@extends('layouts.app')
@section('title', $usuario->nome)

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('usuarios.index') }}" style="color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">← Voltar aos Usuários</a>
        <h1 style="margin-top: 0.4rem;">{{ $usuario->nome }}</h1>
        <p style="color: var(--text-muted); margin-top: 0.3rem;">
            {{ $usuario->email }} &nbsp;·&nbsp; Matrícula: <strong>{{ $usuario->matricula }}</strong>
        </p>
    </div>
    <a href="{{ route('emprestimos.create') }}?usuario_id={{ $usuario->id }}" class="btn btn-primary">+ Novo Empréstimo</a>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">

    {{-- Empréstimos ativos --}}
    <div class="card">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 1.2rem;">
            Empréstimos Ativos
        </h2>
        @php $ativos = $usuario->emprestimos->where('status', 'ativo'); @endphp

        @forelse($ativos as $emp)
            <div style="padding: 0.8rem 0; border-bottom: 1px solid var(--border);">
                <div style="font-weight: 500;">{{ $emp->livro->titulo }}</div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.3rem;">
                    <span style="font-size: 0.8rem; color: var(--text-muted);">
                        Devolução: {{ $emp->data_devolucao_prevista->format('d/m/Y') }}
                    </span>
                    @if($emp->isAtrasado())
                        <span class="badge badge-red">Atrasado</span>
                    @else
                        <span class="badge badge-gold">Em aberto</span>
                    @endif
                </div>
            </div>
        @empty
            <p style="color: var(--text-muted); font-size: 0.9rem; padding: 1rem 0;">
                Nenhum empréstimo ativo.
            </p>
        @endforelse
    </div>

    {{-- Reservas na fila --}}
    <div class="card">
        <div style="display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1.2rem;">
            <h2 style="font-family: 'Playfair Display', serif; font-size: 1.2rem;">Reservas na Fila</h2>
            <span class="algo-tag">Queue FIFO</span>
        </div>

        @forelse($usuario->reservas->where('status', 'aguardando') as $res)
            <div class="queue-item">
                <div class="queue-pos">{{ $res->posicao_fila }}</div>
                <div>
                    <div style="font-weight: 500;">{{ $res->livro->titulo }}</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">
                        Reservado em {{ $res->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @empty
            <p style="color: var(--text-muted); font-size: 0.9rem; padding: 1rem 0;">
                Sem reservas na fila.
            </p>
        @endforelse
    </div>

    {{-- Histórico completo --}}
    <div class="card" style="grid-column: 1 / -1;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 1.2rem;">
            Histórico Completo de Empréstimos
        </h2>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Livro</th>
                        <th>Emprestado</th>
                        <th>Devolução Prevista</th>
                        <th>Devolução Real</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuario->emprestimos->sortByDesc('created_at') as $emp)
                        <tr>
                            <td>
                                <a href="{{ route('livros.show', $emp->livro_id) }}"
                                   style="color: var(--text); text-decoration: none; font-weight: 500;">
                                    {{ $emp->livro->titulo }}
                                </a>
                            </td>
                            <td style="color: var(--text-muted); font-size: 0.88rem;">{{ $emp->data_emprestimo->format('d/m/Y') }}</td>
                            <td style="font-size: 0.88rem;">{{ $emp->data_devolucao_prevista->format('d/m/Y') }}</td>
                            <td style="font-size: 0.88rem; color: var(--text-muted);">
                                {{ $emp->data_devolucao_real?->format('d/m/Y') ?? '—' }}
                            </td>
                            <td>
                                @if($emp->status === 'devolvido')
                                    <span class="badge badge-green">Devolvido</span>
                                @elseif($emp->isAtrasado())
                                    <span class="badge badge-red">Atrasado</span>
                                @else
                                    <span class="badge badge-gold">Em aberto</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="color: var(--text-muted); text-align: center; padding: 2rem 0;">
                                Nenhum empréstimo no histórico.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

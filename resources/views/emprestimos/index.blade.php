@extends('layouts.app')
@section('title', 'Empréstimos')

@section('content')
<div class="page-header">
    <h1>Empréstimos <span>& Devoluções</span></h1>
    <a href="{{ route('emprestimos.create') }}" class="btn btn-primary">+ Novo Empréstimo</a>
</div>

{{-- Stats rápidos --}}
@php
    $ativos    = \App\Models\Emprestimo::where('status', 'ativo')->count();
    $atrasados = \App\Models\Emprestimo::where('status', 'ativo')->where('data_devolucao_prevista', '<', now())->count();
    $hoje      = \App\Models\Emprestimo::where('status', 'ativo')->whereDate('data_devolucao_prevista', today())->count();
@endphp
<div class="stats-row" style="margin-bottom: 1.5rem;">
    <div class="stat-card">
        <div class="label">Em Aberto</div>
        <div class="value" style="color: var(--gold);">{{ $ativos }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Atrasados</div>
        <div class="value" style="color: #e74c3c;">{{ $atrasados }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Vencem Hoje</div>
        <div class="value" style="color: #f39c12;">{{ $hoje }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Total Histórico</div>
        <div class="value">{{ \App\Models\Emprestimo::count() }}</div>
    </div>
</div>

<div class="card">
    <div style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
        <span class="algo-tag">📋 Filas </span>
        <span style="color: var(--text-muted); font-size: 0.8rem;">Ao devolver, o próximo da fila de reservas é notificado automaticamente</span>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Livro</th>
                    <th>Usuário</th>
                    <th>Emprestado em</th>
                    <th>Devolução Prevista</th>
                    <th>Status</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @forelse($emprestimos as $emp)
                    <tr>
                        <td style="color: var(--text-muted); font-size: 0.8rem;">{{ $emp->id }}</td>
                        <td>
                            <a href="{{ route('livros.show', $emp->livro_id) }}"
                               style="color: var(--text); text-decoration: none; font-weight: 500;">
                                {{ $emp->livro->titulo }}
                            </a>
                            <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $emp->livro->autor }}</div>
                        </td>
                        <td>
                            <div style="font-weight: 500;">{{ $emp->usuario->nome }}</div>
                            <div style="font-size: 0.78rem; color: var(--text-muted);">{{ $emp->usuario->matricula }}</div>
                        </td>
                        <td style="color: var(--text-muted); font-size: 0.88rem;">
                            {{ $emp->data_emprestimo->format('d/m/Y') }}
                        </td>
                        <td style="font-size: 0.88rem;">
                            {{ $emp->data_devolucao_prevista->format('d/m/Y') }}
                            @if($emp->isAtrasado())
                                <div style="font-size: 0.75rem; color: #e74c3c;">
                                    {{ floor(now()->diffInDays($emp->data_devolucao_prevista)) }} dias de atraso
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($emp->status === 'devolvido')
                                <span class="badge badge-green">Devolvido<br>
                                    <small>{{ $emp->data_devolucao_real?->format('d/m/Y') }}</small>
                                </span>
                            @elseif($emp->isAtrasado())
                                <span class="badge badge-red">⚠ Atrasado</span>
                            @else
                                <span class="badge badge-gold">No prazo</span>
                            @endif
                        </td>
                        <td>
                            @if($emp->status === 'ativo')
                                <form method="POST" action="{{ route('emprestimos.devolver', $emp->id) }}"
                                      onsubmit="return confirm('Confirmar devolução de \'{{ addslashes($emp->livro->titulo) }}\'?')">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-outline btn-sm">Devolver</button>
                                </form>
                            @else
                                <span style="color: var(--text-muted); font-size: 0.8rem;">—</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 3rem 0;">
                            Nenhum empréstimo registrado ainda.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($emprestimos->hasPages())
        <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
            {{ $emprestimos->links() }}
        </div>
    @endif
</div>
@endsection

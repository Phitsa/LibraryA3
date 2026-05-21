@extends('layouts.app')
@section('title', 'Acervo')

@section('content')
<div class="page-header">
    <h1>Acervo <span>de Livros</span></h1>
    <a href="{{ route('livros.create') }}" class="btn btn-primary">+ Cadastrar Livro</a>
</div>

{{-- Busca Binária --}}
<form method="GET" action="{{ route('livros.index') }}">
    <div class="search-bar">
        <input
            type="text"
            name="busca"
            value="{{ $busca }}"
            placeholder="Buscar livro pelo título..."
            autocomplete="off"
        >
        <button type="submit" class="btn btn-primary">Buscar</button>
        @if($busca)
            <a href="{{ route('livros.index') }}" class="btn btn-outline">Limpar</a>
        @endif
    </div>
</form>

@if($busca)
    <div class="search-info">
        <span class="algo-tag">🔍 Busca Binária — O(log n)</span>
        @if(count($livros) > 0)
            {{ count($livros) }} resultado(s) encontrado(s) para "<strong>{{ $busca }}</strong>"
        @else
            Nenhum livro encontrado para "<strong>{{ $busca }}</strong>"
        @endif
    </div>
@endif

{{-- Stats --}}
@if(!$busca)
@php
    $total = \App\Models\Livro::count();
    $disponiveis = \App\Models\Livro::where('quantidade_disponivel', '>', 0)->count();
    $emprestados = \App\Models\Emprestimo::where('status', 'ativo')->count();
    $reservas = \App\Models\Reserva::where('status', 'aguardando')->count();
@endphp
<div class="stats-row">
    <div class="stat-card">
        <div class="label">Total de Títulos</div>
        <div class="value">{{ $total }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Disponíveis</div>
        <div class="value" style="color: #2ecc71">{{ $disponiveis }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Emprestados</div>
        <div class="value" style="color: #e74c3c">{{ $emprestados }}</div>
    </div>
    <div class="stat-card">
        <div class="label">Na Fila (FIFO)</div>
        <div class="value" style="color: var(--gold)">{{ $reservas }}</div>
    </div>
</div>
@endif

{{-- Grid de Livros --}}
<div class="card-grid">
    @forelse($livros as $livro)
        <div class="livro-card">
            <h3>{{ $livro->titulo }}</h3>
            <div class="autor">{{ $livro->autor }}</div>

            @if($livro->categoria)
                <span class="badge badge-gray">{{ $livro->categoria }}</span>
            @endif

            <div class="meta">
                @if($livro->quantidade_disponivel > 0)
                    <span class="badge badge-green">✓ {{ $livro->quantidade_disponivel }} disponível(is)</span>
                @else
                    <span class="badge badge-red">✗ Indisponível</span>
                @endif
                <a href="{{ route('livros.show', $livro->id) }}" class="btn btn-outline btn-sm">Ver</a>
            </div>
        </div>
    @empty
        <p style="color: var(--text-muted); grid-column: 1/-1; text-align: center; padding: 3rem 0;">
            Nenhum livro cadastrado ainda.
        </p>
    @endforelse
</div>

@if(!$busca && method_exists($livros, 'links'))
    <div style="margin-top: 2rem; display: flex; justify-content: center;">
        {{ $livros->links() }}
    </div>
@endif
@endsection

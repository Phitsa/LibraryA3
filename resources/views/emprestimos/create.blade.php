@extends('layouts.app')
@section('title', 'Novo Empréstimo')

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('emprestimos.index') }}" style="color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">← Voltar aos Empréstimos</a>
        <h1 style="margin-top: 0.4rem;">Novo <span>Empréstimo</span></h1>
    </div>
</div>

<div style="max-width: 600px;">
    <div class="card">
        <form method="POST" action="{{ route('emprestimos.store') }}">
            @csrf

            <div class="form-group">
                <label>Livro *</label>
                <select name="livro_id" required>
                    <option value="">Selecione um livro disponível...</option>
                    @foreach($livros as $livro)
                        <option value="{{ $livro->id }}"
                            {{ (request('livro_id') == $livro->id || old('livro_id') == $livro->id) ? 'selected' : '' }}>
                            {{ $livro->titulo }} — {{ $livro->autor }}
                            ({{ $livro->quantidade_disponivel }} disponível(is))
                        </option>
                    @endforeach
                </select>
                @error('livro_id') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
                @if($livros->isEmpty())
                    <p style="color: #e74c3c; font-size: 0.82rem; margin-top: 0.4rem;">
                        ⚠ Nenhum livro disponível no momento. Todos estão emprestados.
                    </p>
                @endif
            </div>

            <div class="form-group">
                <label>Usuário *</label>
                <select name="usuario_id" required>
                    <option value="">Selecione o usuário...</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nome }} — Matrícula: {{ $usuario->matricula }}
                        </option>
                    @endforeach
                </select>
                @error('usuario_id') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
                @if($usuarios->isEmpty())
                    <p style="color: #e74c3c; font-size: 0.82rem; margin-top: 0.4rem;">
                        ⚠ Nenhum usuário cadastrado.
                        <a href="{{ route('usuarios.create') }}" style="color: var(--gold);">Cadastrar usuário</a>
                    </p>
                @endif
            </div>

            <div style="background: var(--surface2); border-radius: var(--radius); padding: 1rem; margin-bottom: 1.2rem;">
                <p style="font-size: 0.82rem; color: var(--text-muted);">
                    📅 O prazo de devolução será automaticamente definido para <strong style="color: var(--text);">14 dias</strong> a partir de hoje
                    <strong style="color: var(--gold);">({{ now()->addDays(14)->format('d/m/Y') }})</strong>.
                </p>
            </div>

            <div style="display: flex; gap: 0.8rem;">
                <button type="submit" class="btn btn-primary" {{ $livros->isEmpty() || $usuarios->isEmpty() ? 'disabled' : '' }}>
                    Confirmar Empréstimo
                </button>
                <a href="{{ route('emprestimos.index') }}" class="btn btn-outline">Cancelar</a>
            </div>
        </form>
    </div>

    {{-- Dica sobre fila --}}
    <div style="margin-top: 1rem; background: rgba(201,168,76,0.05); border: 1px solid rgba(201,168,76,0.15); border-radius: var(--radius); padding: 1rem;">
        <p style="font-size: 0.83rem; color: var(--text-muted);">
            <span class="algo-tag">📋 Queue FIFO</span>
            &nbsp; Se o livro desejado estiver indisponível, acesse a
            <a href="{{ route('livros.index') }}" style="color: var(--gold);">página do livro</a>
            para entrar na fila de reservas. Quando for devolvido, o primeiro da fila é notificado automaticamente.
        </p>
    </div>
</div>
@endsection

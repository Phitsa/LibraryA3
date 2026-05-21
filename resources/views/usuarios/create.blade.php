@extends('layouts.app')
@section('title', 'Novo Usuário')

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('usuarios.index') }}" style="color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">← Voltar aos Usuários</a>
        <h1 style="margin-top: 0.4rem;">Cadastrar <span>Usuário</span></h1>
    </div>
</div>

<div style="max-width: 500px;">
    <div class="card">
        <form method="POST" action="{{ route('usuarios.store') }}">
            @csrf

            <div class="form-group">
                <label>Nome Completo *</label>
                <input type="text" name="nome" value="{{ old('nome') }}" required placeholder="Ex: Maria Silva">
                @error('nome') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>E-mail *</label>
                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Ex: maria@email.com">
                @error('email') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Matrícula *</label>
                <input type="text" name="matricula" value="{{ old('matricula') }}" required placeholder="Ex: 2024001">
                @error('matricula') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: flex; gap: 0.8rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Cadastrar Usuário</button>
                <a href="{{ route('usuarios.index') }}" class="btn btn-outline">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

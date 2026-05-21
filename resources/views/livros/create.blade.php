@extends('layouts.app')
@section('title', 'Cadastrar Livro')

@section('content')
<div class="page-header">
    <div>
        <a href="{{ route('livros.index') }}" style="color: var(--text-muted); font-size: 0.85rem; text-decoration: none;">← Voltar ao Acervo</a>
        <h1 style="margin-top: 0.4rem;">Cadastrar <span>Livro</span></h1>
    </div>
</div>

<div style="max-width: 600px;">
    <div class="card">
        <form method="POST" action="{{ route('livros.store') }}">
            @csrf

            <div class="form-group">
                <label>Título *</label>
                <input type="text" name="titulo" value="{{ old('titulo') }}" required placeholder="Ex: Dom Casmurro">
                @error('titulo') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label>Autor *</label>
                <input type="text" name="autor" value="{{ old('autor') }}" required placeholder="Ex: Machado de Assis">
                @error('autor') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label>ISBN *</label>
                    <input type="text" name="isbn" value="{{ old('isbn') }}" required placeholder="Ex: 978-3-16-148410-0">
                    @error('isbn') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Quantidade de Exemplares *</label>
                    <input type="number" name="quantidade_total" value="{{ old('quantidade_total', 1) }}" min="1" required>
                    @error('quantidade_total') <span style="color: #e74c3c; font-size: 0.8rem;">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label>Categoria</label>
                <select name="categoria">
                    <option value="">Sem categoria</option>
                    @foreach(['Romance', 'Ficção Científica', 'Fantasia', 'Técnico', 'História', 'Filosofia', 'Autoajuda', 'Biografia', 'Poesia', 'Outros'] as $cat)
                        <option value="{{ $cat }}" {{ old('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 0.8rem; margin-top: 1.5rem;">
                <button type="submit" class="btn btn-primary">Cadastrar Livro</button>
                <a href="{{ route('livros.index') }}" class="btn btn-outline">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

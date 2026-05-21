@extends('layouts.app')
@section('title', 'Usuários')

@section('content')
<div class="page-header">
    <h1>Usuários <span>Cadastrados</span></h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">+ Novo Usuário</a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Matrícula</th>
                    <th>Empréstimos</th>
                    <th>Reservas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td style="font-weight: 500;">{{ $usuario->nome }}</td>
                        <td style="color: var(--text-muted); font-size: 0.88rem;">{{ $usuario->email }}</td>
                        <td><span class="badge badge-gray">{{ $usuario->matricula }}</span></td>
                        <td style="color: var(--text-muted);">{{ $usuario->emprestimos_count }}</td>
                        <td style="color: var(--text-muted);">{{ $usuario->reservas_count }}</td>
                        <td>
                            <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-outline btn-sm">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem 0;">
                            Nenhum usuário cadastrado ainda.
                            <a href="{{ route('usuarios.create') }}" style="color: var(--gold);">Cadastrar agora</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($usuarios->hasPages())
        <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
            {{ $usuarios->links() }}
        </div>
    @endif
</div>
@endsection

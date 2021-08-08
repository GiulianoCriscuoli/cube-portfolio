@extends('adminlte::page')

@section('title', 'Grupo de portfólio')

@section('content_header')

<div class="content-header--admin" style="display: flex; justify-content: space-between;">
    <h1>Grupos de Portfólios</h1>
    <div class="btn-area">
        <a href="{{ route('grupo-portfolio.create') }}" class="btn btn-success btn-sm">Adicionar novo grupo de portfólio</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success mt-4">
        {{ session('success') }}
    </div>
@endif

@endsection

@section('content')
<table class="table table-hover">
    <thead>
        <th>#ID</th>
        <th>Título</th>
        <th>Ativo</th>
        <th>Ações</th>
    </thead>
    <tbody>
        @if ($portfoliosGroups)
            @foreach ($portfoliosGroups as $gp)
                <tr style="background-color: {{  $gp->active == false ? '#990000;' : 'unset;' }}
                    color: {{  $gp->active == false ? '#FFFFFF;' : '#000;' }} ">
                    <td>{!! $gp->id !!}</td>
                    <td>{!! $gp->title !!}</td>
                    <td>{!! $gp->active !!}</td>
                    <td style="display: flex;">
                        <a href="{{ route('grupo-portfolio.edit', $gp->id) }}" class="btn btn-info">Editar</a>

                        <form action="{{ route('grupo-portfolio.destroy', $gp->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach        
        @else
            <tr>
                <td>Não há nenhum grupo cadastrado</td>
            </tr>
        @endif
    </tbody>
</table>
@endsection
@extends('adminlte::page')

@section('title', 'Portfólio')

@section('content_header')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="content-header--admin" style="display: flex; justify-content: space-between;">
    <h1>Portfólios</h1>
    <div class="btn-area">
        <a href="{{ route('portfolio.create') }}" class="btn btn-success btn-sm">Adicionar um novo portfólio</a>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <th>#ID</th>
        <th>Título</th>
        <th>Ativo</th>
        <th>URL</th>
        <th>Ações</th>
    </thead>
    <tbody>
        @forelse ($portfolios as $portfolio)
            <tr style="background-color: {{ $portfolio->active == false ? '#dc5454;' : 'unset;' }}
                color: {{ $portfolio->active == false ? '#FFFFFF;' : '#000;' }} ">
                <td>{!! $portfolio->id !!}</td>    
                <td>{!! $portfolio->title !!}</td>    
                <td>
                    {!! $portfolio->active == true ? 'SIM' : 'NÃO' !!}
                </td>    
                <td>{!! isset($portfolio->url) ? $portfolio->url : 'Não informado' !!}</td> 
                <td style="display:flex;">
                    <a href="{{ route('portfolio.edit', $portfolio->id) }}" class="btn btn-info" style="margin-right: 5px;">Editar</a> 
                     <form action="{{ route('portfolio.destroy', $portfolio->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>   
                </td>   
            </tr>            
        @empty

        <div>Nenhum portfólio cadastrado</div>

        @endforelse
    </tbody>
</table>
@endsection

@section('content')

@endsection

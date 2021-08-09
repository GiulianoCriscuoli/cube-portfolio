@extends('adminlte::page')

@section('title', 'Editar Grupo de portfólio')

@section('content_header')

<h1>Editar grupo de portfólio</h1>
    
@endsection

@section('content')

    <form action="{{ route('grupo-portfolio.update', $portfolioGroup->id) }}" method="POST">
        @csrf
        @method('PUT')

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="title">Título do grupo</label>
                    <input type="text"  value="{{ @$portfolioGroup->title }}" name="title" class="form-control">
                </div>
            </div>
            <div class="col-md-6" style="display: flex; justify-content: center; align-items:flex-end;">
                <div class="form-group">
                    <label for="active">Ativo:</label>
                    <input class="checkbox" {{ !empty($portfolioGroup->active) ? 'checked="checked"' : '' }} type="checkbox" name="active" id="active">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button class="btn btn-success">Editar</button>
            </div>
        </div>
    </form>

@endsection
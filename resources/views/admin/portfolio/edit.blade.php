@extends('adminlte::page')

@section('title', 'Editar portfólio')

@section('content_header')
    <h1>Editar portfólio</h1>
@endsection

@section('content')

<form action="{{ route('portfolio.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
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
                <label for="title">Título</label>
                <input class="form-control form-input" value="{{ @$portfolio->title }}" type="text" name="title">
            </div>
        </div>
       
        <div class="col-md-6" style="display: flex; justify-content: center; align-items:flex-end;">
            <div class="form-group">
                <label for="active">Ativo:</label>
                <input class="checkbox" type="checkbox"  {{  !empty($portfolio->active) ? 'checked="checked"' : ''  }} name="active" id="active">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="short_description">Descrição curta</label>
                <textarea class="form-control" name="short_description"  cols="30" rows="10">{{ @$portfolio->short_description }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="url">URL:</label>
                <input class="form-control" type="text" value="{{ @$portfolio->url }}" name="url">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="image">Imagem:</label>
                <input class="form-control" value="{{ old('image') }}" type="file" name="image">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <h4>Grupo de portfólios</h4>
                @foreach($portfolioGroup as $key => $gp)
                    <label for="portfolioGroup">{!! $gp !!}</label>
                    <input type="checkbox" name="portfolioGroup[]" {{ @$key ? 'checked=checked' : '' }} value="{{ @$key }}"><br>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row pb-4">
        <div class="col-md-4">
            <div class="btn-area">
                <button type="submit" class="btn btn-success">Editar</button>
            </div>
        </div>
    </div>
    
</form>
    
@endsection
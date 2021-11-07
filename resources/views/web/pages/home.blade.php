@extends('web.layouts.app')

@section('title', 'Portfólio')


@section('content')

@php $count = 0; @endphp
<div class="container">

    <div class="list-groupPortfolio">
        @if (isset($groupPortfolios))
            @foreach ($groupPortfolios as $groupPortfolio)

                @if ($count == 0)
                    <div class="groupPortfolio active" data-group="all">
                        Todos
                    </div>
                @endif
                    <div class="groupPortfolio" data-group="{{ 'gp-'.$groupPortfolio->id }}">
                        {!! $groupPortfolio->title !!}
                    </div>
                @php $count++; @endphp
            @endforeach
        @endif
    </div>

    <div class="row row-portfolio">
  
        @foreach ($portfolios as $portfolio)
            <div class="col-md-3 portfolio-area @foreach($portfolio->portfoliosGroup as $portfolioGroup) gp-{{$portfolioGroup->id}} @endforeach">
                <img src="images/upload/{{ $portfolio->image }}" alt="{{ $portfolio->title }}" class="img-fluid">
            </div>
        @endforeach
    </div>
</div>

@endsection
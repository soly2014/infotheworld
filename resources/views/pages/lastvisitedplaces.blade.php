@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">

            <div class="box white-bg animate-box">

                <h1 class="main-head">{{ trans('trans.last visited places') }}</h1>

                @if(count($places) > 0)
                    <div class="row">

                        {{--@for($i = 1; $i <= 6; $i++)--}}

                        <div class="">
                            @foreach($places as $place)

                                <a class="col-xs-12 col-sm-12 col-md-3" href="{{ $place->url }}">{{ $place->place }}</a>
                            @endforeach

                        </div>

                        {{--@endfor--}}
                    </div>

                @endif


            </div>
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{  $places->links()}}
                </ul>
            </nav>
        </div>
    </div>
@stop
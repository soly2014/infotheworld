@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">

            <div class="box white-bg animate-box">

                <h1 class="main-head">{{ trans('trans.terms') }}</h1>
                @if(count($terms) > 0)
                    <h3 class="color-blue">{{ $terms->title }}</h3>

                    <p>{!! $terms->content !!}</p>
                @endif
            </div>

        </div>
    </div>
@stop
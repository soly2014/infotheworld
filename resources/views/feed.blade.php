


@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">
            <div class="row">


                <div class="col-xs-12 col-sm-7 col-lg-8">
                    <div class="box white-bg animate-box">

                        <div class="header">
                          <h1><a href="{{ $permalink }}">{{ $title }}</a></h1>
                        </div>

                        @foreach ($items as $item)
                          <div class="item">
                            <h2><a href="{{ $item->get_permalink() }}">{{ $item->get_title() }}</a></h2>
                            <p>{{ $item->get_description() }}</p>
                            <p><small>Posted on {{ $item->get_date('j F Y | g:i a') }}</small></p>
                          </div>
                        @endforeach


                    </div>
                </div>


                <div class="col-xs-12 col-sm-5 col-lg-4">
                    <div class="box white-bg animate-box">

                    </div>
                </div>


            </div>
        </div>
    </div>

@stop
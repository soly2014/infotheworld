@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">

            <div class="box white-bg animate-box">

                <h1 class="main-head">{{trans('trans.about')}}</h1>


                <p class="text-center">@if(count($about) > 0) {!! $about->content !!} @endif</p>

            </div>

        </div>
    </div>
@stop
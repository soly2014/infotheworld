@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">

            <div class="box white-bg animate-box">

                <h1 class="main-head">{{ trans('trans.site map') }}</h1>

                <div class="row">


                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <ul class="list-unstyled sitemap">
                            <li><strong>{{ trans('trans.pages') }}</strong></li>
                            <li><a href="{{ action('MainController@home') }}">{{ trans('trans.home') }}</a></li>
                            <li><a href="{{ action('MainController@about') }}">{{ trans('trans.about') }}</a></li>
                            <li><a href="{{ action('MainController@contactUs') }}">{{ trans('trans.contact') }}</a></li>
                            <li><a href="{{ action('MainController@getTerms') }}">{{ trans('trans.terms') }}</a></li>
                            <li><a href="{{ action('MainController@getRss') }}">rss</a></li>
                            <li><a href="{{ action('MainController@getSiteMap') }}">{{ trans('trans.site map') }}</a>
                            </li>

                        </ul>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <ul class="list-unstyled sitemap">
                            <li><strong>{{ trans('trans.last visited places') }}</strong></li>
                            @if(count($places) > 0)
                                @foreach($places as $place)
                                    <li><a href="{{ $place->url }}">{{ $place->place }}</a></li>
                                @endforeach
                                <li>
                                    <a href="{{ action('MainController@lastVisitedPlaces') }}"><strong>{{trans('trans.see more')}}
                                        </strong></a></li>
                            @endif
                        </ul>
                    </div>


                </div>

            </div>

        </div>
    </div>
@stop
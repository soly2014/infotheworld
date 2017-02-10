<!DOCTYPE html>
<html dir=@if(App::getLocale() == 'ar')"rtl" @else"ltr"@endif lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="true">

    <meta name="description" content="@if(isset($meta_desc)){{ $meta_desc->content }}@endif">
    <meta name="keywords" content="@if(isset($meta_keywords)){{ $meta_keywords->content }}@endif">

    <title>{{ trans('trans.title') }} | {{ $title }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">

    @if(App::isLocale('ar'))
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-ar.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-en.css') }}">
    @endif
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lightbox/css/lightbox.css') }}">
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" /> 

    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-79434314-1', 'auto');
        ga('send', 'pageview');

    </script>

    <style>
        #links {
            display: block;
        }

        #links a {
            margin-top: 5px;
        }
    </style>

</head>

<body>

<!--===============================
    NAV
===================================-->

<nav class="navbar">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#navbar-collapse-1" aria-expanded="false">
                    <span class="fa fa-bars"></span>
                </button>
                {{--@if(App::getLocale() == 'en')--}}
                <a href="{{ action('MainController@home') }}" class="navbar-brand">{{ trans('trans.title') }}</a>
                {{--@else--}}
                {{--<a href="http://{{ App::getLocale() }}.infotheworld.com/"--}}
                {{--class="navbar-brand">{{ trans('trans.title') }}</a>--}}
                {{--@endif--}}

            </div>

              <!--   <form style="margin-left: 50px;" class="navbar-form navbar-left text-center" role="search">
                {!! csrf_field() !!}
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="searchcountry" id="searchcountry">
                  </div>
                <button type="submit" class="btn btn-default" id="searchid">Submit</button>

               </form> 
 -->
<!--===============================
    SEARCH
===================================-->

<!-- <div class="search-box">
    <div class="container">

        <div class="animate-box">

            <div class="clearfix">
                <h1 class="text-center pull-right">{{ trans('trans.look for country') }}</h1>

                <a class="btn btn-small btn-black pull-left coll-btn" role="button" data-toggle="collapse"
                   href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa fa-search"></i>
                </a>
            </div>

            <div class="row collapse" id="collapseExample">


                <div class="col-xs-12 col-sm-4 col-lg-10">
                    <label>{{ trans('trans.country') }}</label>
                    <input id="address" type="textbox">
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-2">
                    <input id="submit" type="submit" class="btn btn-block btn-black"
                           value="{{ trans('trans.search') }}">
                </div>


            </div>

        </div>

    </div>
</div> -->

<!--===============================
MAP
===================================-->                                   

            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav text-center">

            <form style="margin-right: 130px;" class="navbar-form navbar-left text-center" method="get" action="{{ url('/country-search') }}">
<!-- 
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="searchcountry" id="searchcountry">
                  </div>
                <button type="submit" style="margin-top: -13px;" class="btn btn-default" id="searchid">Submit</button>
 -->
                <div class="col-xs-12 col-sm-4 col-lg-8">
                    <label>{{ trans('trans.search') }}</label>
                    <input name="searchcountry" type="textbox">
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <input style="margin-top: 15px;" type="submit" class="btn btn-block btn-black"
                           value="{{ trans('trans.search') }}">
                </div>

            </form>  


             <!--    <div class="col-xs-12 col-sm-4 col-lg-10">
                    <label>{{ trans('trans.country') }}</label>
                    <input id="address" type="textbox">
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-2">
                    <input id="submit" type="submit" class="btn btn-block btn-black"
                           value="{{ trans('trans.search') }}">
                </div>
 -->

                    <li @if(Request::segment(1) == false) class="active" @endif>

                        {{--@if(App::getLocale() == 'en')--}}
                        <a href="{{ action('MainController@home') }}">{{ trans('trans.home') }}</a>
                        {{--@else--}}
                        {{--<a href="http://{{ App::getLocale() }}.infotheworld.com/">{{ trans('trans.home') }}</a>--}}
                        {{--@endif--}}

                    </li>
                    <li @if(Request::segment(1) == 'about-us') class="active" @endif>
                        <a href="{{ action('MainController@about') }}">{{ trans('trans.about') }}</a>
                    </li>
                    <li @if(Request::segment(1) == 'contact-us') class="active" @endif>
                        <a href="{{ action('MainController@contactUs') }}">{{ trans('trans.contact') }}</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ trans('trans.language') }} <span class="caret left-fa"></span></a>
                        <ul class="dropdown-menu">
                           <li><a href="http://ar.infotheworld.com/{{ Request::segment(1) }}">عربي</a></li>
                            <li><a href="http://de.infotheworld.com/{{ Request::segment(1) }}">German</a></li>
                            <li><a href="http://infotheworld.com/{{ Request::segment(1) }}">English</a></li>
                            <li><a href="http://es.infotheworld.com/{{ Request::segment(1) }}">Spanish</a></li>
                            <li><a href="http://fr.infotheworld.com/{{ Request::segment(1) }}">French</a></li>
                            <li><a href="http://hi.infotheworld.com/{{ Request::segment(1) }}">Hindi</a></li>
                            <li><a href="http://ja.infotheworld.com/{{ Request::segment(1) }}">Japanese</a></li>
                            <li><a href="http://pt.infotheworld.com/{{ Request::segment(1) }}">Portuguese</a></li>
                            <li><a href="http://ru.infotheworld.com/{{ Request::segment(1) }}">Russian</a></li>
                            <li><a href="http://tr.infotheworld.com/{{ Request::segment(1) }}">Turkish</a></li>
                            <li><a href="http://zh.infotheworld.com/{{ Request::segment(1) }}">Chinese</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>


@yield('content')
<!--===============================
    FOOTER
===================================-->

<a name="footer"></a>
<footer class="div-small-padding">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-4">
                <h1>{{ trans('trans.about') }}</h1>
                @if(count($about) > 0)
                    <p>{{ $about->content }}</p>
                @else
                    <p>{{ trans('trans.there is none') }}</p>
                @endif
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
                <h1>{{ trans('trans.important links') }}</h1>

                <ul class="list-unstyled">
                    <li><a href="{{ action('MainController@getRss') }}"><i class="fa fa-rss right-fa color-blue"></i>
                            Rss</a></li>
                    <li><a href="{{ action('MainController@getSiteMap') }}"><i
                                    class="fa fa-sitemap right-fa color-blue"></i> {{ trans('trans.site map') }}</a>
                    </li>
                    <li><a href="{{ action('MainController@getTerms') }}"><i
                                    class="fa fa-terminal right-fa color-blue"></i>{{ trans('trans.terms') }}</a></li>
                </ul>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-5">
                <h1>{{ trans('trans.contact') }}</h1>
                <form action="{{ action('MainController@sendMessage') }}" method="post">
                    <div class="row">

                        <div class="col-xs-12 col-sm-6">
                            <label>{{ trans('trans.name') }}</label>
                            <input name="name" type="text" required>
                            <label>{{ trans('trans.email') }}</label>
                            <input name="email" type="email" required>
                            <label>{{ trans('trans.subject') }}</label>
                            <input name="subject" type="text" required>
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <label>{{ trans('trans.message') }}</label>
                            <textarea required name="message"></textarea>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-blue btn-block" value="{{ trans('trans.send') }}">
                        </div>

                    </div>
                </form>
            </div>

        </div>

        <div class="social text-center">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-google-plus"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
            <a href="#"><i class="fa fa-rss"></i></a>
        </div>

        <p class="text-center">{{ trans('trans.all rights reserved') }}</p>
    </div>
</footer>


<!--===============================
    SCRIPT
===================================-->

<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/image-popup/source/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/lightbox/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
@yield('script')
</body>
</html>
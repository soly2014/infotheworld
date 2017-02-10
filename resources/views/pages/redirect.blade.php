<!DOCTYPE html>
<html dir=@if(App::getLocale() == 'ar')"rtl" @else"ltr"@endif lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="true">


    <title>{{ trans('trans.title') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/font-awesome.min.css') }}">

    @if(App::isLocale('ar'))
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style-ar.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style-en.css') }}">
    @endif
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/custom.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/lightbox/css/lightbox.css') }}">
    <script src="{{ asset('public/assets/js/jquery-1.11.1.min.js') }}"></script>
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
                <a href="{{ action('MainController@home') }}" class="navbar-brand">{{ trans('trans.title') }}</a>
            </div>


            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav text-center">
                    <li class="active"><a href="{{ action('MainController@home') }}">{{ trans('trans.home') }}</a></li>
                    <li><a href="#footer">{{ trans('trans.about') }}</a></li>
                    <li><a href="#footer">{{ trans('trans.contact') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ trans('trans.language') }} <span class="caret left-fa"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ action('MainController@setLang','ar') }}">عربي</a></li>
                            <li><a href="{{ action('MainController@setLang','de') }}">German</a></li>
                            <li><a href="{{ action('MainController@setLang','en') }}">English</a></li>
                            <li><a href="{{ action('MainController@setLang','es') }}">Spanish</a></li>
                            <li><a href="{{ action('MainController@setLang','fr') }}">French</a></li>
                            <li><a href="{{ action('MainController@setLang','hi') }}">Hindi</a></li>
                            <li><a href="{{ action('MainController@setLang','ja') }}">Japanese</a></li>
                            <li><a href="{{ action('MainController@setLang','pt') }}">Portuguese</a></li>
                            <li><a href="{{ action('MainController@setLang','ru') }}">Russian</a></li>
                            <li><a href="{{ action('MainController@setLang','tr') }}">Turkish</a></li>
                            <li><a href="{{ action('MainController@setLang','zh') }}">Chinese</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>


<h1>{{ trans('trans.loading') }}</h1>
<?php
if (Session::has('locale')) {
    $localeLang = Session::get('locale');
} else {
    $localeLang = 'en';
}
?>
<div id="form-container">

</div>

<script>
    var url = "https://maps.googleapis.com/maps/api/geocode/json?address={{ $place }}&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&language={{ $localeLang }}";

    $.ajax({
        url: url,
        dataType: 'json',
        success: function (response) {
            var resultNum = response.results.length - 1;
            var num = response.results[resultNum].address_components.length - 1;
            var countryName = response.results[0].address_components[0].long_name;
            var countryName2 = response.results[resultNum].address_components[num].long_name;
            if (countryName2 == '13243' || countryName2 == '12488') {
                countryName2 = 'السعوديه';
            }
            var countryCode = response.results[resultNum].address_components[num].short_name;
            if (countryCode == '13243' || countryCode == '12488') {
                countryCode = 'SA';
            }
            countryName2 = countryName2.replace(" ", '_');
            var lat = response.results[0].geometry.location.lat;
            lat = lat.toString();
            lat = lat.replace('.', '_');
            var lng = response.results[0].geometry.location.lng;
            lng = lng.toString();
            lng = lng.replace('.', '_');
            var type = response.results[0].types[0];

            if (type !== 'country') {
                var type = 'city';
            }

            window.location.href = "/" + countryName + '/' + type + '/' + countryName2 + '/' + countryCode + '/' + lat + '/' + lng;

            {{--$('#form-container').html('' +--}}
            {{--'<form id="form-data" action="/{{ $localeLang }}/place-view/' + type + '/' + countryName + '" method="post">' +--}}
            {{--'<input type="hidden" name="cN" value="' + countryName + '" />' +--}}
            {{--'<input type="hidden" name="cN2" value="' + countryname2 + '" />' +--}}
            {{--'<input type="hidden" name="cC" value="' + countryCode + '" />' +--}}
            {{--'<input type="hidden" name="lat" value="' + lat + '" />' +--}}
            {{--'<input type="hidden" name="lng" value="' + lng + '" />' +--}}
            {{--'<input type="hidden" name="type" value="' + type + '" />' +--}}
            {{--'<input type="hidden" name="_token" value="{{ csrf_token() }}">' +--}}
            {{--'</form>');--}}

            {{--$('#form-container form').submit();--}}


            {{--var url = "/{{$localeLang}}/place-view/" + type + '/' + countryName;--}}
            {{--window.location.href = url;--}}

        }
    })
</script>
<!--===============================
    FOOTER
===================================-->
<a name="footer"></a>
<footer class="div-small-padding">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-3">
                <h1>{{ trans('trans.about') }}</h1>
                @if(count($about) > 0)
                    <p>{{ $about->content }}</p>
                @else
                    <p>{{ trans('trans.there is none') }}</p>
                @endif
            </div>

            <div class="col-xs-12 col-sm-6 col-md-3">
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6">
                <h1>{{ trans('trans.contact') }}</h1>
                @if(Session::has('success'))
                    <div class="text-right col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="text-left col-lg-12 alert alert-danger">{{ Session::get('error') }}</h1>
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="text-left col-lg-12 alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
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

<script src="{{ asset('public/assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/assets/image-popup/source/jquery.fancybox.js') }}"></script>
<script src="{{ asset('public/assets/lightbox/js/lightbox.js') }}"></script>
<script src="{{ asset('public/assets/js/script.js') }}"></script>

</body>
</html>

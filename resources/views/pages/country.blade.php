<!DOCTYPE html>
<html dir=@if(App::getLocale() == 'ar')"rtl" @else"ltr"@endif lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="true">

    <?php
    $metaD = $dataText->where('place', $country)->first();

    if (count($metaD) > 0) {

        $metaDesc = $metaD->text;
        $length = strlen($metaDesc);
        $length = ceil($length / 4);
        $metaDesc = substr($metaDesc, 0, $length);
        $metaKey = str_replace(" ", ",", $metaD->text);
        $metaKey = substr($metaKey, 0, $length);
//        dd($metaKey);
    }

    ?>

    @if(count($metaD) > 0)
        <meta name="description"
              content="@if(strlen($metaDesc) > 0) <?php echo $metaDesc; ?> @endif @if(count($country_metaDesc) > 0){{ $country_metaDesc->content }}@endif">
        <meta name="keywords"
              content="@if(strlen($metaKey) > 0) <?php echo $metaKey; ?> @endif @if(count($country_metaKey) > 0){{ $country_metaKey->content }}@endif">
    @endif
    <title>{{ trans('trans.about title') }} {{ $country }} @if($country2 !== $country) - {{ $country2 }}@endif</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/font-awesome.min.css') }}">

    @if(App::isLocale('ar'))
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style-ar.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style-en.css') }}">
    @endif
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

                <a href="{{ action('MainController@home') }}" class="navbar-brand">
                    {{trans('trans.logo')}}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse-1">
                <ul class="nav navbar-nav text-center">

                
            <form style="margin-right: 130px;" class="navbar-form navbar-left text-center" method="get" action="{{ url('/country-search') }}">
                <div class="col-xs-12 col-sm-4 col-lg-8">
                    <label>{{ trans('trans.search') }}</label>
                    <input  name="searchcountry" type="textbox">
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <input style="margin-top: 15px;" type="submit" class="btn btn-block btn-black"
                           value="{{ trans('trans.search') }}">
                </div>

            </form>  

                    <li><a href="{{ action('MainController@home') }}">{{ trans('trans.home') }}</a></li>
                    <li><a href="{{ action('MainController@about') }}">{{trans('trans.about')}}</a></li>
                    <li><a href="{{ action('MainController@contactUs') }}">{{ trans('trans.contact') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ trans('trans.language') }} <span class="caret left-fa"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="http://ar.infotheworld.com/{{ Request::segment(1) .'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6)}}">عربي</a>
                            </li>
                            <li>
                                <a href="http://de.infotheworld.com/{{ Request::segment(1) .'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6)}}">German</a>
                            </li>
                            <li>
                                <a href="http://infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">English</a>
                            </li>
                            <li>
                                <a href="http://es.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Spanish</a>
                            </li>
                            <li>
                                <a href="http://fr.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">French</a>
                            </li>
                            <li>
                                <a href="http://hi.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Hindi</a>
                            </li>
                            <li>
                                <a href="http://ja.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Japanese</a>
                            </li>
                            <li>
                                <a href="http://pt.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Portuguese</a>
                            </li>
                            <li>
                                <a href="http://ru.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Russian</a>
                            </li>
                            <li>
                                <a href="http://tr.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Turkish</a>
                            </li>
                            <li>
                                <a href="http://zh.infotheworld.com/{{ Request::segment(1).'/'. Request::segment(2).'/'.Request::segment(3).'/'.Request::segment(4).'/'.Request::segment(5).'/'.Request::segment(6) }}">Chinese</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!--===============================
    SEARCH
===================================-->

<div class="search-box">
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
</div>

<!--===============================
MAP
===================================-->

@if(Session::has('locale'))
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&callback=initMap&language={{ Session::get('locale') }}"
            async defer>
    </script>
@else
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&callback=initMap&language=en"
            async defer>
    </script>
@endif
<?php

$localeLang = App::getLocale();

?>
<script>
    function initMap() {
        var mapDiv = document.getElementById('map-canvas');
        var map = new google.maps.Map(mapDiv, {
            center: {lat: {{ $lat }}, lng: {{ $lng }}},
            zoom: 4
        });


        var geocoder = new google.maps.Geocoder();
        document.getElementById('submit').addEventListener('click', function () {
            geocodeAddress(geocoder, map);
        });

        marker = new google.maps.Marker({
            position: {lat: {{ $lat }}, lng: {{ $lng }}},
            draggable: true,
            map: map,
            title: "Drag me!"
        }); //end marker


        var contentString = '<h3>{{ trans('trans.drag me') }}</h3>';

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });


        // infoWindow
        marker.addListener('click', function () {
            infowindow.open(map, marker);
        });
        infowindow.open(map, marker);

        //Add listener
        google.maps.event.addListener(marker, "dragend", function (event) {

            infowindow.close(map, marker);

            var latitude = this.position.lat();
            var lat = latitude.toString();
            var lat = lat.replace('.', '_');
            var longitude = this.position.lng();
            var lng = longitude.toString();
            var lng = lng.replace('.', '_');

            var url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng=' + latitude + ',' + longitude + '&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&callback&language={{ $localeLang }}';
            $.ajax({
                url: url,
                dataType: "json",
                success: function (response) {
                    var num = response.results.length - 1;
                    var countryName = response.results[0].address_components[0].long_name;
                    var countryName2 = response.results[num].address_components[0].long_name;
                    countryName2 = countryName2.replace(" ", '-');
                    var countryCode = response.results[num].address_components[0].short_name;
                    var type = response.results[num].types[0];

                    if (type !== 'country') {
                        var type = 'city';
                    }

                    var contentString = '' + countryName2 + '' +
                            '<br />' +
                            '<a href="/' + countryName2 + '/' + type + '/' + countryName2 + '/' + countryCode + '/' + lat + '/' + lng + '" class="btn btn-success">{{ trans('trans.view place') }}</a>';


                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });


                    // infoWindow
                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });

                    infowindow.open(map, marker);

                    $('#infoWindow form').css('font-size', '0px');

                }
            });
        }); //end addListener


        function geocodeAddress(geocoder, resultsMap) {
            var address = document.getElementById('address').value;
            geocoder.geocode({'address': address}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    resultsMap.setCenter(results[0].geometry.location);
                    var marker = new google.maps.Marker({
                        map: resultsMap,
                        position: results[0].geometry.location
                    });

                    var resultNum = results.length - 1;
                    var num = results[resultNum].address_components.length - 1;
                    var countryName = results[0].address_components[0].long_name;
                    countryName = countryName.replace(" ", '_');
                    var countryName2 = results[resultNum].address_components[num].long_name;
                    if (countryName2 == '13243' || countryName2 == '12488') {
                        countryName2 = 'السعوديه';
                    }
                    countryName2 = countryName2.replace(" ", '_');
                    var countryCode = results[resultNum].address_components[num].short_name;
                    if (countryCode == '13243' || countryCode == '12488') {
                        countryCode = 'SA';
                    }
                    var lat = results[0].geometry.location.lat();
                    lat = lat.toString();
                    lat = lat.replace('.', '_');
                    var lng = results[0].geometry.location.lng();
                    lng = lng.toString();
                    lng = lng.replace('.', '_');
                    var type = results[0].types[0];

                    if (type !== 'country') {
                        var type = 'city';
                    }

                    var contentString = '' + countryName + '' +
                            '<br />' +
                            '<a href="/' + countryName + '/' + type + '/' + countryName2 + '/' + countryCode + '/' + lat + '/' + lng + '" class="btn btn-success">{{ trans('trans.view place') }}</a>';


                    var infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });


                    // infoWindow
                    marker.addListener('click', function () {
                        infowindow.open(map, marker);
                    });

                    infowindow.open(map, marker);

                    $('#infoWindow').css('padding', '10px');
                    $('#infoWindow form').css('font-size', '0px');


                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                }
            });
        }

///////////////////////////////////////////////////////////////////////////

        $("#c-s a").click(function () {
            var id = $(this).attr('id');


            var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + id + "&components=country:{{ $countryCode }}&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&language={{ $localeLang }}";

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
                    {{--'<form id="form-data" action="/{{ $localeLang }}/place-view/' + type + '/' + countryName + '" method="get">' +--}}
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
        });


    }

    var countryInfoUrl = 'http://api.geonames.org/countryInfoJSON?formatted=true&lang={{ $localeLang }}&country={{ $countryCode }}&username=hosny&style=full';

    @if(Session::has('locale'))
    $.ajax({
        url: countryInfoUrl,
        dataType: 'json',
        success: function (response) {

            var capital = response.geonames[0].capital;
            $("#capital").html('' +
                    '<a id="' + capital + '" >{{ trans('trans.capital') }}:' + capital + '</a>');


        }
    });
    @else
            $.ajax({
        url: countryInfoUrl,
        dataType: 'json',
        success: function (response) {

            var capital = response.geonames[0].capital;
            $("#capital").html('' +
                    '<a id="' + capital + '" >{{ trans('trans.capital') }}:' + capital + '</a>');
        }
    });
    @endif


</script>

<div id="map-canvas" style="width: 100%; height: 250px;"></div>

<div id="form-container">

</div>


<!--===============================
    ABOUT CITY
===================================-->

<div class="blue-block div-small-padding">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-5 text-align-left">
                <i class="fa fa-map-marker fa-5x"></i>
            </div>
            <div class="col-xs-12 col-sm-7 text-align-right">

                <h1>{{ $country }}  @if($country2 !== $country) - {{ $country2 }} @endif
                    <a title="@if(isset($country2)){{ $country2 }}@endif">
                        <img src="@if($flag){{asset("public/assets/flags/$flag->alpha_2.png")}}@endif">
                    </a>
                </h1>
                <div id="capital">

                </div>
                <script>
                    $("#capital").click(function () {
//                        alert('haha');
                        var id = $(this).attr('id');


                        var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + id + "&components=country:{{ $countryCode }}&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&language={{ $localeLang }}";

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
                                {{--'<form id="form-data" action="/{{ $localeLang }}/place-view/' + type + '/' + countryName + '" method="get">' +--}}
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
                    });
                </script>
            </div>
            {{--<br/>--}}
        </div>
        {{--<div id="c-s">--}}
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                               aria-expanded="true" aria-controls="collapseOne">
                                {{ trans('trans.states') }} +
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">
                            @if(isset($states))
                                @if(count($states) > 0)
                                    <div id="c-s">
                                        @foreach($states as $state)
                                            <a id="{{ $state->name }}"
                                               class="btn btn-black btn-sm states">{{ $state->name }}</a>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-center">{{ trans('trans.no data') }}</p>
                                @endif
                            @else
                                <p class="text-center">{{ trans('trans.no data') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">

                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                {{ trans('trans.cities') }} +
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            @if(isset($cities))
                                @if(count($cities) > 0)
                                    <div id="c-s">
                                        @foreach($cities as $city)
                                            @foreach($city as $c)
                                                <a id="{{ $c->name }}"
                                                   class="btn btn-black btn-sm states">{{ $c->name }}</a>
                                            @endforeach
                                        @endforeach
                                    </div>
                                @endif
                            @else
                                <p class="text-center">{{ trans('trans.no data') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{--<div id="c-s">--}}
        {{--<h3>{{ trans('trans.states') }}</h3>--}}
        {{--@if(count($states) > 0)--}}
        {{--@foreach($states as $state)--}}
        {{--<a id="{{ $state->name }}" class="btn btn-success btn-sm states">{{ $state->name }}</a>--}}
        {{--@endforeach--}}
        {{--@endif--}}


        {{--<h3>{{ trans('trans.cities') }}</h3>--}}
        {{--@if(count($cities) > 0)--}}
        {{--@foreach($cities as $city)--}}
        {{--@foreach($city as $c)--}}
        {{--<input id="address" type="hidden" value="{{ $c->name }}"/>--}}
        {{--<input id="submit" type="submit" class="btn btn-success btn-sm"--}}
        {{--value="{{ $c->name }}"/>--}}

        {{--<a id="{{ $c->name }}" class="btn btn-success btn-sm states">{{ $c->name }}</a>--}}
        {{--@endforeach--}}
        {{--@endforeach--}}
        {{--@endif--}}
        {{--</div>--}}

        <?php
        if (Session::has('locale')) {
            $localeLang = Session::get('locale');
        } else {
            $localeLang = 'en';
        }
        ?>
    </div>
</div>
</div>

<!--===============================
    WIDGETS
===================================-->

<div class="div-padding">
    <script>
        var theUrl = 'http://api.geonames.org/timezoneJSON?lat={{ $lat }}&lng={{ $lng }}&username=hosny';
        $.ajax({
            url: theUrl,
            dataType: 'json',
            success: function (response) {
                var timeZone = response.timezoneId;
                var time = response.time;
                var timeDate = time.split(" ");

                $("#timezone-info").html('' +
                        '<p>' + timeDate[1] + '</p>' +
                        '<p>' + timeDate[0] + '</p>' +
                        '</h3>');

                var prayUrl = 'http://api.aladhan.com/timings/1398332113?latitude={{ $lat }}&longitude={{ $lng }}&timezonestring=' + timeZone + '&method=2';

                $.ajax({
                    url: prayUrl,
                    dateType: 'json',
                    success: function (response) {

                        $("#fajr").html('' +
                                '<td>{{ trans('trans.fajr') }}</td>' +
                                '<td>' + $.parseJSON(response).data.timings.Fajr + '</td>');
                        $("#dhuhr").html('' +
                                '<td>{{ trans('trans.dhuhr') }}</td>' +
                                '<td>' + $.parseJSON(response).data.timings.Dhuhr + '</td>');
                        $("#asr").html('' +
                                '<td>{{ trans('trans.asr') }}</td>' +
                                '<td>' + $.parseJSON(response).data.timings.Asr + '</td>');
                        $("#maghrib").html('' +
                                '<td>{{ trans('trans.maghrib') }}</td>' +
                                '<td>' + $.parseJSON(response).data.timings.Maghrib + '</td>');
                        $("#isha").html('' +
                                '<td>{{ trans('trans.isha') }}</td>' +
                                '<td>' + $.parseJSON(response).data.timings.Isha + '</td>');

                    }
                });

            }
        })

        var weatherUrl = 'http://api.geonames.org/findNearByWeatherJSON?lat={{ $lat }}&lng={{ $lng }}&username=hosny';

        $.ajax({
            url: weatherUrl,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                var windD = response;
                windDD = response;
                var windDirection = response.weatherObservation.windDirection;
                var windSpeed = response.weatherObservation.windSpeed;
                var temperature = response.weatherObservation.temperature;
                $("#weather-info").html('' +
                        '<p>{{ trans('trans.wind direction') }}: ' + windDirection + '<i id="w1" class="fa fa-cloud"></i></p>' +
                        '<p>{{ trans('trans.wind speed') }}: ' + windSpeed + '<i id="w1" class="fa fa-bolt"></i></p>' +
                        '<p>{{ trans('trans.temprature') }}: ' + temperature + '<i id="w1" class="fa fa-sun-o"></i></p>'
                );

            }

        });

    </script>

    <div class="container">
        <div class="inner-box text-center animate-box adv">
            @if(count($ad1) > 0)
                {!! $ad1->ad !!}
            @else
                <a href="#"><img src="http://placehold.it/728x90"></a>
            @endif
        </div>
        <br/>
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="box text-center">
                    <i class="fa fa-laptop fa-4x"></i>
                    <h1>{{ trans('trans.ip address') }}</h1>
                    <p>{{ $ip }}</p>
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="box text-center">
                    <i class="fa fa-clock-o fa-4x"></i>
                    <h1>{{ trans('trans.time and date') }}</h1>
                    <div id="timezone-info">

                    </div>
                    {{--<p>05:00 PM</p>--}}
                </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="box text-center">
                    <i class="fa fa-sun-o fa-4x"></i>
                    <h1>{{ trans('trans.weather') }}</h1>
                    <div id="weather-info">

                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 pull-left">
                <div class="box text-center">
                    <img src="{{ asset('public/assets/images/mosque.png') }}">
                    <h1>{{ trans('trans.prayer Times') }}</h1>
                    <table class="table table-striped table-hover">
                        <tr id="fajr">
                        </tr>
                        <tr id="dhuhr">
                        </tr>
                        <tr id="asr">
                        </tr>
                        <tr id="maghrib">
                        </tr>
                        <tr id="isha">
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-md-8 col-lg-9 animate-box">
                <div id="disc" class="box">
                    <h1>{{ trans('trans.about place') }} {{ $country }}</h1>
                    <p id="desc-p">


                        <?php
                        $textCheck = $dataText->where('place', $country)->first();
                        ?>
                        @if(count($textCheck) > 0)
                            <?php
                            $textD = $textCheck->text;
                            $textK = str_replace(" ", ",", $textCheck->text);
                            echo substr($textCheck->text, 0, 1500);

                            $visit = $classVisit->where('place', $country)->first();
                            if (count($visit) > 0) {
                                $visit->url = url()->full();
                                $visit->place = $country;
                                $visit->locale = Session::get('locale');
                                $visit->save();
                            } else {
                                $visit = $classVisit;
                                $visit->url = url()->full();
                                $visit->place = $country;
                                $visit->locale = Session::get('locale');
                                $visit->save();
                            }
                            ?>

                            <a href="" id="see-more">{{trans('trans.see more')}}...</a>
                        @else
                            <?php

                            try {
                                if (Session::has('locale')) {
                                    $lang = Session::get('locale');
                                    $html = new Htmldom("https://$lang.wikipedia.org/wiki/$country");
                                } else {
                                    $html = new Htmldom("https://en.wikipedia.org/wiki/$country");
                                }
                            } catch (ErrorException $e) {
                                echo trans('trans.no data');
                            }

                            ?>

                            @if(isset($html))
                                @foreach($html->find('div[id=mw-content-text]') as $content)

                                    @foreach($content->find('p') as $p)

                                        <?php

                                        foreach ($p->find('span[class=geo-dms]') as $text) {
                                            $textr1 = $text->find('text');
                                            $textr1 = implode(" ", $textr1);
                                        }
                                        foreach ($p->find('span[class=geo-dec]') as $txt) {
                                            $textr2 = $txt->find('text');
                                            $textr2 = implode(" ", $textr2);
                                        }

                                        foreach ($p->find('span[class=geo]') as $te) {
                                            $textr3 = $te->find('text');
                                            $textr3 = implode(" ", $textr3);

                                        }


//                                        dd($textr1 . $textr2 . $textr3);

                                        $Ptext[] = $p->find('text', 1);
                                        $Ptext[] = $p->find('text', 2);
                                        $Ptext[] = $p->find('text', 3);
                                        $Ptext[] = $p->find('text', 4);
                                        $Ptext[] = $p->find('text', 5);
                                        $Ptext[] = $p->find('text', 6);
                                        $Ptext[] = $p->find('text', 7);
                                        $Ptext[] = $p->find('text', 8);
                                        $Ptext[] = $p->find('text', 9);
                                        $Ptext[] = $p->find('text', 10);

                                        //                                        $dataPlace = $dataText->where('place', $country)->first();
                                        //                                        if (count($dataPlace) > 0) {
                                        //                                            $content1 = str_replace($textr1, " ", implode(" ", $Ptext));
                                        //                                            $content2 = str_replace($textr2, " ", $content1);
                                        //                                            $content = str_replace($textr3, " ", $content2);
                                        //
                                        //                                            $dataPlace->text = $content;
                                        //                                            $data->place = $country;
                                        //                                            $dataPlace->save();
                                        //                                        } else {
                                        //
                                        //                                        }
                                        $data = $dataText;

                                        if (isset($textr1) || isset($textr2) || isset($textr3)) {
                                            $string = implode(" ", $Ptext);
                                            $content1 = str_replace($textr1, " ", $string);
                                            $content2 = str_replace($textr2, " ", $content1);
                                            $content = str_replace($textr3, " ", $content2);
                                            $data->text = trim($content, ": ﻿ / ﻿ ﻿ /");
                                        } else {
                                            $data->text = implode(" ", $Ptext);
                                        }

                                        $data->place = $country;
                                        $data->save();
                                        ?>
                                    @endforeach
                                @endforeach

                                <?php
                                $txt = $dataText->where('place', $country)->first();
                                if (count($txt) > 0) {
                                    echo substr($txt->text, 0, 1500);
                                    $visit = $classVisit->where('place', $country)->first();
                                    if (count($visit) > 0) {
                                        $visit->url = url()->full();
                                        $visit->place = $country;
                                        $visit->save();
                                    } else {
                                        $visit = $classVisit;
                                        $visit->url = url()->full();
                                        $visit->place = $country;
                                        $visit->save();
                                    }
                                } else {
                                    if (isset($Ptext)) {
                                        echo substr(implode(" ", $Ptext), 0, 1500);
                                    } else {
                                        echo '<h2>' . trans('trans.no data in wikipedia') . '</h2>';
                                    }
                                }

                                ?>
                                <a id="see-more">{{trans('trans.see more')}}...</a>
                            @endif
                        @endif


                    </p>
                    <script>

                        $("#see-more").click(function () {
                            var SeeMoreUrl = "<?php echo url("see-more/$country"); ?>"
                            $.ajax({
                                url: SeeMoreUrl,
                                success: function (response) {
                                    $("#desc-p").html(response);
                                }
                            });
                        });


                        {{--@if(isset($textD) && isset($textK))--}}
                        {{--$('head').append('<meta name="description" content="{{ $textD }}">');--}}
                        {{--$('head').append('<meta name="keywords" content="{{ $textK }}">');--}}
                        {{--@endif--}}
                    </script>
                </div>
            </div>



            <script>
                var postCode = "https://api.postcodes.io/postcodes?lon={{ $lng }}&lat={{ $lat }}";
                $.ajax({
                    url: postCode,
                    dataType: 'json',
                    success: function (response) {
                        if (response.result == null) {
                            $("#post-code").html('{{ trans('trans.there is none') }}');
                        } else {
                            $("#post-code").html(response.result);
                        }
                    }
                });
            </script>
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                <div class="box text-center">
                    <i class="fa fa-link fa-4x"></i>
                    @if(isset($phoneCode))
                        <h1>{{ trans('trans.international phone key') }}</h1>
                        <P>00{{ $phoneCode }}</P>
                    @endif
                    <h1>{{ trans('trans.zip code') }}</h1>
                    <P id="post-code">{{ trans('trans.there is none') }}</P>
                </div>
            </div>
        <div class="clearfix"></div>

          <div class="inner-box text-center animate-box adv adv4" style="">
            @if(count($ad4) > 0)
                {!! $ad4->ad !!}
            @else
                <a href="#"><img src="http://placehold.it/728x90"></a>
            @endif
        </div>
        
        <script type="text/javascript">
        // $(document).ready(function() {
            // $('.adv4').css({
                // display: 'inline-block'
            // });
        // });
        </script>
            <div class="col-xs-12 col-md-12 col-lg-12">
                <div id="images" class="box">
                    @if(count($uploadedImages) > 0)
                        @foreach($uploadedImages as $image)
                            <a target="_blank" href="{{ asset("public/assets/uploads/images/$image->image") }}"
                               data-lightbox="roadtrip"
                               data-fancybox-group="gallery"><img
                                        src="{{ asset("public/assets/uploads/images/$image->image") }}"></a>
                        @endforeach
                    @endif
                    <?php
                    $imagesCheck = $dataImage->where('place', $country)->first();
                    ?>

                    @if(count($imagesCheck) > 0)
                        <?php
                        $imgs = $imagesCheck->images_src;
                        $imgs = explode(" ", $imgs);
                        ?>
                        @foreach($imgs as $im)
                            <a target="_blank" href="{{ $im }}" data-lightbox="roadtrip"
                               data-fancybox-group="gallery"><img
                                        src="{{ $im }}"></a>
                        @endforeach
                    @else
                        <?php
                        try {
                            if (Session::has('locale')) {
                                $lang = Session::get('locale');
                                $html = new Htmldom("https://$lang.wikipedia.org/wiki/$country");
                            } else {
                                $html = new Htmldom("https://en.wikipedia.org/wiki/$country");
                            }
                        } catch (ErrorException $e) {

                        }

                        ?>
                        @if(isset($html))
                            @foreach($html->find('div[id=mw-content-text]') as $content)
                                @foreach($content->find('div[class=thumbinner]') as $link)
                                    @foreach($link->find('img') as $img)
                                        <a target="_blank" href="{{ $img->src }}" data-lightbox="roadtrip"
                                           data-fancybox-group="gallery"><img
                                                    src="{{ $img->src }}"></a>
                                        <?php $images[] = $img->src ?>
                                    @endforeach
                                    <?php
                                    if (isset($images)) {
                                        $Dimages = $dataImage->where('place', $country)->first();

                                        if (count($Dimages) > 0) {
                                            $Dimages->images_src = implode(" ", $images);
                                            $dataI->place = $country;
                                            $Dimages->save();
                                        } else {
                                            $dataI = $dataImage;
                                            $dataI->images_src = implode(" ", $images);
                                            $dataI->place = $country;
                                            $dataI->save();
                                        }
                                    }
                                    ?>
                                @endforeach
                            @endforeach
                        @endif
                    @endif

                </div>

            </div>


            <div class="col-xs-12 col-sm-6 col-md-4 animate-box">
                <div class="text-center margin-bottom adv">

                    @if(count($ad3) > 0)
                        <?php echo $ad3->ad; ?>
                    @else
                        <a href="#"><img src="http://placehold.it/336x280"></a>
                    @endif

                </div>
            </div>
            @if(isset($states))

                <div class="col-xs-12 col-sm-6 col-md-4 animate-box">
                    <div class="box box-scroll mCustomScrollbar">
                        <h1>{{ trans('trans.states') }}</h1>

                        <table class="table table-striped">
                            @if(isset($states))
                                @foreach($states as $state)
                                    <tr>
                                        <td>
                                            <a href="#">{{ $state->name }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>

            @endif
            @if(isset($cities))
                <div class="col-xs-12 col-sm-6 col-md-4 animate-box">
                    <div class="box box-scroll mCustomScrollbar">
                        <h1>{{ trans('trans.cities') }}</h1>

                        <table class="table table-striped">


                            @if(isset($cities))
                                @foreach($cities as $city)
                                    @foreach($city as $c)
                                        <tr>
                                            <td>
                                                <a href="#">{{ $c->name }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif

                        </table>
                    </div>
                </div>
            @endif

            @if(count($placeArticle) > 0)
                <div class="col-xs-12">
                    <div class="box white-bg animate-box">
                        <div class="border-bottom">
                            <div class="row">

                                <div class="col-sm-3 hidden-xs">
                                    <a href="{{ action('MainController@getArticle', $placeArticle->id) }}">
                                        <img src="{{ asset("public/assets/articles_images/$placeArticle->image") }}" alt=".."
                                             class="img-responsive">
                                    </a>
                                </div>

                                <div class="col-xs-12 col-sm-9">
                                    <h3>
                                        <a href="{{ action('MainController@getArticle', $placeArticle->id) }}">{{ $placeArticle->title }}</a>
                                    </h3>
                                    <span class="color-gray">{{ $placeArticle->date }}</span>
                                    <p><?php echo substr($placeArticle->content, 0, 300); ?>
                                        <a href="{{ action('MainController@getArticle', $placeArticle->id) }}S">{{trans('trans.see more')}}
                                            ...</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="box text-center">
                    <i class="fa fa-money fa-4x"></i>
                    <h1>{{ trans('trans.stock market') }}</h1>
                    <script src="http://widgets.macroaxis.com/widgets/url.jsp?t=2&s=FTSE,GDAXI,SSEC,HSI,BSESN,MXX,FCHI,BVSP,KS11,TWII,GSPTSE,MERV,NZ50,ATX,OSEAX,FTSEMIB,IBEX,OMXSPI,SSMI,NQIL,JKSE,STI,AORD,ISEQ,AEX,NYA,NQGRT,N225,OMXC20,BFX,XU100,OMXVGI,NQRUT,NQFI,NQEGT,NQTH,OMXRGI,NQPH,NQDMMEA,NYA,NYA,IXIC,RUT,GSPC"></script>
                </div>
            </div>





        </div>
    </div>
</div>
<!--===============================
    FOOTER
===================================-->
<a name="footer"></a>
<footer class="div-small-padding">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-6 col-md-4">
                <h1>{{trans('trans.about')}}</h1>
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
<script>
    $('#flag-id').popover();
</script>
</body>
</html>
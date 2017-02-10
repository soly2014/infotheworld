@extends('app')
@section('content')
    <!--===============================
    MAP
     ===================================-->

    <div class="map-holder">

        @if(Session::has('locale'))
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&callback=initMap&language={{ Session::get('locale') }}">
            </script>
        @else
            <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&callback=initMap&language=en">
            </script>
        @endif
        <?php
        if (Session::has('locale')) {
            $localeLang = Session::get('locale');
        } else {
            $localeLang = 'en';
        }
        ?>
        <script>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map-canvas'), {
                    zoom: 6,
                    center: {lat: {{ $lat }}, lng: {{ $lng }}}
                });
                var geocoder = new google.maps.Geocoder();


                document.getElementById('submit').addEventListener('click', function () {
                    console.log(geocoder);
                    geocodeAddress(geocoder, map);
                });

                //infoWindow

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

            }


        </script>
        {{--<script>--}}
        {{--function initialize() {--}}
        {{--var myLatlng = new google.maps.LatLng({{ $lat }}, {{ $lng }});--}}
        {{--var mapOptions = {--}}
        {{--zoom: 10,--}}
        {{--center: myLatlng--}}
        {{--}--}}
        {{--var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);--}}

        {{--var marker = new google.maps.Marker({--}}
        {{--position: myLatlng,--}}
        {{--map: map,--}}
        {{--title: "Drag me!"--}}
        {{--});--}}

        {{--}--}}

        {{--google.maps.event.addDomListener(window, 'load', initialize);--}}
        {{--</script>--}}

        <div id="map-canvas" style="width: 100%;"></div>


        <div class="search-block">
            <div class="animate-box">
                <h1 class="text-center">{{ trans('trans.look for country') }}</h1>
                <label>{{ trans('trans.country') }}</label>
                <input id="address" type="textbox" value="{{ $country }}"/>
                <div id="result">
                </div>
                <br>
                <input id="submit" type="submit" class="btn btn-block btn-black" value="{{ trans('trans.search') }}"/>
            </div>
        </div>


    </div>

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
                console.log($.parseJSON(response).data.timings)
//                        alert(response.data.timings.Dhuhr);
                        $("#fajr").html('' +
                                '<td>{{trans('trans.fajr')}}</td>' +
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
                var clouds = response.weatherObservation.clouds;
                var windDirection = response.weatherObservation.windDirection;
                var windSpeed = response.weatherObservation.windSpeed;
                var temperature = response.weatherObservation.temperature;
                $("#weather-info").html('' +
                        '<p>{{trans('trans.wind direction')}}: ' + windDirection + '<i id="w1" class="fa fa-cloud "></i></p>' +
                        '<p>{{ trans('trans.wind speed') }}: ' + windSpeed + '<i id="w1" class="fa fa-bolt "></i></p>' +
                        '<p>{{ trans('trans.temprature') }}: ' + temperature + '<i id="w1" class="fa fa-sun-o "></i></p>'
                );

            }

        });

    </script>
    <div class="container">
        <br/>
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
        </div>
    </div>

    @if(count($articles) > 0)

        <div class="div-small-padding">
            <div class="container">
                <div class="row">

                    <div class="box white-bg animate-box">

                        <h1 class="main-head">{{ trans('trans.latest articles') }}</h1>

                        <div class="row">

                            @foreach($articles as $article)
                                <div class="col-xs-12 col-md-6">
                                    <div class="border-bottom">
                                        <div class="row">

                                            <div class="col-sm-4 hidden-xs">
                                                <a href="{{ action('MainController@getArticle', $article->id) }}">
                                                    <img src="{{ asset("public/assets/articles_images/$article->image") }}"
                                                         alt=".."
                                                         class="img-responsive">
                                                </a>
                                            </div>

                                            <div class="col-xs-12 col-sm-8">
                                                <h3>
                                                    <a href="{{ action('MainController@getArticle', $article->id) }}">{{ $article->title }}</a>
                                                </h3>
                                                <span class="color-gray">{{ $article->date }}</span>
                                                <p><?php echo substr($article->content, 0, 500) . '...'; ?></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div class="text-center div-padding-top">
                            <a href="{{ action('MainController@allArticles') }}"
                               class="btn btn-blue btn-lg">{{trans('trans.see more')}}</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endif
    @if(count($homeText) > 0)
        <div class="div-small-padding">
            <div class="container">

                <div class="col-xs-12 col-md-8 col-lg-12 animate-box">
                    <div id="disc" class="box text-center">
                        <h1>{{ $homeText->title }}</h1>
                        <p id="desc-p">
                            {{ $homeText->content }}
                        </p>
                    </div>
                </div>

            </div>
        </div>
    @endif


    <div id="links" class="box">
        <div class="text-center">
            <h2>{{ trans('trans.last visited places') }}</h2>
        </div>

        <div class="visited">
            @if(count($visited) > 0)
            @foreach($visited as $visit)
                <a href="{{ $visit->url }}" class="btn btn-black">{{ $visit->place }}</a>
            @endforeach
        @endif
        </div>

        <a href="{{ url('/last-visited-places') }}" class="seemore btn btn-info col-md-push-5">{!! trans('trans.see more') !!}</a>
    </div>

@stop
@section('script')
@stop
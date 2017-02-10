
<html dir=@if(App::getLocale() == 'ar')"rtl" @else"ltr"@endif lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="true">


    <title>{{ trans('trans.title') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">

    @if(App::isLocale('ar'))
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-ar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/searchstyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/searchstyle-ar.css') }}">
    @else
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style-en.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/searchstyle.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/searchstyle-en.css') }}">

    @endif
    {{--<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lightbox/css/lightbox.css') }}">
    <script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
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


            <form style="margin-right: 130px;" class="navbar-form navbar-left text-center" method="get" action="{{ url('/country-search') }}">
                <div class="col-xs-12 col-sm-4 col-lg-8">
                    <label>{{ trans('trans.search') }}</label>
                    <input id="address" name="searchcountry" type="textbox">
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <input id="submit" style="margin-top: 15px;" type="submit" class="btn btn-block btn-black"
                           value="{{ trans('trans.search') }}">
                </div>

            </form>  

                    <li class="active"><a href="{{ action('MainController@home') }}">{{ trans('trans.home') }}</a></li>
                    <li><a href="#footer">{{ trans('trans.about') }}</a></li>
                    <li><a href="#footer">{{ trans('trans.contact') }}</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ trans('trans.language') }} <span class="caret left-fa"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="ar.infotheworld.com">عربي</a></li>
                            <li><a href="de.infotheworld.com">German</a></li>
                            <li><a href="infotheworld.com">English</a></li>
                            <li><a href="es.infotheworld.com">Spanish</a></li>
                            <li><a href="fr.infotheworld.com">French</a></li>
                            <li><a href="hi.infotheworld.com">Hindi</a></li>
                            <li><a href="jp.infotheworld.com">Japanese</a></li>
                            <li><a href="pt.infotheworld.com">Portuguese</a></li>
                            <li><a href="ru.infotheworld.com">Russian</a></li>
                            <li><a href="tr.infotheworld.com">Turkish</a></li>
                            <li><a href="zh.infotheworld.com">Chinese</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</nav>







<!--Content-->
<div class="div-padding-top">
      <div class="container">
            <div class="box white-bg results animate-box">
                <h1 class="main-head">نتائج البحث</h1>
                


        @if(count($arr) > 0)
                <h2>الدول</h2>
                @foreach($arr as $ar)

                <div class="row">
                   <div class="col-md-3 col-xs-12">

                        @if(\App\Country::where('name',$ar)->first())
                       <a href="#">
                            <img src="{{ url('assets/flags/').'/'.\App\Country::where('name',$ar)->first()->alpha_2.'.png' }}" class="img-responsive center-block">
                        </a>
                        @endif

                    </div> 
                    <div class="col-md-9 col-xs-12 state-name">
                        <h4><a class="countsearch">{{ DB::table('countries')->where('name', $ar)->first()->$name }}</a></h4>
                    </div>
                </div>
                
              
                <hr>

                @endforeach                

        @endif                   
                
        @if(count($stat) > 0)

                <h2>المحافظات</h2>

                @foreach($stat as $st)

                        <?php $country_id = DB::table('states')->where('name', $st)->first()->country_id; ?>
                        <?php $country_name = DB::table('countries')->where('id', $country_id)->first()->name; ?>


               <div class="row">
                   <div class="col-md-3 col-xs-12">

                    @if(\App\Country::where('name',$country_name)->first())                   
                       <a href="#">
                            <img src="{{ url('assets/flags/').'/'.\App\Country::where('name',$country_name)->first()->alpha_2.'.png' }}" class="img-responsive center-block">
                        </a>
                        @endif

                    </div> 
                    <div class="col-md-9 col-xs-12 state-name">
                        <h4><a class="countsearch">{{  DB::table('states')->where('name', $st)->first()->$name  }}</a></h4>
                    </div>
                </div>
                
               <!--Governments-->
                
                <hr>

                @endforeach                

        @endif    


        @if(count($cit) > 0)

                <h2>المحافظات</h2>

                @foreach($cit as $ci)

                        <?php $state_id = DB::table('cities')->where('name', $ci)->first()->state_id; ?>
                        <?php $country_id = DB::table('states')->where('id', $state_id)->first()->country_id; ?>
                        <?php $country_name = DB::table('countries')->where('id', $country_id)->first()->name; ?>

               <div class="row">
                   <div class="col-md-3 col-xs-12">

                    @if(\App\Country::where('name',$country_name)->first())                   
                       <a href="#">
                            <img src="{{ url('assets/flags/').'/'.\App\Country::where('name',$country_name)->first()->alpha_2.'.png' }}" class="img-responsive center-block">
                        </a>
                        @endif

                    </div> 
                    <div class="col-md-9 col-xs-12 state-name">
                        <h4><a class="countsearch">{{  DB::table('cities')->where('name', $ci)->first()->$name  }}</a></h4>
                    </div>
                </div>
                
               <!--Governments-->
                
                <hr class="no-margin">

                @endforeach                

        @endif  

       
                
                
        <div class="articlesNew">
            <h1 class="main-head">أخر المقالات</h1>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="border-bottom">
                            <div class="row">

                                <div class="col-sm-4 hidden-xs">
                                    <a href="article.html">
                                        <img src="images/pic.jpg" alt=".." class="img-responsive">
                                    </a>
                                </div>

                                <div class="col-xs-12 col-sm-8">
                                    <h3><a href="article.html">عنوان المقال</a></h3>
                                    <span class="color-gray">2/1/2016</span>
                                    <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي ....</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
</div>
<!--Content-->
















<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-11">
        <h1> Your Search Results page </h1>  

        <table class="table">  

        @if(count($arr) > 0)
                @foreach($arr as $ar)

                    <tr>
                        @if(\App\Country::where('name',$ar)->first())
                        <td><img src="{{ url('assets/flags/').'/'.\App\Country::where('name',$ar)->first()->alpha_2.'.png' }}"></td>
                        @endif
                        <td><h2><a class="countsearch">{{ DB::table('countries')->where('name', $ar)->first()->$name }}</a></h2></td>
                        <td></td>
                        <td></td>
                        

                    </tr>


                @endforeach                

        @endif    
        @if(count($cit) > 0)
                @foreach($cit as $ci)

                        <?php $state_id = DB::table('cities')->where('name', $ci)->first()->state_id; ?>
                        <?php $country_id = DB::table('states')->where('id', $state_id)->first()->country_id; ?>
                        <?php $country_name = DB::table('countries')->where('id', $country_id)->first()->name; ?>
                    <tr>
                        <td>city</td>
                         @if(\App\Country::where('name',$country_name)->first())
                        <td><img src="{{ url('assets/flags/').'/'.\App\Country::where('name',$country_name)->first()->alpha_2.'.png' }}"></td>
                        @endif
                       
                        <td><h2><a class="countsearch">{{  DB::table('cities')->where('name', $ci)->first()->$name  }}</a></h2></td>
                        <td></td>
                        <td></td>
                        

                    </tr>


                @endforeach                

        @endif    
        @if(count($stat) > 0)
                @foreach($stat as $st)

                        <?php $country_id = DB::table('states')->where('name', $st)->first()->country_id; ?>
                        <?php $country_name = DB::table('countries')->where('id', $country_id)->first()->name; ?>
                    <tr>
                        <td>state</td>
                          @if(\App\Country::where('name',$country_name)->first())
                        <td><img src="{{ url('assets/flags/').'/'.\App\Country::where('name',$country_name)->first()->alpha_2.'.png' }}"></td>
                        @endif
                                              
                        <td><h2><a class="countsearch">{{  DB::table('states')->where('name', $st)->first()->$name  }}</a></h2></td>
                        <td></td>
                        <td></td>
                        

                    </tr>


                @endforeach                

        @endif    

        </table>    

        @if(count($articles) > 0)
                        <div class="row">

                            @foreach($articles as $articl)
                            <?php $article = \App\Article::where('title',$articl)->first(); ?>
                                <div class="col-xs-12 col-md-6">
                                    <div class="border-bottom">
                                        <div class="row">

                                            <div class="col-sm-4 hidden-xs">
                                                <a href="{{ action('MainController@getArticle', $article->id) }}">
                                                    <img style="height: 120px;" src="{{ asset('assets/articles_images/$article->image') }}"
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
        @else    

        <h1>no results</h1>

        @endif

    </div>
</div>



<!--===============================
    FOOTER
===================================-->
<a name="footer"></a>
<footer class="div-small-padding">
    <div class="container">
        <div class="row">
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

<script src="{{ asset('assets/js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/image-popup/source/jquery.fancybox.js') }}"></script>
<script src="{{ asset('assets/lightbox/js/lightbox.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<?php
if (Session::has('locale')) {
    $localeLang = Session::get('locale');
} else {
    $localeLang = 'en';
}
?>

<script>



$(document).ready(function() {

    $(".countsearch").on('click',function() {

        var countsearch = $(this).html();
        
        var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + countsearch + "&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&language={{ $localeLang }}";

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
        });
    
    });
 });

</script>

</body>
</html>

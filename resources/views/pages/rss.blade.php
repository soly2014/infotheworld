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

                        <h1 class="main-head">{{ trans('trans.latest articles') }}</h1>

                        @if(count($articles) > 0 )
                            @foreach($articles as $article)
                                <div class="border-bottom">
                                    <div class="row">

                                        <div class="col-sm-3 hidden-xs">
                                            <a href="{{ action('MainController@getArticle', $article->id) }}">
                                                <img src="{{ asset("public/assets/articles_images/$article->image") }}"
                                                     alt=".." class="img-responsive">
                                            </a>
                                        </div>

                                        <div class="col-xs-12 col-sm-9">
                                            <h3><a href="{{ action('MainController@getArticle', $article->id) }}">
                                                    {{ $article->title }}
                                                </a></h3>
                                            <span class="color-gray">{{ $article->date }}</span>
                                            <p><?php echo substr($article->content, 0, 250) . '...'; ?></p>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>


                <div class="col-xs-12 col-sm-5 col-lg-4">
                    <div class="box white-bg animate-box">

                        <h1 class="main-head">{{ trans('trans.last visited places') }}</h1>

                        <table class="table table-striped">
                            <tbody>
                            @if(count($places) > 0 )
                                @foreach($places as $place)
                                    <tr>
                                        <td><a href="{{ $place->url }}">{{ $place->place }}</a></td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>


            </div>
        </div>
    </div>

@stop
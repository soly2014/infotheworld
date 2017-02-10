@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">
            <div class="row">

                <!--===============================
                    ARTICLES
                ===================================-->
                <div class="col-xs-12 col-sm-8 col-lg-9">

                    <div class="box animate-box">
                        <div class="inner-box article">
                            <h1>{{ $article->title }}</h1>


                            <img src="{{ asset("public/assets/articles_images/$article->image") }}" alt="article title">

                            <p>{!! $article->content !!}</p>


                            {{--<div class="details">--}}
                            {{--<span>مشاركة: </span>--}}
                            {{--<a href="#" class="share"><i class="fa fa-facebook"></i></a>--}}
                            {{--<a href="#" class="share"><i class="fa fa-twitter"></i></a>--}}
                            {{--<a href="#" class="share"><i class="fa fa-google-plus"></i></a>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                </div>


                <!--===============================
                    WIDGET
                ===================================-->
                <div class="col-xs-12 col-sm-4 col-lg-3">

                    <div class="box inner-box animate-box">
                        <h1 class="main-head">{{ trans('trans.latest articles') }}</h1>

                        @if(count($articles) > 0)
                            @foreach($articles as $ar)
                                <div class="border-bottom">
                                    <a href="{{ action('MainController@getArticle', $ar->id) }}"><?php echo substr($ar->content, 0, 150); ?></a>
                                    <span class="color-gray"><i
                                                class="fa fa-calendar right-fa left-fa color-gray"></i> {{ $ar->date }}</span>
                                </div>
                            @endforeach
                        @endif

                    </div>

                </div>
                <div class="col-xs-12 col-sm-4 col-lg-3">

                    <?php
                    $tags = explode(" ", trim($article->tags));
                    ?>

                    <div id="links" class="box inner-box animate-box">
                        <h1 class="main-head">{{ trans('trans.tags') }}</h1>
                        @foreach($tags as $tag)
                            <?php
                            $link = $Visit->where([
                                    ['place', 'like', '%' . $tag . '%']
                            ])->first();
                            ?>
                            <a class="btn btn-black"
                               @if(count($link) > 0) href="{{ $link->url }}" @endif >{{ $tag }}</a>
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>

@stop
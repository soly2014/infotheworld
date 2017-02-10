@extends('app')
@section('content')
<div class="inner-box text-center animate-box adv" style=" margin-top: 25px; ">
            @if(count($ad1) > 0)
                {!! $ad1->ad !!}
            @else
                <a href="#"><img src="http://placehold.it/728x90"></a>
            @endif
        </div>
        <br/>
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
                    </div>

                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        {{  $articles->links()}}
                    </ul>
                </nav>
            </div>
        </div>
    @endif
@stop
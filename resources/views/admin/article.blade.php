@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">{{ $article->title }}</h3>
            </div>
            <div class="box-body">

                <a data-lightbox="roadtrip"
                   href="{{ asset("public/assets/articles_images/$article->image") }}">
                    <img src="{{ asset("public/assets/articles_images/$article->image") }}" width="200">
                </a>

                <hr/>

                <div>
                    {{ $article->content }}
                </div>
                {{--<br/>--}}
                <hr/>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>التاريخ</th>
                        <th>المكان</th>
                        <th>اللغه</th>
                        <th>تعديل</th>
                        @if(Auth::user()->type == 1)
                        <th>حذف</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>{{ $article->date }}</td>
                        <td>{{ $article->place }}</td>
                        <td>{{ $article->locale }}</td>
                        <td><a href="{{ action('AdminController@editArticle', $article->id) }}"
                               class="btn btn-info">تعديل</a></td>
                        @if(Auth::user()->type == 1)
                            <td><a href="{{ action('AdminController@deleteArticle', $article->id) }}"
                               class="btn btn-danger">حذف</a></td>
                        @endif
                    </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@stop
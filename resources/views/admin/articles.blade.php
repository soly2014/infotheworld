@extends('adminApp')
@section('adminContent')
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">المقالات</h3>
            </div>
            <div class="box-body">
                @if(count($articles) > 0)
                    <table id="table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان المقاله</th>
                            <th>اقرأ المقاله</th>
                            <th>الصوره</th>
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
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ $article->title }}</td>
                                <td><a href="{{ action('AdminController@getArticle', $article->id) }}"
                                       class="btn btn-success">اقرأ المقاله</a></td>
                                <td>
                                    <a data-lightbox="roadtrip"
                                       href="{{ asset("public/assets/articles_images/$article->image") }}">
                                        <img src="{{ asset("public/assets/articles_images/$article->image") }}" width="60">
                                    </a>
                                </td>
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
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="label label-warning">لا يوجد مقالات</div>
                @endif
            </div>

        </div>
    </div>
@stop
@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">تعديل مقالة {{ $article->title }}</h3>
            </div>
            <div class="box-body">
                @if(Session::has('success'))
                    <div class="text-left col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
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
                <form action="{{ action('AdminController@editArticlePost', $article->id) }}" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>عنوان المقاله</label>
                        <input class="form-control" type="text" value="{{ $article->title }}" name="title">
                    </div>
                    <div class="form-group">
                        <label>المحتوى</label>
                    <textarea name="content" id="editor1" class="textarea form-control"
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $article->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>الصوره</label>
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>المكان</label>
                        <select name="place" class="form-control" style="height: 40px">
                            <option selected disabled>اختر المكان</option>
                            @if(count($dataText) > 0)
                                @foreach($dataText as $place)
                                    <option @if($article->place == $place->place) selected
                                            @endif value="{{ $place->place }}">{{ $place->place }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label>اللغه</label>
                        <select name="lang" class="form-control" style="height: 40px">
                            <option selected disabled>حدد اللغه</option>
                            <option @if($article->locale == 'ar') selected @endif value="ar">العربيه</option>
                            <option @if($article->locale == 'de') selected @endif value="de">الالمانيه</option>
                            <option @if($article->locale == 'en') selected @endif value="en">الانجليزيه</option>
                            <option @if($article->locale == 'es') selected @endif value="es">الاسبانيه</option>
                            <option @if($article->locale == 'fr') selected @endif value="fr">الفرنسيه</option>
                            <option @if($article->locale == 'hi') selected @endif value="hi">الهنديه</option>
                            <option @if($article->locale == 'ja') selected @endif value="ja">اليابانيه</option>
                            <option @if($article->locale == 'pt') selected @endif value="pt">البرتغاليه</option>
                            <option @if($article->locale == 'ru') selected @endif value="ru">الروسيه</option>
                            <option @if($article->locale == 'tr') selected @endif value="tr">التركيه</option>
                            <option @if($article->locale == 'zh') selected @endif value="zh">الصينيه</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>التاجات ( tags ) افصل بين كل كلمة والاخرى بمسافه</label>
                        <input class="form-control" type="text" name="tags" value="{{ $article->tags }}">
                    </div>
                    <div class="box-footer clearfix">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="pull-right btn btn-default" id="sendEmail">اضافة<i
                                    class="fa fa-arrow-circle-left"></i>
                        </button>
                    </div>


                </form>
            </div>

        </div>
    </div>
@stop
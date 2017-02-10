@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">اضافة مقاله</h3>
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
                <form action="{{ action('AdminController@addTermsPost') }}" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label>العنوان</label>
                        <input class="form-control" type="text" name="title" value="{{ $terms->title }}">
                    </div>
                    <div class="form-group">
                        <label>المحتوى</label>
                    <textarea name="content" id="editor1" class="textarea form-control"
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $terms->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label>اللغه</label>
                        <select name="lang" class="form-control" style="height: 40px">
                            <option selected disabled>حدد اللغه</option>
                            <option @if($terms->lang == 'ar') selected @endif value="ar">العربيه</option>
                            <option @if($terms->lang == 'de') selected @endif value="de">الالمانيه</option>
                            <option @if($terms->lang == 'en') selected @endif value="en">الانجليزيه</option>
                            <option @if($terms->lang == 'es') selected @endif value="es">الاسبانيه</option>
                            <option @if($terms->lang == 'fr') selected @endif value="fr">الفرنسيه</option>
                            <option @if($terms->lang == 'hi') selected @endif value="hi">الهنديه</option>
                            <option @if($terms->lang == 'ja') selected @endif value="ja">اليابانيه</option>
                            <option @if($terms->lang == 'pt') selected @endif value="pt">البرتغاليه</option>
                            <option @if($terms->lang == 'ru') selected @endif value="ru">الروسيه</option>
                            <option @if($terms->lang == 'tr') selected @endif value="tr">التركيه</option>
                            <option @if($terms->lang == 'zh') selected @endif value="zh">الصينيه</option>
                        </select>
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
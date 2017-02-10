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
                        <input class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group">
                        <label>المحتوى</label>
                    <textarea name="content" id="editor1" class="textarea form-control"
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>اللغه</label>
                        <select name="lang" class="form-control" style="height: 40px">
                            <option selected disabled>حدد اللغه</option>
                            <option value="ar">العربيه</option>
                            <option value="de">الالمانيه</option>
                            <option value="en">الانجليزيه</option>
                            <option value="es">الاسبانيه</option>
                            <option value="fr">الفرنسيه</option>
                            <option value="hi">الهنديه</option>
                            <option value="ja">اليابانيه</option>
                            <option value="pt">البرتغاليه</option>
                            <option value="ru">الروسيه</option>
                            <option value="tr">التركيه</option>
                            <option value="zh">الصينيه</option>
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
@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">تحديث المحتوى</h3>
            </div>
            <div class="box-body">
                @if(Session::has('success'))
                    <div class="text-center col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="text-center col-lg-12 alert alert-danger">{{ Session::get('error') }}</h1>
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="text-left col-lg-12 alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
                <form action="{{ action('AdminController@editMetaDescPost') }}" method="post">
                    <div class="form-group">
                        <label>ادخل كود اللغه( حرفين فقط باللغه الانجليزيه مثل 'ar' للعربيه )</label>
                        <input type="text" name="lang" id="langCode" class="form-control"/>
                    </div>
                    <div>
                    <textarea name="content" id="content" class="textarea" placeholder="ادخل محتوى جديد"
                              style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                    <div class="box-footer clearfix">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <button class="pull-right btn btn-default" id="sendEmail">تحديث<i
                                    class="fa fa-arrow-circle-left"></i>
                        </button>
                    </div>
                </form>
                <script>
                    $("#langCode").keyup(function () {
                        var locale = $("#langCode").val();
                        var url = "/admin/get-meta-content/" + locale;
                        $.ajax({
                            url: url,
                            success: function (response) {
                                $("#content").html(response);
                            }
                        });
                    })

                </script>
            </div>

        </div>
    </div>
@stop
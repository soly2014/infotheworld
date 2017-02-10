@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">تحديث المحتوى</h3>
                <!-- tools box -->
                {{--<div class="pull-left box-tools">--}}
                {{--<button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i--}}
                {{--class="fa fa-times"></i></button>--}}
                {{--</div><!-- /. tools -->--}}
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
                <form action="{{ action('AdminController@addAboutPost') }}" method="post">
                    <div class="form-group">
                        <label>ادخل كود اللغه( حرفين فقط باللغه الانجليزيه مثل 'ar' للعربيه )</label>
                        <input id="langCode" class="form-control" type="text" max="2" name="langCode">
                    </div>
                    <div class="form-group">
                        <label>المحتوى</label>
                    <textarea name="content" id="content" rows="9" class="textarea form-control"
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
                            var url = "/admin/get-about-content/" + locale;
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
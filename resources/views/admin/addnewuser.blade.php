@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">اضافة مشرف جديد</h3>
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
                <form action="{{ action('AdminController@addNewUserPost') }}" method="post">
                    <div class="form-group">
                        <label>اسم المستخدم</label>
                        <input class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label>كلمة المرور</label>
                        <input class="form-control" type="password" name="password">
                    </div>
                    <div class="form-group">
                        <label>البريد الالكترونى</label>
                        <input class="form-control" type="email" name="email">
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
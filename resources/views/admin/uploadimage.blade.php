@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">رفع صوره ل {{ $place }}</h3>
                <a href="{{ action('AdminController@placeData', $place) }}"
                   class="btn btn-warning pull-left">رجوع لصفحة {{ $place }}</a>
            </div>
            <div class="box-body">
                @if(Session::has('success'))
                    <div class="text-left col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
                    </div>
                @endif
                @if(Session::has('error'))
                    <div class="text-center col-lg-12 alert alert-danger">{{ Session::get('error') }}</h1>
                    </div>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="text-center col-lg-12 alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif
            </div>
            <form action="{{ action('AdminController@uploadImagePost', $place) }}" method="post"
                  enctype="multipart/form-data">

                <div class="form-control">
                    <input type="file" name="image">
                </div>

                <div class="box-footer clearfix">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button class="pull-right btn btn-success btn-lg" id="sendEmail">رفع<i
                                class="fa fa-arrow-circle-left"></i>
                    </button>
                </div>
            </form>


        </div>
    </div>
@stop
@extends('app')
@section('content')

    <!--===============================
    CONTENT
===================================-->

    <div class="div-padding-top">
        <div class="container">

            <div class="box white-bg animate-box">

                <h1 class="main-head">{{ trans('trans.contact') }}</h1>

                {{--<p class="text-center">هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن--}}
                {{--التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة--}}
                {{--لوريم إيبسوم لأنها تعطي </p>--}}


                <form action="{{ action('MainController@sendMessage') }}" method="post">
                    <div class="row">
                        @if(Session::has('success'))
                            <div class="text-right col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
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
                        <div class="col-xs-12 col-sm-6">
                            <label>{{ trans('trans.name') }}</label>
                            <input name="name" type="text">
                            <label>{{ trans('trans.email') }}</label>
                            <input name="email" type="text">
                            <label>{{ trans('trans.subject') }}</label>
                            <input name="subject" type="text">
                        </div>

                        <div class="col-xs-12 col-sm-6">
                            <label>{{ trans('trans.message') }}</label>
                            <textarea name="message"></textarea>
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-blue btn-block" value="{{trans('trans.send')}}">
                        </div>

                    </div>
                </form>

            </div>

        </div>
    </div>
@stop
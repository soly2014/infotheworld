@extends('adminApp')
@section('adminContent')
    <div class="col-md-8 col-lg-offset-2 text-right">
        <div class="text-center form-group">
            <div class="box box-primary text-right">
                <div class="box-header with-border">
                    <h3 class="box-title">الرد على رسالة {{ $contact->name }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ action('AdminController@replyPost', $contact->id) }}" method="POST"
                      enctype="multipart/form-data"
                      role="form">

                    @if(Session::has('success'))
                        <div class="text-right col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="text-right col-lg-12 alert alert-danger">{{ Session::get('error') }}</h1>
                        </div>
                    @endif
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="text-left col-lg-12 alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputName">البريد المرسل اليه</label>
                            <input type="text" name="email" value="{{ $contact->email }}" class="form-control"
                                   id="exampleInputName">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">عنوان الموضوع</label>
                            <input type="text" name="subject" value="{{ $contact->subject }}" class="form-control"
                                   id="exampleInputName">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputContent">الرساله</label>
                            <textarea name="message" class="form-control" rows="6" id="exampleInputContent"></textarea>

                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" name="submit" value="ارسال" class="btn btn-success"/>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
@stop
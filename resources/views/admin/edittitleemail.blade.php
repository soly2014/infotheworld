@extends('adminApp')
@section('adminContent')
    <div class="col-md-8 col-lg-offset-2 text-center">
        <div class="text-center">
            @include('errors.list')

            <form action="{{ action('AdminController@editTitleEmailPost') }}" method="post" class="form-inline">
                @if(Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <div class="form-group">
                    {{--<label for="exampleInputName2">إضافة مجال</label>--}}

                    <input type="text" name="title" value="{{ $tit->content }}" class="form-control"
                           id="exampleInputName2"
                           placeholder="العنوان الجديد">
                </div>
                <div class="form-group">
                    {{--<label for="exampleInputName2">إضافة مجال</label>--}}
                    <input type="text" name="email" value="{{ $email->content }}" class="form-control"
                           id="exampleInputName2"
                           placeholder="ايميل الموقع">
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" name="add" value="تحديث البيانات" class="btn btn-success "/>
            </form>
        </div>
    </div>
@stop
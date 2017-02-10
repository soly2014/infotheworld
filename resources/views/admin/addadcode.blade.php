@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="text-center form-group">
            <div class="box box-primary text-right">
                <div class="box-header with-border">
                    <h3 class="box-title">اضافة كود اعلان جديد</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ action('AdminController@addAdPost') }}" method="POST" enctype="multipart/form-data"
                      role="form">

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
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputName">الكود </label>
                            <textarea name="ad-code" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputContent">مكان الاعلان</label>
                            <select id="add-select" name="section" class="form-control">
                                <option disabled selected>مكان الاعلان</option>
                                <option value="1">اسفل البار الازرق</option>
                                <option value="2">اسفل اوقات الصلاه</option>
                                <option value="3">اسفل الصور</option>
                                <option value="4">اسفل سوق الاوراق الماليه</option>
                            </select>

                        </div>

                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" name="submit" value="اضافة" class="btn btn-success"/>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>

@stop
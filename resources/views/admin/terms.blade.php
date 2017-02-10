@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">شروط الاستخدام</h3>
            </div>
            <div class="box-body">
                @if(count($terms) > 0)
                    <table id="table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>العنوان</th>
                            <th>اللغه</th>
                            <th>تعديل</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($terms as $term)
                            <tr>
                                <td>{{ $term->id }}</td>
                                <td>{{ $term->title }}</td>
                                <td>{{ $term->lang }}</td>
                                <td><a href="{{ action('AdminController@editTerms', $term->id) }}" class="btn btn-info">تعديل</a>
                                </td>
                                <td><a href="{{ action('AdminController@deleteTerms', $term->id) }}"
                                       class="btn btn-danger">حذف</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="label label-warning">لا يوجد شروط استخدام فى قاعدة البيانات</div>
                @endif
            </div>

        </div>
    </div>
@stop
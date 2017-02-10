@extends('adminApp')
@section('adminContent')
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">جميع المشرفين</h3>
            </div>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اسم المشرف</th>
                    <th>البريد الالكرونى</th>
                    <th>كلمة المرور</th>
                    <th>التاريخ</th>
                    <th>حذف</th>
                </tr>
                </thead>

                <tbody>
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->password }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <a href="{{ action('AdminController@deleteUser', $user->id) }}"
                                   class="btn btn-danger">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
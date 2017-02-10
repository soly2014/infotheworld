@extends('adminApp')
@section('adminContent')
    <div class="col-md-10 col-lg-offset-1 text-right">

        @if(count($contacts) > 0)
            @foreach($contacts as $c)
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading">رساله من {{ $c->name }}</div>
                    <div class="panel-body">
                        <p>{{ $c->message }}</p>
                    </div>

                    <!-- Table -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>البريد الالكترونى</th>
                            <th>التاريخ</th>
                            <th>رد</th>
                            <th>حذف</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->date }}</td>
                            <td><a href="{{ action('AdminController@reply', $c->id) }}"
                                   class="btn btn-info btn-lg">رد</a>
                            <td><a href="{{ action('AdminController@deleteContact', $c->id) }}"
                                   class="btn btn-danger btn-lg">حذف</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
            {{ $contacts->links() }}
        @endif
    </div>
@stop
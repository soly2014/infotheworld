@extends('adminApp')
@section('adminContent')
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">رؤيه المؤرشف</h3>
            </div>

            <table id="table" class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>اللغه</th>
                    <th>المكان</th>
                    <th>تاريخ الاضافه</th>
                </tr>
                </thead>

                <tbody>
                        @if(count($archive) > 0)
                            @foreach($archive as $ar)
                                <tr>
                                <td>{{ $ar->id }}</td>
                                <td>{{ $ar->locale }}</td>
                                <td>{{ $ar->place }}</td>
                                <td>{{ $ar->visited_at }}</td>
                                </tr>
                            @endforeach
                        @endif    
                </tbody>
            </table>
        </div>
    </div>
@stop
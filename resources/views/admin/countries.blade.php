@extends('adminApp')
@section('adminContent')
    <div class="container col-lg-offset-1">
        <table id="table" class="table tab-content">
            <thead>
            <tr>
                <th>#</th>
                <th>اسم البلد & المدينه</th>
                <th>تصفح المحتوى</th>
            </tr>
            </thead>
            <tbody>
            {{--@if(count($countriesText) == count($countriesImages))--}}
            @foreach($countriesText as $cText)
                <tr>
                    <td>{{ $cText->id }}</td>
                    <td>{{ $cText->place }}</td>
                    <td><a href="{{ action('AdminController@placeData', $cText->place) }}"
                           class="btn btn-success">تصفح</a>
                    </td>
                </tr>
            @endforeach
            {{--@endif--}}
            </tbody>
        </table>
    </div>
@stop
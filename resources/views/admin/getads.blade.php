@extends('adminApp')
@section('adminContent')

    <div class="col-lg-10 col-lg-offset-1">

        <table id="tabel" class="table table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>الكود</th>
                <th>المكان</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
            @if(count($ads) > 0)
                @foreach($ads as $ad)
                    <tr>
                        <td>{{ $ad->id }}</td>
                        <td>{{ $ad->ad }}</td>
                        <td>{{ $ad->place }}</td>
                        <td><a href="{{ action('AdminController@deleteAd', $ad->id) }}" class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>

    </div>

@stop
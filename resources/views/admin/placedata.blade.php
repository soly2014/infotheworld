@extends('adminApp')
@section('adminContent')
    <div class="container col-lg-10 col-lg-offset-1">
        @if(Session::has('success'))
            <div class="text-center col-lg-12 alert alert-success">{{ Session::get('success') }}</h1>
            </div>
        @endif
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="text-center col-lg-12 alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="panel panel-default">
            <div id="div-marign" class="panel-heading">نبذه عن {{ $placeText->place }}
                <a href="{{ action('AdminController@placeTextEdit', $placeText->place) }}"
                   class="btn btn-info pull-left">تعديل المحتوى القادم من ويكيبيديا</a>
            </div>
            <div class="panel-body" id="admin-desc">
                {{ $placeText->text }}
            </div>
        </div>

        <div class="panel panel-default">
            @if(count($placeImages) > 0)
                <div id="div-marign" class="panel-heading">صور {{ $placeImages->place }}
                    <a href="{{ action('AdminController@uploadImage', $placeImages->place) }}"
                       class="btn btn-info pull-left">رفع صوره لصفحة {{ $placeImages->place }}</a>
                </div>

                <div class="panel-body box">
                    <div class="container">

                        <table id="table" class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>الصوره</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($uploadedImages) > 0)
                                @foreach($uploadedImages as $image)
                                    <tr>
                                        <td>0</td>
                                        <td><a href="{{ asset("public/assets/uploads/images/$image->image") }}"
                                               data-lightbox="roadtrip"><img id="table-img"
                                                                             src="{{ asset("public/assets/uploads/images/$image->image") }}"></a>
                                        </td>
                                        <td><a href="{{ action('AdminController@deleteImage' , $image->id) }}"
                                               class="btn btn-danger">حذف</a></td>
                                    </tr>
                                @endforeach
                                <hr/>
                            @endif

                            <?php $i = 1; ?>
                            @foreach(explode(" ",$placeImages->images_src) as $img)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><a href="{{ $img }}" data-lightbox="roadtrip"><img id="table-img"
                                                                                           src="{{ $img }}"></a>
                                    </td>
                                    <td>
                                        <form action="{{ action('AdminController@deletePlaceImg') }}" method="post">
                                            <input type="hidden" name="img_src" value="{{ $img }}">
                                            <input type="hidden" name="img_place" value="{{ $placeImages->place }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-danger" value="حذف">
                                        </form>
                                    </td>
                                </tr>
                                <?php $i++ ?>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="alert alert-warning text-center"><h3>لا يوجد صور لهذا المكان</h3></div>
            @endif
        </div>

    </div>
@stop
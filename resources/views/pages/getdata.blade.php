@extends('app')
@section('content')
    <div class="container">
        <h1 class="alert alert-info col-lg-6">جارى جلب البيانات .........</h1>
    </div>

    <?php
    $places = ['cairo', 'rome', 'madrid', 'manchester', 'mumbai', 'rotterdam', 'bangkok'];
    ?>

    @foreach($places as $place)

        <?php
        $cCheck = \App\visit::where('place', 'ddsds')->first();
        ?>
        @if(count($cCheck) == 0)
            <script>
                try {
                    var url = "https://maps.googleapis.com/maps/api/geocode/json?address={{$place}}&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&language={{ $lang }}";

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function (response) {

                            var resultNum = response.results.length - 1;
                            var num = response.results[resultNum].address_components.length - 1;
                            var countryName = response.results[0].address_components[0].long_name;
                            var countryName2 = response.results[resultNum].address_components[num].long_name;
                            if (countryName2 == '13243' || countryName2 == '12488') {
                                countryName2 = 'السعوديه';
                            }
                            var countryCode = response.results[resultNum].address_components[num].short_name;
                            if (countryCode == '13243' || countryCode == '12488') {
                                countryCode = 'SA';
                            }
                            countryName2 = countryName2.replace(" ", '_');
                            var lat = response.results[0].geometry.location.lat;
                            lat = lat.toString();
                            lat = lat.replace('.', '_');
                            var lng = response.results[0].geometry.location.lng;
                            lng = lng.toString();
                            lng = lng.replace('.', '_');
                            var type = response.results[0].types[0];

                            if (type !== 'country') {
                                var type = 'city';
                            }

//                        window.location.href

                            var link = "/" + countryName + '/' + type + '/' + countryName2 + '/' + countryCode + '/' + lat + '/' + lng;

                            $.ajax({
                                url: link,
                                success: function (response) {
                                    console.log(response);
                                }
                            });


                        }
                    });
                } catch (error) {
                    console.log(error);
                }

            </script>
        @endif
    @endforeach
@stop
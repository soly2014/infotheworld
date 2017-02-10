<script>


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(document).ready(function(){

        $("#searchid").click(function () {

            var searchval = $("#searchcountry").val();// = egypt

            /* start ajax */

                        $.ajax({
                                url:"{{url('/country-search')}}",
                                method:'post',
                                dataType:'json',
                                data:{searchval:searchval,'_token':'{!! csrf_token() !!}'},
                                beforeSend: function()
                                {
                                    $('#searchid').html("sending...");

                                },
                                success: function(data)
                                {
                                    var lol = $.parseJSON(data.id);
                                    console.log(lol);

                                   /* var id = data.id;
                                    if (id == 'article') {

                                        window.location.href = "{{ url('/all-articles') }}";
                                    }else {

                                        alert('awesome '+ id);*/
                                    var url = "https://maps.googleapis.com/maps/api/geocode/json?country:" + id + "&key=AIzaSyDdkw5jSp0me6yNlxkLzZVoyNgfsMferJs&language={{ $localeLang }}";

                                    $.ajax({
                                        url: url,
                                        dataType: 'json',
                                        success: function (response) {
                                            console.log(response);
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

                                            window.location.href = "/" + countryName + '/' + type + '/' + countryName2 + '/' + countryCode + '/' + lat + '/' + lng;
                                            {{--$('#form-container').html('' +--}}
                                            {{--'<form id="form-data" action="/{{ $localeLang }}/place-view/' + type + '/' + countryName + '" method="get">' +--}}
                                            {{--'<input type="hidden" name="cN" value="' + countryName + '" />' +--}}
                                            {{--'<input type="hidden" name="cN2" value="' + countryname2 + '" />' +--}}
                                            {{--'<input type="hidden" name="cC" value="' + countryCode + '" />' +--}}
                                            {{--'<input type="hidden" name="lat" value="' + lat + '" />' +--}}
                                            {{--'<input type="hidden" name="lng" value="' + lng + '" />' +--}}
                                            {{--'<input type="hidden" name="type" value="' + type + '" />' +--}}
                                            {{--'<input type="hidden" name="_token" value="{{ csrf_token() }}">' +--}}
                                            {{--'</form>');--}}

                                            {{--$('#form-container form').submit();--}}


                                            {{--var url = "/{{$localeLang}}/place-view/" + type + '/' + countryName;--}}
                                            {{--window.location.href = url;--}}

                                        }
                                    })
                                    
                                    } 
 


                                    //$('.spin_dep').addClass('hidden');
                                },
                                error: function(fuck)
                                {
                                      console.log("Something went wrong"+fuck);
                                     //   $('#submit').html("ارشف الان");

                                }
                        }); 
            /* end ajax */  

        });


});

</script>

@extends('adminApp')
@section('adminContent')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="box">
        	<div class="box-body">

        	<div id="msg"></div>
        	
        	<!-- start country -->
        	<div class="row">
        		<div class="col-md-5">

        			   <!-- /.form-group -->
		              <div class="form-group">
		                <label>اختار الدوله</label>
		                <select class="form-control select2 countrylist" style="width: 100%;" name="country">
		                @foreach(\App\Country2::all() as $count)
		                  <option value="{{ $count->sortname }}">{{ $count->name }}</option>
		                @endforeach  

		                </select>
		              </div>
		              <!-- /.form-group -->
        		</div>
        		<div class="col-md-3">
		             <!-- /.form-group -->
		              <div class="form-group">
		                <label>اختار اللغه</label>
		                <select class="form-control select2 langlist" style="width: 100%;" name="lang">
		                  <option value="ar">العربيه</option>
		                  <option value="en">English</option>
		                  <option value="de">German</option>
		                  <option value="es">Spanish</option>
		                  <option value="fr">French</option>
		                  <option value="hi">Hindi</option>
		                  <option value="ja">Japanese</option>
		                  <option value="pt">Portuguese</option>
		                  <option value="ru">Russian</option>
		                  <option value="tr">Turkish</option>
		                  <option value="zh">Chinese</option>
		                </select>
		              </div>
		              <!-- /.form-group -->
        		</div>
        		<div class="col-md-4 text-center">
		             <!-- /.form-group -->
		              <div class="form-group">
		                <br>
		                	<button type="submit" class="btn btn-primary archiv" id="submit" style="margin-top: 5px;">ارشف الان</button>
		                	<button class="btn btn-primary choosstat" style="margin-top: 5px;">رؤيه الولايات</button>
		              </div>
		              <!-- /.form-group -->
        		</div>
        	</div>

        	<!-- start states -->
        	<div class="row states">

        	</div>
        	<!-- end states -->


 

        	<!-- start states -->
        	<div class="row cities">

        	</div>
        	<!-- end states -->


 




 
				    <script>
				      function initMap(country) {



				        var geocoder =  new google.maps.Geocoder();
					    geocoder.geocode( { 'componentRestrictions': {'country':country}}, function(results, status) {
					          if (status == google.maps.GeocoderStatus.OK) {
					             var lat = results[0].geometry.location.lat(); 
					             var lng = results[0].geometry.location.lng();
						        var myArray = new Array(2);
						        myArray[0] = lat;
						        myArray[1] = lng;
						       
						                return myArray;

					          } else {
					            alert("Something got wrong " + status);
					          }
					        });
					    return lng;
					    return "textk";
				      }


					 </script>
				    
				    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLkUMzd2rh5ThGMOzGHUuDhxFt7vinMtY&language=ar"
				    async defer></script>



				    <script type="text/javascript">
				    
				    $( document ).ready(function() {
					

							$(document).on('click','.archiv',function(){
                              

                                var imgurl = "{{ url('/public/assets/images/ajax-loader.gif') }}";
								var country = $('select[name="country"]').val();
								var lang    = $('select[name="lang"]').val();
								/* google maps api */
		

								/* start new career */
								  var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + country + "&key=AIzaSyC0FRYQhclryGo0XBUfoHSEBLaylI6Gowk&language=" + lang;

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

								                


								            }
								        });
								    

								/* end new career */

								var geocoder =  new google.maps.Geocoder();
								geocoder.geocode( { 'componentRestrictions': {'country':country}}, function(results, status) {
					        	
						        	 if (status == google.maps.GeocoderStatus.OK) {
						             var lat = results[0].geometry.location.lat(); 
						             var lng = results[0].geometry.location.lng();
								     var countryName = response.results[0].address_components[0].long_name;			  
							         var myArray = new Array(2);
							         myArray[0] = lat;
							         myArray[1] = lng;

							         /* start ajax */
							         	$.ajax({
												url:'{{url('admin/archive')}}',
												type:'post',
												dataType:'json',
												data:{country:country,countryName:countryName,lang:lang,lat:myArray[0],lng:myArray[1],'_token':'{!! csrf_token() !!}'},
												beforeSend: function()
												{
		 										//	$('#submit').html('<img src="{{ url('/public/assets/images/ajax-loader.gif') }}" height="20px" width="64px">');

		 											$('#submit').html("جارى الارشفه..");

		 										},success: function(data)
												{
													if(data.success == 'done')
													{
														//swal("احسنت صنعا !", "تمت الارشفه بنجاح", "success");
		 											    $('#submit').html("ارشف الان");
		 											    $('#msg').html('<div class="alert alert-success">تمت الارشفه بنجاح</div>');

													}else{

													  //  sweetAlert("خطا...", "تمت الارشفه من قبل!", "error");
		 											    $('#submit').html("ارشف الان");
		 											    $('#msg').html('<div class="alert alert-danger">تمت الارشفه من قبل!</div>');

													}
													//$('.spin_dep').addClass('hidden');
												},error: function()
												{
													  sweetAlert("Oops...", "Something went wrong!", "error");
		 											    $('#submit').html("ارشف الان");

												}
										}); 


							    
						            } else {
						              alert("Something got wrong " + status);
						            }
					            });
					            /* end google maps api */

							});	




							/* viewing the states */
							$(document).on('click','.choosstat',function(){

								var country = $('select[name="country"]').val();

 									/* start ajax */
							         	$.ajax({
												url:'{{url('admin/archive/states')}}',
												type:'post',
												dataType:'json',
												data:{country:country,'_token':'{!! csrf_token() !!}'},
												beforeSend: function()
												{
		 											$('.choosstat').html("جارى التحميل ...");

		 										},success: function(data)
												{
													if(data != 'false')
													{
		 											    $('.choosstat').html("اظهر الولايات");
		 											    $('.states').html(data);
													}
													//$('.spin_dep').addClass('hidden');
												},error: function()
												{
													  sweetAlert("Oops...", "Something went wrong!", "error");
		 											    $('#submit').html("ارشف الان");

												}
										}); 
									/* end ajax */	
							});	
							/* end viewing the states */






							/* viewing the cities */
							$(document).on('click','.chooscity',function(){

								var state = $('select[name="states[]"]').val();

 									/* start ajax */
							         	$.ajax({
												url:'{{url('admin/archive/cities')}}',
												type:'post',
												dataType:'json',
												data:{state:state,'_token':'{!! csrf_token() !!}'},
												beforeSend: function()
												{
		 											$('.chooscity').html("جارى التحميل ...");

		 										},success: function(data)
												{
													if (data.success == "statenull") {

													//  sweetAlert("Oops...", "من فضلك اختار ولايه", "error");
		 											    $('.chooscity').html("اظهر المدن");
		 											    $('#msg').html('<div class="alert alert-danger">من فضلك اختار ولايه</div>');


													}

													if (data.success == "multistate") {

													 // sweetAlert("Oops...", "من فضلك اختار ولايه واحده فقط", "error");
		 											    $('.chooscity').html("اظهر المدن");
		 											    $('#msg').html('<div class="alert alert-danger">من فضلك اختار ولايه واحده فقط</div>');


													}

													if(data != 'false')
													{
		 											    $('.chooscity').html("اظهر المدن");
		 											    $('.cities').html(data);
													}
													//$('.spin_dep').addClass('hidden');
												},error: function()
												{
													  sweetAlert("Oops...", "Something went wrong!", "error");
													  $('.chooscity').html("اظهر المدن");
		 											  $('#submitcity').html("ارشف الان");

												}
										}); 
									/* end ajax */	
							});	
							/* end viewing the cities */




							/* start archive the states */
							$(document).on('click','.archivstat',function(){
                              

                                var imgurl = "{{ url('/public/assets/images/ajax-loader.gif') }}";
								var country = $('select[name="country"]').val();
								var lang    = $('select[name="lang"]').val();
								var states  = $('select[name="states[]"]').val();
								//var address = 
								console.log(states);
							//	console.log(address);
								/* google maps api */
								
								var geocoder =  new google.maps.Geocoder();
								geocoder.geocode({ 'componentRestrictions': {'country':country}}, function(results, status) {
					        	
						        	 if (status == google.maps.GeocoderStatus.OK) {
						             var lat = results[0].geometry.location.lat(); 
						             var lng = results[0].geometry.location.lng();
							         var myArray = new Array(2);
							         myArray[0] = lat;
							         myArray[1] = lng;

							         /* start ajax */
							         	$.ajax({
												url:'{{url('admin/archive/archivstat')}}',
												type:'post',
												dataType:'json',
												data:{country:country,states:states,lang:lang,lat:myArray[0],lng:myArray[1],'_token':'{!! csrf_token() !!}'},
												beforeSend: function()
												{
		 										//	$('#submit').html('<img src="{{ url('/public/assets/images/ajax-loader.gif') }}" height="20px" width="64px">');

		 											$('#submitstat').html("جارى الارشفه..");

		 										},success: function(data)
												{
													if(data.success == 'done')
													{
														//swal("احسنت صنعا !", "تمت الارشفه بنجاح", "success");
		 											    $('#submitstat').html("ارشف الان");
		 											    $('#msg').html('<div class="alert alert-success">تمت الارشفه بنجاح</div>');

													}else{

													   // sweetAlert("خطا...", "تمت الارشفه من قبل!", "error");
		 											    $('#submitstat').html("ارشف الان");
		 											    $('#msg').html('<div class="alert alert-danger">تمت الارشفه من قبل</div>');

													}
													//$('.spin_dep').addClass('hidden');
												},error: function()
												{
													  sweetAlert("Oops...", "Something went wrong!", "error");
		 											    $('#submitstat').html("ارشف الان");

												}
										}); 


							    
						            } else {
						              alert("Something got wrong " + status);
						            }
					            });
					            /* end google maps api */

							});	
							/* end archive the states */








							/* start cities the states */
							$(document).on('click','.archivcity',function(){

                                var imgurl = "{{ url('/public/assets/images/ajax-loader.gif') }}";
								var country = $('select[name="country"]').val();
								var lang    = $('select[name="lang"]').val();
								var cities  = $('select[name="cities[]"]').val();
								/* google maps api */
								
								var geocoder =  new google.maps.Geocoder();
								geocoder.geocode( { 'componentRestrictions': {'country':country}}, function(results, status) {
					        	
						        	 if (status == google.maps.GeocoderStatus.OK) {
						             var lat = results[0].geometry.location.lat(); 
						             var lng = results[0].geometry.location.lng();
							         var myArray = new Array(2);
							         myArray[0] = lat;
							         myArray[1] = lng;

							         /* start ajax */
							         	$.ajax({
												url:'{{url('admin/archive/archivcity')}}',
												type:'post',
												dataType:'json',
												data:{country:country,cities:cities,lang:lang,lat:myArray[0],lng:myArray[1],'_token':'{!! csrf_token() !!}'},
												beforeSend: function()
												{
		 										//	$('#submit').html('<img src="{{ url('/public/assets/images/ajax-loader.gif') }}" height="20px" width="64px">');

		 											$('#submitcity').html("جارى الارشفه..");

		 										},success: function(data)
												{
													if(data.success == 'done')
													{
														//swal("احسنت صنعا !", "تمت الارشفه بنجاح", "success");
		 											    $('#submitcity').html("ارشف الان");
		 											    $('#msg').html('<div class="alert alert-success">تمت الارشفه بنجاح</div>');
													}else{

													  //  sweetAlert("خطا...", "تمت الارشفه من قبل!", "error");
		 											    $('#submitcity').html("ارشف الان");
		 											    $('#msg').html('<div class="alert alert-danger">تمت الارشفه من قبل</div>');

													}
													//$('.spin_dep').addClass('hidden');
												},error: function()
												{
													  sweetAlert("Oops...", "Something went wrong!", "error");
		 											    $('#submitcity').html("ارشف الان");

												}
										}); 


							    
						            } else {
						              alert("Something got wrong " + status);
						            }
					            });
					            /* end google maps api */

							});	
							/* end cities the  */





					});
					</script>

	
 				@foreach(\App\State::all() as $count)
			<!--  start translated languages here   -->
			<!-- 	<script>
                

                    var url = "https://maps.googleapis.com/maps/api/geocode/json?address={{$count->name}}&key=AIzaSyCLkUMzd2rh5ThGMOzGHUuDhxFt7vinMtY&language=de";

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

                            var link  = countryName;
                            var place = "{{ $count->name }}";
                            console.log(link);

                            $.ajax({
                                url: "{{ url('/addmultilang') }}",
                                method:'post',
                                data:{link:link,place:place,'_token':'{!! csrf_token() !!}'},
                                success: function (data) {
                                   //console.log(data);
                                }
                            });


                        }
                    });
                

            </script> -->

			<!--  end translated languages here   -->
			@endforeach


             </div>   
        </div>
    </div>
@stop
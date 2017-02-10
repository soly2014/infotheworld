        		<div class="col-md-8">  
		             <!-- /.form-group -->
		              <div class="form-group">
		                <label>اختار الولايه</label>
		                <select class="form-control" style="width: 100%;" multiple="multiple" name="states[]">
		                @foreach($states as $count)
		                  <option value="{{ $count->id }}">{{ $count->name }}</option>
		                @endforeach  

		                </select>
		              </div>
		              <!-- /.form-group -->
        		</div>
        		<div class="col-md-4 text-center">
		             <!-- /.form-group -->
		              <div class="form-group">
		                <br>
		                	<button type="submit" class="btn btn-primary archivstat" id="submitstat" style="margin-top: 5px;">ارشف الان</button>
		                	<button class="btn btn-primary chooscity" style="margin-top: 5px;">رؤيه المدن</button>
		              </div>
		              <!-- /.form-group -->
        		</div>

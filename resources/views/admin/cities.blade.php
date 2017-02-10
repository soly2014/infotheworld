        		<div class="col-md-8">  
		             <!-- /.form-group -->
		              <div class="form-group">
		                <label>اختار المدن</label>
		                <select class="form-control" style="width: 100%;" multiple="multiple" name="cities[]">
		                @foreach($cities as $count)
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
		                	<button type="submit" class="btn btn-primary archivcity" id="submitcity" style="margin-top: 5px;">ارشف الان</button>
		              </div>
		              <!-- /.form-group -->
        		</div>

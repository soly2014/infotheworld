@if($errors->any())

    <div class="container">
        <br/><br/><br/>
        @foreach($errors->all() as $error)
            <div class="col-lg-6 col-lg-offset-3 alert alert-danger">{{ $error }}</div>
        @endforeach
    </div>
@endif
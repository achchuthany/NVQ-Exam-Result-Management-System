@if(Session::has('message'))
<div class="row m-1">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            {{ Session::get('message')}}
        </div>
    </div>
</div>
@endif
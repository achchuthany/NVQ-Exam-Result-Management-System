@if(count($errors)>0)
<div class="row m-1">
    <div class="col-md-12">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error}}
            </div>
            @endforeach     
    </div>
</div>
@endif
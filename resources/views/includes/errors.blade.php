{{-- @if(count($errors)>0)
<div class="row m-1">
    <div class="col-md-12">
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error}}
            </div>
            @endforeach     
    </div>
</div>
@endif --}}
@if(count($errors)>0)
<div style="position: absolute; top: 0; right: 0; z-index: 1;">
@foreach ($errors->all() as $error)
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast bg-danger" data-delay="10000">
        <div class="toast-header">
          <strong class="mr-auto">Error</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body text-light">
            {{ $error}}
        </div>
    </div>
@endforeach  
</div>
@endif
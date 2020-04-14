{{-- @if(Session::has('message'))
<div class="row m-1">
    <div class="col-md-12">
        <div class="alert alert-success" role="alert">
            {{ Session::get('message')}}
        </div>
    </div>
</div>
@endif --}}
<div style="position: absolute; top: 0; right: 0; z-index: 1;">
@if(Session::has('message'))
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast bg-success" data-delay="10000">
        <div class="toast-header">
          <strong class="mr-auto">Success</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
            {{ Session::get('message')}}
        </div>
    </div>
@endif 
@if(Session::has('warning'))
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast bg-warning" data-delay="10000">
        <div class="toast-header">
          <strong class="mr-auto">Warning</strong>
          <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="toast-body">
            {{ Session::get('warning')}}
        </div>
    </div>
@endif 
</div>
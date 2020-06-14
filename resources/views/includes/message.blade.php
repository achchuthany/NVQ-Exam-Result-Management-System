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


<div class="modal fade" id="warning-model" tabindex="-1" role="dialog" aria-labelledby="warning-model" aria-hidden="true">
    <div class="modal-dialog modal-confirm " >
        <div class="modal-content">
            <div class="modal-header border-0 bg-warning text-dark">
                <h5 class="modal-title" id="exampleModalCenterTitle">Warning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center mb-5 ">
                <h4 class="display-1 text-warning"> <i class="fas fa-exclamation-circle"></i> </h4>
                <p class="modaltitle"> </p>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="success-model" tabindex="-1" role="dialog" aria-labelledby="success-model" aria-hidden="true">
    <div class="modal-dialog modal-confirm " >
        <div class="modal-content ">
            <div class="modal-header border-0 bg-success text-dark">
                <h5 class="modal-title" id="exampleModalCenterTitle">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center mb-5 ">

                <h4 class="display-1 text-success"> <i class="fas fa-check-circle"></i></h4>
                <p class="modaltitle"> </p>
            </div>
        </div>
    </div>
</div>


@if(\Session::has('success'))
    <div class="alert alert-success" >{{ \Session::get('success') }}</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-12">
            @if(\Session::has('success'))
                <div class="alert alert-success">{{ \Session::get('success') }}</div>
            @endif

@if(\Session::has('danger'))
    <div class="alert alert-danger" >{{ \Session::get('danger') }}</div>
@endif
                @if(\Session::has('danger'))
                    <div class="alert alert-danger">{{ \Session::get('danger') }}</div>
                @endif
        </div>
    </div>
</div>

@section('content')
<h2>CALL CENTER</h2>

@include('flash')
<div class="row-fluid">
      <center> 
          <div class="callcenter">
              <div class="nav nav-tabs">
                  <h4>Call Center Biro Hukum & Organisasi</h4>
              </div>

            <div class="control-group">
                @if($call->email && $call->email != "")
                <label class="control-label">Email   :  {{ $call->email }}</label>
                @endif
                @if($call->telp && $call->telp != "")
                    <label class="control-label">Telpon : {{ $call->telp }}</label>
                @endif
                @if($call->fax && $call->telp != "")                
                <label class="control-label">Fax    :  {{ $call->fax }} </label>
                @endif
            </div>
        </div>
        </center>
</div>
@endsection

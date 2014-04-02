@section('content')
<!--CALL CENTER-->
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-address-book'></span> Kontak Kami";
</script>

@include('flash')
<div class="row-fluid">
  <div class="span12 offset6">
    <div class="well text-center" id="call-center">
      <h4>Kontak Kami Biro Hukum & Organisasi</h4>
      @if($call->email && $call->email != "")
      <p><span class="rulycon-mail-4"></span> {{ $call->email }}</p>
      @endif
      @if($call->telp && $call->telp != "")
      <p><span class="rulycon-phone"></span> {{ $call->telp }}</p>
      @endif
      @if($call->fax && $call->telp != "")
      <p><span class="rulycon-print"></span> {{ $call->fax }}</p>
      @endif
    </div>
  </div>
  <script>
    document.getElementById("menu-call-center").setAttribute("class", "active");
  </script>
</div>
@endsection


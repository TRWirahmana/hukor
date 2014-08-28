@section('content')
<!--CALL CENTER-->
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-address-book'></span> Kontak Kami";
</script>

@include('flash')
<div class="row-fluid">
  <div class="span12 offset6">
    <div class="well text-center" id="call-center">
<!--        <h4>KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN</h4>-->
      <h4>BIRO HUKUM DAN ORGANISASI</h4></br>
        <p>Komplek Kemdikbud Gedung C Lantai 10</p>
        <p>Jalan Jenderal Sudirman, Senayan Jakarta Pusat 10270</p></br>
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

    <script type="text/javascript">
//    var $ = jQuery.noConflict();

    document.getElementById("menu-call-center").setAttribute("class", "active");
    document.title = "Layanan Biro Hukum dan Organisasi | Kontak Kami";
  </script>

</div>


@endsection


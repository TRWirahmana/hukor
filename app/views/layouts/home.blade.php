@section('content')

@include('flash')
<div class="content-non-title">
  <p id="welcome-to-the-fucking-app">
    <span class="rulycon-accessibility"></span><br/>
    Selamat datang di aplikasi Biro Hukum dan Organisasi<br/>
    Kementerian Pendidikan dan Kebudayaan Republik Indonesia<br/>
    <small>© 2014 BIRO HUKUM DAN ORGANISASI</small>
  </p>
</div>

<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-home-2'></span> Selamat datang";
</script>

@stop
@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li>Berita</li>
  </ul>

  @include('adminflash')
  <?php $user = Auth::user(); ?>
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-newspaper"></span></div>
    <div class="pagetitle">
      <h1>Berita</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    <div class="maincontentinner">

      <!-- MAIN CONTENT -->
      <div class="row-fluid">
        @if($user->role_id == 3)
        <a class="btn btn-primary" href="{{ URL::to('/admin/berita/create')}}">Tambah Berita Baru</a>
        @endif
      </div>

      <table id="table_news" class="table">
        <thead>
        <tr>
          <th>Judul Berita</th>
          <th>Kategori</th>
          <th>Ditulis</th>
          <th></th>
        </tr>
        </thead>
      </table>

      <div class="footer">
        <div class="footer-left">
          <span>&copy;2014 Biro Hukum dan Organisasi</span>
        </div>
        <div class="footer-right">
          <span></span>
        </div>
      </div>
      <!--footer-->
    </div>
    <!--maincontentinner-->
  </div>
  <!--maincontent-->


</div>
<!--rightpanel-->

@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/berita_index.js')}}"></script>
<script>
  jQuery("#menu_berita > li:first-child > a").addClass("sub-menu-active");
  jQuery("#menu_berita").css({
    "display": "block",
    "visibility": "visible"
  });
</script>
@stop
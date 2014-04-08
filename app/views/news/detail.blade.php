@section('news-content')
<div class="maincontent" id="detail-news">
  <div class="container" style="width: 960px;">
    <!-- News Feed -->
    <div class="row-fluid">
      <div id="dashboard-left" class="span12">
        <h3 class="section-title" id="news-feed">{{$berita->judul}}</h3>
        <div class="news-content news-content-detail">
          <h6><?php $date = new DateTime($berita->tgl_penulisan); ?>
          <span class="date-time">{{$date->format('d')}}  <span
              class="date"><?php echo HukorHelper::castMonthToString3($date->format('m')) ?></span> {{$date->format('Y')}}</span></h6>
          <br>
          @if($berita->gambar != null)
          {{ HTML::image('assets/uploads/berita/' . $berita->gambar) }}
          @endif
          <br>
          <p>{{$berita->berita}}</p>
        </div>
      </div>
    </div>
    <!--row-fluid-->
  </div>


</div>
<!--container-->
</div>
<!--maincontent-->
@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.simplePagination.js')}}"></script>
<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Berita"
    });
</script>
@stop
@stop
@section('news-content')
<div class="maincontent" id="detail-news">
  <div class="container" style="width: 960px;">
    <!-- News Feed -->
    <div class="row-fluid">
      <div id="dashboard-left" class="span8">
        <h3 class="section-title" id="news-feed">{{$berita->judul}}</h3>
        <div class="news-content news-content-detail">
          <h6 style="margin-bottom: 15px; padding: 0px;"><?php $date = new DateTime($berita->tgl_penulisan); ?>
          <span class="date-time">{{$date->format('d')}}
          <span class="date"><?php echo HukorHelper::castMonthToString3($date->format('m')) ?></span> {{$date->format('Y')}}</span></h6>

          @if($berita->gambar != null)
          {{ HTML::image('assets/uploads/berita/' . $berita->gambar,'', array('class' => 'span16 gambar')) }}
          @endif
          <p>{{$berita->berita}}</p>
        </div>
      </div>

        <div class="span4" style="padding-top: 32px;">
            <!-- form cari berita-->
            <div id="counter-widget" style="margin-bottom: 10px;">
                {{ Form::open(array('action' => 'NewsController@search', 'method' => 'post', 'id'=>'form-cari-berita', 'class' =>'pull-right' )) }}
                <input type="text" placeholder="cari..." name="search" style="height: 35px; width: 165px;"/>
                <button class="btn btn-primary btn-searchs" type="submit"><span class="rulycon-search"></span></button>
                {{ Form::close() }}

                <!--      -->
                <p style="padding: 5px;">
                    <a href="https://twitter.com/hukor_kemdikbud" target="_blank"><span class="rulycon-twitter bigger-icon"></span></a>
                    <a href="#"><span class="rulycon-feed-3 bigger-icon"></span></a>
                </p>
            </div>
            <h3 class="section-title" id="tautan">Tautan</h3>

            <div class="verticalslider">
                <?php
                $DAL = new DAL_Dikbud();
                $link_dikbud = $DAL->GetAllLink();
                ?>
                @foreach($link_dikbud as $dikbud)
                <?php $link = "http://" . $dikbud->link; ?>
                <?php $assets = asset('assets/uploads/link/' . $dikbud->gambar); ?>
                <div class="slider"><a href="{{ $link }}"><img src="{{ $assets }}"></a></div>
                @endforeach
            </div>

            <!-- Widget Counter -->
            <div id="counter-widget">
                <h3 class="section-title widgets">Pengunjung</h3>

                <div class="widget-body">
                    <div class="widget-content">
                        <table class="table">
                            <tr>
                                <th><span class="rulycon-calendar-2"></span></th>
                                <th>Per-hari     :</th>
                                <th>{{ $pengunjung[0] }}</th>
                            </tr>
                            <tr>
                                <th><span class="rulycon-calendar"></span></th>
                                <th>Per-bulan    :</th>
                                <th>{{ $pengunjung[1] }}</th>
                            </tr>
                            <tr>
                                <th><span class="rulycon-table-2"></span></th>
                                <th>Per-tahun    :</th>
                                <th>{{ $pengunjung[2] }}</th>
                            </tr>
                            <tr>
                                <th><span class="rulycon-stats"></span></th>
                                <th>Keseluruhan     :</th>
                                <th>{{ $pengunjung[3] }}</th>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
            <!-- End Widget Counter -->
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
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Berita";

        $('.verticalslider').bxSlider({
            mode: 'vertical',
            minSlides: 4,
            slideMargin: 4
        });
    });
</script>
@stop
@stop
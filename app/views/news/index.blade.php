@section('news-content')

<div class="maincontent">
<div class="container">
<!-- Latest News -->
<!--        <div class="row-fluid">-->
<!--            --><?php $t = 0; ?>
<!--            @foreach($latest_news as $data)-->
<!--            @if($t++ < 4)-->
<!--            <div class="span3 latest-news">-->
<!--                <h6>{{$data->judul}}</h6>-->
<!--                <p><small><span class="rulycon-clock"></span> {{$data->tgl_penulisan}}</small></p>-->
<!--                --><?php $berita = strip_tags($data->berita);
//                $highlight = substr($berita, 0, 150);
//
?>
<!--                @if(strlen($berita) > 150)-->
<!--                    <p>{{$highlight}}...</p>-->
<!--                    <p><a href="{{ URL::to('/news/detail?id='. $data->id .'') }}" class="read-more">Read more <span class="rulycon-arrow-right-3"></span></a></p>-->
<!--                @else-->
<!--                    <p>{{$berita}}</p>-->
<!--                @endif-->
<!--            </div>-->
<!--            @endif-->
<!--            --><? $t++; ?>
<!--            @endforeach-->
<!--        </div>-->

<?php $f = 4; ?>
<!-- News Feed -->
<div class="row-fluid">
  <div class="container" id="carousel-wrapper" style="box-shadow: 0 1px 2px rgba(0, 0, 0, .25); width: 960px;">
    <div id="main-carousel" class="carousel slide">
      <div class="carousel-indicators">
          <?php $x = 0;
          foreach ($latest_news as $data) {
              if ($x < 6) {
                  echo "<li data-target=#main-carousel data-slide-to= " . $x . ">" . $data->judul . "</li>";
              }
              $x++;
          }
          ?>

      </div>
      <div class="carousel-inner">
          <?php $s = 0;
          ?>

          @foreach($latest_news as $data)
            @if($s < 6)
              @if($data->slider != null)
                  <div class="item">
                      {{ HTML::image('assets/uploads/berita/' . $data->slider) }}
                  </div>
              @else
                  <div class="item">
                      {{ HTML::image('assets/img/noim.jpg') }}
                  </div>
              @endif
            @endif
          @endforeach

<!--        <div class="item">-->
<!--          <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-01.jpg')}}" alt=""/>-->
<!--        </div>-->
<!--        <div class="item">-->
<!--          <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-02.jpg')}}" alt=""/>-->
<!--        </div>-->
<!--        <div class="item">-->
<!--          <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-03.jpg')}}" alt=""/>-->
<!--        </div>-->
<!--        <div class="item">-->
<!--          <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-04.jpg')}}" alt=""/>-->
<!--        </div>-->
<!--        <div class="item">-->
<!--          <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-01.jpg')}}" alt=""/>-->
<!--        </div>-->
<!--        <div class="item">-->
<!--          <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-02.jpg')}}" alt=""/>-->
<!--        </div>-->
      </div>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div class="container" style="width: 960px;">
    <div id="dashboard-left" class="span8">

      <div id="paging_container">
        <h3 class="section-title" id="news-feed">Berita</h3>
        <ul class="content">

          <?php $s = 0; ?>
          @foreach($latest_news as $news_feeds)
          @if($s++ >= 6)
          <li>
            <div class="news-content">
              <div class="row-fluid">
                <div class="span4">
                  @if($news_feeds->gambar != null)
                  {{ HTML::image('assets/uploads/berita/' . $news_feeds->gambar) }}
                  @else
                  {{ HTML::image('assets/img/no-available-image.png') }}
                  @endif
                </div>
                <div class="span8">
                  <h4><a href="{{ URL::to('/news/detail?id='. $news_feeds->id .'') }}">{{$news_feeds->judul}}</a>
                  </h4>
                  <?php $date = new DateTime($news_feeds->tgl_penulisan); ?>
                  <p class="date-time"><span class="rulycon-clock"></span>
                    {{$date->format('d')}}  <span
                      class="date"><?php echo HukorHelper::castMonthToString3($date->format('m')) ?></span>
                    {{$date->format('Y')}}</p>
                  <?php $berita_feed = strip_tags($news_feeds->berita);
                  $highlight_feed = substr($berita_feed, 0, 350);
                  ?>
                  @if(strlen($berita_feed) > 350)
                  <p>{{$highlight_feed}} ...</p>

                  <p><a class="read-more"
                        href="{{ URL::to('/news/detail?id='. $news_feeds->id .'') }}">Selengkapnya
                      <span class="rulycon-arrow-right-3"></span></a></p>
                  @else
                  <p>{{$berita_feed}}</p>
                  @endif
                </div>
              </div>
            </div>
          </li>
          @endif
          <? $s++; ?>
          @endforeach

        </ul>
<!--         JIKA #BERITA KURANG DARI LIMA ITEM-->
          @if($count_news <=6)
                <div class="row-fluid">
                    <div class="span12">
                        <div id="not-enough-message" class="text-center">
                            <p><span class="rulycon-info"></span></p>
                            <h5>Belum cukup berita untuk menampilkan berita di area ini.</h5>
                        </div>
                    </div>
                </div>
            @else
        <div class="page_navigation pagination"></div>
          @endif
      </div>
    </div>
    <!--span8-->

    <div class="span4" style="margin-top: 32px;
  border-top: 1px solid rgba(0, 0, 0, .075);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, .85); padding-top: 32px;">
      <h3 class="section-title" id="cemendikbud">Tautan</h3>

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
<!--              <div id="rule-widget">-->
<!--                <h3 class="section-title widgets">Peraturan</h3>-->
<!---->
<!--                <div class="widget-body">-->
<!--                  <div class="widget-content">-->
<!--                    <table class="table">-->
<!--                      <thead>-->
<!--                      <tr>-->
<!--                        <th>No</th>-->
<!--                        <th>Perihal</th>-->
<!--                      </tr>-->
<!--                      </thead>-->
<!--                      <tbody>-->
<!--                      @if ($document != null)-->
<!--                      --><?php //$increment = 1; ?>
<!--                      @foreach($document as $doc)-->
<!--                      <tr>-->
<!--                        <td>--><?php //echo $doc->nomor; //$increment; ?><!--</td>-->
<!--                        <td>{{ $doc->perihal }}</td>-->
<!--                      </tr>-->
<!--                      --><?php //$increment++; ?>
<!--                      @endforeach-->
<!--                      @endif-->
<!--                      </tbody>-->
<!--                    </table>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->

      <!--        <div id="twitter-widget">-->
      <!--          <h3 class="section-title widgets">Twitter</h3>-->
      <!---->
      <!--          <div class="widget-body">-->
      <!--            <div class="widget-content">-->
      <!---->
      <!--              <a class="twitter-timeline" href="https://twitter.com/hukor_kemdikbud"-->
      <!--                 data-widget-id="440745484580184065">Tweets by @hukor_kemdikbud</a>-->
      <!---->
      <!---->
      <!--            </div>-->
      <!--          </div>-->
      <!--        </div>-->
    </div>
    <!--span4-->
  </div>


</div>
<!--row-fluid-->

</div>
<!--container-->
</div>
<!--maincontent-->
@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.pajinate.js')}}"></script>
<script type="text/javascript">
  var $ = jQuery.noConflict();

  $(document).ready(function () {
    $('.verticalslider').bxSlider({
      mode: 'vertical',
      minSlides: 4,
      slideMargin: 4
    });
  });

  $(function () {
//        $(".news-feed").pagination({
//            items: {{$count_news}},
//            itemsOnPage: 4
//        });

    $('#paging_container').pajinate({
//            start_page : 1,
      items_per_page: 2,
        nav_label_first: 'Awal',
        nav_label_last: 'Akhir',
        nav_label_prev: 'Sebelumnya',
        nav_label_next: 'Selanjutnya'
    });
  });
</script>
@stop
@stop
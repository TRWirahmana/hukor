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
  <div class="container" style="box-shadow: 0 1px 2px rgba(0, 0, 0, .25);">
    <div class="half">
      <div id="main-carousel" class="carousel slide">
        <!--<ol class="carousel-indicators">
          <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
          <li data-target="#main-carousel" data-slide-to="1" class=""></li>
          <li data-target="#main-carousel" data-slide-to="2" class=""></li>
          <li data-target="#main-carousel" data-slide-to="3" class=""></li>
        </ol>-->
        <div class="carousel-inner">
          <?php $n = 0 ?>
          @foreach($latest_news as $data)
          @if($n++ < 5)
          <div class="item" style="height:249px !important;">
            @if($data->slider != null)
            {{ HTML::image('assets/uploads/berita/' . $data->slider) }}
            @else
            {{ HTML::image('assets/img/noim.jpg') }}
            @endif

            <div class="carousel-caption">
              <h3><a href="{{ URL::to('/news/detail?id='. $data->id .'') }}">{{$data->judul}}</a></h3>
              <?php $berita = strip_tags($data->berita);
              $highlight = substr($berita, 0, 150);

              ?>
              <p>{{$highlight}}</p>
            </div>
          </div>
          @endif
          <? $n++; ?>
          @endforeach
        </div>
      </div>
    </div>
    <div class="half">
      <h2>Berita terbaru</h2>
      <ul>
        <?php $x = 0;
        foreach($latest_news as $data){
          if($x < 5){
            echo "<li><a href=# data-target=#main-carousel data-slide-to= ".$x.">". $data->judul ."</a></li>";
          }
          $x++;
        }
        ?>

      </ul>
    </div>
  </div>
</div>
<div class="row-fluid">
  <div id="dashboard-left" class="span8">

    <div id="paging_container">
      <!--<h3 class="section-title" id="news-feed">Berita</h3>-->
      <ul class="content">

        <?php $s = 0; ?>
        @foreach($latest_news as $news_feeds)
        @if($s++ >= 5)
        <li>
          <div class="news-content">
            <div class="row-fluid">
              <div class="span12">
                <h4><a href="{{ URL::to('/news/detail?id='. $news_feeds->id .'') }}">{{$news_feeds->judul}}</a></h4>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span4">
                @if($news_feeds->gambar != null)
                {{ HTML::image('assets/uploads/berita/' . $news_feeds->gambar) }}
                @else
                {{ HTML::image('assets/img/no-available-image.png') }}
                @endif
              </div>
              <div class="span8">
                <?php $date = new DateTime($news_feeds->tgl_penulisan); ?>
                <p class="date-time"><span class="rulycon-clock"></span> {{$date->format('d')}}  <span
                    class="date"><?php echo HukorHelper::castMonthToString3($date->format('m')) ?></span>
                  {{$date->format('Y')}}</p>
                <?php $berita_feed = strip_tags($news_feeds->berita);
                $highlight_feed = substr($berita_feed, 0, 350);
                ?>
                @if(strlen($berita_feed) > 350)
                <p>{{$highlight_feed}} ...</p>

                <p><a class="read-more" href="{{ URL::to('/news/detail?id='. $news_feeds->id .'') }}">Read more
                    <span class="rulycon-arrow-right-3"></span></a></p>
                @else
                <p>{{$berita_feed}}</p>
                @endif
              </div>
            </div>
          </div>
        </li>
        @else
          <!-- JIKA #BERITA KURANG DARI LIMA ITEM -->
          <div class="row-fluid">
              <div class="span12">
                  <div id="not-enough-message" class="text-center">
                      <p><span class="rulycon-info"></span></p>
                      <h5>Belum cukup berita untuk menampilkan berita di area ini.</h5>
                  </div>
              </div>
          </div>
        @endif
        <? $s++; ?>
        @endforeach

      </ul>
      <div class="page_navigation pagination"></div>
    </div>
  </div>
  <!--span6-->

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
      <?php $assets = asset('assets/uploads/link/'.$dikbud->gambar); ?>
      <div class="slider"><a href="{{ $link }}"><img src="{{ $assets }}"></a></div>
      @endforeach
    </div>


    <!--        <div id="counter-widget">-->
    <!--          <h3 class="section-title widgets">Visitor counter</h3>-->
    <!---->
    <!--          <div class="widget-body">-->
    <!--            <div class="widget-content">-->
    <!--              <p>--><?php //echo HukorHelper::GetCounterVisitor(); ?><!--</p>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->

    <!--        <div id="rule-widget">-->
    <!--          <h3 class="section-title widgets">Peraturan</h3>-->
    <!---->
    <!--          <div class="widget-body">-->
    <!--            <div class="widget-content">-->
    <!--              <table class="table">-->
    <!--                <thead>-->
    <!--                <tr>-->
    <!--                  <th>No</th>-->
    <!--                  <th>Perihal</th>-->
    <!--                </tr>-->
    <!--                </thead>-->
    <!--                <tbody>-->
    <!--                @if ($document != null)-->
    <!--                --><?php //$increment = 1; ?>
    <!--                @foreach($document as $doc)-->
    <!--                <tr>-->
    <!--                  <td>--><?php //echo $doc->nomor; //$increment; ?><!--</td>-->
    <!--                  <td>{{ $doc->perihal }}</td>-->
    <!--                </tr>-->
    <!--                --><?php //$increment++; ?>
    <!--                @endforeach-->
    <!--                @endif-->
    <!--                </tbody>-->
    <!--              </table>-->
    <!--            </div>-->
    <!--          </div>-->
    <!--        </div>-->

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
  <!--span6-->
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

  $(document).ready(function(){
    $('.verticalslider').bxSlider({
      mode: 'vertical',
      minSlides: 3,
      slideMargin: 32
    });
  });

  $(function () {
//        $(".news-feed").pagination({
//            items: {{$count_news}},
//            itemsOnPage: 4
//        });

    $('#paging_container').pajinate({
//            start_page : 1,
      items_per_page: 2
    });
  });
</script>
@stop
@stop
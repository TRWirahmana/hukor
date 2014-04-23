@section('news-content')
<div class="maincontent" id="detail-news">
    <div class="container" style="width: 960px;">
        <!-- News Feed -->
        <div class="row-fluid">

          <h3 class="section-title" id="search-result">Hasil pencarian</h3>
          <div id="search-result-lists">
            <p>Berikut adalah hasil pencarian untuk kata kunci <strong>{{ $keyword }}</strong>.</p>
            <div id="paging_container">
            <ul class="content">
                @if($berita['0'] != null)
                    @foreach($berita as $data)
                      <li>
                        <h6><a href="#">{{$data->judul}}</a></h6>
                          <?php $berita_feed = strip_tags($data->berita);
                          $highlight_feed = substr($berita_feed, 0, 180);
                          ?>
                          @if(strlen($berita_feed) > 180)
                            <p>{{$highlight_feed}} ...</p>
                          @else
                          <p>{{$data->berita}}</p>
                          @endif
                      </li>
                      <br>
                    @endforeach
            </ul>
                <div class="page_navigation pagination"></div>
            </div>
                @else
                <p>Pencarian berita tidak ditemukan</p>
                @endif

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
<script src="{{asset('assets/js/jquery.pajinate.js')}}"></script>
<script type="text/javascript">
    var $ = jQuery.noConflict();
    $('#paging_container').pajinate({
//            start_page : 1,
        items_per_page: 6,
        nav_label_first: 'Awal',
        nav_label_last: 'Akhir',
        nav_label_prev: 'Sebelumnya',
        nav_label_next: 'Selanjutnya'
    });
    $(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Pencarian Berita"
    });
</script>
@stop
@stop
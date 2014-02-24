@section('news-content')
<div class="maincontent">
        <!-- News Feed -->
        <div class="row-fluid">
            <div id="dashboard-left" class="span9">
                <h3 class="section-title" id="news-feed">Berita</h3>
                <div class="news-content">
                    <div class="row-fluid">
                        <div class="span9">
                            <h4>{{$berita->judul}}</h4>
                            <p>{{$berita->berita}}</p>
{{ HTML::image('assets/uploads/berita/' . $berita->gambar) }}
                        </div>
                        <div class="span3">
                            <?php $date = new DateTime($berita->tgl_penulisan); ?>
                            <span class="date-time pull-right">{{$date->format('d')}}  <span class="date"><?php echo HukorHelper::castMonthToString3($date->format('m'))?></span> {{$date->format('Y')}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--span9-->

            <div id="dashboard-right" class="span3">
                <h3 class="section-title" id="widgets">Widgets</h3>
            </div>
            <!--span3-->
        </div>
        <!--row-fluid-->

    </div>
    <!--container-->
</div>
<!--maincontent-->
@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.simplePagination.js')}}"></script>

@stop
@stop
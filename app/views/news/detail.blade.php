@section('news-content')
<div class="maincontent">
  <div class="container">
    <!-- News Feed -->
    <div class="row-fluid">
      <div id="dashboard-left" class="span9">
        <h3 class="section-title" id="news-feed">Berita</h3>
        <div class="news-content">
          <div class="row-fluid">
            <div class="span9">
              <h4>{{$berita->judul}}</h4>
		<br>
		{{ HTML::image('assets/uploads/berita/' . $berita->gambar) }}
		<br>
              <p>{{$berita->berita}}</p>
              
            </div>
            <div class="span3">
              <?php $date = new DateTime($berita->tgl_penulisan); ?>
              <span class="date-time pull-right">{{$date->format('d')}}  <span class="date"><?php echo HukorHelper::castMonthToString3($date->format('m'))?></span> {{$date->format('Y')}}</span>
            </div>
          </div>
        </div>
      </div>
      <!--span9-->

        <div class="span3">
            <div id="counter-widget">
                <h3 class="section-title widgets">Visitor counter</h3>

                <div class="widget-body">
                    <div class="widget-content">
                        <p><?php echo HukorHelper::GetCounterVisitor(); ?></p>
                    </div>
                </div>
            </div>

            <div id="rule-widget">
                <h3 class="section-title widgets">Peraturan</h3>

                <div class="widget-body">
                    <div class="widget-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Perihal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if ($document != null)
                            <?php $increment = 1; ?>
                            @foreach($document as $doc)
                            <tr>
                                <td><?php echo $increment; ?></td>
                                <td>{{ $doc->perihal }}</td>
                            </tr>
                            <?php $increment++; ?>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="twitter-widget">
                <h3 class="section-title widgets">Twitter</h3>

                <div class="widget-body">
                    <div class="widget-content">

                        <a class="twitter-timeline" href="https://twitter.com/hukor_kemdikbud"
                           data-widget-id="440745484580184065">Tweets by @hukor_kemdikbud</a>


                    </div>
                </div>
            </div>
        </div>
      <!--span3-->
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

@stop
@stop
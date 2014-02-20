@section('news-content')
<div class="maincontent">
    <div id="main-carousel" class="carousel slide">
        <div class="container">
            <ol class="carousel-indicators">
                <li data-target="#main-carousel" data-slide-to="0" class="active"></li>
                <li data-target="#main-carousel" data-slide-to="1" class=""></li>
                <li data-target="#main-carousel" data-slide-to="2" class=""></li>
                <li data-target="#main-carousel" data-slide-to="3" class=""></li>
            </ol>
        </div>
        <div class="carousel-inner">
            <div class="item active">
                <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-01.jpg')}}" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <h4>First Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-02.jpg')}}" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <h4>Second Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-03.jpg')}}" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <h4>Third Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{asset('assets/img/bootstrap-mdo-sfmoma-04.jpg')}}" alt="">
                <div class="carousel-caption">
                    <div class="container">
                        <h4>Fourth Thumbnail label</h4>
                        <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida
                            at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- Latest News -->
        <div class="row-fluid">
            <?php $t = 0;?>
            @foreach($latest_news as $data)
            @if($t++ < 4)
            <div class="span3 latest-news">
                <h6>{{$data->judul}}</h6>
                <p><small><span class="rulycon-clock"></span> {{$data->tgl_penulisan}}</small></p>
                <p>{{$data->berita}}</p>
                <p><a href="#" class="read-more">Read more <span class="rulycon-arrow-right-3"></span></a></p>
            </div>
            @endif
            <? $t++; ?>
            @endforeach
        </div>

        <?php $f = 4;?>
        <!-- News Feed -->
        <div class="row-fluid">
            <div id="dashboard-left" class="span9">
                <h3 class="section-title" id="news-feed">News feed</h3>
                @foreach($latest_news as $news_feeds)
                @if($f++ > 4)
                <div class="news-content">
                    <div class="row-fluid">
                        <div class="span9">
                            <h4>{{$news_feeds->judul}}</h4>
                            <p>{{$news_feeds->berita}}</p>
                            <p><a class="read-more" href="#">Read more <span class="rulycon-arrow-right-3"></span></a></p>
                        </div>
                        <div class="span3">
                            <span class="date-time pull-right">Feb <span class="date">17</span> 2014</span>
                        </div>
                    </div>
                </div>
                @endif
                <? $f++; ?>
                @endforeach

                <div class="pagination">
                    <ul>
                        <li class="disabled"><a href="#">«</a></li>
                        <li class="disabled"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li><a href="#">»</a></li>
                    </ul>
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

@stop
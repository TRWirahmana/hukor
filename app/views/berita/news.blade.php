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
<div class="row-fluid">
    <div class="span3 latest-news">
        <h6>Latest news 01</h6>
        <p><small><span class="rulycon-clock"></span> Feb 18 2014, 07:49</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam animi consequuntur, doloremque earum et fugit ipsum maxime nulla odio officiis, quibusdam quod repellat saepe! Fugiat nesciunt officiis quas qui quod.</p>
        <p><a href="#" class="read-more">Read more <span class="rulycon-arrow-right-3"></span></a></p>
    </div>
    <div class="span3 latest-news">
        <h6>Latest news 02</h6>
        <p><small><span class="rulycon-clock"></span> Feb 18 2014, 07:49</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias facere velit? A consectetur ea illo magni maiores officia porro reprehenderit vitae voluptatem. Exercitationem in incidunt molestias odio, unde veniam?</p>
        <p><a href="#" class="read-more">Read more <span class="rulycon-arrow-right-3"></span></a></p>
    </div>
    <div class="span3 latest-news">
        <h6>Latest news 03</h6>
        <p><small><span class="rulycon-clock"></span> Feb 18 2014, 07:49</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aliquid autem consequuntur culpa, deleniti dolorum eligendi itaque nisi optio pariatur quaerat quo similique ut vel vero. Maiores soluta vero voluptates?</p>
        <p><a href="#" class="read-more">Read more <span class="rulycon-arrow-right-3"></span></a></p>
    </div>
    <div class="span3 latest-news">
        <h6>Latest news 04</h6>
        <p><small><span class="rulycon-clock"></span> Feb 18 2014, 07:49</small></p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab adipisci autem blanditiis dolore excepturi itaque iure perspiciatis provident, sit ullam. Amet dolores eius facilis incidunt natus obcaecati ut? Doloribus, reiciendis.</p>
        <p><a href="#" class="read-more">Read more <span class="rulycon-arrow-right-3"></span></a></p>
    </div>
</div>
<div class="row-fluid">
    <div id="dashboard-left" class="span9">
        <h3 class="section-title" id="news-feed">News feed</h3>
        <div class="news-content">
            <div class="row-fluid">
                <div class="span9">
                    <h4>Eligendi esse excepturi hic maiores molestias dignissimos</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aspernatur at aut culpa cumque
                        deleniti molestias porro, quisquam quo totam vitae voluptas, voluptate voluptatum. Assumenda
                        consequuntur dignissimos harum id repudiandae? Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Accusamus delectus, distinctio eligendi esse excepturi hic maiores molestias nisi non nostrum obcaecati
                        officiis porro quisquam recusandae sequi tempore veritatis vero vitae!</p>
                    <p><a class="read-more" href="#">Read more <span class="rulycon-arrow-right-3"></span></a></p>
                </div>
                <div class="span3">
                    <span class="date-time pull-right">Feb <span class="date">17</span> 2014</span>
                </div>
            </div>
        </div>

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
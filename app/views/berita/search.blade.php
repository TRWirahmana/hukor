@section('news-content')
<div class="maincontent" id="detail-news">
    <div class="container" style="width: 960px;">
        <!-- News Feed -->
        <div class="row-fluid">
<p>sadasdasd</p>
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
        document.title = "Layanan Biro Hukum dan Organisasi | Pencarian Berita"
    });
</script>
@stop
@stop
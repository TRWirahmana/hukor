@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Berita</li>
    </ul>

    @include('adminflash')
    <?php $user = Auth::user(); ?>
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Berita</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>

                    @if($user->role_id == 3)
                    <legend><a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/admin/berita/create')}}">Tambah Berita Baru</a></legend>
                    @endif
                    @if($user->role_id == 1)
                    <legend><a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/kepala_biro/berita/create')}}">Tambah Berita Baru</a></legend>
                    @endif

            <table id="table_news" class="table">
                <thead>
                <tr>
                    <td>Judul Berita</td>
                    <td>Penulis</td>
                    <td>Kategori</td>
                    <td>Ditulis</td>
                    <td></td>
                </tr>
                </thead>
            </table>

            <div class="footer">
                <div class="footer-left">
                    <span>&copy;2014 Direktorat Jenderal Kebudayaan Republik Indonesia</span>
                </div>
                <div class="footer-right">
                    <span></span>
                </div>
            </div>
            <!--footer-->
        </div>
        <!--maincontentinner-->
    </div>
    <!--maincontent-->


</div>
<!--rightpanel-->

@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/berita_index.js')}}"></script>
@stop
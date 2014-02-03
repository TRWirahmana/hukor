@section('content')
@include('flash')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Berita</li>
    </ul>

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

            <form class="form-inline">
                <fieldset>
                    <legend><a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/admin/berita/create')}}">Tambah Berita Baru</a></legend>
<!--                    <label for="select_role" class="control-label">Tipe Pengguna</label>-->
<!--                    <select id="select_role">-->
<!--                        <option value="0">Semua User</option>-->
<!--                        <option value="2">User</option>-->
<!--                        <option value="3">Admin</option>-->
<!--                    </select>-->
                </fieldset>
            </form>

            <table id="table_news" class="table">
                <thead>
                <tr>
                    <td>Judul Berita</td>
                    <td>Penulis</td>
                    <td>Ditulis</td>
                    <td></td>
                </tr>
                </thead>
            </table>

            <div class="footer">
                <div class="footer-left">
                    <span>&copy; 2013. Admin Template. All Rights Reserved.</span>
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
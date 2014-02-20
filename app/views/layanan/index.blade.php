@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Manage Layanan</li>
    </ul>

    @include('adminflash')

    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Manage Layanan</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>

            <form class="form-inline">
                <a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/admin/layanan/create')}}">Tambah Info Layanan Baru</a>
                <fieldset>
                    <legend></legend>
                    <!--                    <label for="select_role" class="control-label">Tipe Pengguna</label>-->
                    <!--                    <select id="select_role">-->
                    <!--                        <option value="0">Semua User</option>-->
                    <!--                        <option value="2">User</option>-->
                    <!--                        <option value="3">Admin</option>-->
                    <!--                    </select>-->
                </fieldset>
            </form>

            <table id="table_layanan" class="table">
                <thead>
                <tr>
                    <td>Nama Menu</td>
                    <td>Nama Submenu</td>
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
<script src="{{asset('assets/js/layanan_index.js')}}"></script>
@stop
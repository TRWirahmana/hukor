@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Manage Menu</a> <span class="separator"></span></li>
        <li>Kelola Submenu</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Kelola Submenu</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>
            <?php $set_menu = Menu::all();
            $count = count($set_menu);?>
            <form class="form-inline">
                <a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/admin/create_submenu')}}">Tambah Submenu Baru</a>
                <fieldset>
                    @if($count != 0)
                    <legend></legend>
                    <!--                    <label for="select_role" class="control-label">Tipe Pengguna</label>-->
                    <!--                    <select id="select_role">-->
                    <!--                        <option value="0">Semua User</option>-->
                    <!--                        <option value="2">User</option>-->
                    <!--                        <option value="3">Admin</option>-->
                    <!--                    </select>-->
                    @endif
                </fieldset>
            </form>

            <table id="table_submenu" class="table">
                <thead>
                <tr>
                    <td>Nama Menu</td>
                    <td>Sub Menu</td>
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
<script src="{{asset('assets/js/management_submenu.js')}}"></script>
<!--<style>-->
<!--    .leftmenu .nav-tabs.nav-stacked > li.dropdown ul {-->
<!--        display: block !important;-->
<!--    }-->
<!--    #produkhukum, #ketatalaksanaan, #bahu, #puu, #diskusi, #callcenter, #app, #manage, #info {-->
<!--        display: none !important;-->
<!--    }-->
<!--</style>-->
@stop
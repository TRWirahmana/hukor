@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Kelola Submenu</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-settings"></span></div>
        <div class="pagetitle"><h1>Kelola Submenu</h1>
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
                @if($count != 0)
                <a class="btn btn-mini btn-primary pull-left" href="{{ URL::to('/admin/create_submenu')}}">Tambah Submenu Baru</a>
                <fieldset>

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
                    <th>Nama Menu</th>
                    <th>Sub Menu</th>
                    <th></th>
                </tr>
                </thead>
            </table>

            <div class="footer">
                <div class="footer-left">
                    <span>&copy;2014 Biro Hukum dan Organisasi</span>
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

<script>
  jQuery("#manage-menu > #kelola_submenu > a").addClass("sub-menu-active");
  jQuery("#manage-menu").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Kelola Submenu"
  });
</script>
@stop
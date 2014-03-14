@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Kelola Menu</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-notebook"></span></div>
        <div class="pagetitle"><h1>Kelola Menu</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>

            <form class="form-inline">
                <a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/admin/create_menu')}}">Tambah Menu Baru</a>
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

            <table id="table_menu" class="table">
                <thead>
                <tr>
                    <th>Nama Menu</th>
<!--                    <th>Sub Menu</th>-->
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
<script src="{{asset('assets/js/management_menu.js')}}"></script>

<script>
  jQuery("#manage-menu > #menu > a").addClass("sub-menu-active");
  jQuery("#manage-menu").css({
    "display": "block",
    "visibility": "visible"
  });
</script>
@stop
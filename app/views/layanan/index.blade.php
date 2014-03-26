@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Kelola Konten Layanan</li>
    </ul>

    @include('adminflash')

    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-settings"></span></div>
        <div class="pagetitle">
          <h1>Kelola Konten Layanan</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>

            <form class="form-inline">
                <a class="btn btn-mini btn-primary pull-left" href="{{ URL::to('/admin/layanan/create')}}">Tambah Konten Layanan Baru</a>
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
                    <th>Nama Menu</th>
                    <th>Nama Submenu</th>
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

<!-- dialog box -->
<div id="dialog" title="Hapus Menu" style="display: none;">
    <p>Apakah Anda Yakin?</p>
</div>

@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/layanan_index.js')}}"></script>

<script>
  jQuery("#manage-menu > li:nth-child(4) > a").addClass("sub-menu-active");
  jQuery("#manage-menu").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Kelola Konten Layanan"
  });
</script>
@stop
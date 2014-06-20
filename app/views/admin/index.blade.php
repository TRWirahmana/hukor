@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Kelola Akun</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
<!--        <form action="results.html" method="post" class="searchbar">-->
<!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
<!--        </form>-->
        <div class="pageicon"><span class="rulycon-user"></span></div>
        <div class="pagetitle">
          <h1>Akun</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

          <style>
            #table_admin tr td:last-child {
              width: 80px !important;
              text-align: center;
            }
          </style>

            <!-- MAIN CONTENT -->
          <div class="row-fluid" style="margin-bottom: 12px;">
            <a class="btn btn-mini btn-primary" href="{{ URL::to('/admin/account/create')}}">Tambah Akun Baru</a>
          </div>

            <form class="form-inline" style="margin-bottom: 8px;">
                <fieldset>
                    <label for="select_role" class="control-label">Tipe Pengguna</label>
                    <select id="select_role">
                        <option value="0">Semua Pengguna</option>
                        <option value="2">Pengguna</option>
                        <option value="3">Super Admin</option>
                        <option value="6">Admin Peraturan Perundang-Undangan</option>
                        <option value="7">Admin Pelembagaan</option>
                        <option value="8">Admin Bantuan Hukum</option>
                        <option value="9">Admin Ketatalaksanaan</option>
                    </select>
                </fieldset>
            </form>
<br>
            <table id="table_admin" class="table">
                <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
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
<div id="dialog" title="Hapus Akun" style="display: none;">
    <p>Apakah Anda yakin menghapus akun ini?</p>
</div>

@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/admin_index.js')}}"></script>

<!--<style>-->
<!--    .leftmenu .nav-tabs.nav-stacked > li.dropdown ul {-->
<!--        display: block !important;-->
<!--    }-->
<!--    #produkhukum, #ketatalaksanaan, #bahu, #puu, #diskusi, #callcenter, #app, #kelembagaan, #manage-menu{-->
<!--        display: none !important;-->
<!--    }-->
<!--    #kelola{-->
<!--        background: #0866C6;-->
<!--    }-->
<!--</style>-->

<script>
  jQuery("#kelola > a").addClass("sub-menu-active");
  jQuery("#manage").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Kelola Akun"
  });
</script>
@stop
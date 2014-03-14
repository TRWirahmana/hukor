@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Dokumentasi</li>
    </ul>

    @include('adminflash')
    <?php $user = Auth::user(); ?>
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-wrench"></span></div>
        <div class="pagetitle">
          <h1>Dokumentasi</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">
          <style>
            #basictable tr td:last-child {
              width: 80px !important;
              text-align: center;
            }
          </style>

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>
            @if($user->role_id == 3)
            <a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('admin/adddoc')}}">Tambah Baru</a>
            @endif
            <legend></legend>

            <table id="basictable" class="dataTable table">
                <thead>
                <tr>
                    <th>Nomor</th>
<!--                    <th>Tanggal</th>-->
                    <th>Tentang</th>
                    <th>Kategori</th>
                    <th>Masalah</th>
                    <th>Publikasi</th>
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

@section('scripts')
@parent
<script>
  jQuery("#app_ketatalaksanaan > ul > li:nth-child(3) > a").addClass("sub-menu-active");
  jQuery(".leftmenu .dropdown > #app, #app_ketatalaksanaan > ul").css({
    "display": "block",
    "visibility": "visible"
  });
</script>
<script type="text/javascript">
    var $ = jQuery.noConflict();
    var tbl_data = $("#basictable").dataTable({
        bFilter: true,
        bInfo: false,
        bSort: false,
        bPaginate: true,
        bLengthChange: true,
        bServerSide: true,
        bProcessing: true,
//                sAjaxSource: baseUrl + "/lkpm/data",
        sAjaxSource: '<?php echo URL::to("admin/tabledoc"); ?>',
        aoColumns: [
            {mData: "nomor", sClass: "center", sWidth: '15%',},
//            {mData: "tgl_pengesahan", sClass: "center"},
            {mData: "perihal", sWidth: '30%'},
            {
                mData: "kategori",
                sClass: "center",
                sWidth: '15%',
                mRender:function(kat){
                    var kategori = "";
                    switch (parseInt(kat))
                    {
                        case 1 :
                            kategori = 'Undang-undang Dasar';
                            break;
                        case 2 :
                            kategori = 'Peraturan Pemerintah';
                            break;
                        case 3 :
                            kategori = 'Peraturan Presiden';
                            break;
                        case 4 :
                            kategori = 'Keputusan Presiden';
                            break;
                        case 5 :
                            kategori = 'Instruksi Presiden';
                            break;
                        case 6 :
                            kategori = 'Peraturan Menteri';
                            break;
                        case 7 :
                            kategori = 'Keputusan Menteri';
                            break;
                        case 8 :
                            kategori = 'Instruksi Menteri';
                            break;
                        case 9 :
                            kategori = 'Surat Edaran Menteri';
                            break;
                        case 10 :
                            kategori = 'Nota Kesepakatan';
                            break;
                        case 11 :
                            kategori = 'Nota Kesepahaman';
                            break;
                        case 12 :
                            kategori = 'Peraturan Bersama';
                            break;
                        case 13 :
                            kategori = 'Keputusan Bersama';
                            break;
                        case 14 :
                            kategori = 'Surat Edaran Bersama';
                            break;
                    }

                    return kategori;
                }
            },
            {
                mData: "masalah",
                sClass: "center",
                sWidth: '15%',
                mRender:function(mas){
                    var masalah = "";
                    switch (parseInt(mas))
                    {
                        case 1 :
                            masalah = 'Kepegawaian';
                            break;
                        case 2 :
                            masalah = 'Keuangan';
                            break;
                        case 3 :
                            masalah = 'Organisasi';
                            break;
                        case 4 :
                            masalah = 'Umum';
                            break;
                        case 5 :
                            masalah = 'Perlengkapan';
                            break;
                        case 6 :
                            masalah = 'Lainnya';
                            break;
                    }

                    return masalah;
                }
            },
            {
                mData: "status_publish",
                sClass: "center",
                sWidth: '10%',
                mRender:function(status){
                    var publish;
                    if(status == 0)
                    {
                        publish = '-';
                    }
                    else
                    {
                        publish = 'Ya';
                    }
                    return publish;
                }
            },
            {
                mData: "id",
                sClass: "center",
                sWidth: '15%',
                mRender: function(data){
                    var detailUrl = "<?php echo URL::to('admin/detaildoc'); ?>" + "/" + data;
                    var updateUrl = "<?php echo URL::to('admin/editdoc'); ?>" + "/" + data;
                    var publishUrl = "<?php echo URL::to('admin/publishdoc'); ?>" + "/" + data;
                    var deleteUrl = "<?php echo URL::to('admin/deletedoc'); ?>" + "/" + data;

                    return '<a href="' + detailUrl + '" title="Detail"><i class="rulycon-file"></i></a> &nbsp;' +
                        '<a href="' + publishUrl + '" title="Publish"><i class="rulycon-arrow-up"></i></a> &nbsp;' +
                        '<a href="' + updateUrl + '" title="Update"><i class="rulycon-pencil"></i></a> &nbsp;' +
                        '<a href="' + deleteUrl + '" title="Delete" class="btn_delete"><i class="rulycon-remove-2"></i></a>';
                }
            }
        ],
        fnServerParams: function(aoData) {
//                    aoData.push({name: "tahun", value: $("#select_filter_tahun").val()});
//                    aoData.push({name: "id_prop", value: $("#select_filter_provinsi").val()});
        },
        fnServerData: function(sSource, aoData, fnCallback) {
            $.getJSON(sSource, aoData, function(json) {
                $("#text-tahun").text(json.tahun);
                fnCallback(json);
            });
        }
    });
</script>

<script>
  jQuery("#app_ketatalaksanaan > ul > li:last-child > a").addClass("sub-menu-active");
  jQuery("#app, #app_ketatalaksanaan > ul").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

@stop
@stop

@section('styles');
@parent
@stop
@section('admin')

@include('flash')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Aplikasi</a>  <span class="separator"></span></li>
        <li>Ketatalaksanaan</li>
    </ul>

    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-notebook"></span></div>
        <div class="pagetitle"><h1>Ketatalaksanaan</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="stripe-accent"></div>
                <a class="btn btn-mini btn-primary" href="{{ URL::to('admin/addketatalaksanaan')}}" >Tambah Baru</a>
            <legend></legend>

            <style>
                #basictable tr td:last-child {
                    width: 80px !important;
                    text-align: center;
                }
            </style>

            <table id="basictable" class="dataTable table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Produk</th>
                    <th>Unit</th>
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
<div id="dialog" title="Hapus Bantuan Hukum" style="display: none;">
    <p>Apakah Anda Yakin?</p>
</div>

@section('scripts')
@parent
<script type="text/javascript">
    var $ = jQuery.noConflict();
    jQuery( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    }).val();

    var tbl_data = jQuery("#basictable").dataTable({
        bServerSide: true,
        bFilter:true,
        bInfo: true,
        bLengthChange: false,
        bProcessing: true,
        bPaginate: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
            "sEmptyTable": "Data Kosong",
            "sSearch":       "Cari:",
            "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
            "sProcessing": 'Memproses...',
            "sZeroRecords" : "Pencarian Tidak Ditemukan"
        },
        sAjaxSource: '<?php echo URL::to("admin/tableketatalaksanaan"); ?>',
        aoColumns: [
            {
                mData: "id",
                sWidth: "1%"
            },
            {
                mData: "produk",
                sWidth: "29%",
                mRender: function(data, type, full){
                    switch (data)
                    {
                        case '1':
                            return "Uraian Jabatan";
                            break;
                        case '2':
                            return "Daftar Jabatan";
                            break;
                        case '3':
                            return "Kamus Jabatan";
                            break;
                        case '4':
                            return "Indeks Kepuasan Masyarakat";
                            break;
                        case '5':
                            return "Prosedur Operasional Standard";
                            break;
                        case '6':
                            return "Standard Layanan";
                            break;
                    }
                }
            },
            {
                mData: "unit",
                sWidth: "60%"
            },
            {
                mData: "id",
                sWidth: "10%",
                mRender: function(data, type, full){
                    var updateUrl = "<?php echo URL::to('admin/editketatalaksanaan'); ?>" + "/" + data;
                    var downloadUrl = "<?php echo URL::to('admin/downloadketatalaksanaan'); ?>" + "/" + data;
                    var deleteUrl = "<?php echo URL::to('admin/deleteketatalaksanaan'); ?>" + "/" + data;

                    if(role == 3){
                        return '<a href="' + downloadUrl + '" title="Unduh"><i class="icon-download "></i></a> &nbsp;' +
                            '<a href="' + updateUrl + '" title="Ubah"><i class="icon-edit"></i></a> &nbsp;' +
                            '<a href="' + deleteUrl + '" title="Hapus" class="btn_delete"><i class="icon-trash"></i></a>';
                    }else{
                        return '<a href="' + downloadUrl + '" title="Unduh"><i class="icon-download "></i></a> &nbsp;';
                    }
                }
            }
        ],
        fnServerParams: function(aoData) {
//            aoData.push({name: "jenis_perkara", value: jQuery("#jenis-perkara").val()});
//            aoData.push({name: "status_pemohon", value: jQuery("#status-pemohon").val()});
//            aoData.push({name: "advokasi", value: jQuery("#advokasi").val()});
        },
        "fnDrawCallback": function ( oSettings ) {
            /* Need to redo the counters if filtered or sorted */
            if ( oSettings.bSorted || oSettings.bFiltered )
            {
                for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                {
                    $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                }
            }
        },
        fnServerData: function(sSource, aoData, fnCallback) {
            jQuery.getJSON(sSource, aoData, function(json) {
                jQuery("#text-tahun").text(json.tahun);
                fnCallback(json);
            });
        }
    });

    $("#basictable").on('click', '.btn_delete', function (e) {
        var delkodel = $(this);
        $('#dialog').dialog({
            width: 500,
            modal: true,
            buttons: {
                "Hapus" : function(){
                    window.location.replace(delkodel.attr('href'));
                    $(this).dialog("close");
                },
                "Batal" : function() {
                    $(this).dialog("close");
                }
            }
        });
        e.preventDefault();
    });

    jQuery("#jenis-perkara").change(function(){
        tbl_data.fnReloadAjax();
    });

    jQuery("#status-pemohon").change(function(){
        tbl_data.fnReloadAjax();
    });

    jQuery("#advokasi").change(function(){
        tbl_data.fnReloadAjax();
    });

    jQuery("#print").click(function(){

    });
</script>

<script>
    jQuery("#app_ketatalaksanaan > a").addClass("sub-menu-active");
    jQuery("#app").css({
        "display": "block",
        "visibility": "visible"
    });
</script>

<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Ketatalaksanaan"
    });
</script>
@stop
@stop

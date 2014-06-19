@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="#">Produk Hukum</a> <span class="separator"></span></li>
        <li>Semua Peraturan</li>
    </ul>

    @include('adminflash')
    <?php $user = Auth::user(); ?>
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-notebook"></span></div>
        <div class="pagetitle">
          <h1>Peraturan</h1>
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
            <form id="form-filter" class="form form-horizontal" method="post" action="{{ URL::action('DocumentController@printToPDF') }}" style="margin-bottom: 25px;">
                <fieldset>
                    <legend class="f_legend"></legend>
                    <div class="row-fluid">
                        <div class="span6">
                            <div class="control-group">
                                <label for="" class="control-label">Tahun</label>
                                <div class="controls">
                                    {{ Form::select('tahun', $tahun, null, array('id' => 'tahun')) }}
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="toDate" class="control-label">Kategori</label>
                                <div class="controls">
                                    {{ Form::select('kategori', array(
                                    '0' => '- Pilih Kategori -',
                                    '1' => 'Undang-undang Dasar',
                                    '2' => 'Peraturan Pemerintah',
                                    '3' => 'Peraturan Presiden',
                                    '4' => 'Keputusan Presiden',
                                    '5' => 'Instruksi Presiden',
                                    '6' => 'Peraturan Menteri',
                                    '7' => 'Keputusan Menteri',
                                    '8' => 'Instruksi Menteri',
                                    '9' => 'Surat Edaran Menteri',
                                    '10' => 'Nota Kesepahaman',
                                    '11' => 'Kesepakatan Bersama',
                                    '12' => 'Peraturan Bersama',
                                    '13' => 'Keputusan Bersama',
                                    '14' => 'Surat Edaran Bersama',
                                    '15' => 'Peraturan Lain',
                                    ), null, array('id' => 'kategori')) }}
                                </div>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <input type="reset" value="Reset" class="btn btn-primary" id="btn-reset">
                                    <input type="submit" value="Cetak" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>
            <a class="btn btn-mini btn-primary" href="{{ URL::to('admin/adddoc')}}" >Tambah Baru</a>
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

<!-- dialog box -->
<div id="dialog" title="Hapus Peraturan" style="display: none;">
    <p>Apakah anda yakin untuk menghapus peraturan ini?</p>
</div>

@section('scripts')
@parent
<script type="text/javascript">
    var $ = jQuery.noConflict();
    var tbl_data = $("#basictable").dataTable({
        bServerSide: true,
        bProcessing: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Peraturan",
            "sEmptyTable": "Data Kosong",
            "sSearch":       "Cari:",
            "sZeroRecords" : "Pencarian Tidak Ditemukan",
            "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
            "sProcessing": 'Memproses...',
            "oPaginate": {
                "sNext": "<span class='rulycon-forward-3'></span>",
                "sPrevious": "<span class='rulycon-backward-2'></span>"
            },
            "sLengthMenu": 'Tampilkan <select>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '</select> Peraturan'

        },
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
                        publish = 'Tidak';
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
                mRender: function(data, type, row){
                    var detailUrl = "<?php echo URL::to('admin/detaildoc'); ?>" + "/" + data;
                    var updateUrl = "<?php echo URL::to('admin/editdoc'); ?>" + "/" + data;
                    var publishUrl = "<?php echo URL::to('admin/publishdoc'); ?>" + "/" + data;
                    var deleteUrl = "<?php echo URL::to('admin/deletedoc'); ?>" + "/" + data;

                    if(row[8] != null || row[8] != "")
                    {
                        return '<a href="' + detailUrl + '" title="Detail"><i class="rulycon-file"></i></a> &nbsp;' +
                            '<a href="' + publishUrl + '" title="Publish"><i class="rulycon-arrow-up"></i></a> &nbsp;' +
                            '<a href="' + updateUrl + '" title="Ubah"><i class="rulycon-pencil"></i></a> &nbsp;' +
                            '<a href="' + deleteUrl + '" title="Hapus" class="btn_delete"><i class="rulycon-remove-2"></i></a>';
                    }
                    else
                    {
                        return '<a href="' + detailUrl + '" title="Detail"><i class="rulycon-file"></i></a> &nbsp;' +
                            '<a href="' + publishUrl + '" title="Publish"><i class="rulycon-arrow-up"></i></a> &nbsp;' +
                            '<a href="' + updateUrl + '" title="Ubah"><i class="rulycon-pencil"></i></a> &nbsp;';
                    }
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
</script>

<script>
  jQuery("#produk-hukum > li:first-child").addClass("sub-menu-active");
  jQuery("#produk-hukum").css({
    "display": "block",
    "visibility": "visible"
  });

  $(document).on("ready", function() {
      document.title = "Layanan Biro Hukum dan Organisasi | Produk Hukum";
  });
</script>

@stop
@stop

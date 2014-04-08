@section('styles');
@parent
@stop
@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Aplikasi</a>  <span class="separator"></span></li>
        <li>Bantuan Hukum</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-notebook"></span></div>
        <div class="pagetitle"><h1>Bantuan Hukum</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            {{ Form::open(array('action' => 'BantuanHukumController@convertpdf', 'method' => 'post',
            'id' => 'pdf-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal')) }}
	<fieldset style="margin-bottom: 48px;">

            <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                        <label for="status-pemohon" class="control-label">Status Pemohon</label>
                        <div class="controls">
                            <select id="status-pemohon">
                                <option value="0">Tampilkan Semua</option>
                                <option value="1">Tergugat</option>
                                <option value="2">Penggugat</option>
                                <option value="3">Interfent</option>
                                <option value="4">Saksi</option>
                                <option value="5">Pemohon</option>
                            </select>
                         </div>
   	        </div>
                <div class="control-group">
                        <label for="jenis-perkara" class="control-label">Jenis Perkara</label>
                        <div class="controls">
                            <select id="jenis-perkara">
                                <option value="0">Tampilkan Semua</option>
                                <option value="1">Tata Usaha Negara</option>
                                <option value="2">Perdata</option>
                                <option value="3">Pidana</option>
                                <option value="4">Uji Materil Mahkamah Konstitusi</option>
                                <option value="5">Uji Materil Mahkamah Agung</option>
                            </select>
                        </div>
               </div>
               <div class="control-group">
                        <label for="advokasi" class="control-label">Advokasi</label>
                       <div class="controls">
                            <select id="advokasi">
                                <option value="0">Tampilkan Semua</option>
                                <option value="1">Bankum I</option>
                                <option value="2">Bankum II</option>
                                <option value="3">Bankum III</option>
                            </select>
                        </div>
		</div>
	</div>
             
	<div class="span6">
	    <div class="control-group">
                     	{{ Form::label('start-date', 'Tanggal Awal', array('class' => 'control-label')) }}
                        <div class="controls">
                         {{ Form::text('start_date', '', array('id' => 'start-date', 'class' => 'datepicker')) }}
                        </div>
            </div>
            <div class="control-group">
                     {{ Form::label('end-date', 'Tanggal Akhir', array('class' => 'control-label')) }}
                	<div class="controls">
                   	 {{ Form::text('end_date', '', array('id' => 'end-date', 'class' => 'datepicker')) }}
            	   	</div>
            </div>
	   <div class="control-group">
			<div class="controls">
                <input type="reset" value="Reset" class="btn btn-primary" id="btn-reset">
                <input class="btn btn-primary btn-primary" type="submit" value="Cetak">
			</div>
           </div>
	</div>
        </div>
	</fieldset>
            {{ Form::close() }}

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
                    <th>Nama Pemohon</th>
                    <th>Jenis Perkara</th>
                    <th>Status Pemohon</th>
                    <th>Status Perkara</th>
                    <th>Advokasi</th>
<!--                    <th>Advokator</th>-->
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
            "sZeroRecords" : "Pencarian Tidak Ditemukan"
        },
        sAjaxSource: '<?php echo URL::to("admin/bantuan_hukum/datatable"); ?>',
        aoColumns: [
            {
                mData: "id",
                sWidth: "1%"
            },
            {mData: "pengguna.nama_lengkap"},
            {
                mData: "jenis_perkara",
                sClass: "center",
                mRender: function(id){
                    var jenis_perkara;
                    switch (parseInt(id)){
                        case 1:
                            jenis_perkara = 'Tata Usaha Negara';
                            break;
                        case 2:
                            jenis_perkara = 'Perdata';
                            break;
                        case 3:
                            jenis_perkara = 'Pidana';
                            break;
                        case 4:
                            jenis_perkara = 'Uji Materil Mahkamah Konstitusi';
                            break;
                        case 5:
                            jenis_perkara = 'Uji Materil Mahkamah Agung';
                            break;
                    }

                    return jenis_perkara;
                }
            },
            {
                mData: "status_pemohon",
                sClass: "center",
                mRender: function(id){
                    var status_pemohon;
                    switch (parseInt(id)){
                        case 1:
                            status_pemohon = 'Tergugat';
                            break;
                        case 2:
                            status_pemohon = 'Penggugat';
                            break;
                        case 3:
                            status_pemohon = 'Interfent';
                            break;
                        case 4:
                            status_pemohon = 'Saksi';
                            break;
                        case 5:
                            status_pemohon = 'Pemohon';
                            break;
                    }

                    return status_pemohon;
                }
            },
            {mData: "status_perkara", sClass: "center"},
            {
                mData: "advokasi",
                mRender: function(id){
                    var advokasi;
                    switch (parseInt(id)){
                        case 1:
                            advokasi = "Bankum I";
                            break;
                        case 2:
                            advokasi = "Bankum II";
                            break;
                        case 3:
                            advokasi = "Bankum III";
                            break;
                        default:
                            advokasi = "Belum Diadvokasi";
                            break;
                    }

                    return advokasi;
                }
            },
//            {mData: "advokator", sClass: "center"},
            {
                mData: "id",
                mRender: function(data, type, full){
                    var detailUrl = baseUrl + '/admin/bantuan_hukum/detail/' + data;
                    var deleteUrl = baseUrl + '/admin/bantuan_hukum/delete/' + data;
                    var downloadUrl = baseUrl + '/bantuan_hukum/download/' + data;

                    if(role == 3 || role == 8){
                        if(full.lampiran == null || full.lampiran == 'a:0:{}'){
                            return '<a href="' + detailUrl + '" title="Detail"><i class="icon-edit"></i></a> &nbsp;' +
                                '<a href="' + deleteUrl + '" title="Hapus" class="btn_delete"><i class="icon-trash"></i></a>';
                        }else{
                            return '<a href="' + downloadUrl + '" title="Unduh"><i class="icon-download "></i></a> &nbsp;' +
                                '<a href="' + detailUrl + '" title="Detail"><i class="icon-edit"></i></a> &nbsp;' +
                                '<a href="' + deleteUrl + '" title="Hapus" class="btn_delete"><i class="icon-trash"></i></a>';
                        }

                    }
                }
            }
        ],
        fnServerParams: function(aoData) {
            aoData.push({name: "jenis_perkara", value: jQuery("#jenis-perkara").val()});
            aoData.push({name: "status_pemohon", value: jQuery("#status-pemohon").val()});
            aoData.push({name: "advokasi", value: jQuery("#advokasi").val()});
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
  jQuery("#app_bahu > a").addClass("sub-menu-active");
  jQuery("#app").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Bantuan Hukum";
  });
</script>
@stop
@stop

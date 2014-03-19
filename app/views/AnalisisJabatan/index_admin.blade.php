@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Informasi</a> <span class="separator"></span></li>
        <li>Analisis Jabatan</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-notebook"></span></div>
        <div class="pagetitle">
          <h1>ANALISIS JABATAN</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->

            <div class="content-non-title">
                <form id="form-filter" class="form form-horizontal" action="{{URL::route('admin.aj.printTable')}}">
                    <fieldset>
                        <legend class="f_legend">Filter</legend>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="control-group">
                                    <label for="" class="control-label">Tanggal Awal</label>
                                    <div class="controls">
                                        <input type="text" id="first-date" name="firstDate">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="toDate" class="control-label">Tanggal Akhir</label>
                                    <div class="controls">
                                        <input type="text" id="last-date" name="lastDate">
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label for="select-status" class="control-label">Status</label>
                                    <div class="controls">
                                        <select id="select-status" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="1">Diproses</option>
                                            <option value="2">Ditunda</option>
                                            <option value="3">Ditolak</option>
                                            <option value="4">Buat Salinan</option>
                                            <option value="5">Penetapan</option>
                                        </select>        
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

                <table id="tbl-per-uu" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl Usulan</th>
                            <th>Unit Kerja</th>
                            <th>Jabatan</th>
                            <th>Perihal</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
              <style>
                table.dataTable tr td:nth-child(6) {
                  text-align: center;
                }
              </style>

                <!-- END OF MAIN CONTENT -->

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
    <script src="{{asset('assets/js/ZeroClipboard.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/TableTools-2.2.0/js/dataTables.tableTools.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(function($) {
            $("#menu-peraturan-perundangan").addClass("active");

            $("#first-date").datepicker({
                dateFormat: "dd/mm/yy",
                onClose: function( selectedDate ) {
                    $("#last-date").datepicker( "option", "minDate", selectedDate );
                }
            });
            $("#last-date").datepicker({
                dateFormat: "dd/mm/yy",
                onClose: function( selectedDate ) {
                    $("#first-date").datepicker("option", "maxDate", selectedDate);
                }                    
            });

            $dataTable = $("#tbl-per-uu").dataTable({
                // sDom: 'Trtip',
                // oTableTools: {
                //     sSwfPath: "/assets/TableTools-2.2.0/swf/copy_csv_xls_pdf.swf"
                // },
                bServerSide: true,
                sAjaxSource: document.location.href,
                bFilter: true,
                bInfo: true,
                bLengthChange: false,
                oLanguage:{
                    "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Peraturan",
                    "sEmptyTable": "Data Kosong",
                    "sZeroRecords" : "Pencarian Tidak Ditemukan"
                },
                aoColumns: [
                    {
                        mData: "id",
                        sWidth: "1%"
                    },
                    {
                        mData: "tgl_usulan",
                        sWidth: "10%",
                        mRender: function(data) {
                            return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                        }
                    },
                    {
                        mData: "unit_kerja",
                        sWidth: "10%"
                    },
                    {
                        mData: "nama_jabatan",
                        sWidth: "10%"
                    },
                    {
                        mData: "perihal",
                        sWidth: "30%"
                    },
                    {
                        mData: "status",
                        sWidth: "10%",
                        mRender: function(data) {
                            switch (parseInt(data)) {
                                case 1:
                                    return "Diproses";
                                    break;
                                case 2:
                                    return "Ditunda";
                                    break;
                                case 3:
                                    return "Ditolak";
                                    break;
                                case 4:
                                    return "Buat salinan";
                                    break;
                                case 5:
                                    return "Penetapan";
                                    break;
                                default:
                                    return " ";
                                    break;
                            }
                            ;
                        }
                    },
                    {
                        mData: 'id',
                        sWidth: "8%",
                        mRender: function(data, type, all) {
                            var html = ["<a href='"+baseUrl+"/aj/download/" + data + "' title='Unduh'><i class='icon-download'></i></a>"];
                            if(all._role_id == 3 || all._role_id == 9) {
                                html.push("<a href='"+baseUrl+"/admin/aj/" + data + "/edit' title='Ubah'><i class='icon-edit'></i></a> ");
                                html.push("<a data-delete href='"+baseUrl+"/admin/aj/" + data + "' title='Hapus'><i class='icon-trash'></i></a>")
                            }
                            return html.join("&nbsp;");
                        }
                    }
                ],
                fnServerParams: function(aoData) {
                    aoData.push({name: "status", value: $("#select-status").val()});
                    aoData.push({name: "firstDate", value: $("#first-date").val()});
                    aoData.push({name: "lastDate", value: $("#last-date").val()});
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
                }
            });

            $dataTable.on('click', 'a[data-delete]', function(e) {
                if (!confirm('Apakah anda yakin?'))
                    return;
                $.post($(this).attr('href'), {_method: 'delete'}, function(r) {
                    $dataTable.fnReloadAjax();
                });
                e.preventDefault();
            });

            $("#select-status, #first-date, #last-date").change(function() {
                $dataTable.fnReloadAjax();
            });

            $("#form-filter").on("reset", function(){
                $dataTable.fnReloadAjax();
            });

        });




    </script>
</div>

<script>
  jQuery("#app_ketatalaksanaan > ul > li:nth-child(2) > a").addClass("sub-menu-active");
  jQuery("#app, #app_ketatalaksanaan > ul").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

@stop

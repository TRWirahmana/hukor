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
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>ANALISIS JABATAN</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->

            <div class="content-non-title">
                <form id="form-filter" class="form form-horizontal" action="{{URL::route('print_analisis_jabatan')}}">
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

                <table id="tbl-per-uu">
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

                <!-- END OF MAIN CONTENT -->

                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2013. Admin Template. All Rights Reserved.</span>
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
                bFilter: false,
                bLengthChange: false,
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
                            return "<a href='analisisJabatan/download/" + data + "'><i class='icon-download'></i></a> " +
                                    "<a href='analisisJabatan/update/" + data + "'><i class='icon-edit'></i></a> " +
                                    "<a class='delete' href='javascript:void(0)' data-id='" + data + "'><i class='icon-trash'></i></a>";
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

            $dataTable.on('click', '.delete', function() {
                if (!confirm('Apakah anda yakin?'))
                    return;

                var id = $(this).data('id');
                $.post('analisisJabatan/delete', {id: id}, function() {
                    $dataTable.fnReloadAjax();
                });
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

@stop
@section('content')

<h2><span class="rulycon-library"></span>Ketatalaksanaan</h2>
<div class="stripe-accent"></div>
<legend>Informasi & Status Usulan Sistem dan Prosedur</legend>

@include('flash')
<div class="content-non-title">
 <table id="tbl-sistem-dan-prosedur">
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
</div>
@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
 jQuery(function($) {
            $("#menu-peraturan-perundangan").addClass("active");

            $dataTable = $("#tbl-sistem-dan-prosedur").dataTable({
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
				if(all._role_id != null) 
					return "<a href='"+baseUrl+"/sp/download/" + data + "'><i class='icon-download'></i></a> ";
				return "";
			}
                    }
                ],
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

});

</script>

<script>
  $("#collapse12").css("height", "auto");
  $("#menu-pelembagaan-informasi2").addClass("user-menu-active");
</script>

@stop

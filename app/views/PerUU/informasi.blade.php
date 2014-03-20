@section('content')

<!--PERATURAN PERUNDANG-UNDANGAN-->
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Peraturan perundang-undangan";
</script>

<legend>Status Usulan</legend>

@include('flash')
<div class="content-non-title">
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
  <style>
    table.dataTable tr td:nth-child(6) {
      text-align: center;
    }
  </style>
</div>
@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
$("#menu-peraturan-perundangan").addClass("active");
        jQuery(function($) {
            $("#menu-peraturan-perundangan").addClass("active");


            $dataTable = $("#tbl-per-uu").dataTable({
                // sDom: 'Trtip',
                // oTableTools: {
                //     sSwfPath: "/assets/TableTools-2.2.0/swf/copy_csv_xls_pdf.swf"
                // },
                bServerSide: true,
                sAjaxSource: document.location.href,
                bFilter: true,
                bLengthChange: false,
                oLanguage:{
                    "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
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
				if(all._role_id != null) {
					return "<a href='"+baseUrl+"/puu/download/" + data + "' title='Unduh'><i class='icon-download'></i></a> ";
				}
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
  $("#collapse10").css("height", "auto");
  $("#menu-peruu-informasi").addClass("user-menu-active");
</script>

@stop

@section('content')

<!--PERATURAN PERUNDANG-UNDANGAN-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Status Usulan Per-UU";
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
<!--                            <th>Jabatan</th>-->
                            <th>Usulan</th>
                            <th>Status</th>
                            @if($role_id == null)
                            @else
                            <th></th>
                            @endif
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

            var roles = '<?php echo $role_id; ?>';
            if(roles == null)
            roles = 0;

            if(roles == 0){
                $dataTable = $("#tbl-per-uu").dataTable({
                    bServerSide: true,
                    sAjaxSource: document.location.href,
                    bFilter: true,
                    bProcessing: true,
                    oLanguage:{
                        "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                        "sEmptyTable": "Data Kosong",
                        "sZeroRecords" : "Pencarian Tidak Ditemukan",
                        "sSearch":       "Cari:",
                        "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
                        "sProcessing": 'Memproses...',
                        "oPaginate": {
                            "sFirst": "<span class='rulycon-forward-3'></span>",
                            "sNext": "<span class='rulycon-forward-3'></span>",
                            "sPrevious": "<span class='rulycon-backward-2'></span>",
                            "sLast": "<span class='rulycon-backward-2'></span>"
                        },
                        "sLengthMenu": 'Tampilkan <select>'+
                            '<option value="10">10</option>'+
                            '<option value="25">25</option>'+
                            '<option value="50">50</option>'+
                            '<option value="100">100</option>'+
                            '</select> Usulan'
                    },
                    aoColumns: [
                        {
                            mData: "id",
                            sWidth: "1%"
                        },
                        {
                            mData: "tgl_usulan",
                            sWidth: "10%",
                            sClass: "center",
                            mRender: function(data) {
                                return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                            }
                        },
                        {
                            mData: "unit_kerja",
                            sWidth: "10%"
                        },
//                        {
//                            mData: "nama_jabatan",
//                            sWidth: "10%"
//                        },
                        {
                            mData: "perihal",
                            sWidth: "30%"
                        },
                        {
                            mData: "status",
                            sWidth: "10%",
                            sClass: "center",
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
                                        return "Belum Diproses";
                                        break;
                                }
                                ;
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
            }else{
                $dataTable = $("#tbl-per-uu").dataTable({
                    // sDom: 'Trtip',
                    // oTableTools: {
                    //     sSwfPath: "/assets/TableTools-2.2.0/swf/copy_csv_xls_pdf.swf"
                    // },
                    bServerSide: true,
                    sAjaxSource: document.location.href,
                    bFilter: true,
                    bProcessing: true,
                    oLanguage:{
                        "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                        "sEmptyTable": "Data Kosong",
                        "sZeroRecords" : "Pencarian Tidak Ditemukan",
                        "sSearch":       "Cari:",
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
                            '</select> Usulan'
                    },
                    aoColumns: [
                        {
                            mData: "id",
                            sWidth: "1%"
                        },
                        {
                            mData: "tgl_usulan",
                            sWidth: "10%",
                            sClass: "center",
                            mRender: function(data) {
                                return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                            }
                        },
                        {
                            mData: "unit_kerja",
                            sWidth: "10%"
                        },
//                        {
//                            mData: "nama_jabatan",
//                            sWidth: "10%"
//                        },
                        {
                            mData: "perihal",
                            sWidth: "30%"
                        },
                        {
                            mData: "status",
                            sWidth: "10%",
                            sClass: "center",
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
                                        return "Belum Diproses ";
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
                                    if(all.lampiran == null || all.lampiran == "a:0:{}"){
                                        return "<a href='"+baseUrl+"/puu/puu/" + data + "/edit'  title='Ubah'><i class='icon-edit'></i></a>";
                                    }else{
                                        return "<a href='"+baseUrl+"/puu/download/" + data + "' title='Unduh'><i class='icon-download'></i></a> "+
                                            "<a href='"+baseUrl+"/puu/puu/" + data + "/edit'  title='Ubah'><i class='icon-edit'></i></a>";
                                    }

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
            }



        });





</script>

<script>
  $("#collapse10").css("height", "auto");
  $("#menu-peruu-informasi").addClass("user-menu-active");

</script>

@stop

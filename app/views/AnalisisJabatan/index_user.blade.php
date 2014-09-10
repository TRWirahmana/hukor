@section('content')

<!--Ketatalaksanaan-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Status Usulan Analisis Jabatan";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Analisis Jabatan";
</script>

<legend>Status Usulan</legend>

@include('flash')
<div class="content-non-title">

                <table id="tbl-analisis-jabatan" class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl Usulan</th>
                            <th>Unit Kerja</th>
<!--                            <th>Jabatan</th>-->
                            <th>Jenis Usulan</th>
                            <th>Status</th>
                            @if($role_id != null)
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
    jQuery(function($) {
        $("#menu-peraturan-perundangan").addClass("active");

        var roles = '<?php echo $role_id; ?>';
        var col;
        if(roles){
            col = [
                { mData: "id", sWidth: "1%" },
                { mData: "tgl_usulan", sWidth: "10%",
                    mRender: function(data) {
                        return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                    }
                },
                { mData: "id", sWidth: "10%" },
//                { mData: "nama_jabatan", sWidth: "10%" },
                { mData: "id", sWidth: "30%",
                    mRender: function(data, a, all){
                        switch (parseInt(all.jenis_usulan)) {
                            case 1:
                                return "Uraian Jabatan";
                                break;
                            case 2:
                                return "Peta Jabatan";
                                break;
                            case 3:
                                return "Perhitungan Beban Kerja";
                                break;
                            case 4:
                                return "Evaluasi Jabatan";
                                break;
                            case 5:
                                return "Standar Kompetensi";
                                break;
                            default :
                                return "-";
                                break;
                        }
                    }
                },
                { mData: "status", sWidth: "10%",
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
                    }
                },
                { mData: 'id', sWidth: "8%",
                    mRender: function(data, type, all) {
                        if(all._role_id == 2)
                            if(all.lampiran == null || all.lampiran == 'a:0:{}'){
                                return "<a href='"+baseUrl+"/aj/" + data + "/edit' title='Ubah'><i class='icon-edit'></i></a>";
                            }else{
                                return "<a href='aj/download/" + data + "' title='Unduh'><i class='icon-download'></i></a> " + " " +
                                    "<a href='"+baseUrl+"/aj/" + data + "/edit' title='Ubah'><i class='icon-edit'></i></a> ";
                            }

                        return "";
                    }
                }
            ];
        }else{
            col = [
                { mData: "id",sWidth: "1%" },
                { mData: "tgl_usulan", sWidth: "10%",
                    mRender: function(data) {
                        return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                    }
                },
                { mData: "unit_kerja", sWidth: "10%" },
//                { mData: "nama_jabatan", sWidth: "10%" },
                { mData: "id", sWidth: "30%",
                    mRender: function(data, a, all){
                        switch (parseInt(all.jenis_usulan)) {
                            case 1:
                                return "Uraian Jabatan";
                                break;
                            case 2:
                                return "Peta Jabatan";
                                break;
                            case 3:
                                return "Perhitungan Beban Kerja";
                                break;
                            case 4:
                                return "Evaluasi Jabatan";
                                break;
                            case 5:
                                return "Standar Kompetensi";
                                break;
                            case null:
                                return "-";
                                break;
                        }
                    }
                },
                { mData: "status", sWidth: "10%",
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
                    }
                }
            ];
        }

        $dataTable = $("#tbl-analisis-jabatan").dataTable({
            bServerSide: true,
            sAjaxSource: document.location.href,
            bFilter: true,
            bInfo: true,
            bLengthChange: true,
            bProcessing:true,
            oLanguage:{
                "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                "sEmptyTable": "Data Kosong",
                "sZeroRecords" : "Pencarian Tidak Ditemukan",
                "sSearch":       "Cari:",
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
            aoColumns: col,
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
  $("#menu-anjab-status").addClass("user-menu-active");
</script>

@stop

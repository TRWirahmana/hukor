@section('content')

<!--KETATALAKSANAAN-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Status Usulan Sistem dan Prosedur";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Sistem dan Prosedur";
</script>

<legend><div class="stats">Status Usulan Sistem Prosedur</div></legend>

@include('flash')
<div class="content-non-title">
<!--<div class="row-fluid">-->
<!--<div class="span24">-->
<!--    <div class="control-group">-->
<!--        <label for="jenis_usulan" class="control-label  span3">Jenis Usulan</label>-->
<!---->
<!--        <div class="controls">-->
<!--            <select id="jenis_usulan">-->
<!--                <!--        <option value="0">Pilih Usulan</option>-->
<!--                <option value="1">Sistem dan Prosedur</option>-->
<!--                <option value="2">Analisis Jabatan</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--</div>-->

 <table id="tbl-sistem-dan-prosedur">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl Usulan</th>
                            <th>Unit Kerja</th>
<!--                            <th>Jabatan</th>-->
                            <th>Perihal</th>
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
 jQuery(function($) {
     $("#menu-peraturan-perundangan").addClass("active");

     var roles = '<?php echo $role_id; ?>';
     if(roles == null)
         roles = 0;

     if(roles == 0){
     $dataTable = $("#tbl-sistem-dan-prosedur").dataTable({
         // sDom: 'Trtip',
         // oTableTools: {
         //     sSwfPath: "/assets/TableTools-2.2.0/swf/copy_csv_xls_pdf.swf"
         // },
         bServerSide: true,
         sAjaxSource:  '<?php echo URL::to("sp"); ?>',
         bFilter: true,
         bLengthChange: true,
         bDestroy: true,
         bProcessing:true,
         oLanguage:{
             "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
             "sEmptyTable": "Data Kosong",
             "sZeroRecords" : "Pencarian Tidak Ditemukan",
             "sSearch":       "Cari:",
             "sProcessing": 'Memproses...',
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
                 mRender: function(data) {
                     return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                 }
             },
             {
                 mData: "unit_kerja",
                 sWidth: "10%"
             },
//             {
//                 mData: "nama_jabatan",
//                 sWidth: "10%"
//             },
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
             $dataTable = $("#tbl-sistem-dan-prosedur").dataTable({
                 // sDom: 'Trtip',
                 // oTableTools: {
                 //     sSwfPath: "/assets/TableTools-2.2.0/swf/copy_csv_xls_pdf.swf"
                 // },
                 bServerSide: true,
                 sAjaxSource:  '<?php echo URL::to("sp"); ?>',
                 bFilter: true,
                 bLengthChange: true,
                 bDestroy: true,
                 bProcessing:true,
                 oLanguage:{
                     "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                     "sEmptyTable": "Data Kosong",
                     "sZeroRecords" : "Pencarian Tidak Ditemukan",
                     "sSearch":       "Cari:",
                     "sProcessing": 'Memproses...',
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
                         mRender: function(data) {
                             return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                         }
                     },
                     {
                         mData: "unit_kerja",
                         sWidth: "10%"
                     },
//                     {
//                         mData: "nama_jabatan",
//                         sWidth: "10%"
//                     },
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
                                 return "<a href='"+baseUrl+"/sp/download/" + data + "' title='Unduh'><i class='icon-download'></i></a>" + " " +
                                     "<a href='"+baseUrl+"/sp/" + data + "/edit' title='Ubah'><i class='icon-edit'></i></a>";
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
  $("#collapse14").css("height", "auto");
  $("#menu-prosedur-status").addClass("user-menu-active");
</script>

@stop

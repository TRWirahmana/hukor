@section('content')

<!--Pelembagaan-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Status Usulan Pelembagaan";
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Pelembagaan";
</script>

<legend>Status Usulan</legend>

@include('flash')
<div class="content-non-title">
    <table id="tbl-pelembagaan" class="table">
        <thead>
        <tr>
            <th>#</th>
            <!--                           <th>No Usulan</th> -->
            <th>Tgl Usulan</th>
            <th>Unit Kerja</th>
            <th>Jenis Usulan</th>
            <th>Perihal</th>
            <th>Status</th>
            @if($user->role_id == null)
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
jQuery(function ($) {
    $("#first-date").datepicker({
        dateFormat: "dd/mm/yy",
        onClose: function (selectedDate) {
            $("#last-date").datepicker("option", "minDate", selectedDate);
        }
    });

    $("#last-date").datepicker({
        dateFormat: "dd/mm/yy",
        onClose: function (selectedDate) {
            $("#first-date").datepicker("option", "maxDate", selectedDate);
        }
    });

    //       $(document).ready(function(){
    var role_id = <?php if($user->role_id) echo $user->role_id; else echo '0'; ?>;
    if(role_id == 0){
        $dataTable = $("#tbl-pelembagaan").dataTable({
            bFilter: true,
            bInfo: true,
            //     bInfo: false,
            bSort: false,
            bPaginate: true,
            //   bLengthChange: false,
            bServerSide: true,
            bProcessing: true,
            bLengthChange: true,
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
            sAjaxSource: document.location.href,
            aoColumns: [
                {
                    mData: "id",
                    sClass: 'center-ac',
                    sWidth: '1%'
                },


                {
                    mData: "tgl_usulan",

                    sWidth: '14%',
                    sClass: "center",
                    mRender: function (data) {
                        return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                    }
                },
                {
                    mData: "unit_kerja",
                    sClass: 'center-ac',
                    sWidth: '14%'
                },
                /*
                 {
                 mData: "jabatan" ,
                 sClass: 'center-ac',
                 mRender: function ( data, type, full ) {
                 if (null != data && "" != data){
                 if(data ==='1'){
                 return 'Direktur';
                 }else if(data === '2'){
                 return 'Kepala Divisi';
                 }
                 }
                 return data;
                 }
                 },
                 */
                {
                    mData: "jenis_usulan",
                    sClass: "center",
                    mRender: function (data, type, full) {
                        if (null != data && "" != data) {
                            if (data === '1') {
                                return 'Pendirian';
                            } else if (data === '2') {
                                return 'Perubahan';
                            } else if (data === '3') {
                                return 'Statuta';
                            } else if (data === '4') {
                                return 'Penutupan';
                            }
                            else if (data === '0') {
                                return '-';
                            }
                        }
                    }
                },

                {mData: "perihal"},
                {

                    mData: "status",
                    sClass: "center",
                    mRender: function (data, type, full) {
                        if (null != data && "" != data) {
                            if (data === '1') {
                                return 'proses';
                            } else if (data === '2') {
                                return 'Dikirim ke Bagian Per-UU';
                            }
                        }
                        return 'Belum Diproses';
                    }

                }
            ],

            fnServerParams: function (aoData) {
                aoData.push({name: "status", value: $("#select-status").val()});
                aoData.push({name: "firstDate", value: $("#first-date").val()});
                aoData.push({name: "lastDate", value: $("#last-date").val()});
            },
            fnDrawCallback: function (oSettings) {
                if (oSettings.bSorted || oSettings.bFiltered) {
                    for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                    }
                }
            },

            aoColumnDefs: [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            aaSorting: [
                [ 1, 'asc' ]
            ]

        });
    }else{
        $dataTable = $("#tbl-pelembagaan").dataTable({
            bFilter: true,
            bInfo: true,
            //     bInfo: false,
            bSort: false,
            bPaginate: true,
            //   bLengthChange: false,
            bServerSide: true,
            bProcessing: true,
            bLengthChange: true,
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
            sAjaxSource: document.location.href,
            aoColumns: [
                {
                    mData: "id",
                    sClass: 'center-ac',
                    sWidth: '1%'
                },


                {
                    mData: "tgl_usulan",
                    sClass: 'center',
                    sWidth: '14%',
                    mRender: function (data) {
                        return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
                    }
                },
                {
                    mData: "unit_kerja",
                    sClass: 'center-ac',
                    sWidth: '14%'
                },
                /*
                 {
                 mData: "jabatan" ,
                 sClass: 'center-ac',
                 mRender: function ( data, type, full ) {
                 if (null != data && "" != data){
                 if(data ==='1'){
                 return 'Direktur';
                 }else if(data === '2'){
                 return 'Kepala Divisi';
                 }
                 }
                 return data;
                 }
                 },
                 */
                {
                    mData: "jenis_usulan",
                    sClass: "center",
                    mRender: function (data, type, full) {
                        if (null != data && "" != data) {
                            if (data == '1') {
                                return 'Pendirian';
                            } else if (data == '2') {
                                return 'Perubahan';
                            } else if (data == '3') {
                                return 'Statuta';
                            } else if (data == '4') {
                                return 'Penutupan';
                            }
                        }
                    }
                },

                {mData: "perihal"},
                {

                    mData: "status",
                    sClass: "center",
                    mRender: function (data, type, full) {
                        if (null != data && "" != data) {
                            if (data === '1') {
                                return 'proses';
                            } else if (data === '2') {
                                return 'Dikirim Ke Bagian Per-UU';
                            }
                        }
                        return 'Belum Diproses';
                    }

                },
                {
                    mData: "id",
                    sClass: 'center-ac',
                    sWidth: '10%',
                    mRender: function (data, type, full) {
                        if (role_id == 0) {
//                                          return "<a href='" + baseUrl + '/pelembagaan/download/'+data+ "'> <i class='icon-download'></i></a>";
                        } else if(role_id == 2) {
                            if(full.lampiran == null || full.lampiran == 'a:0:{}'){
                                return "<a href='" + baseUrl + '/pelembagaan/' + data + "/update' title='Detail'> <i class='icon-edit'></i></a>";
                            }else{
                                return "<a href='" + baseUrl + '/pelembagaan/download/' + data + "' title='Unduh'> <i class='icon-download'></i></a>" +
                                    "<a href='" + baseUrl + '/pelembagaan/' + data + "/update' title='Detail'> <i class='icon-edit'></i></a>";
                            }

                        }
                        return "";
                    }
                }
            ],

            fnServerParams: function (aoData) {
                aoData.push({name: "status", value: $("#select-status").val()});
                aoData.push({name: "firstDate", value: $("#first-date").val()});
                aoData.push({name: "lastDate", value: $("#last-date").val()});
            },
            fnDrawCallback: function (oSettings) {
                if (oSettings.bSorted || oSettings.bFiltered) {
                    for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
                    }
                }
            },

            aoColumnDefs: [
                { "bSortable": false, "aTargets": [ 0 ] }
            ],
            aaSorting: [
                [ 1, 'asc' ]
            ]

        });
    }

    $("#tbl-pelembagaan").on('click', '.btn_delete', function (e) {
        var delkodel = $(this);
        $('#dialog').dialog({
            width: 500,
            modal: true,
            buttons: {
                "Hapus" : function(){
                    $.ajax({
                        url: delkodel.attr('href'),
                        type: 'post',
                        data: {_method:"delete"},
                        success: function (response) {
                            $dataTable.fnReloadAjax();
                        }
                    });
                    $(this).dialog("close");
                },
                "Batal" : function() {
                    $(this).dialog("close");
                }
            }
        });
        e.preventDefault();
//      if (confirm('Apakah anda yakin ?')) {
//        $.ajax({
//          url: $(this).attr('href'),
//          type: 'post',
//	  data: {_method:"delete"},
//          success: function (response) {
//            $dataTable.fnReloadAjax();
//          }
//        });
//      }
//      e.preventDefault();
//      return false;
    });

    // $("#filter_unit").keyup( function() { fnFilterUnit ( 3 ); } );
    // $("#filter_tahun").change( function() { fnFilterTahun( 2 ); } );

    $("#select-status, #first-date, #last-date").change(function () {
        $dataTable.fnReloadAjax();
    });

    $("#form-filter").on("reset", function () {
        $dataTable.fnReloadAjax();
    });

//          });

});
</script>

<script>
    document.getElementById("menu-pelembagaan-informasi").setAttribute("class", "user-menu-active");
    document.getElementById("collapse11").style.height = "auto";
</script>

@stop

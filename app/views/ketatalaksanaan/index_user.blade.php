@section('content')

<!--BANTUAN HUKUM-->
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Ketatalaksanaan";
</script>

<!--<legend>Status Usulan</legend>-->

@include('flash')

<br>
<table id="basictable" class="dataTable">
    <thead>
    <tr>
        <th>#</th>
        <th>Produk</th>
        <th>Unit</th>
        <th>Unduh</th>
    </tr>
    </thead>
</table>

@section('scripts')
@parent
<script type="text/javascript">
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true
    }).val();

    var tbl_data = $("#basictable").dataTable({
        bFilter: true,
        bInfo: true,
        bSort: false,
        bPaginate: true,
        bLengthChange: true,
        bServerSide: true,
        bProcessing: true,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
            "sEmptyTable": "Data Kosong",
            "sZeroRecords" : "Pencarian Tidak Ditemukan",
            "sSearch":       "Cari:",
            "sLengthMenu": 'Tampilkan <select>'+
                '<option value="10">10</option>'+
                '<option value="25">25</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '</select> Usulan'
        },
//                sAjaxSource: baseUrl + "/lkpm/data",
        sAjaxSource: '<?php echo URL::to("userketatalaksanaan"); ?>',
        aoColumns: [
            {
                mData: "id",
                sWidth: "1%"
            },
            {
                mData: "produk",
                sWidth: "29%",
                mRender: function(data, type, full){
                    switch (data)
                    {
                        case '1':
                            return "Uraian Jabatan";
                            break;
                        case '2':
                            return "Daftar Jabatan";
                            break;
                        case '3':
                            return "Kamus Jabatan";
                            break;
                        case '4':
                            return "Indeks Kepuasan Masyarakat";
                            break;
                        case '5':
                            return "Prosedur Operasional Standard";
                            break;
                        case '6':
                            return "Standard Layanan";
                            break;
                    }
                }
            },
            {
                mData: "unit",
                sWidth: "60%"
            },
            {
                mData: "id",
                sWidth: "10%",
                sClass: "center",
                mRender: function(data, type, full){
                    var downloadUrl = "<?php echo URL::to('download_ketatalaksanaan'); ?>" + "/" + data;
                    return '<a href="' + downloadUrl + '" title="Unduh"><i class="icon-download "></i></a> &nbsp;';
                }
            }
        ],
        fnServerParams: function(aoData) {
//            aoData.push({name: "jenis_perkara", value: $("#jenis-perkara").val()});
//            aoData.push({name: "status_pemohon", value: $("#status-pemohon").val()});
//            aoData.push({name: "advokasi", value: $("#advokasi").val()});
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
            $.getJSON(sSource, aoData, function(json) {
                $("#text-tahun").text(json.tahun);
                fnCallback(json);
            });
        }
    });

    $("#jenis-perkara").change(function(){
        tbl_data.fnReloadAjax();
    });

    $("#status-pemohon").change(function(){
        tbl_data.fnReloadAjax();
    });

    $("#advokasi").change(function(){
        tbl_data.fnReloadAjax();
    });

    $("#print").click(function(){

    });
</script>

<script>
    document.getElementById("menu-ketatalaksanaan").setAttribute("class", "user-menu-active");
//    document.getElementById("collapse13").style.height = "auto";
</script>
@stop
@stop

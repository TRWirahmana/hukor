@section('content')
<input type="hidden" id="role_id" value="{{Auth::user()->role_id}}"/>

<!--BANTUAN HUKUM-->
<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Status Usulan Bantuan Hukum";
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Bantuan hukum";
</script>

    <legend>Status Usulan</legend>

    @include('flash')
<br>
    <table id="basictable" class="dataTable">
        <thead>
        <tr>
<!--            <th>Nama Pemohon</th>-->
            <th>Jenis Perkara</th>
            <th>Status Pemohon</th>
<!--            <th>Status Perkara</th>-->
            <th>Advokasi</th>
<!--            <th>Advokator</th>-->
            @if($user == null)
            @else
            <th></th>
            @endif
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

            var roles = '<?php echo $user; ?>';
            if(roles == null)
                roles = 0;

            if(roles == 0){
            var tbl_data = $("#basictable").dataTable({
                bServerSide: true,
//                sAjaxSource: document.location.href,
                bFilter: true,
                bInfo: true,
                bProcessing: true,
                oLanguage:{
                    "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                    "sEmptyTable": "Data Kosong",
                    "sSearch":       "Cari:",
                    "sZeroRecords" : "Pencarian Tidak Ditemukan",
                    "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
                    "sProcessing": 'Memproses...',
                    "sInfoFiltered": ""
                },
//                sAjaxSource: baseUrl + "/lkpm/data",
                sAjaxSource: '<?php echo URL::to("bantuan_hukum/datatable"); ?>',
                aoColumns: [
//                    {mData: "pengguna.nama_lengkap"},
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
//                    {mData: "status_perkara"},
                    {
                        mData: "advokasi",
                        sClass: "center",
                        mRender: function(advokasi){
                            switch (advokasi){
                                case '1':
                                    return "Bankum I";
                                    break;
                                case '2':
                                    return "Bankum II";
                                    break;
                                case '3':
                                    return "Bankum III";
                                    break;
                                default:
                                    return "Belum Diadvokasi";
                                    break;
                            }
                        }
                    }
                ],
                fnServerParams: function(aoData) {
                    aoData.push({name: "jenis_perkara", value: $("#jenis-perkara").val()});
                    aoData.push({name: "status_pemohon", value: $("#status-pemohon").val()});
                    aoData.push({name: "advokasi", value: $("#advokasi").val()});
                },
                fnServerData: function(sSource, aoData, fnCallback) {
                    $.getJSON(sSource, aoData, function(json) {
                        $("#text-tahun").text(json.tahun);
                        fnCallback(json);
                    });
                }
            });
            }else{
                var tbl_data = $("#basictable").dataTable({
                    bServerSide: true,
//                sAjaxSource: document.location.href,
                    bFilter: true,
                    bInfo: true,
                    bProcessing: true,
                    oLanguage:{
                        "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                        "sEmptyTable": "Data Kosong",
                        "sSearch":       "Cari:",
                        "sZeroRecords" : "Pencarian Tidak Ditemukan",
                        "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
                        "sProcessing": 'Memproses...',
                        "sInfoFiltered": ""
                    },
//                sAjaxSource: baseUrl + "/lkpm/data",
                    sAjaxSource: '<?php echo URL::to("bantuan_hukum/datatable"); ?>',
                    aoColumns: [
//                    {mData: "pengguna.nama_lengkap"},
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
//                    {mData: "status_perkara"},
                        {
                            mData: "advokasi",
                            sClass: "center",
                            mRender: function(advokasi){
                                switch (advokasi){
                                    case '1':
                                        return "Bankum I";
                                        break;
                                    case '2':
                                        return "Bankum II";
                                        break;
                                    case '3':
                                        return "Bankum III";
                                        break;
                                    default:
                                        return "Belum Diadvokasi";
                                        break;
                                }
                            }
                        },
//                    {mData: "advokator"},
                        {
                            mData: "id",
                            sWidth: "10%",
                            mRender: function(data, type, full){
                                if($("#role_id").val() == 2) {

                                    var downloadUrl = baseUrl + '/bantuan_hukum/download/' + data;
                                    if(full.lampiran == null || full.lampiran == 'a:0:{}'){
                                        return "&nbsp;<a href='"+baseUrl+"/bantuan_hukum/detail/" + data + "'  title='Ubah'><i class='icon-edit'></i></a>";
                                    }else{
                                        return '<a href="' + downloadUrl + '" title="Unduh"><i class="icon-download "></i></a>&nbsp;'+
                                            "&nbsp;<a href='"+baseUrl+"/bantuan_hukum/detail/" + data + "'  title='Ubah'><i class='icon-edit'></i></a>";
                                    }

                                }
                                return "";
                            }
                        }
                    ],
                    fnServerParams: function(aoData) {
                        aoData.push({name: "jenis_perkara", value: $("#jenis-perkara").val()});
                        aoData.push({name: "status_pemohon", value: $("#status-pemohon").val()});
                        aoData.push({name: "advokasi", value: $("#advokasi").val()});
                    },
                    fnServerData: function(sSource, aoData, fnCallback) {
                        $.getJSON(sSource, aoData, function(json) {
                            $("#text-tahun").text(json.tahun);
                            fnCallback(json);
                        });
                    }
                });
            }

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
  document.getElementById("menu-banhuk-informasi").setAttribute("class", "user-menu-active");
  document.getElementById("collapse13").style.height = "auto";
</script>
    @stop
@stop

@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
    <legend>Informasi dan Status Usulan Bantuan Hukum</legend>

    @include('flash')
<br>
    <table id="basictable" class="dataTable">
        <thead>
        <tr>
            <th>Nama Pemohon</th>
            <th>Jenis Perkara</th>
            <th>Status Pemohon</th>
            <th>Status Perkara</th>
            <th>Advokasi</th>
            <th>Advokator</th>
            <th></th>
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
                bFilter: false,
                bInfo: false,
                bSort: false,
                bPaginate: true,
                bLengthChange: false,
                bServerSide: true,
                bProcessing: true,
//                sAjaxSource: baseUrl + "/lkpm/data",
                sAjaxSource: baseUrl + '/bantuan_hukum/datatable',
                aoColumns: [
                    {mData: "pengguna.nama_lengkap"},
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
                                    jenis_perkara = 'Uji Materil MK';
                                    break;
                                case 5:
                                    jenis_perkara = 'Uji Materil MA';
                                    break;
                            }

                            return jenis_perkara;
                        }
                    },
                    {
                        mData: "status_pemohon",
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
                    {mData: "status_perkara"},
                    {
                        mData: "advokasi",
                        mRender: function(id){
                            var advokasi;
                            switch (id){
                                case 1:
                                    advokasi = "Bankum I";
                                    break;
                                case 2:
                                    advokasi = "Bankum II";
                                    break;
                                case 3:
                                    advokasi = "Bankum III";
                                    break;
                                default:
                                    advokasi = "";
                                    break;
                            }

                            return advokasi;
                        }
                    },
                    {mData: "advokator"},
                    {
                        mData: "id",
                        mRender: function(data, type, full){
                            var downloadUrl = baseUrl + '/bantuan_hukum/download/' + data;
                            return '<a href="' + downloadUrl + '" title="Download"><i class="rulycon-arrow-down "></i></a>';
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
    @stop
@stop

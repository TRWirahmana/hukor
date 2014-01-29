@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('/addbahu')}}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>

    @include('flash')
    
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
            var tbl_data = $("#basictable").dataTable({
                bFilter: false,
                bInfo: false,
                bSort: false,
                bPaginate: true,
                bLengthChange: false,
                bServerSide: true,
                bProcessing: true,
//                sAjaxSource: baseUrl + "/lkpm/data",
                sAjaxSource: '<?php echo URL::to("tabelbahu"); ?>',
                aoColumns: [
                    {mData: "pengguna.nama_lengkap"},
                    {
                        mData: "jenis_perkara",
                        sClass: "center",
                        mRender: function(id){
                            var jenis_perkara;
                            switch (id){
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
                            switch (id){
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
                            }

                            return advokasi;
                        }
                    },
                    {mData: "advokator"},
                    {
                        mData: "id",
                        mRender: function(data, type, full){
                            var detailUrl = baseUrl + '/detail_banhuk?id=' + data;
                            var deleteUrl = baseUrl + '/delete_banhuk?id=' + data;

                            return '<a href="' + detailUrl + '"><i class="icon-edit"></i></a> &nbsp;' +
                                '<a href="' + deleteUrl + '" class="btn_delete"><i class="icon-trash"></i></a>';
                        }
                    }
                ],
                fnServerParams: function(aoData) {
//                    aoData.push({name: "tahun", value: $("#select_filter_tahun").val()});
//                    aoData.push({name: "id_prop", value: $("#select_filter_provinsi").val()});
                },
                fnServerData: function(sSource, aoData, fnCallback) {
                    $.getJSON(sSource, aoData, function(json) {
                        $("#text-tahun").text(json.tahun);
                        fnCallback(json);
                    });
                }
            });
        </script>
    @stop
@stop
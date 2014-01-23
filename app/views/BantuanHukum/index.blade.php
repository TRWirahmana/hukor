@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('/BantuanHukum/add')}}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>

    @include('flash')
    
    <table id="basictable" class="dataTable">
        <thead>
        <tr>
            <th>Nama lengkap</th>
            <th>Alamat</th>
            <th>TTL</th>
            <th>Pendidikan terakhir</th>
            <th>Status</th>
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
                    {mData: "nama"}, {mData: "jml_proyek", sClass: "center"}
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
@section('content')
    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('/addbahu')}}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>
    <table id="basictable" class="dataTable">
        <thead>
        <tr>
            <th>Nama Pemohon</th>
            <th>Jenis Perkara</th>
            <th>Status Pemohon</th>
            <th>Status Perkara</th>
            <th>Di Advokasi Oleh</th>
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
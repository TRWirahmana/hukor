@section('content')
    <h2>Layanan Kelembagaan</h2>
<div class="stripe-accent"></div>

<legend>Informasi Layanan Kelembagaan
<a class="btn btn-mini btn-primary" href="{{ URL::route('pengajuan_per_uu')}}">
        <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
</legend>

@include('flash')

<!--<select id="select-filter">-->
<!--    <option value="0">Tampilkan Semua</option>-->
<!--    <option value="1">Tampilkan Usulan Anda</option>-->
<!--</select>-->

<table id="tabel_layanan_kelembagaan">
    <thead>
    <tr>
        <th>Judul Informasi</th>
        <th>Penanggung Jawab</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>
@stop

@section('scripts')
@parent
<script type="text/javascript">
    $(function(){
        $dataTable = $("tabel_layanan_kelembagaan").dataTable({
            bServerSide: true,
            sAjaxSource: document.location.href,
            aoColumns: [
                {mData: "judul_berita"},
                {mData: "penanggung_jawab"},
            ],
            fnServerParams: function(aoData) {
//                aoData.push({name: "filter", value: $("#select-filter").val()});
            }
        });

//        $("#select-filter").change(function(){
//            $dataTable.fnReloadAjax();
//        });

    });

</script>
@stop
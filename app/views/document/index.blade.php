@section('content')


<h2>KETATALAKSANAAN</h2>
<div class="stripe-accent"></div>
<legend>Document
    <a class="btn btn-mini btn-primary" href="{{ URL::to('/adddoc')}}">
        <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
</legend>

@include('flash')

<table id="basictable" class="dataTable">
    <thead>
    <tr>
        <th>Nomor</th>
        <th>Tanggal</th>
        <th>Tentang</th>
        <th>Kategori</th>
        <th>Masalah</th>
        <th>Publikasi</th>
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
        sAjaxSource: '<?php echo URL::to("tabledoc"); ?>',
        aoColumns: [
            {mData: "nomor", sClass: "center"},
            {mData: "tgl_pengesahan", sClass: "center"},
            {mData: "perihal", sClass: "center"},
            {
                mData: "kategori",
                sClass: "center",
                mRender:function(kat){
                    var kategori;
                    switch (kat)
                    {
                        case 1 :
                            kategori = 'Keputusan Menteri';
                            break;
                        case 2 :
                            kategori = 'Peraturan Menteri';
                            break;
                        case 3 :
                            kategori = 'Peraturan Bersama';
                            break;
                        case 4 :
                            kategori = 'Keputusan Bersama';
                            break;
                        case 5 :
                            kategori = 'Instruksi Menteri';
                            break;
                        case 6 :
                            kategori = 'Surat Edaran';
                            break;
                    }

                    return kategori;
                }
            },
            {
                mData: "masalah",
                sClass: "center",
                mRender:function(mas){
                    var masalah;
                    switch (mas)
                    {
                        case 1 :
                            masalah = 'Kepegawaian';
                            break;
                        case 2 :
                            masalah = 'Keuangan';
                            break;
                        case 3 :
                            masalah = 'Organisasi';
                            break;
                        case 4 :
                            masalah = 'Umum';
                            break;
                        case 5 :
                            masalah = 'Perlengkapan';
                            break;
                        case 6 :
                            masalah = 'Lainnya';
                            break;
                    }

                    return masalah;
                }
            },
            {
                mData: "status_publish",
                sClass: "center",
                mRender:function(status){
                    var publish;
                    if(status == 0)
                    {
                        publish = '-';
                    }
                    else
                    {
                        publish = 'Ya';
                    }
                    return publish;
                }
            },
            {
                mData: "id",
                sClass: "center",
                mRender: function(data){
                    var detailUrl = baseUrl + '/detaildoc?id=' + data;
                    var updateUrl = baseUrl + '/editdoc?id=' + data;
                    var publishUrl = baseUrl + '/publishdoc?id=' + data;
                    var deleteUrl = baseUrl + '/deletedoc?id=' + data;

                    return '<a href="' + updateUrl + '"><i class="icon-edit"></i></a> &nbsp;' +
                        '<a href="' + publishUrl + '" class="btn_delete"><i class="icon-trash"></i></a>';
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
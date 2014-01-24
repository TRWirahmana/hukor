@section('content')
<H2>PELEMBAGAAN</H2>
<div class='stripe-accent'></div>

    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('pelembagaan/usulan'); }}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>

@include('flash')


    

    <table id="tbl-pelembagaan">
        <thead>
        <tr>
            <th>No. Usulan</th>
            <th>Tgl Usulan</th>
            <th>Unit Kerja</th>
            <th>Jabatan</th>
            <th>Perihal</th>
            <th>Status</th>
<!--            <th>edit</th>-->
        </tr>
        </thead>
      	<tbody></tbody>

    </table>
    
    @section('scripts')
        @parent
        <script type="text/javascript">
            $("#tbl-pelembagaan").dataTable({
        
                iDisplayLength: 5,
                
//                bProcessing: true,
               	bServerSide: true,
		sAjaxSource: document.location.href,
		aoColumns: [
                    {mData: "id"},
                    {mData: "tanggal_usulan"},
                    {mData: "unit_kerja"},
                    {mData: "jabatan"},
                    {mData: "perihal"},
                    {mData: "status"}
                ]
                
            });
        </script>        
@stop
@stop
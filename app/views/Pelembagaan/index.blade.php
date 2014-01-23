@section('content')
    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('/pelembagaan/usulan')}}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>
    <table id="basictable" class="dataTable">
        <thead>
        <tr>
            <th>No. Usulan</th>
            <th>Tgl Usulan</th>
            <th>Unit Kerja</th>
            <th>Jabatan</th>
            <th>Perihal</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
    </table>
    
    @section('scripts')
        @parent
        <script type="text/javascript">
            $("#tbl-pelembagaan").dataTable({
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

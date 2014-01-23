@section('content')
    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('/pelembagaan/usulan')}}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>
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
@stop

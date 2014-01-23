@section('content')
<h2>PERATURAN PERUNDANG-UNDANGAN</h2>
<div class="stripe-accent"></div>

<legend>Informasi & Status Usulan
    <a class="btn btn-mini btn-primary" href="{{ URL::route('pengajuan_per_uu')}}">
        <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
</legend>

@include('flash')

<table id="tbl-per-uu">
	<thead>
		<tr>
			<th>Nomor</th>
			<th>Tgl Usulan</th>
			<th>Unit Kerja</th>
			<th>Jabatan</th>
			<th>Perihal</th>
			<th>Status</th>
			<th>-</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
@stop

@section('scripts')
@parent
<script type="text/javascript">
	$("#tbl-per-uu").dataTable({
		bServerSide: true,
		sAjaxSource: document.location.href,
		aoColumns: [
			{mData: "id"},
			{mData: "tgl_usulan"},
			{mData: "pengguna.unit_kerja"},
			{mData: "pengguna.detail_jabatan.nama_jabatan"},
			{mData: "perihal"},
			{mData: "status"},
			{mData: "id"}
		]
	});
</script>
@stop
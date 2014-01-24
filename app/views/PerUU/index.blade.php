@section('content')
<h2>PERATURAN PERUNDANG-UNDANGAN</h2>
<div class="stripe-accent"></div>

<legend>Informasi & Status Usulan
    <a class="btn btn-mini btn-primary" href="{{ URL::route('pengajuan_per_uu')}}">
        <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
</legend>

@include('flash')

<select id="select-filter">
	<option value="0">Tampilkan Semua</option>
	<option value="1">Tampilkan Usulan Anda</option>
</select>

<table id="tbl-per-uu">
	<thead>
		<tr>
			<th>#</th>
			<th>Tgl Usulan</th>
			<th>Unit Kerja</th>
			<th>Jabatan</th>
			<th>Perihal</th>
			<th>Status</th>
			<th>Lampiran</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>
@stop

@section('scripts')
@parent
<script type="text/javascript">
	$(function(){
		$dataTable = $("#tbl-per-uu").dataTable({
			bServerSide: true,
			sAjaxSource: document.location.href,
			aoColumns: [
				{mData: "id"},
				{mData: "tgl_usulan"},
				{mData: "unit_kerja"},
				{mData: "nama_jabatan"},
				{mData: "perihal"},
				{mData: "status"},
				{
					mData: "lampiran",
					mRender: function($data) {
						return "<a href='/assets/uploads/"+$data+"'>Unduh</a>";
					}
				}
			],
			fnServerParams: function(aoData) {
				aoData.push({name: "filter", value: $("#select-filter").val()});			
			}
		});

		$("#select-filter").change(function(){
			$dataTable.fnReloadAjax();
		});

	});
	
</script>
@stop
@section('admin')
	<div class="rightpanel">
		<ul class="breadcrumbs">
			<li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
	        <li><a href="{{URL::to('admin/berita')}}">Berita</a> <span class="separator"></span></li>
	        <li>Kategori Berita</li>
		</ul>
		@include('adminflash')
		<div class="pageheader">
			<div class="pageicon">&nbsp;</div>
			<div class="pagetitle">
				<h1>Kategori Berita</h1>
			</div>
		</div>

		<div class="maincontent">
			<div class="maincontentinner">
				<div class="content-non-title">
					<a class="btn btn-mini btn-primary pull-right" href="{{ URL::route('admin.categories.create') }}">Tambah Kategori Baru</a>
					<table id="tbl-categories">
						<thead>
							<tr>
								<th>Nama kategori</th>
								<th>Dibuat Tanggal</th>
								<th></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
@parent
<script type="text/javascript">
	jQuery(function($){
		$tblCategories = $("#tbl-categories");
		$dTblCategories = $tblCategories.dataTable({
			sAjaxSource: document.location.href,
			bProcessing: true,
			aoColumns: [
				{mData: "nama_kategori"},
				{mData: "created_at"},
				{
					mData: "id",
					mRender: function(data, type, obj) {
						var btns = new Array(
							"<a href='categories/" + data + "/edit'><i class='icon icon-edit'></i></a>",
							"<a href='categories/" + data +"' class='delete'>"
								+ "<i class='icon icon-trash'></i></a>"
						);
						return btns.join("&nbsp;");
					}
				}
			]
		});

		// delete button handler
		$dTblCategories.on("click", "a.delete", function(e){
			e.preventDefault();

			if(!confirm("Apakah anda yakin menghapus kategori berita?"))
				return false;

			$.ajax({
				url: $(this).attr("href"),
				type: "post",
				data: {'_method': 'delete'},
				success: function(result) {
					$dTblCategories.fnReloadAjax();
				}
			});
		});

	});
</script>
@stop
@section('admin')
	<div class="rightpanel">
		<ul class="breadcrumbs">
			<li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
	        <li><a href="{{URL::to('admin/berita')}}">Berita</a> <span class="separator"></span></li>
	        <li>Kategori Berita</li>
		</ul>
		@include('adminflash')
		<div class="pageheader">
			<div class="pageicon"><span class="rulycon-newspaper"></span></div>
			<div class="pagetitle">
				<h1>Kategori Berita</h1>
			</div>
		</div>

		<div class="maincontent">
			<div class="maincontentinner">
        <div class="row-fluid">
          <a class="btn btn-primary" href="{{ URL::route('admin.categories.create') }}">Tambah Kategori Baru</a>
        </div>

				<div class="content-non-title">
					<table id="tbl-categories" class="table">
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

<!-- dialog box -->
<div id="dialog" title="Hapus Perundang-Undangan" style="display: none;">
    <p>Apakah Anda Yakin?</p>
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
            oLanguage:{
                "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Kategori Berita",
                "sEmptyTable": "Data Kosong",
//                "oPaginate": {
//                    "sNext": "Selanjutnya",
//                    "sPrevious": "Sebelumnya"
//                },
                "sZeroRecords" : "Pencarian Tidak Ditemukan",
                "sSearch":       "Cari:",
                "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
                "sProcessing": 'Memproses...',
                "sLengthMenu": 'Tampilkan <select>'+
                    '<option value="10">10</option>'+
                    '<option value="25">25</option>'+
                    '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '</select> Kategori Berita'
            },
			aoColumns: [
				{mData: "nama_kategori"},
				{mData: "created_at"},
				{
					mData: "id",
					mRender: function(data, type, obj) {
						var btns = new Array(
							"<a href='categories/" + data + "/edit' title='Ubah'><i class='icon icon-edit'></i></a>",
							"<a href='categories/" + data +"' class='delete' title='Hapus'>"
								+ "<i class='icon icon-trash'></i></a>"
						);
						return btns.join("&nbsp;");
					}
				}
			]
		});

		// delete button handler
		$dTblCategories.on("click", "a.delete", function(e){
            var delkodel = $(this);
            $('#dialog').dialog({
                width: 500,
                modal: true,
                buttons: {
                    "Hapus" : function(){
                        $.ajax({
                            url: delkodel.attr("href"),
                            type: "post",
                            data: {'_method': 'delete'},
                            success: function(result) {
                                $dTblCategories.fnReloadAjax();
                            }
                        });
                        $(this).dialog("close");
                    },
                    "Batal" : function() {
                        $(this).dialog("close");
                    }
                }
            });
            e.preventDefault();
		});

	});
</script>

<script>
  jQuery("#menu_berita > li:last-child > a").addClass("sub-menu-active");
  jQuery("#menu_berita").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Kategori Berita"
  });
</script>
@stop
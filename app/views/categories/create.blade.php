@section('admin')
	<div class="rightpanel">
		<ul class="breadcrumbs">
			<li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
	        <li><a href="{{URL::to('admin/berita')}}">Berita</a> <span class="separator"></span></li>
	        <li><a href="{{URL::route('admin.categories.index')}}">Kategori Berita</a> <span class="separator"></span></li>
	        <li>Tambah Kategori Berita</li>
		</ul>
		@include('adminflash')
		<div class="pageheader">
			<div class="pageicon">&nbsp;</div>
			<div class="pagetitle">
				<h1>Tambah Kategori Berita</h1>
			</div>
		</div>

		<div class="maincontent">
			<div class="maincontentinner">
        <div class="row-fluid">
          <div class="span8 offset2">
            <div class="content-non-title">
              {{ Form::open(array("route" => "admin.categories.store", "class" => "form form-horizontal")) }}
              <div class="control-group {{$errors->has('nama_kategori')? 'error': ''}}">
                <label for="nama_kategori" class="control-label">
                  Nama Kategori
                </label>
                <div class="controls">
                  {{Form::text("nama_kategori")}}
                  {{$errors->first('nama_kategori', '<span class="help-block">:message</span>')}}
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                    <input class="btn btn-primary" type="button" value="Batal" onclick="history.go(-1);return true;" name="batal">
                  {{Form::submit("Simpan", array("class" => "btn btn-primary"))}}
                </div>
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
			</div>
		</div>
	</div>
@stop

@section('scripts')
@parent
<script>
    jQuery("#menu_berita > li:last-child > a").addClass("sub-menu-active");
    jQuery("#menu_berita").css({
        "display": "block",
        "visibility": "visible"
    });

  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Tambah Kategori Berita"
  });
</script>
@stop
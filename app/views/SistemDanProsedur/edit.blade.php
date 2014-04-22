@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
	<li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Aplikasi</a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Sistem dan Prosedur</a> <span class="separator"></span></li>
        <li>Detail Usulan</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
	<!--        <form action="results.html" method="post" class="searchbar">-->
	    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
	    <!--        </form>-->
	<div class="pageicon"><span class="rulycon-notebook"></span></div>
	<div class="pagetitle">
	    <!--<h5>Events</h5>-->

	    <h1>Sistem dan Prosedur</h1>
	</div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
	<div class="maincontentinner">

	    <!-- MAIN CONTENT -->

	    <legend>Perbaharui Usulan</legend>

	    @include('flash')

	    {{ Form::open(array('route' => array('admin.sp.update', $data->id), 'method' => 'put', 'files' => true, 'class' => 'form form-horizontal')) }}
	    <div class="row-fluid">
		<div class="span6">
		    <fieldset>
			<legend>PENANGGUNG JAWAB</legend>
			
			<div class="control-group">
			    <label for="" class="control-label">Unit Kerja</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->unit_kerja }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Jabatan</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->jabatan }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">NIP</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->NIP }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Nama</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->nama }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Alamat</label>
			    <div class="controls"><textarea rows="3" disabled>{{ $data->penanggungJawab->alamat_kantor }}</textarea></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Telp Kantor</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->telepon_kantor }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Email</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->email }}"></div>
			</div>
		    </fieldset>
		</div>
		<div class="span6">
		    <fieldset>
			<legend>INFORMASI PENGUSUL</legend>
			<div class="control-group">
			    <label for="" class="control-label">Unit Kerja</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->unit_kerja }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Jabatan</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->jabatan }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">NIP</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->NIP }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Nama</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->nama }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Alamat</label>
			    <div class="controls"><textarea rows="3" disabled>{{ $data->penanggungJawab->alamat_kantor }}</textarea></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Telp Kantor</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->telepon_kantor }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Email</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->email }}"></div>
			</div>
		    </fieldset>

		    

		    
		</div>
	    </div>

	    <div class="row-fluid">
		<div class="span6">
		    <fieldset>
			<legend>INFORMASI PERIHAL & LAMPIRAN</legend>
			<div class="control-group">
			    <label for="" class="control-label">Tgl Usulan</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->tgl_usulan }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Perihal</label>
			    <div class="controls"><input type="text" disabled="" value="{{ $data->perihal }}"></div>
			</div>
			<div class="control-group">
			    <label for="" class="control-label">Lampiran</label>
			    <div class="controls">
				<ul style="list-style: none;">
				    @foreach(unserialize($data->lampiran) as $index => $lampiran)
				    <li>	
				    <a href="{{URL::route('sp.download', array('id' => $data->id, 'index' => $index))}}">
					{{explode(DS, $lampiran)[count(explode(DS, $lampiran))-1] }}
				    </a>
				    </li>
				    @endforeach
				</ul>
			    </div>
			</div>

			<div class="control-group">
			    <label for="" class="control-label">Status Terakhir</label>
			    <div class="controls">
				@if ($data->status == 1)
				Diproses
				@elseif($data->status == 2)
				Ditunda
				@elseif($data->status == 3)
				Ditolak
				@elseif($data->status == 4)
				Buat Salinan
				@elseif($data->status == 5)
				Penetapan
				@endif
			    </div>
			</div>
		    </fieldset>
		</div>
		<div class="span6">
		    <fieldset>
			<legend>UPDATE STATUS</legend>
			<div class="control-group">
			    {{ Form::label('status', 'Status', array('class' => 'control-label'))}}
			    <div class="controls">
				{{ 
				Form::select('status', array(
				1 => "Diproses",
				2 => "Ditunda",
				3 => "Ditolak",
				4 => "Buat Salinan",
				5 => "Penetapan"
				), 0, array())
				}}
			    </div>
			</div>
			<div class="control-group">
			    {{ Form::label('catatan', 'Deskripsi', array('class' => 'control-label')) }}
			    <div class="controls">
				{{
				Form::textarea('catatan', null, array('rows' => 2, 'placeholder' => 'Masukan deskripsi usulan'))
				}}
			    </div>
			</div>
			<div class="control-group">
			    {{ Form::label('ket_lampiran', 'Ket. Lampiran', array('class' => 'control-label')) }}
			    <div class="controls">
				{{
				Form::text('ket_lampiran', null, array('placeholder' => 'Masukan keterangan lampiran...'))
				}}
			    </div>
			</div>
			<div class="control-group">
			    {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
			    <div class="controls">
				{{
				Form::file('lampiran[]', array('multiple' => true));
				}}
			    </div>
			</div>

		    </fieldset>

		</div>
            <div class="row-fluid">
                <div class="span24">
                    <a class="btn btn-primary" type="button" href="{{URL::to('admin.sp.index')}}">Batal</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>

                </div>
            </div>
	    </div>

<br>
<br>
	    <div class="row-fluid">
		<div class="span24">
		    <table id="tbl-log">
			<thead>
			    <tr>
				<th>Tgl Proses</th>
				<th>Status</th>
				<th>Catatan</th>
				<th>Lampiran</th>
			    </tr>
			</thead>
			<tbody></tbody>
		    </table>
      <style>
        table.dataTable tr td:nth-child(2) {
          text-align: center;
        }
      </style>
		</div>
	    </div>


	    {{ Form::close() }}



	    <!-- END OF MAIN CONTENT -->

	    <div class="footer">
		<div class="footer-left">
            <span>&copy;2014 Biro Hukum dan Organisasi</span>
		</div>
		<div class="footer-right">
		    <span></span>
		</div>
	    </div>
	    <!--footer-->
	</div>
	<!--maincontentinner-->
    </div>
    <!--maincontent-->


</div>
<!--rightpanel-->

@stop

@section('scripts')
@parent
<script type="text/javascript">
    jQuery(function($){
	    $tblLog = $("#tbl-log").dataTable({
        bServerSide: true,
        sAjaxSource: document.location.href,
        bProcessing: true,
        iDisplayLength: 5,
            oLanguage:{
                "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
                "sEmptyTable": "Data Kosong",
                "sZeroRecords" : "Pencarian Tidak Ditemukan",
                "sProcessing": 'Memproses...',
                "sSearch":       "Cari:",
                "oPaginate": {
                    "sNext": '<span class="rulycon-forward-3"></span>',
                    "sPrevious": "<span class='rulycon-backward-2'></span>"
                },
                "sLengthMenu": 'Tampilkan <select>'+
                    '<option value="10">10</option>'+
                    '<option value="25">25</option>'+
                    '<option value="50">50</option>'+
                    '<option value="100">100</option>'+
                    '</select>'
            },
        aoColumns: [
        {
        mData: "tgl_proses",
        mRender: function(data) {
        return $.datepicker.formatDate("dd M yy", new Date(Date.parse(data)));
        }
        },
        {
        mData: "status",
        mRender: function(data) {
        switch(parseInt(data)) {
        case 1:

            return "Diproses";
            break;
        case 2:
            return "Ditunda";
            break;
        case 3:
            return "Ditolak";
            break;
        case 4:
            return "Buat salinan";
            break;
        case 5:
            return "Penetapan";
            break;
        default:
            return " ";
            break;
        };
        }
        },
        {mData: "catatan"},
        {
        mData: "lampiran",
               mRender: function(data, type, full) {
               return '<a href="'+baseUrl+'/admin/sp/log/download/'+full.id+'">Unduh</a>';
               }
        }
        // {mData: "id"}
        ]
        });
        });
</script>
<script>
    jQuery("#app_sisprod > a").addClass("sub-menu-active");
    jQuery("#app").css({
        "display": "block",
        "visibility": "visible"
    });
</script>

<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Usulan Sistem dan Prosedur"
    });
</script>
@stop

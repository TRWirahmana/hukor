@section('content')

<h2>PRODUK HUKUM</h2>
<div class="stripe-accent"></div>
<!-- <legend>Pengajuan Usulan</legend>
 -->

@include('flash')
	{{ Form::open($form_opts) }}

		<div class="row-fluid">
			<div class="span12">
				<fieldset>
		              <legend>Informasi Detail Peraturan</legend>		
					<div class="control-group">		
						{{ Form::label('nomor', 'Nomor', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('nomor', $data->nomor); }}
						</div>
					</div>
					
					<div class="control-group">
						{{ Form::label('kategori', 'Kategori', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('kategori', $data->getKategori($data->kategori)) }}						
						</div>
					</div>		

					<div class="control-group">
						{{ Form::label('masalah', 'Masalah', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('masalah', $data->getMasalah($data->masalah)) }}
						</div>
					</div>

					<div class="control-group">
						{{ Form::label('tentang', 'Tentang', array('class' => 'control-label'))}}					
						<div class="controls">
							{{ Form::text('tentang', $data->deskripsi ) }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('tgl_pengesahan', 'Tanggal Pengesahan', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('tgl_pengesahan', $data->tgl_pengesahan) }}
						</div>
					</div>	

                    <div class="control-group">
                    {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
                        <div class="controls">
                            <a href= {{ URL::asset('assets/uploads/dokumen/' . $data->file_dokumen ); }} > {{ $data->file_dokumen}} </a>
                    </div>

				</fieldset>

				<div class="form-actions">	
					 <input class='btn btn-primary' Type="button" value="Back" onClick="history.go(-1);return true;">
				</div>
			</div>


	{{ Form::close() }}
@stop


@section('scripts')
@parent

<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<script src="{{asset('assets/js/pelembagaan.js')}}"></script>

<script type="text/javascript">
    Pelembagaan.Form();
</script>
@stop
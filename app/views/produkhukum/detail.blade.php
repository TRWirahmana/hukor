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
							{{ $data->nomor }}
						</div>
					</div>
					
					<div class="control-group">
						{{ Form::label('kategori', 'Kategori', array('class' => 'control-label'))}}
						<div class="controls">
							{{ $data->getKategori($data->kategori) }}
						</div>
					</div>		

					<div class="control-group">
						{{ Form::label('masalah', 'Masalah', array('class' => 'control-label'))}}
						<div class="controls">
							{{ $data->getMasalah($data->masalah) }}
						</div>
					</div>

                    <div class="control-group">
                        {{ Form::label('bidang', 'Bidang', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ $data->getBidang($data->bidang) }}
                        </div>
                    </div>

					<div class="control-group">
						{{ Form::label('tentang', 'Tentang', array('class' => 'control-label'))}}					
						<div class="controls">
							{{ $data->deskripsi }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('tgl_pengesahan', 'Tanggal Pengesahan', array('class' => 'control-label'))}}
						<div class="controls">
							{{ $data->tgl_pengesahan }}
						</div>
					</div>	

                    <div class="control-group">
                    {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
                        <div class="controls">
                            <a href= {{ URL::asset('assets/uploads/dokumen/' . $data->file_dokumen ); }} > Unduh </a>
                    </div>

				</fieldset>

				<div class="form-actions">	
					 <input class='btn btn-hukor' Type="button" value="Kembali" onClick="history.go(-1);return true;">
				</div>
			</div>


	{{ Form::close() }}
@stop

@section('content')
	{{ Form::open(array('route' => 'prosesPengajuan', 'class' => 'form form-horizontal' )) }}

		<div class="row-fluid">
			<div class="span12">
				<fieldset>
					<legend>Informasi Pengusul</legend>
					
					<div class="control-group">		
						{{ Form::label('jenis_usulan', 'Jenis Usulan', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::select('jenis_usulan', array('1' => 'Pendirian', '2' => 'Perubahan', '3' => 'Statuta', '4' => 'Penutupan' )); }}
						</div>
					</div>
					
					<div class="control-group">
						{{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::text('unit_kerja') }}
						</div>
					</div>		

					<div class="control-group">	
						{{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::text('jabatan') }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::text('nip') }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('nama_pemohon', "Nama Pemohon", array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::text('nama_pemohon') }}
						</div>
					</div>	


					<div class="control-group">
						{{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::textarea('alamat_kantor') }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::text('telp_kantor') }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('pos_el', 'Pos_el', array('class' => 'control-label'))}}
						<div class="controls">
						{{ Form::text('pos_El') }}
						</div>
					</div>	
	
				</fieldset>
			</div>

		<div class="row-fluid">
			<div class="span12">
			
				<fieldset>
					<legend>Informasi Perihal & Lampiran</legend>

					<div class="control-group">
					{{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::text('perihal') }}</div>
					</div>

					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::file('lampiran') }}</div>
					</div>
					<div class="control-group">
					{{ Form::label('catatan', "Catatan", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::textarea('catatan') }}</div>
					</div>
				</fieldset>
			</div>
			<div class="span6"></div>

		
			<div class="span12">
				<fieldset>
					<legend>Informasi Registrasi</legend>

					<div class="control-group">
					{{ Form::label("nama", "Nama", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::text("nama") }}</div>
					</div>
				
					<div class="control-group">
					{{ Form::label("pos_el", "Pos-El", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::text("pos_el") }}</div>
					</div>

					<p>( <a href="#">klik disini untuk merubah informasi registrasi</a> )</p>

		<div class="form-actions">
			{{ Form::submit('Kirim', array('class' => 'btn btn-primary', 'style'=>'float: left')) }}
		</div>
			</div>	

</div>

	{{ Form::close() }}
@stop




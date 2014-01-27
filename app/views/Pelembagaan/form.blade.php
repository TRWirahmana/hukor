@section('content')

<h2>PERLEMBAGAAN</h2>
<div class="stripe-accent"></div>

@include('flash')
	{{ Form::open($form_opts) }}

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
						    @if(!is_object($pelembagaan->pengguna))
								{{ Form::text('unit_kerja' ) }}
							@else
								{{ Form::text('unit_kerja', $pelembagaan->pengguna->unit_kerja ) }}
							@endif
						</div>
					</div>		

					<div class="control-group">	
						{{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label'))}}
						<div class="controls">
						    @if(!is_object($pelembagaan->pengguna))
								{{ Form::text('jabatan') }}
							@else
								{{ Form::text('jabatan', $pelembagaan->pengguna->jabatan) }}
	                    	@endif
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('nip') }}
							@else
								{{ Form::text('nip', $pelembagaan->pengguna->nip) }}
							@endif
						</div>
					</div>

					<div class="control-group">
						{{ Form::label('nama_pemohon', "Nama Pemohon", array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('nama_pemohon') }}
							@else
								{{ Form::text('nama_pemohon', $pelembagaan->pengguna->nama_lengkap) }}
							@endif
						</div>
					</div>	


					<div class="control-group">
						{{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::textarea('alamat_kantor')}}
							@else
								{{ Form::textarea('alamat_kantor', $pelembagaan->pengguna->alamat_kantor) }}
							@endif
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('telp_kantor')}}
							@else
								{{ Form::text('telp_kantor', $pelembagaan->pengguna->tlp_kantor) }}
							@endif
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('pos_el', 'Pos_el', array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('pos_el') }}
							@else
								{{ Form::text('pos_el', $pelembagaan->pengguna->email) }}
							@endif							
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
						<div class="controls">{{ Form::text('perihal', $pelembagaan->perihal) }}</div>
					</div>

					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
						@if(!is_object($pelembagaan->pengguna))
							{{ Form::file('lampiran') }}</div>
						@else
							<a href="{{ assets/uploads/}}"  > Unduh</a> </div>
						@endif
					</div>
					<div class="control-group">
					{{ Form::label('catatan', "Catatan", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::textarea('catatan', $pelembagaan->catatan) }}</div>
					</div>
				</fieldset>
			</div>
			<div class="span6"></div>

		
			<div class="span12">
				<fieldset>
					<legend>Informasi Registrasi</legend>

					<div class="control-group">
					{{ Form::label("nama", "Nama", array('class' => 'control-label')) }}
						<div class="controls">
					    @if(!is_object($pelembagaan->pengguna))
							{{ Form::text("nama") }}</div>
					    @else
							{{ Form::text("nama", $pelembagaan->pengguna->nama_lengkap) }}</div>
						@endif
					</div>
				
					<div class="control-group">
					{{ Form::label("pos_el", "Pos El", array('class' => 'control-label')) }}
						<div class="controls">
					    @if(!is_object($pelembagaan->pengguna))
							{{ Form::text("pos_el") }}</div>
					    @else
							{{ Form::text("pos_el", $pelembagaan->pengguna->email) }}</div>
						@endif
					</div>

					<div class="control-group">
					{{ Form::label("id-number", "Id-Number", array('class' => 'control-label')) }}
						<div class="controls">
					    @if(!is_object($pelembagaan->pengguna))
							{{ Form::text("id_number") }}</div>
						@else
							{{ Form::text("id_number", $pelembagaan->pengguna->user_id) }}</div>
						@endif
					</div>


					<p>( <a href="#">klik disini untuk merubah informasi registrasi</a> )</p>

		<div class="form-actions">
			{{ Form::submit('Kirim', array('class' => 'btn btn-primary', 'style'=>'float: left')) }}
		</div>
			</div>	

</div>
</div>
	{{ Form::close() }}
@stop


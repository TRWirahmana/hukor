@section('content')

<h2>PERLEMBAGAAN</h2>
<div class="stripe-accent"></div>

@include('flash')
	{{ Form::open($form_opts) }}

		<div class="row-fluid">
			<div class="span12">
				<fieldset>
		              <div class="nav nav-tabs">
						<h4>Informasi Pengusul</h4>
		              </div>
					<div class="control-group">		
						{{ Form::label('tgl_usulan', 'Tanggal Usulan', array('class' => 'control-label'))}}
						<div class="controls">
								{{ Form::text('tgl_usulan', $pelembagaan->tgl_usulan ) }}
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
						{{ Form::label('nama_pemohon', "Nama", array('class' => 'control-label'))}}
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
	
				<br />
				<fieldset>
		              <div class="nav nav-tabs">
						<h4>Informasi Perihal & Lampiran</h4>
		              </div>
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
							<a href="#"  > Unduh</a> </div>
						@endif
					</div>
				</fieldset>
			</div>

			<div class="span12">
				<fieldset>
		              <div class="nav nav-tabs">
						<h4>Update Status</h4>
		              </div>
					<div class="control-group">
					{{ Form::label("status", "Status", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::select('status', array('1' => 'Diproses', '2' => 'Kirim Ke Bagian Peraturan PerUU' )); }} </div>
					</div>
				
					<div class="control-group">
					{{ Form::label('catatan', "Catatan", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::textarea('catatan', $pelembagaan->catatan) }}</div>
					</div>

					<div class="control-group">
					{{ Form::label("ket_lampiran", "Ket. Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text("ket_lampiran") }}</div>
					</div>

					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::file('lampiran') }}</div>
					</div>

					<div class="control-group">
					{{ Form::label('status_terakhir', "Status Terakhir", array('class' => 'control-label')) }}
						<div class="controls">
						{{ Form::text("ket_lampiran") }}</div>
						</div>

					<p>( <a href="#">klik disini untuk merubah informasi registrasi</a> )</p>

					<div class="form-actions">
						{{ Form::submit('Kirim', array('class' => 'btn btn-primary', 'style'=>'float: left')) }}
					</div>
				</fieldset>
			</div>
<!-- </div>
 -->
	{{ Form::close() }}
@stop

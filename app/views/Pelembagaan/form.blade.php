@section('content')

<h2>PERLEMBAGAAN</h2>
<div class="stripe-accent"></div>
<legend>Pengajuan Usulan</legend>


@include('flash')
{{ Form::open($form_opts) }}
    {{ Form::hidden('id', $user->pengguna->id, array('id' => 'id')) }}
    
	<div class="row-fluid">
		<div class="span12">
			<fieldset>
	              <legend>Informasi Pengusul</legend>		
				<div class="control-group">		
						{{ Form::label('jenis_usulan', 'Jenis Usulan', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::select('jenis_usulan', array('' => 'Pilih Jenis Usulan','1' => 'Pendirian', '2' => 'Perubahan', '3' => 'Statuta', '4' => 'Penutupan' )); }}
						</div>
					</div>
					
					<div class="control-group">
						{{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('nip', null, array('placeholder' => "Masukkan NIP..."))}}
						</div>
					</div>
				
					<div class="control-group">
						{{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('unit_kerja',null, array('placeholder' => "Masukkan Unit erja...")) }}
						</div>
					</div>		


					<div class="control-group">
						{{ Form::label('nama_pemohon', "Nama Pemohon", array('class' => 'control-label'))}}					
						<div class="controls">
							{{ Form::text('nama_pemohon', $user->pengguna->nama_lengkap, array('placeholder' => "Masukkan Nama Lengkap...") ) }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::textarea('alamat_kantor', null, array('placeholder' => "Masukkan Alamat Kantor...")) }}
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
						<div class="controls">
							{{ Form::text('telp_kantor', null, array('placeholder' => "Masukkan Nomor Telepon Kantor...")) }}
						</div>
					</div>

                    <div class="control-group">
                        {{ Form::label('hp', 'Handphone', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('hp', null, array('placeholder' => "Masukkan Nomor Handphone...")) }}
                        </div>
                    </div>


			<div class="control-group">
			{{ Form::label('pos_el', 'Email', array('class' => 'control-label'))}}
			<div class="controls">
				{{ Form::text('email', $user->pengguna->email) }}
			</div>
			</div>	
				</fieldset>
			</div>


			<div class="span12">
				<fieldset>
		              <legend> Informasi Usulan
		              </legend>
					<div class="control-group">
					{{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::text('perihal', $pelembagaan->perihal, array('placeholder' => "Masukkan Perihal...")) }}</div>
					</div>
					<div class="control-group">
					{{ Form::label('catatan', "Keterangan", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::textarea('catatan', $pelembagaan->catatan, array('placeholder' => "Masukkan Catatan...")) }}</div>
					</div>
					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::file('lampiran[]', array('multiple' => true)) }}</div>
					</div>
			</fieldset>
			</div>
		</div>

	<div class="form-actions">	
		{{ Form::submit('Kirim', array('class' => 'btn btn-hukor')) }}
		 <input class='btn btn-hukor' Type="button" value="Batal" onClick="history.go(-1);return true;">
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

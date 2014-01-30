@section('content')

<h2>PERATURAN PERUNDANG-UNDANGAN</h2>
<div class="stripe-accent"></div>
<legend>Perbaharui Usulan</legend>

@include('flash')

{{ Form::open(array('route' => 'proses_update_per_uu', 'method' => 'post', 'files' => true, 'class' => 'form form-horizontal')) }}
	{{ Form::hidden('id', $perUU->id) }}
<div class="row-fluid">
	<div class="span12">
		<fieldset>
			<legend>INFORMASI PENGUSUL</legend>
			<div class="control-group">
				<label for="" class="control-label">Tgl Usulan</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->tgl_usulan }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Unit Kerja</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->unit_kerja }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Jabatan</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->detail_jabatan->nama_jabatan }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">NIP</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->nip }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Nama</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->nama_lengkap }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Alamat</label>
				<div class="controls"><textarea rows="3" disabled>{{ $perUU->pengguna->alamat_kantor }}</textarea></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Telp Kantor</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->tlp_kantor }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Pos/Email</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->email }}"></div>
			</div>
		</fieldset>

		<fieldset>
			<legend>INFORMASI PERIHAL & LAMPIRAN</legend>
			<div class="control-group">
				<label for="" class="control-label">Perihal</label>
				<div class="controls"><input type="text" disabled="" value="{{ $perUU->perihal }}"></div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Lampiran</label>
				<div class="controls">
					<a href="/assets/uploads/{{$perUU->lampiran}}">{{ explode('/', $perUU->lampiran)[1] }}</a>
				</div>
			</div>
		</fieldset>
	</div>
	<div class="span12">
		<fieldset>
			<legend>UPDATE STATUS</legend>
			<div class="control-group">
				{{ Form::label('status', 'Status', array('class' => 'control-label'))}}
				<div class="controls">
					{{ 
						Form::select('status', array(
							0 => 'Silahkan Pilih Status',
							1 => "Di Proses",
							2 => "Di Tunda",
							3 => "Ditolak",
							4 => "Buat Salinan",
							5 => "Penetapan"
						), 0, array())
					}}
				</div>
			</div>
			<div class="control-group">
				{{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
				<div class="controls">
					{{
						Form::textarea('catatan', null, array('rows' => 3))
					}}
				</div>
			</div>
			<div class="control-group">
				{{ Form::label('ket_lampiran', 'Ket. Lampiran', array('class' => 'control-label')) }}
				<div class="controls">
					{{
						Form::text('ket_lampiran', null, array())
					}}
				</div>
			</div>
			<div class="control-group">
				{{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
				<div class="controls">
					{{
						Form::file('lampiran', array());
					}}
				</div>
			</div>
			<div class="control-group">
				<label for="" class="control-label">Status Terakhir</label>
				<div class="controls">
					<input type="text" name="" id="" disabled value="{{ $perUU->status }}">
				</div>
			</div>
		</fieldset>
	</div>
</div>

<div class="form-actions">
	{{ Form::submit('Simpan', array('class' => "btn btn-primary")) }}
</div>
{{ Form::close() }}


@stop()
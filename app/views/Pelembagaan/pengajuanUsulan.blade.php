<h1>INFORMASI PENGUSUL : </h1>

@section('content')
	{{ Form::open(array('route' => 'prosesPengajuan')) }}

		{{ Form::label('jenis_usulan', 'Jenis Usulan')}}
		
		{{ Form::open() }}
			<select id="jenisUsulan" name="jenisUsulan">
				<option value="1">Pendirian</option>
				<option value="2">Perubahan</option>
				<option value="3">Statuta</option>
				<option value="3">Penutupan</option>
			</select>
		{{ Form::close();}}

		{{ Form::label('unit_kerja', 'Unit Kerja')}}
		{{ Form::text('unit_kerja') }}

		
		{{ Form::label('jabatan', 'Jabatan')}}
		{{ Form::text('jabatan') }}

		{{ Form::label('nip', "NIP")}}
		{{ Form::text('nip') }}

		{{ Form::label('nama_pemohon', "Nama Pemohon")}}
		{{ Form::text('nama_pemohon') }}

		{{ Form::label('alamat_kantor', 'Alamat Kantor')}}
		{{ Form::text('alamat_kantor') }}

		{{ Form::label('telp_kantor', 'Telepon Kantor')}}
		{{ Form::text('telp_kantor') }}

		{{ Form::label('pos_el', 'Pos_el')}}
		{{ Form::text('pos_El') }}

		<br>
		{{ Form::submit('Kirim') }}

	{{ Form::close() }}
@stop




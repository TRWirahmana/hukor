
@section('content')
	{{ Form::open(array('route' => 'prosesPengajuan')) }}

		{{ Form::label('nama_pemohon', 'Nama Pemohon')}}
		{{ Form::text('nama_pemohon') }}]
		
		{{ Form::label('jabatan', 'Jabatan')}}
		{{ Form::text('jabatan') }}

		{{ Form::label('nip', "NIP")}}
		{{ Form::text('nip') }}

		{{ Form::label('unit_kerja', "Unit Kerja")}}
		{{ Form::text('unit_kerja') }}

		{{ Form::label('alamat_kantor', 'Alamat Kantor')}}
		{{ Form::text('alamat_kantor') }}

		{{ Form::label('telp_kantor', 'Telepon Kantor')}}
		{{ Form::text('telp_kantor') }}

		{{ Form::label('pos_el', 'Pos_el')}}
		{{ Form::text('pos_El') }}

		{{ Form::submit('Kirim') }}

	{{ Form::close() }}
@stop
@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
<legend>Bantuan Hukum</legend>

@include('flash')

    {{ Form::open(array('action' => 'BantuanHukumController@save', 'method' => 'post',
                        'id' => 'user-registrasi-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal')) }}

        {{ Form::hidden('id', $user->id, array('id' => 'id')) }}
        <div class="row-fluid">
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>INFORMASI PEMOHON</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('nama_pemohon', 'Nama Pemohon', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nama_pemohon', $user->nama_lengkap, array('id' => 'nama_pemohon', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <?php $jenis_kelamin = ($user->jenis_kelamin == 1) ? "Laki-laki" : "Perempuan"; ?>
                <div class="control-group">
                    {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('jenis_kelamin', $jenis_kelamin, array('id' => 'jenis_kelamin', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('tgl_lahir', $user->tgl_lahir, array('id' => 'tgl_lahir', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('pekerjaan', $user->pekerjaan, array('id' => 'pekerjaan', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('nip', $user->nip, array('id'=>'nip', 'disabled' => 'disabled'))}}
                    </div>
                </div>

                <div class="control-group {{$errors->has('password')?'error':''}}">
                    {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::textarea('alamat_kerja', $user->alamat_kantor, array('id'=>'alamat_kerja', 'disabled' => 'disabled'))}}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('telp_kantor', $user->tlp_kantor, array('id'=>'telp_kantor', 'disabled' => 'disabled'))}}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('handphone', 'Telepon Genggam', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('handphone', $user->handphone, array('id'=>'handphone', 'disabled' => 'disabled'))}}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('email', 'Pos-El', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('email', $user->email, array('id'=>'email', 'disabled' => 'disabled'))}}
                    </div>
                </div>
            </div>
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>INFORMASI PERKARA</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('jns_perkara', 'Jenis Perkara', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::select('jns_perkara', array(
                                '0' => '- Pilih Perkara -',
                                '1' => 'Tata Usaha Negara',
                                '2' => 'Perdata',
                                '3' => 'Pidana',
                                '4' => 'Uji Materil MK',
                                '5' => 'Uji Materil MA'
                        ), 'Pilih Perkara') }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('status_perkara', 'Status Perkara', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('status_perkara', '', array('id' => 'status_perkara')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('status_pemohon', 'Status Pemohon (saat pengajuan permohonan)', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::select('status_pemohon', array(
                        '0' => '- Pilih Status Pemohon -',
                        '1' => 'Tergugat',
                        '2' => 'Penggugat',
                        '3' => 'Interfent',
                        '4' => 'Saksi',
                        '5' => 'Pemohon'
                        ), 'Pilih Status Pemohon') }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('uraian', 'Uraian Singkat Mengenai Pokok Persoalan yang Dimohonkan Bantuan Hukum', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::textarea('uraian', '', array('id' => 'catatan')) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>INFORMASI REGISTRASI</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('nama', 'Nama', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nama', $user->nama_lengkap, array('id' => 'nama', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('email2', 'Pos-El', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('email2', $user->email, array('id'=>'email2', 'disabled' => 'disabled')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('id_number', 'ID-Number', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('id_number', $user->id, array('id' => 'id_number', 'disabled' => 'disabled')) }}
                    </div>
                </div>
            </div>
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>INFORMASI LAMPIRAN</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('ket_lampiran', 'Keterangan Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('ket_lampiran', '', array('id' => 'ket_lampiran')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::file('lampiran', array('id'=>'lampiran')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::textarea('catatan', '', array('id' => 'catatan')) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span24 text-center">
                <button class="btn" type="submit">Simpan</button>
            </div>
        </div>
{{ Form::close() }}
@stop
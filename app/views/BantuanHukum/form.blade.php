@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
<legend>Bantuan Hukum</legend>

@include('flash')

    {{ Form::open(array('route' => 'save_bahu', 'method' => 'post',
                        'id' => 'user-registrasi-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal',
                        'enctype' => "multipart/form-data")) }}


        {{ Form::hidden('id', $user->id, array('id' => 'id')) }}
        <div class="row-fluid">
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>PENANGGUNG JAWAB</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('nama', 'Nama Penanggung Jawab', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nama', '', array('id' => 'nama')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label')) }}
                    <div class="controls">
                        <div class="control-group">
                            {{ Form::label('pria', 'Laki-Laki', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::radio('jenis_kelamin', 1, false, array('id' => 'pria')) }}
                            </div>
                        </div>

                        <div class="control-group">
                            {{ Form::label('wanita', 'Perempuan', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::radio('jenis_kelamin', 0, false, array('id' => 'wanita')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('tgl_lahir', '', array('id' => 'tgl_lahir', 'class' => 'datepicker')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('pekerjaan', '', array('id' => 'pekerjaan')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nip', '', array('id'=>'nip')) }}
                    </div>
                </div>

                <div class="control-group {{$errors->has('password')?'error':''}}">
                    {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::textarea('alamat_kantor', '', array('id'=>'alamat_kantor')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('telp_kantor', '', array('id'=>'telp_kantor')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('handphone', 'Telepon Genggam', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('handphone', '', array('id'=>'handphone')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('email', 'E-Mail', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('email', '', array('id'=>'email')) }}
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
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
{{ Form::close() }}
@stop

@section('scripts')
@parent
<script type="text/javascript">
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            yearRange: "1970:2020",
            changeYear: true
        }).val();
    });
</script>
@stop
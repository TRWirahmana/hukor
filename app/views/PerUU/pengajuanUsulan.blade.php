@section('content')

<h2>PERATURAN PERUNDANG-UNDANGAN</h2>
<div class="stripe-accent"></div>
<legend>Pengajuan Usulan</legend>

@include('flash')
<div class="content-non-title">

    {{ Form::open(array('route' => 'proses_pengajuan', 'files' => true, 'class' => 'form form-horizontal'))}}

    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend>Informasi Pengusul</legend>

                <div class="control-group">
                    <div class="control-group">
                        {{ Form::label('nama_pemohon', 'Nama Pemohon', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('nama_pemohon', $user->pengguna->nama_lengkap) }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('jabatan', $user->pengguna->detailJabatan->nama_jabatan) }}
                        </div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('nip', $user->pengguna->nip) }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('unit_kerja', "Unit Kerja", array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('unit_kerja', $user->pengguna->unit_kerja) }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('alamat_kantor', $user->pengguna->alamat_kantor) }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('telp_kantor', $user->pengguna->tlp_kantor) }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('pos_el', 'Pos_el', array('class' => 'control-label'))}}
                        <div class="controls">
                            {{ Form::text('pos_El', $user->pengguna->email) }}
                        </div>
                    </div>

            </fieldset>
        </div>

        <div class="span12">
            <fieldset>
                <legend>Informasi Perihal & Lampiran</legend>

                <div class="control-group">
                    {{ Form::label("per_uu[perihal]", "Perihal", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::text("per_uu[perihal]") }}</div>
                </div>
                <div class="control-group">
                    {{ Form::label("per_uu[lampiran]", "Lampiran", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::file("per_uu[lampiran]") }}</div>
                </div>
                <div class="control-group">
                    {{ Form::label("per_uu[catatan]", "Catatan", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::textarea("per_uu[catatan]") }}</div>
                </div>

            </fieldset>

        </div>

    </div>	

    <div class="row-fluid">
        <div class="span6"></div>
        <div class="span12">

            <fieldset>
                <legend>Informasi Registrasi</legend>

                <div class="control-group">
                    {{ Form::label("nama", "Nama", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::text("nama", $user->pengguna->nama_lengkap, array('disabled' => 'disabled')) }}</div>
                </div>
                <div class="control-group">
                    {{ Form::label('pos_el', "Pos El", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::text('pos_el', $user->pengguna->email, array('disabled' => 'disabled')) }}</div>
                </div>
                <div class="control-group">
                    {{ Form::label('id_number', 'Id Number', array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::text('id_number', $user->pengguna->user_id, array('disabled' => 'disabled')) }}</div>
                </div>

            </fieldset>
        </div>
        <div class="span6"></div>
    </div>	

    <div class="form-actions">
        {{ Form::submit('Kirim', array('class' => 'btn btn-primary')) }}
    </div>

    {{ Form::close() }}
</div>
@stop

@section('scripts')
@parent
<script type="text/javascript">
    $("#menu-peraturan-perundangan").addClass("active");
</script>

@stop
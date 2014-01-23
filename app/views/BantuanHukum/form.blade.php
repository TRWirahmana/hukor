@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
<legend>Bantuan Hukum</legend>

@include('flash')

    {{ Form::open(array('action' => 'BantuanHukumController@save', 'method' => 'post',
                        'id' => 'user-registrasi-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal')) }}
        <div class="row-fluid">
            <div class="span12">
                <div class="control-group">
                    {{ Form::label('nama_pemohon', 'Nama Pemohon', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nama_pemohon', '', array('id' => 'nama_pemohon')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('username', '', array('id' => 'jabatan')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('nip','', array('id'=>'nip'))}}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('unit_kerja','', array('id'=>'unit_kerja'))}}
                    </div>
                </div>

                <div class="control-group {{$errors->has('password')?'error':''}}">
                    {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::textarea('alamat_kerja','', array('id'=>'alamat_kerja'))}}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('telp_kantor','', array('id'=>'telp_kantor'))}}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('email', 'Pos-El', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{Form::text('email','', array('id'=>'email'))}}
                    </div>
                </div>
            </div>
            <div class="span12">
                <div class="control-group">
                    {{ Form::label('perihal', 'Perihal', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('perihal', '', array('id' => 'perihal')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('lampiran', '', array('id' => 'lampiran')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('catatan', '', array('id' => 'catatan')) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">

            </div>
            <div class="span12">
                <div class="control-group">
                    {{ Form::label('nama', 'Nama', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nama', '', array('id' => 'nama')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('email2', 'Pos-El', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('email2', '', array('id'=>'email2')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('id_number', 'ID-Number', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('id_number', '', array('id' => 'id_number')) }}
                    </div>
                </div>
            </div>
        </div>
@stop
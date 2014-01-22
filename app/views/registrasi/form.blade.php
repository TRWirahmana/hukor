@section('content')

{{-- form registrasi --}}
    {{ Form::open(array('action' => 'RegistrasiController@send', 'method' => 'post', 'id'=>'user-register-form', 'class' =>'front-form', 'autocomplete' => 'off', )) }}

        <div class="control-group {{$errors->has('nama_lengkap')?'error':''}}">
            {{ Form::label('nama_lengkap', 'Nama Lengkap', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('nama_lengkap', '',
                array('placeholder' => 'ketikkan Nama Lengkap di sini...')) }}

                @foreach($errors->get('nama_lengkap') as $error)
                <span class="help-block">{{$error}}</span>
                @endforeach
            </div>
        </div>

        <div class="control-group {{$errors->has('username')?'error':''}}">
            {{ Form::label('username', 'Nama Pengguna', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('username', '',
                array('placeholder' => 'Minimal 6 karakter, tidak memakai spasi.')) }}

                @foreach($errors->get('username') as $error)
                <span class="help-block">{{$error}}</span>
                @endforeach
            </div>
        </div>

        <label for='email'>Email</label>
        {{
        Form::text('email','', array(
        'class'=>'password text-input',
        'id'=>'email',
        'placeholder'=>'ketikkan alamat email di sini...',
        ))
        }}

        <div class="control-group {{$errors->has('password')?'error':''}}">
            {{ Form::label('password', 'Password', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::password('password') }}
            </div>
        </div>

        <div class="control-group {{$errors->has('password')?'error':''}}">
            {{ Form::label('password_confirmation', 'Konfirmasi password', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::password('password_confirmation') }}

                @foreach($errors->get('password') as $errors)
                <span class="help-block">{{$errors}}</span>
                @endforeach
            </div>
        </div>


<div class="control-group {{$errors->has('nip')?'error':''}}">
    {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('nip', '',
        array('placeholder' => 'ketikkan NIP di sini...')) }}

        @foreach($errors->get('nip') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('jabatan')?'error':''}}">
    {{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('jabatan', '',
        array('placeholder' => 'ketikkan Jabatan di sini...')) }}

        @foreach($errors->get('jabatan') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('bagian')?'error':''}}">
    {{ Form::label('bagian', 'Bagian', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('bagian', '',
        array('placeholder' => 'ketikkan Bagian di sini...')) }}

        @foreach($errors->get('bagian') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('sub_bagian')?'error':''}}">
    {{ Form::label('sub_bagian', 'Sub Bagian', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('sub_bagian', '',
        array('placeholder' => 'ketikkan Sub Bagian di sini...')) }}

        @foreach($errors->get('sub_bagian') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group block-field {{$errors->has('jenis_kelamin')?'error':''}}">
    {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label required')) }}
    <div class="controls">
        <label class="radio">
            {{ Form::radio('jenis_kelamin', 1, array('id'=>'kelamin-laki2', 'checked' => 'checked') ) }} <span>Laki-laki</span>
        </label>
        <label class="radio">
            {{ Form::radio('jenis_kelamin', 0, array('id'=>'kelamin-perempuan')) }} <span>Perempuan</span>
        </label>
        @foreach($errors->get('jenis_kelamin') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('pekerjaan')?'error':''}}">
    {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('pekerjaan', '',
        array('placeholder' => 'ketikkan Pekerjaan anda di sini...')) }}

        @foreach($errors->get('pekerjaan') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('alamat_kantor')?'error':''}}">
    {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::textarea('alamat_kantor', '',
        array('placeholder' => 'ketikkan Alamat Kantor anda di sini...')) }}

        @foreach($errors->get('alamat_kantor') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('tlp_kantor')?'error':''}}">
    {{ Form::label('tlp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('tlp_kantor', '',
        array('placeholder' => 'ketikkan Telepon Kantor anda di sini...')) }}

        @foreach($errors->get('tlp_kantor') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('handphone')?'error':''}}">
    {{ Form::label('handphone', 'Pekerjaan', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('handphone', '',
        array('placeholder' => 'ketikkan nomor handphone anda di sini...')) }}

        @foreach($errors->get('handphone') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

<div class="control-group {{$errors->has('unit_kerja')?'error':''}}">
    {{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label')) }}
    <div class="controls">
        {{ Form::text('unit_kerja', '',
        array('placeholder' => 'ketikkan Unit Kerja anda di sini...')) }}

        @foreach($errors->get('unit_kerja') as $error)
        <span class="help-block">{{$error}}</span>
        @endforeach
    </div>
</div>

        <span><button class="btn" type="submit">Register</button>

    {{ Form::close() }}

@stop
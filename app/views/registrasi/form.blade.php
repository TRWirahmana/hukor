@section('content')

{{-- form registrasi --}}
    {{ Form::open(array('action' => 'RegistrasiController@send', 'method' => 'post', 'id'=>'user-register-form', 'class' =>'front-form form-horizontal', 'autocomplete' => 'off', )) }}

        <div class="row-fluid">
          <div class="span12">
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

            <div class="control-group">
              <label for='email' class="control-label">Email</label>
              <div class="controls">
                {{
                Form::text('email','', array(
                'class'=>'password text-input',
                'id'=>'email',
                'placeholder'=>'ketikkan alamat email di sini...',
                ))
                }}
              </div>
            </div>

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
          </div>
          <div class="span12">
            simpen form di sini
          </div>
        </div>

        <div class="row-fluid">
          <div class="span24 text-center">
            <button class="btn" type="submit">Register</button>
          </div>
        </div>

    {{ Form::close() }}

@stop

@section('content')
<!--PENGATURAN AKUN-->
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-settings'></span> Pengaturan akun";
</script>
@include('flash')
	{{ Form::open($form_opts) }}

	<div class="row-fluid">
      <div class="span12 offset6">
        <fieldset>
          <legend class="f_legend">{{$title}}</legend>
          <p class="text-info">{{$detail}}</p>

          <div class="control-group {{$errors->has('username')?'error':''}}">
            {{ Form::label('username', 'Ubah Email', array('class' => 'control-label')) }}
            <div class="controls">
              {{ Form::text('username', $user->username,
              array('placeholder' => 'Minimal 6 karakter, tidak memakai spasi.')) }}

              @foreach($errors->get('username') as $error)
              <span class="help-block">{{$error}}</span>
              @endforeach
            </div>
          </div>

          <div class="control-group {{$errors->has('password')?'error':''}}">
            {{ Form::label('password', 'Ubah Password', array('class' => 'control-label')) }}
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

        </fieldset>

        <div class="control-group">
          <div class="controls span4 offset6">
            {{ Form::submit('Simpan', array('class' => 'btn btn-hukor')) }}
          </div>
        </div>
      </div>



	</div>
	{{ Form::close() }}
@stop


@section('scripts')
	@parent
@stop
@section('content')
<h2><span class="rulycon-lock"></span>Reset Password</h2>

@include('flash')
<div class="content-non-title">
  <div class="row-fluid">

    {{ Form::open(array('action' => 'ForgetPasswordController@reset', 'method' => 'post', 'id'=>'user-register-form',
    'class' =>'front-form', 'autocomplete' => 'off')) }}

    <div id="welcome-to-the-fucking-app">
      <p>Silakan masukkan alamat email Anda untuk melakukan proses reset password.</p>
      {{
      Form::text('email','', array(
      'class'=>'email text-input',
      'id'=>'email',
      'placeholder'=>'Masukan alamat email di sini...',
      'style'=>'margin-bottom: 0; min-width: 360px;'
      ))
      }}
      <button class="btn btn-hukor" type="submit">KIRIM</button>
    </div>

    {{ Form::close() }}

  </div>
</div>
@stop

@section('scripts')
@parent
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<script src="{{asset('assets/js/registrasi.js')}}"></script>

<script type="text/javascript">
  Registrasi.Form();
</script>
@stop
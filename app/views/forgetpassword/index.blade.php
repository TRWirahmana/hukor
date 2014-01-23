@section('content')
<h2>Reset Password</h2>
<div class="stripe-accent"></div>
@include('flash')
<div class="row-fluid">

    {{ Form::open(array('action' => 'ForgetPasswordController@reset', 'method' => 'post', 'id'=>'user-register-form', 'class' =>'front-form', 'autocomplete' => 'off')) }}

    <h5>Masukkan Alamat Email anda</h5>
        <div class="control-group">
            <label for='email' class="control-label">Email</label>
            <div class="controls">
                {{
                Form::text('email','', array(
                'class'=>'email text-input',
                'id'=>'email',
                'placeholder'=>'ketikkan alamat email di sini...',
                ))
                }}
            </div>
        </div>

        <span><button class="btn" type="submit">Reset</button>

              {{ Form::close() }}

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
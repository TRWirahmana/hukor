@section('content')

{{-- form login--}}
{{ Form::open(array('action' => 'LoginController@signin', 'method' => 'post', 'id'=>'user-sign-in-form',
'class' =>'front-form', 'autocomplete' => 'off')) }}

@if(Session::has('success'))

<div class="alert alert-success sign-in-register-alert">
    {{ Session::get('success') }}
</div>
@elseif(Session::has('error'))
<div class="alert alert-error sign-in-register-alert">
    <button type="button" class="close" data-dismiss="alert">×</button>
    {{ Session::get('error') }}
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{{
Form::text('username', '', array(
'class'=>'username validate[required] text-input',
'id'=>'username',
'placeholder'=>'ketikkan username di sini...'
))
}}
{{ Form::password('password', array('class'=>'password validate[required] text-input',
'id'=>'password','placeholder'=>'ketikkan password di sini...')) }}
<button class="btn" id="btn-signin" type="submit">Sign in</button>
{{ Form::close() }}

@stop
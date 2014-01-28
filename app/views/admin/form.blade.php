@section('styles');
	@parent
@stop
@section('content')
<h2>Kelola Akun</h2>
<div class="stripe-accent"></div>
	{{ Form::open($form_opts) }}

	<div style="width: 40%; margin: 50px auto;">
				<fieldset>
					<legend class="f_legend">{{$title}}</legend>
					<p class="text-info">{{$detail}}</p>

					<div class="control-group">
						{{ Form::label('nama_lengkap', 'Nama Lengkap', array('class' => 'control-label')); }}
						<div class="controls">
                            @if(!is_object($user->pengguna))
                                {{ Form::text('nama_lengkap', $user->nama_lengkap, array('placeholder' => 'Tuliskan nama lengkap.')) }}
                            @else
                                {{ Form::text('nama_lengkap', $user->pengguna->nama_lengkap, array('placeholder' => 'Tuliskan nama lengkap.')) }}
                            @endif
						</div>
					</div>

					<div class="control-group {{$errors->has('email')? 'error':''}}">
						{{ Form::label('email', 'Alamat E-Mail', array('class' => 'control-label')) }}
						<div class="controls">
                            @if(!is_object($user->pengguna))
                            {{ Form::text('email', '', array('placeholder' => 'contoh: example@email.com')) }}
                            @else
                            {{ Form::text('email', $user->pengguna->email, array('placeholder' => 'contoh: example@email.com')) }}
                            @endif

                            @foreach($errors->get('email') as $error)
								<span class="help-block">{{ $error }}</span>
							@endforeach
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
							
							@foreach($errors->get('password') as $error)
							    <span class="help-block">{{$error}}</span>
							@endforeach
						</div>
					</div>

                    <div class="control-group">
                        {{ Form::label('role', 'Pilih Role', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ Form::select('role', $listRole, $user->role_id, array("id" => "role_id")) }}
                        </div>
                    </div>

				</fieldset>

				<div class="form-actions">
					<div class="controls">
						{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
					</div>
				</div>

	</div>
	{{ Form::close() }}
@stop


@section('scripts')
	@parent
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<script src="{{asset('assets/js/registrasi_admin.js')}}"></script>
	<script>
        Admin.Form();
		
	</script>
@stop
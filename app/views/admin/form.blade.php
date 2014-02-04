@section('styles');
	@parent
@stop
@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Kelola Akun</a>  <span class="separator"></span></li>
        <li>Edit Akun</li>
    </ul>

    <div class="pageheader">
<!--        <form action="results.html" method="post" class="searchbar">-->
<!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
<!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Edit Akun</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
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

            <div class="footer">
                <div class="footer-left">
                    <span>&copy; 2013. Admin Template. All Rights Reserved.</span>
                </div>
                <div class="footer-right">
                    <span></span>
                </div>
            </div>
            <!--footer-->
        </div>
        <!--maincontentinner-->
    </div>
    <!--maincontent-->


</div>
<!--rightpanel-->

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
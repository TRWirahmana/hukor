@section('styles');
	@parent
@stop
@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="dashboard.html"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li>Beranda</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <form action="results.html" method="post" class="searchbar">
            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>
        </form>
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Selamat Datang</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            {{ Form::open($form_opts) }}

            <div class="row-fluid">
                <div class="span12 offset6">
                    <fieldset>
                        <legend class="f_legend">{{$title}}</legend>
                        <p class="text-info">{{$detail}}</p>

                        <div class="control-group {{$errors->has('username')?'error':''}}">
                            {{ Form::label('username', 'Username', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::text('username', $user->username,
                                array('placeholder' => 'Minimal 6 karakter, tidak memakai spasi.')) }}

                                @foreach($errors->get('username') as $error)
                                <span class="help-block">{{$error}}</span>
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

                                @foreach($errors->get('password') as $errors)
                                <span class="help-block">{{$errors}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="control-group">
                            
                        </div>

                    </fieldset>

                    <div class="control-group">
                        <div class="controls">
                            {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
                        </div>
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
@stop
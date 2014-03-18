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
    <div class="pageicon"><span class="rulycon-cog"></span></div>
    <div class="pagetitle">
      <h1>Pengaturan akun</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    <div class="maincontentinner">

      <!-- MAIN CONTENT -->
      {{ Form::open($form_opts) }}

      <div class="row-fluid">
        <div class="span6 offset3">
          <div class="form-horizontal">
            <fieldset>
              <p class="text-info">{{$detail}}</p>
              <legend class="f_legend">{{$title}}</legend>
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

              <div class="control-group">
                <div class="controls">
                  {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
                </div>
              </div>
            </fieldset>
          </div>


        </div>


      </div>
      {{ Form::close() }}

      <div class="footer">
        <div class="footer-left">
            <span>&copy;2014 Biro Hukum dan Organisasi</span>
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
<script>
  jQuery("#user-links > a:first-child").addClass("sub-menu-active");
</script>
@stop
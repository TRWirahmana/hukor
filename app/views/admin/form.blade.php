@section('styles');
@parent
@stop
@section('admin')
<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Kelola Akun</a> <span class="separator"></span></li>
    <li>{{$title}}</li>
  </ul>
  @include('adminflash')
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-user"></span></div>
    <div class="pagetitle">
      <!--<h5>Events</h5>-->

      <h1>{{$title}}</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    <div class="maincontentinner">

      <!-- MAIN CONTENT -->
      {{ Form::open($form_opts) }}

      <div class="row-fluid">
        <div class="span8 offset2">
          <fieldset>
            <legend class="f_legend">{{$title}}</legend>
            <p class="text-info">{{$detail}}</p>

            <div class="control-group">
              {{ Form::label('nip', 'NIP', array('class' => 'control-label')); }}
              <div class="controls">
                @if(!is_object($user->pengguna))
                {{ Form::text('nip', $user->pengguna->nip, array('placeholder' => 'Masukan NIP.')) }}
                @else
                {{ Form::text('nip', $user->pengguna->nip, array('placeholder' => 'Masukan NIP.')) }}
                @endif
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('nama_lengkap', 'Nama Lengkap', array('class' => 'control-label')); }}
              <div class="controls">
                @if(!is_object($user->pengguna))
                {{ Form::text('nama_lengkap', $user->nama_lengkap, array('placeholder' => 'Tuliskan nama lengkap.')) }}
                @else
                {{ Form::text('nama_lengkap', $user->pengguna->nama_lengkap, array('placeholder' => 'Tuliskan nama
                lengkap.')) }}
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

            <div class="control-group">
              {{ Form::label('bagian', 'Pilih Bagian', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::select('bagian', $listbagian, $nama_bagian, array("id" => "bagian")) }}
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('sub_bagian', 'Pilih Sub Bagian', array('class' => 'control-label')) }}
              <div class="controls">
                @if(!is_null($nama_subbagian))
                {{ Form::select('sub_bagian', $listsubbagian, $nama_subbagian , array("id" => "sub_bagian")) }}
                @else

                <select name="sub_bagian" id="sub_bagian">
                </select>
                @endif
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

            <div class="control-group">
              <div class="controls">
                  <input class="btn btn-primary" type="button" value="Batal" onclick="history.go(-1);return true;" name="batal">
                {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
              </div>
            </div>

          </fieldset>
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
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<script src="{{asset('assets/js/registrasi_admin.js')}}"></script>
<script>
    jQuery("#kelola > a").addClass("sub-menu-active");
    jQuery("#manage").css({
        "display": "block",
        "visibility": "visible"
    });

  Admin.Form();

</script>
<script>
  jQuery(document).on("ready", function() {
      var titles = '{{ $title }}';
    document.title = "Layanan Biro Hukum dan Organisasi |"+ titles ;
  });
</script>
@stop
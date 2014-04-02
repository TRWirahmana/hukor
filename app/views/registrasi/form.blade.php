@section('content')

<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-plus'></span> Pendaftaran";
</script>
@include('flash')

{{-- form registrasi --}}
    {{ Form::open(array('action' => 'RegistrasiController@send', 'method' => 'post', 'id'=>'user-register-form', 'class' =>'front-form form-horizontal' )) }}

<div class="span24" style="margin-bottom: 20px;margin-top:0px;">
    <strong>Silahkan lengkapi formulir berikut untuk melakukan pendaftaran. Isian dengan tanda <span class="required"></span> wajib diisi.</strong>
</div>
        <div class="row-fluid">
<!--            left content-->
          <div class="span12">
              <div class="nav nav-tabs">
                  <h4>Registrasi User</h4>
              </div>

            <div class="control-group">
              <label for='email' class="control-label required">Email</label>
              <div class="controls">
                {{
                Form::text('email','', array(
                'class'=>'password text-input',
                'id'=>'email',
                'placeholder'=>'Masukkan alamat email di sini...',
                ))
                }}
              </div>
            </div>

            <div class="control-group {{$errors->has('password')?'error':''}}">
              {{ Form::label('password', 'Password', array('class' => 'control-label required')) }}
              <div class="controls">
                {{ Form::password('password') }}
              </div>
            </div>

            <div class="control-group {{$errors->has('password')?'error':''}}">
              {{ Form::label('password_confirmation', 'Konfirmasi password', array('class' => 'control-label required')) }}
              <div class="controls">
                {{ Form::password('password_confirmation') }}

                @foreach($errors->get('password') as $errors)
                <span class="help-block">{{$errors}}</span>
                @endforeach
              </div>
            </div>
          </div>
<!--            right content-->
          <div class="span12">
              <div class="nav nav-tabs">
                  <h4>Data Pendaftar</h4>
              </div>
              <div class="control-group {{$errors->has('nama_lengkap')?'error':''}}">
                  {{ Form::label('nama_lengkap', 'Nama Lengkap', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('nama_lengkap', '',
                      array('placeholder' => 'Masukkan Nama Lengkap di sini...')) }}

                      @foreach($errors->get('nama_lengkap') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('tempat_lahir')?'error':''}}">
                  {{ Form::label('tempat_lahir', 'Tempat Lahir', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('tempat_lahir', '',
                      array('placeholder' => 'Masukkan Tempat Lahir anda di sini...')) }}

                      @foreach($errors->get('tempat_lahir') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('tgl_lahir')?'error':''}}">
                  {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('tgl_lahir', '', array('class'=>'datepicker')) }}

                      @foreach($errors->get('tgl_lahir') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>


              <div class="control-group {{$errors->has('jenis_kelamin')?'error':''}}">
                  {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label required')) }}
                  <div class="controls">
                      <label class="radio">
                          <input type="radio" name="jenis_kelamin" value="1">Laki-laki<br>
                          <!--                          {{ Form::radio('jenis_kelamin', 1, array('id'=>'kelamin-laki2') ) }} <span>Laki-laki</span>-->
                      </label>
                      <label class="radio">
                          <input type="radio" name="jenis_kelamin" value="0">Perempuan<br>
                          <!--                          {{ Form::radio('jenis_kelamin', 0, array('id'=>'kelamin-perempuan')) }} <span>Perempuan</span>-->
                      </label>
                      @foreach($errors->get('jenis_kelamin') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>


              <div class="control-group {{$errors->has('nip')?'error':''}}">
                  {{ Form::label('nip', 'NIP', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('nip', '',
                      array('placeholder' => 'Masukkan NIP di sini...')) }}

                      @foreach($errors->get('nip') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('unit_kerja')?'error':''}}">
                  {{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('unit_kerja', '',
                      array('placeholder' => 'Masukkan Unit Kerja anda di sini...')) }}

                      @foreach($errors->get('unit_kerja') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('jabatan')?'error':''}}">
                  {{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('jabatan', '',
                      array('placeholder' => 'Masukkan jabatan anda di sini...')) }}

                      @foreach($errors->get('jabatan') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

<!--              <div class="control-group {{$errors->has('pekerjaan')?'error':''}}">-->
<!--                  {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label required')) }}-->
<!--                  <div class="controls">-->
<!--                      {{ Form::text('pekerjaan', '', array('placeholder' => 'Masukkan Pekerjaan anda di sini...')) }}-->
<!--                      @foreach($errors->get('pekerjaan') as $error)-->
<!--                      <span class="help-block">{{$error}}</span>-->
<!--                      @endforeach-->
<!--                  </div>-->
<!--              </div>-->

              <div class="control-group {{$errors->has('alamat_kantor')?'error':''}}">
                  {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::textarea('alamat_kantor', '',
                      array('placeholder' => 'Masukkan Alamat Kantor anda di sini...')) }}

                      @foreach($errors->get('alamat_kantor') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('tlp_kantor')?'error':''}}">
                  {{ Form::label('tlp_kantor', 'Telepon Kantor', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('tlp_kantor', '',
                      array('placeholder' => 'ketikkan Telepon Kantor anda di sini...', 'id' => 'tlp_kantor')) }}

                      @foreach($errors->get('tlp_kantor') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
                  <p class="span9" style="color: #616D79;font-size: 11px;">Format: (999) 999-9999</p>
              </div>

              <div class="control-group {{$errors->has('handphone')?'error':''}}">
                  {{ Form::label('handphone', 'No Handphone', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('handphone', '',
                      array('placeholder' => 'Masukkan nomor handphone anda di sini...', 'id' => 'hp')) }}

                      @foreach($errors->get('handphone') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
                  <p class="span9" style="color: #616D79;font-size: 11px;">Format: 999-999-999-999</p>
              </div>

              <div class="span15">
                  <div class="controls">
                      <img src="{{URL::to('captcha')}}" id="captcha" /><br/>
                  </div>
<!--                  <br>-->
                  <div class="controls">
                      <input name="code" type="text" id="code">
                      <a href="#" onclick="document.getElementById('captcha').src='{{URL::to('captcha')}}?rnd=' + Math.random();">Ubah Kode.</a>
                  </div>
              </div>


          </div>
        </div>

        <div class="row-fluid" style="margin-top: 24px; margin-bottom: 48px;">
          <div class="span24 text-center">
            <button class="btn btn-primary" type="submit" id="submit">Daftar</button>
          </div>
        </div>

    {{ Form::close() }}

@stop

@section('scripts')
@parent
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<script src="{{asset('assets/js/registrasi.js')}}"></script>
<script src="{{asset('assets/js/jquery.mask.js')}}"></script>

<script type="text/javascript">
    $(function() {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            yearRange: "1950:2020",
            changeYear: true,
            onClose: function() {
                $('.datepicker').trigger('blur');
            }
        }).val();

        $("#tlp_kantor").mask("(999) 999-9999");
        $("#hp").mask("999-999-999-999");

    });
    Registrasi.Form();
</script>
@stop
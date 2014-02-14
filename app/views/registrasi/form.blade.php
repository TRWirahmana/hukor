@section('content')

<h2>Pendaftaran</h2>
<div class="stripe-accent"></div>
@include('flash')

{{-- form registrasi --}}
    {{ Form::open(array('action' => 'RegistrasiController@send', 'method' => 'post', 'id'=>'user-register-form', 'class' =>'front-form form-horizontal' )) }}

<div class="span24" style="margin-bottom: 20px;margin-top:0px;margin-left:50px">
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
                'placeholder'=>'ketikkan alamat email di sini...',
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
                      array('placeholder' => 'ketikkan Nama Lengkap di sini...')) }}

                      @foreach($errors->get('nama_lengkap') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>
              <div class="control-group {{$errors->has('nip')?'error':''}}">
                  {{ Form::label('nip', 'NIP', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('nip', '',
                      array('placeholder' => 'ketikkan NIP di sini...')) }}

                      @foreach($errors->get('nip') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>



              <div class="control-group {{$errors->has('jabatan')?'error':''}}">
                  {{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::select('jabatan', array('1' => 'Direktur', '2' => 'Kepala Divisi'), 'Pilih Pekerjaan') }}

                      @foreach($errors->get('jabatan') as $error)
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

              <div class="control-group {{$errors->has('tgl_lahir')?'error':''}}">
                  {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('tgl_lahir', '', array('class'=>'datepicker')) }}

                      @foreach($errors->get('tgl_lahir') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('pekerjaan')?'error':''}}">
                  {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('pekerjaan', '',
                      array('placeholder' => 'ketikkan Pekerjaan anda di sini...')) }}

                      @foreach($errors->get('pekerjaan') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('alamat_kantor')?'error':''}}">
                  {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::textarea('alamat_kantor', '',
                      array('placeholder' => 'ketikkan Alamat Kantor anda di sini...')) }}

                      @foreach($errors->get('alamat_kantor') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('tlp_kantor')?'error':''}}">
                  {{ Form::label('tlp_kantor', 'Telepon Kantor', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('tlp_kantor', '',
                      array('placeholder' => 'ketikkan Telepon Kantor anda di sini...')) }}

                      @foreach($errors->get('tlp_kantor') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('handphone')?'error':''}}">
                  {{ Form::label('handphone', 'Handphone', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('handphone', '',
                      array('placeholder' => 'ketikkan nomor handphone anda di sini...')) }}

                      @foreach($errors->get('handphone') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="control-group {{$errors->has('unit_kerja')?'error':''}}">
                  {{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label required')) }}
                  <div class="controls">
                      {{ Form::text('unit_kerja', '',
                      array('placeholder' => 'ketikkan Unit Kerja anda di sini...')) }}

                      @foreach($errors->get('unit_kerja') as $error)
                      <span class="help-block">{{$error}}</span>
                      @endforeach
                  </div>
              </div>

              <div class="span15">
                  <div class="controls">
                      <img src="{{URL::to('captcha')}}" id="captcha" /><br/>
                  </div>
<!--                  <br>-->
                  <div class="controls">
                      <input name="code" type="text" id="code">
                      <a href="#" onclick="document.getElementById('captcha').src='{{URL::to('captcha')}}?rnd=' + Math.random();">Not readable? Change text.</a>
                  </div>
              </div>


          </div>
        </div>

        <div class="row-fluid">
          <div class="span24 text-center">
            <button class="btn btn-hukor" type="submit" id="submit">Register</button>
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

<script type="text/javascript">
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            yearRange: "1970:2020",
            changeYear: true
        }).val();
    });
    Registrasi.Form();
</script>
@stop
@section('content')
<div class="span24">

    <div id="logo-wrapper">
        <img src="{{asset('assets/img/tut-wuri-handayani.png')}}" alt="Direktorat Jenderal Kebudayaan Indonesia">
      <h4>Direktorat Jenderal Kebudayaan Republik Indonesia</h4>
    </div>
    <div class="row-fluid" id="sign-in-form">
        <div class="span12">
            <h3><span>Selamat datang di</span></h3>
            <h1>Sistem Registrasi Online Penyuluh Nasional</h1>

        </div>
        <div class="span8">
      
            {{-- form login--}}
            {{ Form::open(array('action' => 'LoginController@signin', 'method' => 'post', 'id'=>'user-sign-in-form', 'class' =>'front-form', 'autocomplete' => 'off')) }}

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

                <label for='username'>Username</label>
                {{ 
                    Form::text('username', '', array(
                        'class'=>'username validate[required] text-input',
                        'id'=>'username',
                        'placeholder'=>'Masukan username di sini...'
                    )) 
                }}
                <label for='password'>Password</label>
                {{ Form::password('password', array('class'=>'password validate[required] text-input', 'id'=>'password','placeholder'=>'Masukan password di sini...')) }}
                <span><button class="btn" id="btn-signin" type="submit">Sign in</button>
                Belum memiliki akun? <a href="javascript:void(0)" class="form-toggler">Tukar form registrasi</a></span>
                <!-- Belum memiliki akun? <a href="javascript:void(0)" class="form-toggler">Tukar form registrasi</a></span> -->
            {{ Form::close() }}

            {{-- form registrasi --}}
            {{ Form::open(array('action' => 'RegistrasiController@send', 'method' => 'post', 'id'=>'user-register-form', 'class' =>'front-form', 'autocomplete' => 'off', )) }}

                <label for='no_ktp'>Nomor KTP</label>
                {{ 
                    Form::text('no_ktp', '', array(
                        'class'=>'no_ktp text-input', 
                        'id'=>'no_ktp',
                        'placeholder'=>'Masukan nomor KTP di sini...',
                    ))
                }}

                <label for='email'>Email</label>
                {{
                    Form::text('email','', array(
                        'class'=>'password text-input', 
                        'id'=>'email',
                        'placeholder'=>'Masukan alamat email di sini...',
                    )) 
                }}

                <span><button class="btn" type="submit">Register</button>
                memiliki akun?  <a href="javascript:void(0)" class="form-toggler">Tukar form sign-in</a></span>
            {{ Form::close() }}
            
            {{ Form::open(array('url' => URL::to('error'), 'method' => 'get', 'id'=>'error-form', 'style' => 'color: white')) }}
                Batas akhir pendaftaran tanggal <strong><?php echo $tanggal_berakhir; ?></strong>. 
                Tata cara registrasi dapat dilihat di berkas panduan. <br/><br/>
                <a id="download_manual" href="{{ URL::to('manual_registrasi') }}" style="
                  text-align: center;
                  color: white;
                  font-weight: bold;
                  font-size: 15px;
                  text-decoration: underline;
                ">Unduh Berkas Tata Cara Registrasi</a>
            {{ Form::close() }}

        </div>
    </div>
</div>
    @section('scripts')
    @parent
    <script>
        $(function(){
            $("#user-register-form").hide();
            
            //tanggal estimasi pendaftaran
            <?php $t = EstimasiPendaftaran::find(1); ?>;
            var tanggal_mulai = '<?php echo ($t != null) ? $t->tanggal_mulai : null ; ?>';
            var tanggal_berakhir = '<?php echo ($t != null) ? $t->tanggal_berakhir : null; ?>';
			
			//todays
			var today = new Date();
			var date = today.getDate();
			var Month = today.getMonth()+1;
			var Year = today.getFullYear();
			
			var todays = Year + '-' +
			    (Month<10 ? '0' : '') + Month + '-' +
			    (date<10 ? '0' : '') + date;
			
			// if(tanggal_mulai <= todays && tanggal_berakhir >= todays){
				// $(".form-toggler").hide();
			// }
			   
            var userSignInFormIsVisible = true;
            
          	// if(tanggal_mulai <= todays && tanggal_berakhir >= todays){
          		// $(".form-toggler").show();
          		// $(".ask").show();
          	// }else{
          		// $(".form-toggler").hide();
          		// $(".ask").hide();
          	// }
          	
            $(".form-toggler").on("click", function() {
            	if(tanggal_mulai <= todays && tanggal_berakhir >= todays){
                    if(userSignInFormIsVisible == true /*&& tanggal_mulai <= todays && tanggal_berakhir >= todays*/) {
                            userSignInFormIsVisible = false;
                            
                            $("#user-sign-in-form").hide();
                            $("#user-register-form").show();
	                      $("#sign-in-form h3 > span").css("background", "rgba(255, 84, 0, .85)");
	                      $("#sign-in > .container-fluid form .btn").css("background", "#ff5400");
                    } else {
                            userSignInFormIsVisible = true;
                            $("#user-sign-in-form").show();
                            $("#user-register-form").hide();
                      $("#sign-in-form h3 > span").css("background", "rgba(44, 160, 90, .85)");
                      $("#sign-in > .container-fluid form .btn").css("background", "#2ca05a");
                    }
               }else{
               	 $('#error-form').submit();
               } 
            });       
        });
    </script>
    @stop
@stop
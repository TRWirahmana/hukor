@section('content')

<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Buat Usulan Pelembagaan";
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Pelembagaan";
</script>
<div class="stripe-accent"></div>
<legend>Buat Usulan</legend>


@include('flash')
{{ Form::open($form_opts) }}
    {{ Form::hidden('id', $user->pengguna->id, array('id' => 'id')) }}
    
	<div class="row-fluid">
		<div class="span12">
			<fieldset>
                <div class="nav nav-tabs">
                    <h4>PENANGGUNG JAWAB</h4>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[nama]', 'Nama', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[nama]', null, array('placeholder' => 'Masukan nama lengkap penanggung jawab usulan')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[jenis_kelamin]', 'Jenis Kelamin', array('class' => 'control-label'))}}
                    <div class="controls">
                        <div class="control-group">
                            {{ Form::label('pria', 'Laki-laki') }}
                            <div class="controls">
                                {{ Form::radio('penanggungJawab[jenis_kelamin]', 'L', false, array('id' => 'pria')) }}
                            </div>
                        </div>
                        <div class="control-group">
                            {{ Form::label('perempuan', 'Perempuan') }}
                            <div class="controls">
                                {{ Form::radio('penanggungJawab[jenis_kelamin]', 'P', false, array('id' => 'perempuan')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[jabatan]', 'Jabatan', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[jabatan]', null, array('placeholder' => 'Masukan jabatan penanggung jawab usulan')) }}
                    </div>
                </div>
                <div class="control-group">
                    {{ Form::label('penanggungJawab[nip]', "NIP", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[nip]', null, array('placeholder' => 'Masukan NIP penanggung jawab usulan')) }}
                    </div>
                </div>

                <!--div class="control-group">
                    {{ Form::label('penanggungJawab[no_handphone]', "No Handphone", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[no_handphone]', null, array('placeholder' => 'Masukan no handphone penanggung jawab usulan', 'id' => 'hp')) }}
                        <p class="span9" style="color: #616D79;font-size: 11px;">Format: 999-999-999-999</p>
                    </div>

                </div-->

                <div class="control-group">
                    {{ Form::label('penanggungJawab[unit_kerja]', "Unit Kerja", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[unit_kerja]', null, array('placeholder' => 'Masukan unit kerja penanggung jawab usulan')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[alamat_kantor]', 'Alamat Kantor', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::textarea('penanggungJawab[alamat_kantor]', null, array('rows' => 2, 'placeholder' => 'Masukan alamat kantor penanggung jawab usulan')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[telp_kantor]', 'Telepon Kantor', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[telp_kantor]', null, array('placeholder' => 'Masukan nomor telepon kantor penanggung jawab usulan', 'id' => 'telp_kantor')) }}
                        <p class="span9" style="color: #616D79;font-size: 11px;">*Gunakan spasi setelah kode area</p>
                    </div>

                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[email]', 'Email', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[email]', null, array('placeholder' => 'Masukan alamat email penanggung jawab usulan')) }}
                    </div>
                </div>
				</fieldset>
			</div>


			<div class="span12">
				<fieldset>
                    <div class="nav nav-tabs">
                        <h4>USULAN</h4>
                    </div>

					<div class="control-group">
					{{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::text('perihal', $pelembagaan->perihal, array('placeholder' => "Masukkan Perihal...")) }}</div>
					</div>
					<div class="control-group">
					{{ Form::label('catatan', "Keterangan", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::textarea('catatan', $pelembagaan->catatan, array('placeholder' => "Masukkan Catatan...")) }}</div>
					</div>
					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::file('lampiran[]', array('multiple' => true)) }}</div>
					</div>
			</fieldset>
			</div>
		</div>

	<div class="form-actions">
        <input class='btn btn-primary' Type="button" value="Batal" id="prev-btn" name="batal">
		{{ Form::submit('Kirim', array('class' => 'btn btn-primary')) }}

	</div>



	{{ Form::close() }}
@stop


@section('scripts')
@parent

<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>
<script src="{{asset('assets/js/pelembagaan.js')}}"></script>
<script src="{{asset('assets/js/jquery.mask.js')}}"></script>


<script type="text/javascript">
    $("#telp_kantor").mask("(9999) 999-9999");
    $("#hp").mask("999-999-999-999");

    $("#prev-btn").click(function(){
        window.location.assign('<?php echo URL::previous(); ?>');
    });

    Pelembagaan.Form();
</script>
<script>
    document.getElementById("menu-pelembagaan-usulan").setAttribute("class", "user-menu-active");
    document.getElementById("collapse11").style.height = "auto";
</script>
@stop

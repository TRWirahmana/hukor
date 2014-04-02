@section('content')

<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Ketatalaksanaan";
</script>
<div class="stripe-accent"></div>
<legend>Pengajuan Usulan</legend>

@include('flash')
<div class="content-non-title">



    {{ Form::open(array('route' => 'sp.store', 'files' => true, 'class' => 'form form-horizontal', 'id' => 'form-perUU'))}}
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend>Penanggung Jawab</legend>
                <div class="control-group">
                    <label for="jenis_usulan" class="control-label">Jenis Usulan</label>

                    <div class="controls">
                        <select id="jenis_usulan">
                            <!--        <option value="0">Pilih Usulan</option>-->
                            <option value="1">Sistem dan Prosedur</option>
                            <option value="2">Analisis Jabatan</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[nama]', 'Nama', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[nama]', null, array('placeholder' => 'masukan nama lengap...')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ form::label('penanggungJawab[jabatan]', 'jabatan', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ form::text('penanggungJawab[jabatan]', null, array('placeholder' => 'Masukan jabatan...')) }}
                    </div>
                </div>
                <div class="control-group">
                    {{ Form::label('penanggungJawab[nip]', "NIP", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[nip]', null, array('placeholder' => 'Masukan NIP...')) }}
                    </div>
                </div>

		<div class="control-group">
                    {{ Form::label('penanggungJawab[no_handphone]', "No Handphone", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[no_handphone]', null, array('placeholder' => 'Masukan nomor handphone')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[unit_kerja]', "Unit Kerja", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[unit_kerja]', null, array('placeholder' => 'Masukan unit kerja...')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[alamat_kantor]', 'Alamat Kantor', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::textarea('penanggungJawab[alamat_kantor]', null, array('rows' => 2, 'placeholder' => 'Masukan alamat kantor...')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[telp_kantor]', 'Telepon Kantor', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[telp_kantor]', null, array('placeholder' => 'Masukan no telepon kantor...')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[email]', 'Email', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[email]', null, array('placeholder' => 'Masukan alamat email...')) }}
                    </div>
                </div>

            </fieldset>
        </div>

        <div class="span12">
            <fieldset>
                <legend>Informasi Usulan</legend>

                <div class="control-group">
                    {{ Form::label("sistem_dan_prosedur[perihal]", "Perihal", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::text("sistem_dan_prosedur[perihal]", null, array('placeholder' => 'Masukan perihal usulan...')) }}</div>
                </div>

                <div class="control-group">
                    {{ Form::label("sistem_dan_prosedur[catatan]", "Catatan", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::textarea("sistem_dan_prosedur[catatan]", null, array('placeholder' => 'Masukan keterangan usulan...')) }}</div>
                </div>

		<div class="control-group">
                    {{ Form::label("sistem_dan_prosedur[lampiran]", "Lampiran", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::file("sistem_dan_prosedur[lampiran][]", array('multiple' => true, 'placeholder' => 'Masukan lampiran')) }}</div>
                </div>
            </fieldset>

        </div>

    </div>	

    <!--    <div class="row-fluid">
            <div class="span6"></div>
            <div class="span12">
    
                <fieldset>
                    <legend>Informasi Registrasi</legend>
    
                    <div class="control-group">
                        {{ Form::label("nama", "Nama", array('class' => 'control-label')) }}
                        <div class="controls">{{ Form::text("nama", $user->pengguna->nama_lengkap, array('disabled' => 'disabled')) }}</div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('pos_el', "Pos El", array('class' => 'control-label')) }}
                        <div class="controls">{{ Form::text('pos_el', $user->pengguna->email, array('disabled' => 'disabled')) }}</div>
                    </div>
                    <div class="control-group">
                        {{ Form::label('id_number', 'Id Number', array('class' => 'control-label')) }}
                        <div class="controls">{{ Form::text('id_number', $user->pengguna->user_id, array('disabled' => 'disabled')) }}</div>
                    </div>
    
                </fieldset>
            </div>
            <div class="span6"></div>
        </div>	-->

    <div class="form-actions">
        <a href="{{ URL::to('site') }}" class="btn btn-primary">Batal</a>
        {{ Form::submit('Kirim', array('class' => 'btn btn-primary')) }}
    </div>

    {{ Form::close() }}
</div>
@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script type="text/javascript">
    $( "#jenis_usulan" ).change(function() {
        var jenis_usul = $("#jenis_usulan").val();

//        alert(jenis_usul);
        if(jenis_usul == 1){
//            alert('sisprod');
            $("#form-perUU").attr('action', baseUrl + '/sp');
        }
        if(jenis_usul == 2){
            $("#form-perUU").attr('action',  baseUrl + '/aj');
        }
    });

$("#menu-peraturan-perundangan").addClass("active");


$("#form-perUU").validate({
    ignore: [],
    errorElement: 'span',
    errorClass: 'help-block error',
    rules: {
        'penanggungJawab[nama]': 'required',
        'penanggungJawab[jabatan]': 'required',
        'penanggungJawab[nip]': 'required',
        'penanggungJawab[unit_kerja]': 'required',
        'penanggungJawab[alamat_kantor]': 'required',
        'penanggungJawab[telp_kantor]': 'required',
        'penanggungJawab[email]': 'required',
        'sistem_dan_prosedur[perihal]': 'required',
        'sistem_dan_prosedur[lampiran]': 'required'

    },
    messages: {
        'penanggungJawab[nama]': {
            required: 'Nama penanggung jawab tidak boleh kosong.'
        },
        'penanggungJawab[jabatan]': {
            required: 'Jabatan penanggung jawab tidak boleh kosong.'
        },
        'penanggungJawab[nip]': {
            required: 'Nip penanggung jawab tidak boleh kosong.'
        },
        'penanggungJawab[unit_kerja]': {
            required: 'Unit Kerja penanggung jawab tidak boleh kosong.'
        },
        'penanggungJawab[alamat_kantor]': {
            required: 'Alamat kantor penanggung jawab tidak boleh kosong.'
        },
        'penanggungJawab[telp_kantor]': {
            required: 'Telepon kantor penanggun jawab tidak boleh kosong.'
        },
        'penanggungJawab[email]': {
            required: 'Email penanggung jawab tidak boleh kosong.'
        },
        'sistem_dan_prosedur[perihal]': {
            required: 'Perihal tidak boleh kosong.'
        },
        'sistem_dan_prosedur[lampiran]': {
            required: 'Mohon sertakan lampiran.'
        }
    },
    errorPlacement: function(error, element) {
        error.appendTo(element.parent('div.controls'));
    },
    invalidHandler: function(event, validator) {
        $("div.control-group.error").removeClass('error');
        $('div.controls .error[name]').parents('div.control-group').addClass('error');
    },
    onfocusout: function(elem, event) {
        $(elem).validate();
        $controlGroup = $(elem).parents('div.control-group');
        if ($(elem).valid())
            $controlGroup.removeClass('error');
        else
            $controlGroup.addClass('error');
    }
});

</script>

<script>
    document.getElementById("collapse12").style.height = "auto";
    document.getElementById("menu-ketatalaksanaan-usulan").setAttribute("class", "user-menu-active");
</script>

@stop

@section('content')

<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Buat Usulan Analisis Jabatan";
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Analisis Jabatan";
</script>
<div class="stripe-accent"></div>
<!--<legend>Buat Usulan</legend>-->
@include('flash')
<div class="content-non-title">

    {{ Form::open(array('route' => 'aj.store', 'files' => true, 'class' => 'form form-horizontal', 'id' => 'form-perUU'))}}

    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <div class="nav nav-tabs">
                    <h4>PENANGGUNG JAWAB</h4>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[nama]', 'Nama', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[nama]', null, array('placeholder' => 'Masukan nama lengkap penanggung jawab')) }}
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
                        {{ Form::text('penanggungJawab[jabatan]', null, array('placeholder' => 'Masukan jabatan penanggung jawab')) }}
                    </div>
                </div>
                <div class="control-group">
                    {{ Form::label('penanggungJawab[nip]', "NIP", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[nip]', null, array('placeholder' => 'Masukan NIP penanggung jawab')) }}
                    </div>
                </div>

<!--		        <div class="control-group">-->
<!--                    {{ Form::label('penanggungJawab[no_handphone]', "No Handphone", array('class' => 'control-label'))}}-->
<!--                    <div class="controls">-->
<!--                        {{ Form::text('penanggungJawab[no_handphone]', null, array('placeholder' => 'Masukan nomor handphone penanggung jawab')) }}-->
<!--                        <p class="span9" style="color: #616D79;font-size: 11px;">Format: 999-999-999-999</p>-->
<!--                    </div>-->
<!--                </div>-->

                <div class="control-group">
                    {{ Form::label('penanggungJawab[unit_kerja]', "Unit Kerja", array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[unit_kerja]', null, array('placeholder' => "Masukan nama unit kerja penanggung jawab")) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[alamat_kantor]', 'Alamat Kantor', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::textarea('penanggungJawab[alamat_kantor]', null, array('rows' => 2, 'placeholder' => 'Masukan alamat kantor penanggung jawab')) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[telp_kantor]', 'Telepon Kantor', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[telp_kantor]', null, array('placeholder' => 'Masukan nomor telepon kantor penanggung jawab', 'id' => 'telp_kantor')) }}
                        <p class="span9" style="color: #616D79;font-size: 11px;">*Gunakan spasi setelah kode area</p>
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('penanggungJawab[email]', 'Email', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{ Form::text('penanggungJawab[email]', null, array('placeholder' => 'Masukan alamat email penanggung jawab')) }}
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
                    {{ Form::label("analisisJabatan[jenis_usulan]", "Jenis Usulan", array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::select('analisisJabatan[jenis_usulan]', array(
                        '0' => '- Pilih Jenis Usulan -',
                        '1' => 'Uraian Jabatan',
                        '2' => 'Peta Jabatan',
                        '3' => 'Perhitungan Beban Kerja',
                        '4' => 'Evaluasi Jabatan',
                        '5' => 'Standar Kompetensi',
                        )) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label("analisisJabatan[perihal]", "Perihal", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::text("analisisJabatan[perihal]", null, array('placeholder' => 'Masukan judul perihal usulan...')) }}</div>
                </div>

                <div class="control-group">
                    {{ Form::label("analisisJabatan[catatan]", "Keterangan", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::textarea("analisisJabatan[catatan]", null, array('placeholder' => 'Masukan keterangan tentang perihal usulan...')) }}</div>
                </div>
		
		<div class="control-group">
                    {{ Form::label("analisisJabatan[lampiran]", "Lampiran", array('class' => 'control-label')) }}
                    <div class="controls">{{ Form::file("analisisJabatan[lampiran][]", array('multiple' => true)) }}</div>
                </div>
            </fieldset>

        </div>

    </div>

    <div class="form-actions">
        <input class="btn btn-primary" type="button" value="Batal" id="prev-btn" name="batal">
        <button class="btn btn-primary" type="submit">Kirim</button>
    </div>

    {{ Form::close() }}
</div>
@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/jquery.mask.js')}}"></script>
<script type="text/javascript">
    $("#telp_kantor").mask("(9999) 999-9999");
$("#menu-peraturan-perundangan").addClass("active");

    $("#prev-btn").click(function(){
        window.location.assign('<?php echo URL::previous(); ?>');
    });


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
        'penanggungJawab[email]': {
            required: true,
            email: true
        },
        'analisisJabatan[perihal]': 'required',
        'analisisJabatan[lampiran]': 'required'

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
            required: 'Telepon kantor penanggung jawab tidak boleh kosong.'
        },
        'penanggungJawab[email]': {
            required: 'Email penanggung jawab tidak boleh kosong.',
            email: 'Format email tidak benar'
        },
        'analisisJabatan[perihal]': {
            required: 'Perihal tidak boleh kosong.'
        },
        'analisisJabatan[lampiran]': {
            required: 'Mohon sertakan lampiran.'
        }
    },
    errorPlacement: function(error, element) {
        error.appendTo(element.parent('div.controls'));
    },
    invalidHandler: function(event, validator) {
        $("div.control-group").addClass('error');
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
    document.getElementById("menu-anjab-usulan").setAttribute("class", "user-menu-active");
    document.getElementById("collapse12").style.height = "auto";
</script>
@stop

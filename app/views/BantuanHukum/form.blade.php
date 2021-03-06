@section('content')


<script>
    document.title = "Layanan Biro Hukum dan Organisasi | Buat Usulan Bantuan Hukum";
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Bantuan Hukum";
</script>
<!--<legend>Buat Usulan</legend>-->

@include('flash')

    {{ Form::open(array('route' => 'bantuan_hukum.store', 'method' => 'post',
                        'id' => 'banhuk-usulan-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal',
                        'enctype' => "multipart/form-data")) }}


        {{ Form::hidden('id', $user->id, array('id' => 'id')) }}
        <div class="row-fluid">
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>PENANGGUNG JAWAB</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('nama', 'Nama Penanggung Jawab', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nama', '', array('id' => 'nama', 'placeholder' => "Masukkan Nama Penanggung Jawab")) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label')) }}
                    <div class="controls">
                        <div class="control-group">
                            {{ Form::label('pria', 'Laki-Laki', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::radio('jenis_kelamin', 1, false, array('id' => 'pria')) }}
                            </div>
                        </div>

                        <div class="control-group">
                            {{ Form::label('wanita', 'Perempuan', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::radio('jenis_kelamin', 0, false, array('id' => 'wanita')) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('tgl_lahir', '', array('id' => 'tgl_lahir', 'class' => 'datepicker', 'placeholder' => "Masukkan Tanggal Lahir Penanggung Jawab")) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('pekerjaan', '', array('id' => 'pekerjaan', 'placeholder' => "Masukkan Pekerjaan Penanggung Jawab")) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('nip', '', array('id'=>'nip', 'placeholder' => "Masukkan NIP Penanggung Jawab")) }}
                    </div>
                </div>


                <div class="control-group {{$errors->has('password')?'error':''}}">
                    {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::textarea('alamat_kantor', '', array('id'=>'alamat_kantor', 'placeholder' => "Masukkan Alamat Kantor Penanggung Jawab")) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('telp_kantor', '', array('id'=>'telp_kantor', 'placeholder' => "Masukkan Nomor Telepon Kantor Penanggung Jawab", 'id' => 'telp_kantor')) }}
                        <p class="span9" style="color: #616D79;font-size: 11px;">Format: (9999) 999-9999</p>
                    </div>

                </div>

                <div class="control-group">
                    {{ Form::label('handphone', 'Nomor Handphone', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('handphone', '', array('id'=>'handphone' , 'placeholder' => "Masukkan Nomor Handphone Penanggung Jawab", 'id' => 'hp')) }}
                        <p class="span9" style="color: #616D79;font-size: 11px;">Format: 999-999-999-999</p>
                    </div>

                </div>

                <div class="control-group">
                    {{ Form::label('email', 'E-Mail', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('email', '', array('id'=>'email', 'placeholder' => "Masukkan Email Penanggung Jawab")) }}
                    </div>
                </div>
            </div>
            <div class="span12">
                <div class="nav nav-tabs">
                    <h4>INFORMASI PERKARA</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('jns_perkara', 'Jenis Perkara', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::select('jns_perkara', array(
                                '0' => '- Pilih Perkara -',
                                '1' => 'Tata Usaha Negara',
                                '2' => 'Perdata',
                                '3' => 'Pidana',
                                '4' => 'Uji Materil Mahkamah Konstitusi',
                                '5' => 'Uji Materil Mahkamah Agung'
                        ), 'Pilih Perkara') }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('status_perkara', 'Status Perkara', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('status_perkara', '', array('id' => 'status_perkara', 'placeholder' => "Masukkan Status Perkara...")) }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('status_pemohon', 'Status Pemohon (saat pengajuan permohonan)', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::select('status_pemohon', array(
                        '0' => '- Pilih Status Pemohon -',
                        '1' => 'Tergugat',
                        '2' => 'Penggugat',
                        '3' => 'Interfent',
                        '4' => 'Saksi',
                        '5' => 'Pemohon'
                        ), 'Pilih Status Pemohon') }}
                    </div>
                </div>

                <div class="control-group">
                    {{ Form::label('uraian', 'Uraian Singkat Mengenai Pokok Persoalan yang Dimohonkan Bantuan Hukum', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::textarea('uraian', '', array('id' => 'catatan', 'placeholder' => "Masukkan Uraian...")) }}
                    </div>
                </div>


                <div class="nav nav-tabs">
                    <h4>INFORMASI USULAN</h4>
                </div>


                <div class="control-group">
                    {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::textarea('catatan', '', array('id' => 'catatan', 'placeholder' => "Masukkan Catatan...")) }}
                    </div>
                </div>

		<div class="control-group">
                    {{ Form::label('ket_lampiran', 'Keterangan Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::text('ket_lampiran', '', array('id' => 'ket_lampiran', 'placeholder' => "Masukkan Keterangan Lampiran...")) }}
                    </div>
                </div>	

		<div class="control-group">
                    {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{ Form::file('lampiran[]', array('id'=>'lampiran', 'multiple' => true)) }}
                    </div>
                </div>

            </div>
        </div>

        <div class="row-fluid">
            <div class="span24 text-center">
                <a href="{{ URL::to('BantuanHukum') }}" class="btn btn-primary">Batal</a>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
{{ Form::close() }}
@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/jquery.mask.js')}}"></script>
<script type="text/javascript">
    $(function() {
        $( ".datepicker" ).datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            yearRange: "1970:2020",
            changeYear: true
        }).val();
    });
    $("#telp_kantor").mask("(9999) 999-9999");
    $("#hp").mask("999-999-999-999");

    $("#banhuk-usulan-form").validate({
        ignore: [],
        errorElement: 'span',
        errorClass: 'help-block error',
        rules: {
            'nama': 'required',
            'jenis_kelamin': 'required',
            'tgl_lahir': 'required',
            'nip': 'required',
            'alamat_kantor': 'required',
            'telp_kantor': 'required',
            'handphone': 'required',
            'email':{
                required: true,
                email: true
            },
            'jns_perkara': 'required',
            'status_perkara': 'required',
            'status_pemohon': 'required'



        },
        messages: {
            'nama': {
                required: 'Nama penanggung jawab tidak boleh kosong.'
            },
            'jenis_kelamin': {
                required: 'Jabatan penanggung jawab tidak boleh kosong.'
            },
            'tgl_lahir': {
                required: 'Tanggal Lahir tidak boleh kosong.'
            },
            'nip': {
                required: 'Nip penanggung jawab tidak boleh kosong.'
            },
            'alamat_kantor': {
                required: 'Alamat Kantor tidak boleh kosong.'
            },
            'telp_kantor': {
                required: 'Telepon Kantor tidak boleh kosong.'
            },
            'email': {
                required: 'Alamat E-Mail wajib diisi.',
                email: 'Format email tidak benar'
            },
            'jns_perkara': {
                required: 'Jenis Perkara tidak boleh kosong.'
            },
            'status_perkara': {
                required: 'Status Perkara tidak boleh kosong.'
            },
            'status_pemohon': {
                required: 'Status Pemohon tidak boleh kosong.'
            },
            'handphone': {
                required: 'Nomor Handphone tidak boleh kosong.'
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
    document.getElementById("menu-bantuan-hukum-usul").setAttribute("class", "user-menu-active");
    document.getElementById("collapse13").style.height = "auto";
</script>
@stop

@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
<legend>Bantuan Hukum</legend>

@include('flash')

{{ Form::open(array('action' => 'BantuanHukumController@update', 'method' => 'post',
'id' => 'user-registrasi-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal',
'enctype' => "multipart/form-data")) }}

{{ Form::hidden('id', $banhuk->id, array('id' => 'id')) }}
<div class="row-fluid">
    <div class="span12">
        <div class="nav nav-tabs">
            <h4>INFORMASI PEMOHON</h4>
        </div>
        <div class="control-group">
            {{ Form::label('nama_pemohon', 'Nama Pemohon', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->nama_lengkap }}
            </div>
        </div>

        <?php $jenis_kelamin = ($banhuk->pengguna->jenis_kelamin == 1) ? "Laki-laki" : "Perempuan"; ?>
        <div class="control-group">
            {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->jenis_kelamin }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->tgl_lahir }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->pekerjaan }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->nip }}
            </div>
        </div>

        <div class="control-group {{$errors->has('password')?'error':''}}">
            {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->alamat_kantor }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->tlp_kantor }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('handphone', 'Telepon Genggam', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->handphone }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('email', 'Pos-El', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->email }}
            </div>
        </div>
    </div>
    <div class="span12">
        <div class="nav nav-tabs">
            <h4>INFORMASI PERKARA</h4>
        </div>
        <div class="control-group">
            {{ Form::label('jns_perkara', 'Jenis Perkara', array('class' => 'control-label')) }}

            <?php
                $jns_perkara = "";
                switch($banhuk->jenis_perkara)
                {
                    case 1:
                        $jns_perkara = "Tata Usaha Negara";
                        break;
                    case 2:
                        $jns_perkara = "Perdata";
                        break;
                    case 3:
                        $jns_perkara = "Pidana";
                        break;
                    case 4:
                        $jns_perkara = "Uji Materil MK";
                        break;
                    case 5:
                        $jns_perkara = "Uji Materil MA";
                        break;
                }
            ?>
            <div class="controls">
                {{ $jns_perkara }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('status_perkara', 'Status Perkara', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->status_perkara }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('status_pemohon', 'Status Pemohon (saat pengajuan permohonan)', array('class' => 'control-label')) }}

            <?php
            $status_pemohon = "";
            switch($banhuk->status_pemohon)
            {
                case 1:
                    $status_pemohon = "Tergugat";
                    break;
                case 2:
                    $status_pemohon = "Penggugat";
                    break;
                case 3:
                    $status_pemohon = "Interfent";
                    break;
                case 4:
                    $status_pemohon = "Saksi";
                    break;
                case 5:
                    $status_pemohon = "Pemohon";
                    break;
            }
            ?>
            <div class="controls">
                {{ $status_pemohon }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('uraian', 'Uraian Singkat Mengenai Pokok Persoalan yang Dimohonkan Bantuan Hukum', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->uraian_singkat }}
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span12">
        <div class="nav nav-tabs">
            <h4>INFORMASI REGISTRASI</h4>
        </div>
        <div class="control-group">
            {{ Form::label('nama', 'Nama', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->nama_lengkap }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('email2', 'Pos-El', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->email }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('id_number', 'ID-Number', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->pengguna->id }}
            </div>
        </div>

        <div class="nav nav-tabs">
            <h4>INFORMASI LAMPIRAN</h4>
        </div>

        <div class="control-group">
            {{ Form::label('ket_lampiran', 'Keterangan Lampiran', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->ket_lampiran }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->lampiran }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
            <div class="controls">
                {{ $banhuk->catatan }}
            </div>
        </div>
    </div>
    <div class="span12">
        <div class="nav nav-tabs">
            <h4>UPDATE STATUS</h4>
        </div>
        <div class="control-group">
            {{ Form::label('advokasi', 'Advikasi Oleh', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::select('advokasi', array(
                '0' => '- Pilih -',
                '1' => 'Bankum I',
                '2' => 'Bankum II',
                '3' => 'Bankum III'
                ), 'advokasi') }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('advokator', 'Advokator', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('advokator', '', array('id' => 'advokator')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('status_permohonan', 'Status Permohonan', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('status_permohonan', $status_pemohon, array('id' => 'status_permohonan')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('status_perkara', 'Status Perkara', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('status_perkara', $banhuk->status_perkara, array('id' => 'status_perkara')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('ket_lampiran', 'Ket Lampiran', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::text('ket_lampiran', $banhuk->ket_lampiran, array('id' => 'ket_lampiran')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::file('lampiran', array('id'=>'lampiran')) }}
            </div>
        </div>

        <div class="control-group">
            {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
            <div class="controls">
                {{ Form::textarea('catatan', $banhuk->catatan, array('id' => 'catatan')) }}
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span24 text-center">
        <button class="btn" type="submit">Simpan</button>
        <button class="btn" type="button">Batal</button>
    </div>
</div>
{{ Form::close() }}

<table id="basictable" class="dataTable">
    <thead>
    <tr>
        <th>Tanggal</th>
        <th>Status Pemohon</th>
        <th>Catatan</th>
        <th>Lampiran</th>
        <th>Advokasi</th>
        <th>Advokator</th>
        <th></th>
    </tr>
    </thead>
</table>

    @section('scripts')
    @parent
    <script type="text/javascript">
        var tbl_data = $("#basictable").dataTable({
            bFilter: false,
            bInfo: false,
            bSort: false,
            bPaginate: true,
            bLengthChange: false,
            bServerSide: true,
            bProcessing: true,
    //                sAjaxSource: baseUrl + "/lkpm/data",
            sAjaxSource: '<?php echo URL::to("log_banhuk"); ?>',
            aoColumns: [
                {mData: "created_at"},
                {
                    mData: "status_pemohon",
                    sClass: "center",
                    mRender: function(id){
                        var status_pemohon;
                        switch (id){
                            case 1:
                                status_pemohon = "Tergugat";
                                break;
                            case 2:
                                status_pemohon = "Penggugat";
                                break;
                            case 3:
                                status_pemohon = "Interfent";
                                break;
                            case 4:
                                status_pemohon = "Saksi";
                                break;
                            case 5:
                                status_pemohon = "Pemohon";
                                break;
                        }

                        return status_pemohon;
                    }
                },
                {mData: "catatan"},
                {mData: "lampiran"},
                {
                    mData: "advokasi",
                    mRender: function(id){
                        var advokasi;
                        switch (id){
                            case 1:
                                advokasi = "Bankum I";
                                break;
                            case 2:
                                advokasi = "Bankum II";
                                break;
                            case 3:
                                advokasi = "Bankum III";
                                break;
                        }

                        return advokasi;
                    }
                },
                {mData: "advokator"},
                {
                    mData: "id",
                    mRender: function(data){
                        var deleteUrl = baseUrl + '/delete_log_banhuk?id=' + data;

                        return '<a href="' + deleteUrl + '" class="btn_delete"><i class="icon-trash"></i></a>';
                    }
                }
            ],
            fnServerParams: function(aoData) {
    //                    aoData.push({name: "tahun", value: $("#select_filter_tahun").val()});
    //                    aoData.push({name: "id_prop", value: $("#select_filter_provinsi").val()});
            },
            fnServerData: function(sSource, aoData, fnCallback) {
                $.getJSON(sSource, aoData, function(json) {
                    $("#text-tahun").text(json.tahun);
                    fnCallback(json);
                });
            }
        });
    </script>
    @stop
@stop
@section('content')
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Pelembagaan";
</script>
<!-- <legend>Pengajuan Usulan</legend>
 -->

@include('flash')

{{ Form::open($form_opts) }}
{{ Form::hidden('id', $id) }}
<div class="content-non-title">
<div class="row-fluid">
    <div class="span12">
        <fieldset>
            <!--                <legend>PENANGGUNG JAWAB</legend>-->
            <div class="nav nav-tabs">
                <h4>Informasi Pengusul</h4>
            </div>

            <div class="control-group">
                {{ Form::label('tgl_usulan', 'Tanggal Usulan', array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $pelembagaan->tgl_usulan }}"></div>
            </div>

            <div class="control-group">
                {{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $penanggungJawab->nip }}"></div>
            </div>

            <div class="control-group">
                {{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $penanggungJawab->unit_kerja }}"></div>
            </div>

            <div class="control-group">
                {{ Form::label('nama_pemohon', "Nama", array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $penanggungJawab->nama }}"></div>
            </div>

            <div class="control-group">
                {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
                <div class="controls"><textarea rows="3" disabled> {{ $penanggungJawab->alamat_kantor }} </textarea></div>
            </div>

            <div class="control-group">
                {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $penanggungJawab->telp_kantor }}"></div>
            </div>

            <div class="control-group">
                {{ Form::label('hp', 'Handphone', array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $penanggungJawab->hp }}"></div>
            </div>


            <div class="control-group">
                {{ Form::label('pos_el', 'Email', array('class' => 'control-label'))}}
                <div class="controls"><input type="text" disabled="" value="{{ $penanggungJawab->email }}"></div>
            </div>
        </fieldset>
    </div>

    <div class="span12">
        <fieldset>
            <!--                <legend>INFORMASI PENGUSUL</legend>-->
            <div class="nav nav-tabs">
                <h4>INFORMASI USULAN</h4>
            </div>
            <div class="control-group">
                {{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
                <div class="controls"><input type="text" disabled="" value="{{$pelembagaan->perihal }}"></div>
            </div>

            <div class="control-group">
                {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
                <div class="controls">
                    <ul style="list-style:none">
                        @if($pelembagaan->lampiran == null || $pelembagaan->lampiran == 'a:0:{}')
                        <p>Tidak ada lampiran</p>
                        @else
                        @foreach(unserialize($pelembagaan->lampiran) as $index => $lampiran )
                        <li><a
                                href="{{ URL::route('pelembagaan.download', array('id' => $pelembagaan->id, 'index' => $index)) }}">
                                {{explode(DS, $lampiran)[count(explode(DS, $lampiran)) - 1 ] }}
                            </a>
                        </li>
                        @endforeach
                        @endif
                    </ul>




                    <!--   <a href= {{ URL::asset('assets/uploads/pelembagaan/' . $pelembagaan->lampiran ); }} > {{ $pelembagaan->lampiran}} </a>  -->
                </div>
            </div>


        </fieldset>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">

        <fieldset>
            <!--                <legend>INFORMASI PERIHAL & LAMPIRAN</legend>-->
            <div class="nav nav-tabs">
                <h4>UPDATE STATUS</h4>
            </div>
            <div class="control-group">
                {{ Form::label("status", "Status", array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::select('status', array('' => 'Pilih Status', '1' => 'Diproses', '2' => 'Kirim Ke Bagian
                    Peraturan PerUU' )); }}
                </div>
            </div>

            <div class="control-group">
                {{ Form::label('catatan', "Keterangan", array('class' => 'control-label')) }}
                <div class="controls">{{ Form::textarea('catatan', null, array('placeholder' => "Masukkan Keterangan..."))
                    }}
                </div>
            </div>

            <div class="control-group">
                {{ Form::label("ket_lampiran", "Ket. Lampiran", array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::text("keterangan", null, array('placeholder' => "Masukkan Keterangan Lampiran...")) }}
                </div>
            </div>

            <div class="control-group">
                {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
                <div class="controls">
                    {{ Form::file('lampiran[]', array('multiple' => true)) }}
                </div>
            </div>

            <div class="control-group">
                {{ Form::label('status_terakhir', "Status Terakhir", array('class' => 'control-label')) }}
                <div class="controls">

                    {{ Form::text("status_terakhir", $pelembagaan->getStatus($pelembagaan->status) ) }}
                </div>
            </div>
        </fieldset>
        <div class="control-group">
            <input class='btn btn-primary'  style="margin-left: 10px;" Type="button" value="Batal"
                   onClick="history.go(-1);return true;">
            {{ Form::submit('Simpan', array('id' => 'kirim_btn', 'class' => 'btn btn-primary'))
            }}
        </div>
    </div>
</div>
<br>
<br>
{{ Form::close() }}


<table id="tbl-log_pelembagaan">
    <thead>
    <tr role="row">
        <th>Tgl Proses</th>
        <th>Status</th>
        <th>Catatan</th>
        <th>Lampiran</th>
        <th> Ket</th>
        <th> -</th>
    </tr>
    </thead>
    <tbody></tbody>

</table>
<style>
    table.dataTable tr td:nth-child(2) {
        text-align: center;
    }
</style>

<hr/>


@stop
@section('scripts')
@parent
<script type="text/javascript">
    jQuery(function ($) {
        var oTable;

        $(document).ready(function () {
            oTable = $("#tbl-log_pelembagaan").dataTable({
                bPaginate: true,
                bServerSide: true,
                bProcessing: true,
                oLanguage:{
                    "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_",
                    "sEmptyTable": "Data Kosong",
                    "sZeroRecords" : "Pencarian Tidak Ditemukan",
                    "sInfoEmpty": 'Menampilkan 0 Sampai 0 dari 0 ',
                    "sProcessing": 'Memproses...',
                    "sSearch":       "Cari:",
              "sLengthMenu": 'Tampilkan <select>'+
                  '<option value="10">10</option>'+
                  '<option value="25">25</option>'+
                  '<option value="50">50</option>'+
                  '<option value="100">100</option>'+
                  '</select>'
                },
                sAjaxSource: document.location.href,
                aoColumns: [
                    {
                        mData: "tgl_proses",
                        sClass: 'center',
                        sWidth: '20%'
                    },
                    {
                        mData: "status",
                        sWidth: '20%',
                        mRender: function (data, type, full) {
                            if (null != data && "" != data) {
                                if (data === '1') {
                                    return 'proses';
                                } else if (data === '2') {
                                    return 'DiKirim Ke Bag PerUU';

                                }
                            }
                            return 'Belum Diproses';
                        }
                    },
                    {
                        mData: "catatan",
                        sClass: 'center-ac',
                        sWidth: '35%'
                    },
                    {
                        mData: "lampiran",
                        sClass: 'center',
                        sWidth: '14%',
                        mRender: function (data, type, full) {
                            if(data == null || data == 'a:0:{}'){
                                return '<p>Tidak ada lampiran</p>';
                            }else{
                                return '<a href="' + baseUrl + '/pelembagaan/log/download/' + full.id + '">Unduh</a>';
                            }

                        }
                    },
                    {
                        mData: "keterangan",
                        sClass: 'center-ac',
                        sWidth: '14%'
                    },
                    {
                        mData: "id",
                        sClass: 'center-ac',
                        sWidth: '10%',
                        mRender: function (data, type, full) {
                            var deleteUrl = baseUrl + '/pelembagaan/deletelog/' + data;
                            return '&nbsp;';
//                            return "<a class='btn_delete' title='Hapus' href='" + deleteUrl + "'>"
//                                + "<i class='icon-trash'></i></a>";
                        }
                    }
                ]
            });
        });

        $("#tbl-log_pelembagaan").on('click', '.btn_delete', function (e) {
            if (confirm('Apakah anda yakin ?')) {
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'GET',
                    success: function (response) {
                        oTable.fnReloadAjax();
                    }
                });
            }
            e.preventDefault();
            return false;
        });
        /*
         $("#tbl-pelembagaan").on('click', '.btn_delete', function(e){
         if (confirm('Apakah anda yakin ?')) {
         $.ajax({
         url: $(this).attr('href'),
         type: 'DELETE',
         success: function(response) {
         $dataTable.fnReloadAjax();
         }
         });
         }
         e.preventDefault();
         return false;
         });
         */


        $("#kirim_btn").click(function (e) {
            oTable.fnReloadAjax();
        });

    });
</script>
<script>

    $("#collapse11").css("height", "auto");
    $("#menu-pelembagaan-informasi").addClass("user-menu-active");
</script>
<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Usulan Pelembagaan"
    });
</script>

@stop
@section('content')
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Peraturan Perundang-Undangan";
</script>
<!-- <legend>Pengajuan Usulan</legend>
 -->

{{ Form::open(array('route' => array('puu.puu.update', $perUU->id), 'files' => true, 'method' => 'put', 'class' => 'form form-horizontal', 'id' => 'form-perUU'))}}

{{ Form::hidden('updated_by', 'User') }}

@include('flash')
<div class="content-non-title">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
<!--                <legend>PENANGGUNG JAWAB</legend>-->
                <div class="nav nav-tabs">
                    <h4>PENANGGUNG JAWAB</h4>
                </div>

                <div class="control-group">
                    <label for="dasdasd" class="control-label">Unit Kerja</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->unit_kerja }}" style="width:100%"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Jabatan</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->jabatan }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">NIP</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->NIP }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Nama</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->nama }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Alamat</label>

                    <div class="controls"><textarea rows="3" disabled>{{ $perUU->penanggungJawab->alamat_kantor }}</textarea></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Telp Kantor</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->telepon_kantor }}">
                    </div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Email</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->email }}"></div>
                </div>
            </fieldset>
        </div>

        <div class="span12">
            <fieldset>
<!--                <legend>INFORMASI PENGUSUL</legend>-->
                <div class="nav nav-tabs">
                    <h4>INFORMASI PENGUSUL</h4>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Unit Kerja</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->unit_kerja }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Jabatan</label>

                    <div class="controls"><input type="text" disabled=""
                                                 value="{{ $perUU->pengguna->detailJabatan->nama_jabatan }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">NIP</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->nip }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Nama</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->nama_lengkap }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Alamat</label>

                    <div class="controls"><textarea rows="3" disabled>{{ $perUU->pengguna->alamat_kantor }}</textarea></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Telp Kantor</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->tlp_kantor }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Email</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->pengguna->email }}"></div>
                </div>

            </fieldset>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">

            <fieldset>
<!--                <legend>INFORMASI PERIHAL & LAMPIRAN</legend>-->
                <div class="nav nav-tabs">
                    <h4>INFORMASI PERIHAL & LAMPIRAN</h4>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Tgl Usulan</label>

                    <div class="controls"><input type="text" disabled="" value="{{ $perUU->tgl_usulan }}"></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Perihal</label>

                    <div class="controls"><textarea disabled="">{{ $perUU->perihal }}</textarea></div>
                </div>
                <div class="control-group">
                    <label for="" class="control-label">Lampiran</label>

                    <div class="controls">
                        <ul style="list-style:none">
                            @if($perUU->lampiran == null || $perUU->lampiran == 'a:0:{}')
                            <p>Tidak Ada Lampiran</p>
                            @else
                            @foreach(unserialize($perUU->lampiran) as $index => $lampiran)
                            <li>
                                <a href="{{ URL::route('puu.download', array('id' => $perUU->id, 'index' => $index)) }}">
                                    {{ explode(DS,$lampiran)[count(explode(DS, $lampiran)) - 1] }}
                                </a>
                            </li>
                            @endforeach
                            @endif

                        </ul>
                    </div>
                </div>

                <div class="control-group">
                    <label for="" class="control-label">Status Terakhir</label>

                    <div class="controls">
                        @if ($perUU->status == 1)
                        Diproses
                        @elseif($perUU->status == 2) Ditunda @elseif($perUU->status == 3)
                        Ditolak
                        @elseif($perUU->status == 4)
                        Buat Salinan
                        @elseif($perUU->status == 5)
                        Penetapan
                        @else
                        Belum Diproses
                        @endif
                    </div>
                </div>
                <div class="control-group">
                    <input class='btn btn-primary'  style="margin-left: 10px;" Type="button" value="Batal"
                           onClick="history.go(-1);return true;">
                    {{ Form::submit('Simpan', array('class' => "btn btn-primary")) }}

                </div>
            </fieldset>
        </div>
        <div class="span12">
            <fieldset>
<!--                <legend>UPDATE STATUS</legend>-->
                <div class="nav nav-tabs">
                    <h4>UPDATE STATUS</h4>
                </div>
                <div class="control-group">
                    {{ Form::label('status', 'Status', array('class' => 'control-label'))}}
                    <div class="controls">
                        {{
                        Form::select('status', array(
                        1 => "Diproses",
                        2 => "Ditunda",
                        3 => "Ditolak",
                        4 => "Buat Salinan",
                        5 => "Penetapan"
                        ), 0, array())
                        }}
                    </div>
                </div>
                <div class="control-group">
                    {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{
                        Form::textarea('catatan', null, array('rows' => 2, 'placeholder' => 'Masukan Catatan...'))
                        }}
                    </div>
                </div>
                <div class="control-group">
                    {{ Form::label('ket_lampiran', 'Ket. Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{
                        Form::text('ket_lampiran', null, array('placeholder' => 'Masukan keterangan lampiran...'))
                        }}
                    </div>
                </div>
                <div class="control-group">
                    {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
                    <div class="controls">
                        {{
                        Form::file('lampiran[]', array('multiple' => true));
                        }}
                    </div>
                </div>


            </fieldset>

        </div>
</div>
    {{ Form::close() }}


    <div class="row-fluid">
    <div class="span24">
        <table id="tbl-log">
            <thead>
            <tr>
                <th>Tgl Proses</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Diupdate Oleh</th>
                <th>Lampiran</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

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
            $tblLog = $("#tbl-log").dataTable({
                bServerSide: true,
                sAjaxSource: document.location.href,
                bFilter: false,
                bInfo: false,
                bSort: false,
                bLengthChange: false,
                oLanguage:{
                    "sEmptyTable": "Data Kosong",
                    "sZeroRecords" : "Pencarian Tidak Ditemukan",
                    "sSearch":       "Cari:"
                },
                iDisplayLength: 5,
                aoColumns: [
                    {
                        mData: "tgl_proses",
                        sClass: "center",
                        sWidth: '15%',
                        mRender: function (data) {
                            var timestampArr = data.split(" ");
                            var dateArr = timestampArr[0].split("-");
                            var month = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                            return dateArr[2] + " " + month[parseInt(dateArr[1])] + " " + dateArr[0];
                        }
                    },
                    {
                        mData: "status",
                        sClass: "center",
                        sWidth: '15%',
                        mRender: function (data) {
                            switch (parseInt(data)) {
                                case 1:

                                    return "Diproses";
                                    break;
                                case 2:
                                    return "Ditunda";
                                    break;
                                case 3:
                                    return "Ditolak";
                                    break;
                                case 4:
                                    return "Buat salinan";
                                    break;
                                case 5:
                                    return "Penetapan";
                                    break;
                                default:
                                    return " Belum Diproses";
                                    break;
                            }
                            ;
                        }
                    },
                    {mData: "catatan", sWidth: '40%'},
                    {mData: "updated_by", sWidth: '15%', sClass: "center"},
                    {
                        mData: "lampiran",
                        sWidth: '15%',
                        sClass: "center",
                        mRender: function (data, type, full) {
                            if(data == null || data == 'a:0:{}'){
                                return '<p>Tidak Ada Lampiran</p>';
                            }else{
                                return '<a href="' + baseUrl + '/admin/puu/log/download/' + full.id + '">Unduh</a>';
                            }

                        }
                    }
// {mData: "id"}
                ]
            });
        });
    </script>
    <script>

        $("#collapse10").css("height", "auto");
        $("#menu-peruu-informasi").addClass("user-menu-active");
    </script>
    @stop
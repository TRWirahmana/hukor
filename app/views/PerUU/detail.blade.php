@section('content')
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Peraturan Perundang-Undangan";
</script>
<!-- <legend>Pengajuan Usulan</legend>
 -->

@include('flash')
<div class="content-non-title">
    <div class="row-fluid">
        <div class="span12">
            <fieldset>
                <legend>PENANGGUNG JAWAB</legend>

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
                <legend>INFORMASI PENGUSUL</legend>
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
                <legend>INFORMASI PERIHAL & LAMPIRAN</legend>
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
                            @foreach(unserialize($perUU->lampiran) as $index => $lampiran)
                            <li>
                                <a href="{{ URL::route('puu.download', array('id' => $perUU->id, 'index' => $index)) }}">
                                    {{ explode(DS,$lampiran)[count(explode(DS, $lampiran)) - 1] }}
                                </a>
                            </li>
                            @endforeach
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
                <!--            <div class="control-group">-->
                <!--                <a href="{{ URL::route('admin.puu.index') }}" class="btn btn-primary">Batal</a>-->
                <!--                {{ Form::submit('Simpan', array('class' => "btn btn-primary")) }}-->
                <!---->
                <!--            </div>-->
            </fieldset>
        </div>
</div>



    <div class="row-fluid">
    <div class="span24">
        <table id="tbl-log">
            <thead>
            <tr>
                <th>Tgl Proses</th>
                <th>Status</th>
                <th>Catatan</th>
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
                iDisplayLength: 5,
                aoColumns: [
                    {
                        mData: "tgl_proses",
                        mRender: function (data) {
                            return $.datepicker.formatDate("dd M yy", new Date(Date.parse(data)));
                        }
                    },
                    {
                        mData: "status",
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
                                    return " ";
                                    break;
                            }
                            ;
                        }
                    },
                    {mData: "catatan"},
                    {
                        mData: "lampiran",
                        mRender: function (data, type, full) {
                            return '<a href="' + baseUrl + '/admin/puu/log/download/' + full.id + '">Unduh</a>';
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
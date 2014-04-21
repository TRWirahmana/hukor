@section('content')
<script>
    document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Sistem dan Prosedur";
</script>
<!-- <legend>Pengajuan Usulan</legend>
 -->

{{ Form::open(array('route' => array('sp.update', $data->id), 'files' => true, 'method' => 'put', 'class' => 'form form-horizontal', 'id' => 'form-perUU'))}}

{{ Form::hidden('updated_by', 'User') }}

@include('flash')
<div class="content-non-title">
<div class="row-fluid">
    <div class="span12">
        <fieldset>
            <div class="nav nav-tabs">
                <h4>PENANGGUNG JAWAB</h4>
            </div>

            <div class="control-group">
                <label for="" class="control-label">Unit Kerja</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->unit_kerja }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Jabatan</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->jabatan }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">NIP</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->NIP }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Nama</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->nama }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls"><textarea rows="3" disabled>{{ $data->penanggungJawab->alamat_kantor }}</textarea></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Telp Kantor</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->telepon_kantor }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Email</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->email }}"></div>
            </div>
        </fieldset>
    </div>

    <div class="span12">
        <fieldset>
            <div class="nav nav-tabs">
                <h4>INFORMASI PENGUSUL</h4>
            </div>

            <div class="control-group">
                <label for="" class="control-label">Unit Kerja</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->unit_kerja }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Jabatan</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->jabatan }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">NIP</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->NIP }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Nama</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->nama }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Alamat</label>
                <div class="controls"><textarea rows="3" disabled>{{ $data->penanggungJawab->alamat_kantor }}</textarea></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Telp Kantor</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->telepon_kantor }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Email</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->penanggungJawab->email }}"></div>
            </div>

        </fieldset>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">

        <fieldset>
            <div class="nav nav-tabs">
                <h4>INFORMASI PERIHAL & LAMPIRAN</h4>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Tgl Usulan</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->tgl_usulan }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Perihal</label>
                <div class="controls"><input type="text" disabled="" value="{{ $data->perihal }}"></div>
            </div>
            <div class="control-group">
                <label for="" class="control-label">Lampiran</label>
                <div class="controls">
                    <ul style="list-style: none;">
                        @foreach(unserialize($data->lampiran) as $index => $lampiran)
                        <li>
                            <a href="{{URL::route('sp.download', array('id' => $data->id, 'index' => $index))}}">
                                {{explode(DS, $lampiran)[count(explode(DS, $lampiran))-1] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="control-group">
                <label for="" class="control-label">Status Terakhir</label>
                <div class="controls">
                    @if ($data->status == 1)
                    Diproses
                    @elseif($data->status == 2)
                    Ditunda
                    @elseif($data->status == 3)
                    Ditolak
                    @elseif($data->status == 4)
                    Buat Salinan
                    @elseif($data->status == 5)
                    Penetapan
                    @endif
                </div>
            </div>
        </fieldset>
    </div>
    <div class="span12">
        <fieldset>
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
                {{ Form::label('catatan', 'Deskripsi', array('class' => 'control-label')) }}
                <div class="controls">
                    {{
                    Form::textarea('catatan', null, array('rows' => 2, 'placeholder' => 'Masukan deskripsi usulan'))
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

<div class="form-actions">
    <a href="{{ URL::route('admin.aj.index') }}" class="btn btn-primary">Batal</a>
    {{ Form::submit('Simpan', array('class' => "btn btn-primary")) }}
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
        <style>
            table.dataTable tr td:nth-child(2) {
                text-align: center;
            }
        </style>
    </div>
</div>
{{ Form::close() }}

<!-- END OF MAIN CONTENT -->

<div class="footer">
    <div class="footer-left">
        <span>&copy;2014 Biro Hukum dan Organisasi</span>
    </div>
    <div class="footer-right">
        <span></span>
    </div>
</div>
<!--footer-->
</div>
<!--maincontentinner-->
</div>
<!--maincontent-->


</div>
<!--rightpanel-->

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
                                return " ";
                                break;
                        };
                    }
                },
                {mData: "catatan", sWidth: '55%'},
                {
                    mData: "lampiran",
                    sClass: "center",
                    sWidth: '15%',
                    mRender: function (data, type, full) {
                        return '<a href="' + baseUrl + '/admin/aj/log/download/' + full.id + '">Unduh</a>';
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
<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Usulan Per-UU"
    });
</script>
@stop
@section('admin')

<div class="rightpanel">

<ul class="breadcrumbs">
  <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
  <li><a href="{{URL::previous()}}">Aplikasi</a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Peraturan Perundang-Undangan</a> <span class="separator"></span></li>
  <li>Detail Usulan</li>
</ul>
@include('adminflash')
<div class="pageheader">
  <!--        <form action="results.html" method="post" class="searchbar">-->
  <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
  <!--        </form>-->
    <div class="pageicon"><span class="rulycon-notebook"></span></div>
  <div class="pagetitle">
    <!--<h5>Events</h5>-->

    <h1>Detail Usulan</h1>
  </div>
</div>
<!--pageheader-->

<div class="maincontent">
<div class="maincontentinner">

<!-- MAIN CONTENT -->

<legend>Perbaharui Usulan</legend>

@include('flash')

{{ Form::open(array('route' => array('admin.puu.update', $perUU->id), 'method' => 'put', 'files' => true, 'class' =>
'form form-horizontal')) }}

{{ Form::hidden('updated_by', 'Admin') }}

<div class="row-fluid">
  <div class="span6">
    <fieldset>
      <legend>PENANGGUNG JAWAB</legend>

      <div class="control-group">
        <label for="" class="control-label">Unit Kerja</label>

        <div class="controls"><input type="text" disabled="" value="{{ $perUU->penanggungJawab->unit_kerja }}"></div>
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
  <div class="span6">
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
  <div class="span6">

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
          @endif
        </div>
      </div>
        <div class="control-group">
            <input class="btn btn-primary" type="button" value="Batal" onclick="history.go(-1);return true;" name="batal">
            {{ Form::submit('Simpan', array('class' => "btn btn-primary")) }}

        </div>
    </fieldset>
  </div>
  <div class="span6">
    <fieldset>
      <legend>UPDATE STATUS</legend>
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
<br>
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

@stop

@section('scripts')
@parent
<script type="text/javascript">
  jQuery(function ($) {
    $tblLog = $("#tbl-log").dataTable({
      bServerSide: true,
      sAjaxSource: document.location.href,
      bFilter: true,
      bInfo: true,
      bSort: false,
      bLengthChange: false,
        oLanguage:{
            "sInfo": "Menampilkan _START_ Sampai _END_ dari _TOTAL_ Usulan",
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
            return $.datepicker.formatDate("dd M yy", new Date(Date.parse(data)));
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
                return "Belum Diproses";
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
    jQuery("#app_puu > a").addClass("sub-menu-active");
    jQuery("#app").css({
        "display": "block",
        "visibility": "visible"
    });
</script>

<script>
    jQuery(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Detail Usulan Per-UU"
    });
</script>
@stop

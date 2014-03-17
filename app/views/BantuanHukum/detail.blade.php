@section('admin')

<div class="rightpanel">

<ul class="breadcrumbs">
  <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
  <li><a href="{{URL::previous()}}">Informasi</a> <span class="separator"></span></li>
  <li>BANTUAN HUKUM</li>
</ul>
@include('adminflash')
<div class="pageheader">
  <!--        <form action="results.html" method="post" class="searchbar">-->
  <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
  <!--        </form>-->
  <div class="pageicon">&nbsp;</div>
  <div class="pagetitle">
    <!--<h5>Events</h5>-->

    <h1>Detail Bantuan Hukum</h1>
  </div>
</div>
<!--pageheader-->

<div class="maincontent">
<div class="maincontentinner">

<!-- MAIN CONTENT -->

<legend>Perbaharui Usulan</legend>

@include('flash')
{{ Form::open(array('route' => array('admin.bantuan_hukum.update', $banhuk->id), 'method' => 'put',
'id' => 'user-registrasi-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal',
'enctype' => "multipart/form-data")) }}

{{ Form::hidden('id', $banhuk->id, array('id' => 'id')) }}
<div class="row-fluid">
  <div class="span6">
    <fieldset>
      <legend>PENANGGUNG JAWAB</legend>

      <div class="control-group">
        {{ Form::label('nama', 'Nama Penanggung Jawab', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->nama }}"/>
        </div>
      </div>

      <?php $jenis_kelamin = ($banhuk->PJBantuanHukum->jenis_kelamin == 1) ? "Laki-laki" : "Perempuan"; ?>
      <div class="control-group">
        {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $jenis_kelamin }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->tgl_lahir }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->pekerjaan }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->nip }}"/>
        </div>
      </div>

      <div class="control-group {{$errors->has('password')?'error':''}}">
        {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->alamat_kantor }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->tlp_kantor }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('handphone', 'Telepon Genggam', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->handphone }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('email', 'E-Mail', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->PJBantuanHukum->email }}"/>
        </div>
      </div>
    </fieldset>
  </div>
  <div class="span6">
    <fieldset>
      <legend>INFORMASI PENGUSUL</legend>

      <div class="control-group">
        {{ Form::label('nama', 'Nama Penanggung Jawab', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->nama_lengkap }}"/>
        </div>
      </div>

      <?php $jenis_kelamin = ($banhuk->pengguna->jenis_kelamin == 1) ? "Laki-laki" : "Perempuan"; ?>
      <div class="control-group">
        {{ Form::label('jenis_kelamin', 'Jenis Kelamin', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $jenis_kelamin }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('tgl_lahir', 'Tanggal Lahir', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->tgl_lahir }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('pekerjaan', 'Pekerjaan', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->pekerjaan }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('nip', 'NIP', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->nip }}"/>
        </div>
      </div>

      <div class="control-group {{$errors->has('password')?'error':''}}">
        {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->alamat_kantor }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->tlp_kantor }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('handphone', 'Telepon Genggam', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->handphone }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('email', 'E-Mail', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->pengguna->email }}"/>
        </div>
      </div>
    </fieldset>


  </div>
</div>

<div class="row-fluid">
  <div class="span6">
    <fieldset>
      <legend>INFORMASI PERKARA</legend>

      <div class="control-group">
        {{ Form::label('jns_perkara', 'Jenis Perkara', array('class' => 'control-label')) }}

        <?php
        $jns_perkara = "";
        switch ($banhuk->jenis_perkara) {
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
          <input type="text" disabled value="{{ $jns_perkara }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('status_perkara', 'Status Perkara', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->status_perkara }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('status_pemohon', 'Status Pemohon (saat pengajuan permohonan)', array('class' =>
        'control-label')) }}

        <?php
        $status_pemohon = "";
        switch ($banhuk->status_pemohon) {
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
          <input type="text" disabled value="{{ $status_pemohon }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('uraian', 'Uraian Singkat Mengenai Pokok Persoalan yang Dimohonkan Bantuan Hukum', array('class'
        => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->uraian_singkat }}"/>
        </div>
      </div>
    </fieldset>
    <fieldset>
      <legend>INFORMASI LAMPIRAN</legend>

      <div class="control-group">
        {{ Form::label('ket_lampiran', 'Keterangan Lampiran', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->ket_lampiran }}"/>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('lampiran', 'Lampiran', array('class' => 'control-label')) }}
        <div class="controls">
          <ul style="background: transparent">
            @foreach(unserialize($banhuk->lampiran) as $index => $lampiran)
            <li>
              <a href="{{url::route('bantuan_hukum.download', array('id' => $banhuk->id, 'index' => $index )) }}">
                {{explode(DS, $lampiran)[count(explode(DS, $lampiran)) - 1 ] }}
              </a>
            </li>
            @endforeach
          </ul>
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
        <div class="controls">
          <input type="text" disabled value="{{ $banhuk->catatan }}"/>
        </div>
      </div>
    </fieldset>

  </div>
  <div class="span6">
    <fieldset>
      <legend>UPDATE STATUS</legend>

      <div class="control-group">
        {{ Form::label('advokasi', 'Advokasi Oleh', array('class' => 'control-label')) }}
        <div class="controls">
          {{ Form::select('advokasi', array(
          '0' => '- Pilih -',
          '1' => 'Bankum I',
          '2' => 'Bankum II',
          '3' => 'Bankum III'
          ), $banhuk->advokasi) }}
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('advokator', 'Advokator', array('class' => 'control-label')) }}
        <div class="controls">
          {{ Form::text('advokator', $banhuk->advokator, array('id' => 'advokator')) }}
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('status_pemohon', 'Status Pemohon', array('class' => 'control-label')) }}
        <div class="controls">
          {{ Form::select('status_pemohon', array(
          '0' => '- Pilih Status Pemohon -',
          '1' => 'Tergugat',
          '2' => 'Penggugat',
          '3' => 'Interfent',
          '4' => 'Saksi',
          '5' => 'Pemohon'
          ), $banhuk->status_pemohon) }}

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
          {{ Form::file('lampiran[]', array('id'=>'lampiran', 'multiple' => true)) }}
        </div>
      </div>

      <div class="control-group">
        {{ Form::label('catatan', 'Catatan', array('class' => 'control-label')) }}
        <div class="controls">
          {{ Form::textarea('catatan', $banhuk->catatan, array('id' => 'catatan', 'rows' => 4)) }}
        </div>
      </div>
    </fieldset>
  </div>
</div>

<div class="row-fluid">
  <div class="span24 text-center">
    <button class="btn btn-primary" type="submit">Simpan</button>
    <a class="btn btn-primary" type="button" href="{{URL::to('admin/bantuan_hukum')}}">Batal</a>
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
    var tbl_data = $("#basictable").dataTable({
      bFilter: false,
      bInfo: false,
      bSort: false,
      bPaginate: true,
      bLengthChange: false,
      bServerSide: true,
      bProcessing: true,
//                sAjaxSource: baseUrl + "/lkpm/data",
      sAjaxSource: '<?php echo URL::to("admin/bantuan_hukum/tablelog"); ?>',
      aoColumns: [
        {mData: "tanggal"},
        {
          mData: "status_pemohon",
          sClass: "center"
// mRender: function(id){
//     var status_pemohon;
//     switch (parseInt(id)){
//         case 1:
//             status_pemohon = "Tergugat";
//             break;
//         case 2:
//             status_pemohon = "Penggugat";
//             break;
//         case 3:
//             status_pemohon = "Interfent";
//             break;
//         case 4:
//             status_pemohon = "Saksi";
//             break;
//         case 5:
//             status_pemohon = "Pemohon";
//             break;
//     }

//     return status_pemohon;
// }
        },
        {mData: "catatan"},
        {
          mData: "lampiran",
          mRender: function (data, type, full) {
            return '<a href="' + baseUrl + '/admin/bantuan_hukum/log/download/' + full.id + '">Unduh</a>';
          }
        },
        {
          mData: "advokasi",
          mRender: function (id) {
            var advokasi = "";
            switch (parseInt(id)) {
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
          mRender: function (data) {
            var deleteUrl = baseUrl + '/admin/bantuan_hukum/delete_log/' + data;

            return '<a href="' + deleteUrl + '" class="btn_delete"><i class="icon-trash"></i></a>';
          }
        }
      ],
      fnServerParams: function (aoData) {
        //                    aoData.push({name: "tahun", value: $("#select_filter_tahun").val()});
        //                    aoData.push({name: "id_prop", value: $("#select_filter_provinsi").val()});
        aoData.push({name: "id", value: $("#id").val()});
      },
      fnServerData: function (sSource, aoData, fnCallback) {
        $.getJSON(sSource, aoData, function (json) {
          $("#text-tahun").text(json.tahun);
          fnCallback(json);
        });
      }
    });
  })
</script>
@stop

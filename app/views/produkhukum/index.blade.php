@section('content')
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-books'></span> Produk hukum";
</script>

<div id="filterdiv" class="filterdiv">
  <div class="row-fluid">
    <div class="span24">
      <form id="form-filter" class="form-horizontal" action="#">
        <div class="row-fluid">
          <div class="span12">
            <div class="control-group">
              <label for="tahun-filter" class="control-label">Tahun</label>
              <div class="controls">
                {{ Form::select('tahunFilter', $listThn, '', array('id' => 'tahun-filter')) }}
              </div>
            </div>
            <div class="control-group">
              <label for="select-kategori" class="control-label">Kategori</label>
              <div class="controls">
                <select id="select-kategori" name="kategori">
                    <option value="">Semua Kategori</option>
                    <option value="1">Undang-undang Dasar</option>
                    <option value="2">Peraturan Pemerintah</option>
                    <option value="3">Peraturan Presiden</option>
                    <option value="4">Keputusan Presiden</option>
                    <option value="5">Instruksi Presiden</option>
                    <option value="6">Peraturan Menteri</option>
                    <option value="7">Keputusan Menteri</option>
                    <option value="8">Instruksi Menteri</option>
                    <option value="9">Surat Edaran Menteri</option>
                    <option value="10">Nota Kesepakatan</option>
                    <option value="11">Nota Kesepahaman</option>
                    <option value="12">Peraturan Bersama</option>
                    <option value="13">Keputusan Bersama</option>
                    <option value="14">Surat Edaran Bersama</option>
                </select>
              </div>
            </div>
          </div>
          <div class="span12">
            <div class="control-group">
              <label for="select-masalah" class="control-label">Masalah</label>
              <div class="controls">
                <select id="select-masalah" name="masalah">
                  <option value="">Semua Masalah</option>
                  <option value="1">Kepegawaian</option>
                  <option value="2">Keuangan</option>
                  <option value="3">Organisasi</option>
                  <option value="5">Perlengkapan</option>
                  <option value="4">Umum</option>
                  <option value="7">Tim</option>
                  <option value="6">Lainnya</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label for="select-bidang" class="control-label">Bidang</label>
              <div class="controls">
                <select id="select-bidang" name="masalah">
                  <option value="">Semua Bidang</option>
                  <option value="1">Pendidikan Dasar</option>
                  <option value="2">Pendidikan Menengah</option>
                  <option value="3">Pendidikan Tinggi</option>
                  <option value="4">Kebudayaan</option>
                  <option value="5">Pendidikan Anak Usia Dini, Nonformal, Informal</option>
                  <option value="6">Lainnya</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row-fluid">
    <div class="span24">
      <table id="tbl-produkhukum" class="dataTable table">
        <thead>
        <tr>
<!--          <th>No</th>-->
          <th>Nomor</th>
          <th>Tentang</th>
          <th>Kategori</th>
          <th>Masalah</th>
          <th>Unduh</th>
        </tr>
        </thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
</div>


@stop


@section('scripts')
@parent
<script type="text/javascript">
  // jQuery(document).ready(function(){
  //   jQuery("#filtermenu").next("#filterdiv").hide();
  //   jQuery("#filtermenu").click(function(){
  //     $('.active').not(this).toggleClass('active').next('.hidden').slideToggle(300);
  //     $(this).toggleClass('active').next().slideToggle("fast");
  //   }); 
  // });

  // $(document).ready(function(){
  //   $('#filtermenu').click(function(){
  //       if ( $("#filterdiv").is(':hidden')) {
  //         $("#filterdiv").slideDown('200');
  //         $("#iconfilter").addClass('icon-edit');
  //         $("#iconfilter").removeClass('icon-plus');
  //       } else {
  //         $("#filterdiv").slideUp('200');
  //         $("#iconfilter").removeClass('icon-edit');
  //         $("#iconfilter").addClass('icon-plus');
  //       }
  //   });
  // });


</script>
@stop


@section('scripts')
@parent
<script type="text/javascript">
  jQuery(function ($) {

    $("#first-date").datepicker({
      dateFormat: "dd/mm/yy",
      onClose: function (selectedDate) {
        $("#last-date").datepicker("option", "minDate", selectedDate);
      }
    });

    $("#last-date").datepicker({
      dateFormat: "dd/mm/yy",
      onClose: function (selectedDate) {
        $("#first-date").datepicker("option", "maxDate", selectedDate);
      }
    });

    //       $(document).ready(function(){
    var role_id = <?php if($user->role_id) echo $user->role_id; else echo '0'; ?>;

    $dataTable = $("#tbl-produkhukum").dataTable({
      bFilter: true,
      bInfo: false,
      bSort: false,
      bPaginate: true,
      bLengthChange: false,
      bServerSide: true,
      bProcessing: true,
      sAjaxSource: '<?php echo URL::to("produkhukum/tableph"); ?>',
      aoColumns: [
//        {
//            mData: "id",
//            sClass: "center",
//            sWidth: '5%'
//        },

        {
            mData: "nomor",
            sClass: "center",
            sWidth: '15%'
        },

        {
          mData: "perihal",
          sWidth: '55%'
        },
        {
            mData: "kategori",
            sClass: "center",
            sWidth: '15%',
	    mRender: function (data, type, full) {
		  var kategori = "";
		  switch (parseInt(data))
		  {
			  case 1 :
				  kategori = 'Undang-undang Dasar';
				  break;
			  case 2 :
				  kategori = 'Peraturan Pemerintah';
				  break;
			  case 3 :
				  kategori = 'Peraturan Presiden';
				  break;
			  case 4 :
				  kategori = 'Keputusan Presiden';
				  break;
			  case 5 :
				  kategori = 'Instruksi Presiden';
				  break;
			  case 6 :
				  kategori = 'Peraturan Menteri';
				  break;
			  case 7 :
				  kategori = 'Keputusan Menteri';
				  break;
			  case 8 :
				  kategori = 'Instruksi Menteri';
				  break;
			  case 9 :
				  kategori = 'Surat Edaran Menteri';
				  break;
			  case 10 :
				  kategori = 'Nota Kesepakatan';
				  break;
			  case 11 :
				  kategori = 'Nota Kesepahaman';
				  break;
			  case 12 :
				  kategori = 'Peraturan Bersama';
				  break;
			  case 13 :
				  kategori = 'Keputusan Bersama';
				  break;
			  case 14 :
				  kategori = 'Surat Edaran Bersama';
				  break;
		  }
		  return kategori;
          }
        },
        {
            mData: "masalah",
            sClass: "center",
            sWidth: '15%',
          mRender: function (data, type, full) {
		data = parseInt(data);
            if (data === 1) {
              return 'Kepegawaian';
            } else if (data === 2) {
              return 'Keuangan';
            } else if (data === 3) {
              return 'Organisasi';
            } else if (data === 4) {
              return 'Umum';
            } else if (data === 5) {
              return 'Perlengkapan';
            } else if (data === 6) {
              return 'Lainnya';
            } else {
                return '';
            }
          }

        },
        {
            mData: "id",
            sClass: "center",
            sWidth: '5%',
          mRender: function (data, type, full) {
            return "<a href='produkhukum/" + data + "/detail' title='Detail'> <i class='icon-edit'></i></a>"
              + "&nbsp;<a href='produkhukum/" + data + "/download' title='Unduh'> <i class='icon-download'></i></a>";

          }
        }

      ],
      fnServerParams: function (aoData) {
        aoData.push({name: "kategori", value: $("#select-kategori").val()});
        aoData.push({name: "masalah", value: $("#select-masalah").val()});
        aoData.push({name: "tahunFilter", value: $("#tahun-filter").val()});
        aoData.push({name: "bidang", value: $("#select-bidang").val()});
      },
      fnDrawCallback: function (oSettings) {
//        if (oSettings.bSorted || oSettings.bFiltered) {
//          for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
//            $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
//          }
//        }
      },

      aoColumnDefs: [
        { "bSortable": false, "aTargets": [ 0 ] }
      ],
      aaSorting: [
        [ 1, 'asc' ]
      ]

    });

    $("#tbl-produkhukum").on('click', '.btn_delete', function (e) {
      if (confirm('Apakah anda yakin ?')) {
        $.ajax({
          url: $(this).attr('href'),
          type: 'DELETE',
          success: function (response) {
            $dataTable.fnReloadAjax();
          }
        });
      }
      e.preventDefault();
      return false;
    });

    $("#select-status, #select-kategori, #select-masalah, #tahun-filter, #select-bidang").change(function () {
      $dataTable.fnReloadAjax();
    });

    $("#form-filter").on("reset", function () {
      $dataTable.fnReloadAjax();
    });

  });
</script>

<script>
  $("#menu-produk-hukum").addClass("active");
</script>
@stop

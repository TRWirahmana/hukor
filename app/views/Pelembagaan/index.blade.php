@if($user->role_id == 3 || $user->role_id == 7 || $user->role_id == 4 || $user->role_id == 1 || $user->role_id == 5 || $user->role_id == 6 || $user->role_id == 8 || $user->role_id == 9)
@section('admin')
@else
@section('content')
@endif


@if($user->role_id == 3 || $user->role_id == 7 || $user->role_id == 4 || $user->role_id == 1 || $user->role_id == 5 || $user->role_id == 6 || $user->role_id == 8 || $user->role_id == 9)
<div class="rightpanel">
<ul class="breadcrumbs">
  <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
  <li><a href="{{URL::previous()}}">Aplikasi</a> <span class="separator"></span></li>
  <li>Pelembagaan</li>
</ul>
@include('adminflash')
<div class="pageheader">
  <!--        <form action="results.html" method="post" class="searchbar">-->
  <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
  <!--        </form>-->
  <div class="pageicon"><span class="rulycon-notebook"></span></div>
  <div class="pagetitle">
    <h1>PELEMBAGAAN</h1>
  </div>
</div>
<!--pageheader-->

<div class="maincontent">
  <div class="maincontentinner">
    <!-- MAIN CONTENT -->

    <div class="content-non-title">
      <!--  notifikasi status  -->
      @if($status_belum != 0)
      <div class="row-fluid" style="border-bottom: 1px solid #e5e5e5;">
        <b>
          <table class="table">
            <tr>
              <td width="100" class="style11">Status terkini :</td>
              <td class="style10">
                <div align="right" style="color: red"> {{ $status_belum }}</div>
              </td>
              <td width="5" class="style3"></td>
              <td class="style11">usulan pelembagaan yang belum di proses</td>
            </tr>
          </table>
        </b>
        <br/>
      </div>
      @endif

      @else
<!--      LAYANAN PELEMBAGAAN-->
      <script>
        document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-drawer-3'></span> Pelembagaan";
      </script>

      <legend>Informasi dan Status</legend>

      <script>
        document.getElementById("menu-pelembagaan-informasi").setAttribute("class", "user-menu-active");
        document.getElementById("collapse11").style.height = "auto";
      </script>
      @endif

      <!-- Filter -->
      @if($user->role_id == 3 )
      <form id="form-filter" class="form form-horizontal" action="{{URL::route('admin.pelembagaan.printTable')}}" style="margin-bottom: 24px;">
        @else
        <form id="form-filter" class="form form-horizontal" action="{{URL::route('pelembagaan.printTable')}}" style="margin-bottom: 24px;">
          @endif
          <fieldset>
            <legend class="f_legend">Filter</legend>

            <div class="row-fluid">
              <div class="span6">
                <div class="control-group">
                  <label for="" class="control-label">Tanggal Awal</label>

                  <div class="controls">
                    <input type="text" id="first-date" name="firstDate">
                  </div>
                </div>

                <div class="control-group">
                  <label for="toDate" class="control-label">Tanggal Akhir</label>

                  <div class="controls">
                    <input type="text" id="last-date" name="lastDate">
                  </div>
                </div>
              </div>
              <div class="span6">
                <div class="control-group">
                  <label for="select-status" class="control-label">Status</label>

                  <div class="controls">
                    <select id="select-status" name="status">
                      <option value="">Semua Status</option>
                      <option value="0">Belum diproses</option>
                      <option value="1">Diproses</option>
                      <option value="2">Dikirim Ke bagian PerUU</option>
                    </select>
                  </div>
                </div>

                <div class="control-group">
                  <div class="controls">
                    <input type="reset" value="Reset" class="btn btn-primary" id="btn-reset">
                    <input type="submit" value="Cetak" class="btn btn-primary">
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
        </form>


        <br/>
        <table id="tbl-pelembagaan" class="table">
          <thead>
          <tr>
            <th>#</th>
            <!--                           <th>No Usulan</th> -->
            <th>Tgl Usulan</th>
            <th>Unit Kerja</th>
            <th>Jenis Usulan</th>
            <th>Perihal</th>
            <th>Status</th>
            <th> -</th>
          </tr>
          </thead>
          <tbody></tbody>

        </table>
        <style>
          table.dataTable tr td:nth-child(6) {
            text-align: center;
          }
        </style>

        <!-- END OF MAIN CONTENT -->
        @if($user->role_id == 3 )


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
@endif

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

    $dataTable = $("#tbl-pelembagaan").dataTable({
      bFilter: true,
      //     bInfo: false,
      bSort: false,
      bPaginate: true,
      //   bLengthChange: false,
      bServerSide: true,
      bProcessing: true,
      sAjaxSource: document.location.href,
      aoColumns: [
        {
          mData: "id",
          sClass: 'center-ac',
          sWidth: '1%'
        },


        {
          mData: "tgl_usulan",
          sClass: 'center-ac',
          sWidth: '14%',
          mRender: function (data) {
            return $.datepicker.formatDate('dd M yy', new Date(Date.parse(data)));
          }
        },
        {
          mData: "unit_kerja",
          sClass: 'center-ac',
          sWidth: '14%'
        },
        /*
         {
         mData: "jabatan" ,
         sClass: 'center-ac',
         mRender: function ( data, type, full ) {
         if (null != data && "" != data){
         if(data ==='1'){
         return 'Direktur';
         }else if(data === '2'){
         return 'Kepala Divisi';
         }
         }
         return data;
         }
         },
         */
        {
          mData: "jenis_usulan",
          mRender: function (data, type, full) {
            if (null != data && "" != data) {
              if (data === 1) {
                return 'Pendirian';
              } else if (data === 2) {
                return 'Perubahan';
              } else if (data === 3) {
                return 'Statuta';
              } else if (data === 4) {
                return 'Penutupan';
              } else {
                return 'lain-lain';
              }
            }
          }
        },

        {mData: "perihal"},
        {

          mData: "status",
          mRender: function (data, type, full) {
            if (null != data && "" != data) {
              if (data === '1') {
                return 'proses';
              } else if (data === '2') {
                return 'DiKirim Ke Bag PerUU';
              }
            }
            return 'Belum Di Proses';
          }

        },
        {
          mData: "id",
          sClass: 'center-ac',
          sWidth: '10%',
          mRender: function (data, type, full) {
            if (role_id == 3) {
              return "<a href='" + baseUrl + "/pelembagaan/download/" + data + "' title='Unduh'> <i class='icon-download'></i></a>"
                + "&nbsp;<a href='pelembagaan/" + data + "/update' title='Detail'><i class='icon-edit'></i></a>"
                + "&nbsp;<a class='btn_delete' title='Hapus' href='pelembagaan/" + data + "'>"
                + "<i class='icon-trash'></i></a>";
            } else if (role_id == 7) {
              return "<a href='" + baseUrl + "/pelembagaan/download/" + data + "' title='Unduh'> <i class='icon-download'></i></a>"
                + "&nbsp;<a href='pelembagaan/" + data + "/update' title='Detail'><i class='icon-edit'></i></a>"
                + "&nbsp;<a class='btn_delete' title='Hapus' href='pelembagaan/" + data + "'>"
                + "<i class='icon-trash'></i></a>";
            } else if (role_id == 0) {
//                                          return "<a href='" + baseUrl + '/pelembagaan/download/'+data+ "'> <i class='icon-download'></i></a>";
            } else if(role_id == 2) {
                                          return "<a href='" + baseUrl + '/pelembagaan/download/' + data + "' title='Unduh'> <i class='icon-download'></i></a>";
            }
	    return "";
          }
        }
      ],

      fnServerParams: function (aoData) {
        aoData.push({name: "status", value: $("#select-status").val()});
        aoData.push({name: "firstDate", value: $("#first-date").val()});
        aoData.push({name: "lastDate", value: $("#last-date").val()});
      },
      fnDrawCallback: function (oSettings) {
        if (oSettings.bSorted || oSettings.bFiltered) {
          for (var i = 0, iLen = oSettings.aiDisplay.length; i < iLen; i++) {
            $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr).html(i + 1);
          }
        }
      },

      aoColumnDefs: [
        { "bSortable": false, "aTargets": [ 0 ] }
      ],
      aaSorting: [
        [ 1, 'asc' ]
      ]

    });

    $("#tbl-pelembagaan").on('click', '.btn_delete', function (e) {
      if (confirm('Apakah anda yakin ?')) {
        $.ajax({
          url: $(this).attr('href'),
          type: 'post',
	  data: {_method:"delete"},
          success: function (response) {
            $dataTable.fnReloadAjax();
          }
        });
      }
      e.preventDefault();
      return false;
    });

    // $("#filter_unit").keyup( function() { fnFilterUnit ( 3 ); } );
    // $("#filter_tahun").change( function() { fnFilterTahun( 2 ); } );

    $("#select-status, #first-date, #last-date").change(function () {
      $dataTable.fnReloadAjax();
    });

    $("#form-filter").on("reset", function () {
      $dataTable.fnReloadAjax();
    });

//          });

  });
</script>

<script>
  jQuery("#app_pelembagaan > a").addClass("sub-menu-active");
  jQuery("#app").css({
    "display": "block",
    "visibility": "visible"
  });
</script>
@stop

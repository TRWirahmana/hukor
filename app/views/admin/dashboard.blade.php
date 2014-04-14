@section('admin')
<div class="rightpanel">

<ul class="breadcrumbs">
  <li><a href="{{URL::to('admin/Home')}}"><i class="iconfa-home"></i></a></span></li>
</ul>
@include('adminflash')

<div class="pageheader">
  <div class="pageicon"><span class="rulycon-home-2"></span></div>
  <div class="pagetitle">
    <h1>Selamat Datang</h1>
  </div>
</div>

<div class="maincontent">
<div class="maincontentinner">

<!-- MAIN CONTENT -->
<div class="well well-success">
<!--  <button type="button" class="close" data-dismiss="alert">&times;</button>-->
  <h2>Laporan Usulan</h2>
  <hr>
  <div class="row-fluid dashboard-summary">
    @if (in_array(Auth::user()->role_id, array(1, 3 ,4, 5, 6)))
    <div class="span4">
      <h4>Peraturan Perundang-Undangan</h4>

      <div class="row-fluid">
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_PerUU::getUnreadCount()}}</h4>

            <p>Usulan baru</p>
          </div>
        </div>
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_PerUU::getTodayCount()}}</h4>

            <p>Usulan hari ini</p>
          </div>
        </div>
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_PerUU::getTotalCount()}}</h4>

            <p>Total usulan</p>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if (in_array(Auth::user()->role_id, array(1, 3, 4, 5, 7)))
    <div class="span4">
      <h4>Pelembagaan</h4>

      <div class="row-fluid">
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_Pelembagaan::getUnreadCount()}}</h4>

            <p>Usulan baru</p>
          </div>
        </div>
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_Pelembagaan::getTodayCount()}}</h4>

            <p>Usulan hari ini</p>
          </div>
        </div>
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_Pelembagaan::getTotalCount()}}</h4>

            <p>Total usulan</p>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if(in_array(Auth::user()->role_id, array(1, 3, 4, 5, 8)))
    <div class="span4">
      <h4>Bantuan Hukum</h4>

      <div class="row-fluid">
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_BantuanHukun::getUnreadCount()}}</h4>

            <p>Usulan baru</p>
          </div>
        </div>
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_BantuanHukun::getUnreadCount()}}</h4>

            <p>Usulan hari ini</p>
          </div>
        </div>
        <div class="span4">
          <div class="card three">
            <h4>{{DAL_BantuanHukun::getTotalCount()}}</h4>

            <p>Total usulan</p>
          </div>
        </div>
      </div>
    </div>
    @endif
  </div>
  <br>
  @if (in_array(Auth::user()->role_id, array(1, 3, 4, 5, 9)))
<!--  <div class="row-fluid dashboard-summary">-->
<!--    <div class="span4">-->
<!--      <h4>Sistem dan Prosedur</h4>-->
<!---->
<!--      <div class="row-fluid">-->
<!--        <div class="span4">-->
<!--          <div class="card three">-->
<!--            <h4>{{DAL_SistemDanProsedur::getUnreadCount()}}</h4>-->
<!---->
<!--            <p>Total usulan</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="span4">-->
<!--          <div class="card three">-->
<!--            <h4>{{DAL_SistemDanProsedur::getTodayCount()}}</h4>-->
<!---->
<!--            <p>Total usulan</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="span4">-->
<!--          <div class="card three">-->
<!--            <h4>{{DAL_SistemDanProsedur::getTotalCount()}}</h4>-->
<!---->
<!--            <p>Total usulan</p>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="span4">-->
<!--      <h4>Analisis Jabatan</h4>-->
<!---->
<!--      <div class="row-fluid">-->
<!--        <div class="span4">-->
<!--          <div class="card three">-->
<!--            <h4>{{DAL_AnalisisJabatan::getUnreadCount()}}</h4>-->
<!---->
<!--            <p>Usulan baru</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="span4">-->
<!--          <div class="card three">-->
<!--            <h4>{{DAL_AnalisisJabatan::getTodayCount()}}</h4>-->
<!---->
<!--            <p>Usulan hari ini</p>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="span4">-->
<!--          <div class="card three">-->
<!--            <h4>{{DAL_AnalisisJabatan::getTotalCount()}}</h4>-->
<!---->
<!--            <p>Total usulan</p>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
  @endif
</div>

@if (in_array($user->role_id, array(1, 3, 4, 5)))
<div class="row-fluid">
  <div class="span12">
    <div id="line-chart"></div>
  </div>
</div>
<hr>

<div class="row-fluid">
  <form id="form-filter" action="{{URL::route('admin.cetakLaporan')}}">
    <div class="row-fluid">
      <div class="span6">
        <div class="form-horizontal">
          <legend class="f_legend">Cetak Laporan</legend>
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
          <div class="control-group">
            <label for="select-status" class="control-label">Usulan</label>

            <div class="controls">
              <select id="select-status" name="modul">
                <option value="">Semua</option>
                <option value="1">Peraturan Perundang-Undangan</option>
                <option value="2">Pelembagaan</option>
                <option value="3">Bantuan Hukum</option>
<!--                <option value="4">Sistem dan Prosedur</option>-->
<!--                <option value="5">Analisis Jabatan</option>-->
              </select>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for=""></label>

            <div class="controls">
              <input type="reset" value="Reset" class="btn btn-primary" id="btn-reset">
              <input type="submit" value="Cetak" class="btn btn-primary">
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endif

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
<script src="{{asset('assets/js/highcharts.js')}}"></script>
<script>
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

    $chart = $("#line-chart");
    if ($chart.length > 0) {
      $chart.highcharts({
        title: {
          text: 'REKAPITULASI USULAN',
          x: -20 //center
        },
        xAxis: {
          categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
        },
        yAxis: {
          title: {
            text: 'JUMLAH USULAN'
          },
          plotLines: [
            {
              value: 0,
              width: 1,
              color: '#808080'
            }
          ]
        },
	plotOptions: {
		line: {
			marker: {
				enabled: false	
			}		
		}	
	},
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle',
          borderWidth: 0
        },
        series: [
          {
            name: 'Per UU',
            data: []
          },
          {
            name: 'Pelembagaan',
            data: []
          },
          {
            name: 'Bantuan Hukum',
            data: []
          }
//          {
//            name: 'Sistem dan Prosedur',
//            data: []
//          },
//          {
//            name: 'Analisis Jabatan',
//            data: []
//          }
        ]
      });

      $highcharts = $chart.highcharts();

      $.getJSON(document.location.href, null, function (response) {
        $highcharts.series[0].setData(response.per_uu);
        $highcharts.series[1].setData(response.pelembagaan);
        $highcharts.series[2].setData(response.bantuan_hukum);
//        $highcharts.series[3].setData(response.sistem_dan_prosedur);
//        $highcharts.series[4].setData(response.analisis_jabatan);
      });
    }


  });
</script>
@stop

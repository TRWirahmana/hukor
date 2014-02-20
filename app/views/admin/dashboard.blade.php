@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="{{URL::to('admin/Home')}}"><i class="iconfa-home"></i></a></span></li>
    </ul>
    @include('adminflash')

    <div class="pageheader">
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <h1>Selamat Datang</h1>
        </div>
    </div>

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h1>Laporan Usulan</h1>
                <hr>
                <div class="row-fluid">
                    @if (in_array(Auth::user()->role_id, array(1, 3 ,4, 5, 6)))
                    <div class="span4">
                        <h3>Per UU</h3>
                        <table>
                            <tr>
                                <th align="left">Usulan Baru</th>
                                <td>: {{DAL_PerUU::getUnreadCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Usulan Hari Ini</th>
                                <td>: {{DAL_PerUU::getTodayCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Total Usulan</th>
                                <td>: {{DAL_PerUU::getTotalCount()}}</td>
                            </tr>
                        </table>
                    </div>
                    @endif

                    @if (in_array(Auth::user()->role_id, array(1, 3, 4, 5, 7)))
                    <div class="span4">
                        <h3>Pelembagaan</h3>
                        <table>
                            <tr>
                                <th align="left">Usulan Baru</th>
                                <td>: {{DAL_Pelembagaan::getUnreadCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Usulan Hari Ini</th>
                                <td>: {{DAL_Pelembagaan::getTodayCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Total Usulan</th>
                                <td>: {{DAL_Pelembagaan::getTotalCount()}}</td>
                            </tr>
                        </table>
                    </div>
                    @endif

                    @if(in_array(Auth::user()->role_id, array(1, 3, 4, 5, 8)))
                    <div class="span4">
                        <h3>Bantuan Hukum</h3>
                        <table>
                            <tr>
                                <th align="left">Usulan Baru</th>
                                <td>: {{DAL_BantuanHukun::getUnreadCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Usulan Hari Ini</th>
                                <td>: {{DAL_BantuanHukun::getTodayCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Total Usulan</th>
                                <td>: {{DAL_BantuanHukun::getTotalCount()}}</td>
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>
                <br>
                @if (in_array(Auth::user()->role_id, array(1, 3, 4, 5, 9)))
                <div class="row-fluid">
                    <div class="span4">
                        <h3>Sistem dan Prosedur</h3>
                        <table>
                            <tr>
                                <th align="left">Usulan Baru</th>
                                <td>: {{DAL_SistemDanProsedur::getUnreadCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Usulan Hari Ini</th>
                                <td>: {{DAL_SistemDanProsedur::getTodayCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Total Usulan</th>
                                <td>: {{DAL_SistemDanProsedur::getTotalCount()}}</td>
                            </tr>
                        </table>      
                    </div>
                    <div class="span4">
                        <h3>Analisis Jabatan</h3>
                        <table>
                            <tr>
                                <th align="left">Usulan Baru</th>
                                <td>: {{DAL_AnalisisJabatan::getUnreadCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Usulan Hari Ini</th>
                                <td>: {{DAL_AnalisisJabatan::getTodayCount()}}</td>
                            </tr>
                            <tr>
                                <th align="left">Total Usulan</th>
                                <td>: {{DAL_AnalisisJabatan::getTotalCount()}}</td>
                            </tr>
                        </table>      
                    </div>
                </div>
                @endif
            </div>

            @if (in_array($user->role_id, array(1, 3, 4, 5)))
            <div id="line-chart"></div>    
            <hr>
            <form id="form-filter" class="form form-horizontal" action="{{URL::route('admin.cetakLaporan')}}">
                <fieldset>
                    <legend class="f_legend">Cetak Laporan</legend>
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
                                <label for="select-status" class="control-label">Modul</label>
                                <div class="controls">
                                    <select id="select-status" name="modul">
                                        <option value="">Semua</option>
                                        <option value="1">Peraturan Perundang Undangan</option>
                                        <option value="2">Pelembagaan</option>
                                        <option value="3">Bantuan Hukum</option>
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
            @endif

            <div class="footer">
                <div class="footer-left">
                    <span>&copy; 2013. Admin Template. All Rights Reserved.</span>
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
jQuery(function($) {

    $("#first-date").datepicker({
        dateFormat: "dd/mm/yy",
        onClose: function(selectedDate) {
            $("#last-date").datepicker("option", "minDate", selectedDate);
        }
    });


    $("#last-date").datepicker({
        dateFormat: "dd/mm/yy",
        onClose: function(selectedDate) {
            $("#first-date").datepicker("option", "maxDate", selectedDate);
        }
    });

    $chart = $("#line-chart");
    if ($chart.length > 0) {
        $chart.highcharts({
            title: {
                text: 'Jumlah Usulan Per Bulan',
                x: -20 //center
            },
            xAxis: {
                categories: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]
            },
            yAxis: {
                title: {
                    text: 'Jumlah Usulan'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'Per UU',
                    data: []
                }, {
                    name: 'Pelembagaan',
                    data: []
                }, {
                    name: 'Bantuan Hukum',
                    data: []
                }]
        });

        $highcharts = $chart.highcharts();

        $.getJSON(document.location.href, null, function(response) {
            $highcharts.series[0].setData(response.per_uu);
            $highcharts.series[1].setData(response.pelembagaan);
            $highcharts.series[2].setData(response.bantuan_hukum);
        });
    }


});
</script>
@stop
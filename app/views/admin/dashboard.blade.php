@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="{{URL::to('admin/Home')}}"><i class="iconfa-home"></i></a></span></li>
    </ul>
    @include('adminflash')

    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Selamat Datang</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
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
    jQuery(function ($) {

        $("#first-date").datepicker({
            dateFormat: "dd/mm/yy",
            onClose: function( selectedDate ) {
                $("#last-date").datepicker( "option", "minDate", selectedDate );
            }
        });
        $("#last-date").datepicker({
            dateFormat: "dd/mm/yy",
            onClose: function( selectedDate ) {
                $("#first-date").datepicker("option", "maxDate", selectedDate);
            }                    
        });

        $chart = $('#line-chart').highcharts({
            title: {
                text: 'Jumlah Usulan Per Bulan',
                x: -20 //center
            },
            xAxis: {
                categories: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"]
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
    });
</script>
@stop
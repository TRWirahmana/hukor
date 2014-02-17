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
            <div class="alert alert-block alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h1>Laporan Usulan</h1>
                <hr>
                <div class="row-fluid">
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
                  
                </div>
                <br>
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
                
            </div>

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
<script src="{{asset('assets/js/admin_index.js')}}"></script>
@stop
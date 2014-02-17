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
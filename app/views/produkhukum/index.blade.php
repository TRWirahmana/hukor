@section('content')
      <h2>Produk Hukum</h2>
      <div class="stripe-accent"></div>
<!--       <legend>Peraturan Perundang-Undangan</legend> -->

      <form id="form-filter" class="form form-horizontal" action="{{URL::route('print_table_pelembagaan_user')}}">
	 	<fieldset>
          <legend class="f_legend">Filter</legend>
                <div class="row-fluid">
                            <div class="span6">
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
                                            <option value="1">Keputusan Mentri</option>
                                            <option value="2">Peraturan Mentri</option>
                                            <option value="3">Peraturan Bersama</option>
                                            <option value="4">Keputusan Bersama</option>
                                            <option value="5">Intruksi Mentri</option>
                                            <option value="6">Surat Edaran</option>
                                         </select>        
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label for="select-masalah" class="control-label">Masalah</label>
                                    <div class="controls">
                                        <select id="select-masalah" name="masalah">
                                            <option value="">Semua Masalah</option>
                                            <option value="1">Kepegawaian</option>
                                            <option value="2">Keuangan</option>
                                            <option value="3">Organisasi</option>
                                            <option value="4">Umum</option>
                                            <option value="5">Perlengkapan</option>
                                            <option value="6">Lainnya</option>
                                        </select>        
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <input type="reset" value="Reset" class="btn btn-primary" id="btn-reset">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>

                <br />
                  <table id="tbl-produkhukum">  
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>No. Usulan</th>
                          <th>Tentang</th>
                          <th>Kategori</th>
                          <th>Masalah</th>
                          <th> Unduh </th>
                      </tr>
                      </thead>
                      <tbody></tbody>

                  </table>

@stop

@section('scripts')
@parent
   <script type="text/javascript">
    jQuery(function($){        
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
        
 //       $(document).ready(function(){
            var role_id = <?php if($user->role_id) echo $user->role_id; else echo '0'; ?>;
            
            $dataTable = $("#tbl-produkhukum").dataTable({
                bServerSide: true,
                bFilter: true,
                bLengthChange: false,
 
                sAjaxSource: document.location.href,
                aoColumns: [
                  {
                              mData: "id",
                              sWidth: '3%'
                            },

                            {
                              mData: "nomor",
                              sWidth: '5%'
                            },
                            
                            {
                              mData: "deskripsi",
                              sWidth: '14%'
                            },
                            {
                              mData: "kategori",
                              sWidth: '14%',
                              mRender: function ( data, type, full ) {
                                if(data ==='1'){
                                    return 'Keputusan Mentri';
                                }else if(data === '2'){
                                   return 'Peraturan Mentri';
                                }else if(data === '3'){
                                  return 'Peraturan Bersama';
                                }else if(data === '4'){
                                  return 'Keputusan Bersama';
                                }else if(data === '5'){
                                  return 'Instruksi Mentri';
                                }else if(data === '6'){
                                  return 'Surat Edaran';
                                }
                              }
                            },
                            {
                              mData: "masalah",
                              sWidth: '14%',
                              mRender: function (data, type, full) {
                                if(data === '1'){
                                  return 'Kepegawaian';
                                }else if(data === '2'){
                                  return 'Keuangan';
                                }else if(data === '3'){
                                  return 'Organisasi';
                                }else if(data === '4'){
                                  return 'Umum';
                                }else if(data === '5'){
                                  return 'Perlengkapan';
                                }else if(data === '6'){
                                  return 'Lainnya';
                                }
                              }
                               
                            },
                            {
                              mData: "id",
                              sWidth: '14%',
                                mRender: function(data, type, full) {
                                    return "<a href='produkhukum/"+data+"/detail'> <i class='icon-edit'></i></a>"
                                          +"&nbsp;<a href='produkhukum/"+data+"/download'> <i class='icon-download'></i></a>" ;

                                }
                            }

                        ],
                        fnServerParams: function(aoData) {
    //                        aoData.push({name: "status", value: $("#select-status").val()});
                            aoData.push({name: "kategori", value: $("#select-kategori").val()});
                            aoData.push({name: "masalah", value: $("#select-masalah").val()});
                            aoData.push({name: "tahunFilter", value: $("#tahun-filter").val()});
                            aoData.push({name: "firstDate", value: $("#first-date").val()});
    //                        aoData.push({name: "lastDate", value: $("#last-date").val()});
                        },
                        fnDrawCallback: function ( oSettings ) {
                           if ( oSettings.bSorted || oSettings.bFiltered )
                           {
                             for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                             {
                               $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                             }
                           }
                        },

                        aoColumnDefs: [
                            { "bSortable": false, "aTargets": [ 0 ] }
                            ],
                        aaSorting: [[ 1, 'asc' ]]

                      }); 

                  $("#tbl-produkhukum").on('click', '.btn_delete', function(e){
                          if (confirm('Apakah anda yakin ?')) {
                            $.ajax({
                              url: $(this).attr('href'),
                              type: 'DELETE',
                              success: function(response) {
                                $dataTable.fnReloadAjax();
                              }
                            });
                          }
                          e.preventDefault();
                          return false;
                  });

                  // $("#filter_unit").keyup( function() { fnFilterUnit ( 3 ); } );
                  // $("#filter_tahun").change( function() { fnFilterTahun( 2 ); } );
                          
                  $("#select-status, #select-kategori, #select-masalah, #first-date, #tahun-filter, #last-date").change(function() {
                      $dataTable.fnReloadAjax();
                  });

                  $("#form-filter").on("reset", function(){
                      $dataTable.fnReloadAjax();
                  });

//          });
          
});
        </script>        
@stop

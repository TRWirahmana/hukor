@if($user->role_id == 3 )
  @section('admin')
@else
  @section('content')
@endif


@if($user->role_id == 3 )
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
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>PELEMBAGAAN</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">
            <!-- MAIN CONTENT -->

            <div class="content-non-title">
              <legend>
                Informasi & Status Usulan
                  </legend>
              
                  <!--  notifikasi status  -->
                 @if($status_belum != 0)
                  <div class="row-fluid" style="border-bottom: 1px solid #e5e5e5;">
                  <b>
                    <table>   
                      <tr>
                          <td width="100" class="style11">Status terkini : </td>
                          <td class="style10"><div align="right" style="color: red"> {{ $status_belum }} </div></td>
                          <td width="5" class="style3"></td>
                          <td class="style11">usulan pelembagaan yang belum di proses </td>
                      </tr>
                    </table>
                    </b>
                    <br />
                  </div>
                  @endif


                <form class="form form-horizontal" action="{{URL::route('print_table_pelembagaan')}}">
                    <fieldset>

                                <div class="control-group">
                                    <div class="controls">
                                        <input type="submit" value="Cetak" class="btn btn-primary">
                                    </div>
                                </div>
                  </fieldset>
                </form>

@else
      <h2>Layanan Ketatalaksanaan</h2>
      <div class="stripe-accent"></div>
      <legend>Informasi dan Status</legend>
@endif


                <br />
                  <table id="tbl-pelembagaan">  
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>No. Usulan</th>
                          <th>Tgl Usulan</th>
                          <th>Unit Kerja</th>
                          <th>Jabatan</th>
                          <th>Perihal</th>
                          <th>Status</th>
                          <th> - </th>
                      </tr>
                      </thead>
                      <tbody></tbody>

                  </table>

                <!-- END OF MAIN CONTENT -->
@if($user->role_id == 3 )


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
@endif

@stop


@section('scripts')
@parent
        <script type="text/javascript">

        jQuery(function($){        

        function fnFilterTahun (i)
        {
            $("#tbl-pelembagaan").dataTable().fnFilter(
                    $("#filter_tahun").val(),
                    i                   
            );   
        }       
        
        function fnFilterUnit (i)
        {
            $("#tbl-pelembagaan").dataTable().fnFilter(
                    $("#filter_unit").val(),
                    i                   
            );   
        }       
        
        $(document).ready(function(){
            var role_id = <?php if($user->role_id) echo $user->role_id; else echo '0'; ?>;
            var oTable = $("#tbl-pelembagaan").dataTable({
                        iDisplayLength: 5,
                        bServerSide: true,
                        sAjaxSource: document.location.href,
                        aoColumns: [

                            {
                              mData: "id",
                              sClass: 'center-ac',
                              sWidth: '3%'
                            },

                            {
                              mData: "id",
                              sClass: 'center-ac',
                              sWidth: '5%'
                            },
                            {
                              mData: "tgl_usulan",
                              sClass: 'center-ac',
                              sWidth: '14%'
                            },
                            {
                              mData: "unit_kerja",
                              sClass: 'center-ac',                              
                              sWidth: '14%'
                            },
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
                            {mData: "perihal"},
                            {

                              mData: "status",
                              mRender: function ( data, type, full ) {
                                  if (null != data && "" != data){
                                    if(data ==='1'){
                                      return 'proses';
                                    }else if(data === '2'){
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
                                 mRender: function(data, type, full) {
                                        if(role_id == 3){
                                          return "<a href='pelembagaan/"+data+"/download'> <i class='icon-download'></i></a>"  
                                                + "&nbsp;<a href='pelembagaan/"+data+"/edit' title='Detail'><i class='icon-edit'></i></a>"
                                                + "&nbsp;<a class='btn_delete' title='Hapus' href='pelembagaan/"+data+"'>"
                                                + "<i class='icon-trash'></i></a>";
                                        } else if(role_id == 0 ) {
                                          return "<a href='"+data+"/download'> <i class='icon-download'></i></a>";
                                        }  else {
                                          return "<a href='"+data+"/download'> <i class='icon-download'></i></a>";
                                        }
                              }
                            }
                        ],
                                    
                        "fnDrawCallback": function ( oSettings ) {
                                      /* Need to redo the counters if filtered or sorted */
                                      if ( oSettings.bSorted || oSettings.bFiltered )
                                      {
                                        for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                                        {
                                          $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                                        }
                                      }
                                    },
                        "aoColumnDefs": [
                              { "bSortable": false, "aTargets": [ 0 ] }
                        ],
                        "aaSorting": [[ 1, 'asc' ]]
                  }); 

                  $("#tbl-pelembagaan").on('click', '.btn_delete', function(e){
                          if (confirm('Apakah anda yakin ?')) {
                            $.ajax({
                              url: $(this).attr('href'),
                              type: 'DELETE',
                              success: function(response) {
                                oTable.fnReloadAjax();
                              }
                            });
                          }
                          e.preventDefault();
                          return false;
                  });

                  $("#filter_unit").keyup( function() { fnFilterUnit ( 3 ); } );
                  $("#filter_tahun").change( function() { fnFilterTahun( 2 ); } );
                          
          });
          
});
        </script>        
@stop

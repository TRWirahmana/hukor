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
              
                  // notifikasi status 
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

@else
      <h2>Layanan Ketatalaksanaan</h2>
      <div class="stripe-accent"></div>
      <legend>Informasi dan Status</legend>
@endif


                <br />
                  <table id="tbl-pelembagaan">  
                      <thead>
                      <tr>
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

@if($user->role_id == 3 )
@section('scripts')
@parent
        <script type="text/javascript">

        jQuery(function($){        

/*        function fnFilterTahun (i)
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
*/
        var oTable;
        $(document).ready(function(){
               oTable = $("#tbl-pelembagaan").dataTable({
                        sDom: 'T<"clear">lfrtip',
                        oTableTools: {
                              "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
                        },
                        aButtons: ["copy", "print", {
                               sExtends: "collection",
                               sButtonText: "Save <span class=\"caret\" />",
                               aButtons: ["csv", "xls", "pdf"]
                          }],

                        iDisplayLength: 5,
                        bServerSide: true,
                        sAjaxSource: document.location.href,
                        aoColumns: [
                            {
                              mData: "id",
                              sClass: 'center-ac',
                              sWidth: '9%'
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
                                 mRender: function(id) {
                                           return "<a href='pelembagaan/"+id+"/edit' title='Detail'><i class='icon-edit'></i></a>"
                                                + "&nbsp;<a class='btn_delete' title='Hapus' href='pelembagaan/"+id+"'>"
                                                + "<i class='icon-trash'></i></a>";       
                                    }
 
                                 
                            }
                        ]
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

//                  $("#filter_unit").keyup( function() { fnFilterUnit ( 2 ); } );
//                  $("#filter_tahun").change( function() { fnFilterTahun( 1 ); } );
            });
});
        </script>        
@stop

@else
@section('scripts')
@parent
        <script type="text/javascript">

        jQuery(function($){        

/*        function fnFilterTahun (i)
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
*/
        var oTable;
        $(document).ready(function(){
               oTable = $("#tbl-pelembagaan").dataTable({
                        sDom: 'T<"clear">lfrtip',
                        oTableTools: {
                              "sSwfPath": "/swf/copy_csv_xls_pdf.swf"
                        },
                        aButtons: ["copy", "print", {
                               sExtends: "collection",
                               sButtonText: "Save <span class=\"caret\" />",
                               aButtons: ["csv", "xls", "pdf"]
                          }],

                        iDisplayLength: 5,
                        bServerSide: true,
                        sAjaxSource: document.location.href,
                        aoColumns: [
                            {
                              mData: "id",
                              sClass: 'center-ac',
                              sWidth: '9%'
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
                                mData: "lampiran",
                                sClass: 'center-ac',
                                 mRender: function(id) {
                                           return "<a href='pelembagaan/"+id+"/edit' title='Detail'>" + lampiran + " </a>"
//                                           return  "<a href='"+location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/" + "assets/uploads/"+lampiran+"' >Unduh</a>"
                                               ;       
                                    }
 
                                 
                            }
                        ]
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

//                  $("#filter_unit").keyup( function() { fnFilterUnit ( 2 ); } );
//                  $("#filter_tahun").change( function() { fnFilterTahun( 1 ); } );
            });
});
        </script>        
@stop
@endif
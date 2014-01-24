@section('content')
<H2>PELEMBAGAAN</H2>
<div class='stripe-accent'></div>

    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary" href="{{ URL::to('pelembagaan/usulan'); }}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>

@include('flash')

<table>
       <tr>
		<td align="left">Unit Kerja</td>
                <td><input type="text" name="filter_unit" id="filter_unit"></td>
       </tr> 
       <tr>
		<td align="left">Tahun</td>
                <td><input type="text" name="filter_tahun" id="filter_tahun"></td>
       </tr>            
</table>
 

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
    
    @section('scripts')
        @parent
        <script type="text/javascript">
        
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
              $("#tbl-pelembagaan").dataTable({
         //               iDisplayLength: 5,
                        bServerSide: true,
                        sAjaxSource: document.location.href,
                        aoColumns: [
                            {mData: "id"},
                            {mData: "tanggal_usulan"},
                            {mData: "unit_kerja"},
                            {mData: "jabatan"},
                            {mData: "perihal"},
                            {mData: "status"},
                            {     // fifth column (Edit link)
                                "sName": "id",
                                "bSearchable": false,
                                "bSortable": false,
                                "fnRender": function (oObj)                              
                                {
                                    // oObj.aData[0] returns the RoleId
                                    return "<a href='/pelembagaan/edit?id=" 
                                        + oObj.aData[0] + "'>Edit</a>";
                                }
                            }
                                
                            } 
                            }
                        ]
                  });                             
                    $("#filter_unit").keyup( function() { fnFilterUnit ( 2 ); } );
                    $("#filter_tahun").keyup( function() { fnFilterTahun( 1 ); } );
            });
    
        </script>        
@stop
@stop
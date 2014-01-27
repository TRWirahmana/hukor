@section('content')
<H2>PELEMBAGAAN</H2>
<div class='stripe-accent'></div>

    <legend>Bantuan Hukum
        <a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('pelembagaan/create'); }}">
            <i class="icon-plus"></i>&nbsp; Tambah Baru</a>
    </legend>

@include('flash')

<form class="form-inline">
  <fieldset>
    <label for="filter_unit"> Unit Kerja </label>
               <input type="text" name="filter_unit" id="filter_unit"> 
       <label for="filter_tahun"> Tahun </label>
         {{  Form::select('filter_tahun', $listTgl, null, array ('id' => 'filter_tahun')) }}         
    </fieldset>
</form>

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

        var oTable;
        $(document).ready(function(){
               oTable = $("#tbl-pelembagaan").dataTable({
                        iDisplayLength: 5,
                        bServerSide: true,
                        sAjaxSource: document.location.href,
                        aoColumns: [
                            {mData: "id"},
                            {mData: "tgl_usulan"},
                            {mData: "unit_kerja"},
                            {mData: "jabatan"},
                            {mData: "perihal"},
                            {mData: "status"},
                            {
                                mData: "id",
                                 mRender: function(id) {
                                    return "<a href='"+baseUrl+"/pelembagaan/"+id+"/edit' title='Ubah'><i class='icon-edit'></i></a>"
                                        + "&nbsp;<a class='btn_delete' title='Hapus' href='"+baseUrl+"/pelembagaan/"+id+"'>"
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

                  $("#filter_unit").keyup( function() { fnFilterUnit ( 2 ); } );

                  $("#filter_tahun").change( function() { fnFilterTahun( 1 ); } );
            });
        </script>        
@stop
@stop
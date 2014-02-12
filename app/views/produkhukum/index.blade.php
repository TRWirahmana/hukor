@section('content')
      <h2>Produk Hukum</h2>
      <div class="stripe-accent"></div>
      <legend>Peraturan Perundang-Undangan</legend>

      <form id="form-filter" class="form form-horizontal" action="{{URL::route('print_table_pelembagaan_user')}}">
	 	<fieldset>
          <legend class="f_legend">Filter</legend>
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
                                    <label for="select-status" class="control-label">Status</label>
                                    <div class="controls">
                                        <select id="select-status" name="status">
                                            <option value="">Semua Status</option>
                                            <option value="0">Belum diproses</option>
                                            <option value="1">Diproses</option>
                                            <option value="2">Dikirim Ke bagian PerUU</option>
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

                <br />
                  <table id="tbl-produkhukum">  
                      <thead>
                      <tr>
                          <th>No</th>
                          <th>Tgl Usulan</th>
                          <th>Unit Kerja</th>
                          <th> - </th>
                      </tr>
                      </thead>
                      <tbody></tbody>

                  </table>

@stop

@section('scripts')
@parent
   <script type="text/javascript">
 //   jQuery(function($){        

/*        $("#filter-tahun").datepicker({
            dateFormat: "dd/mm/yy",
            onClose: function( selectedDate ) {
                 $("#last-date").datepicker( "option", "minDate", selectedDate );
            }
        });
  */        
            $dataTable = $("#tbl-produkhukum").dataTable({
                bServerSide: true,
                bFilter: false,
                bLengthChange: false,
                bProcessing: true,
                bPaginate: true,
                sAjaxSource: "{{ URL::to('produkhukum/getData') }}"
                aoColumns: [
                  {mData: "nomor"}
                  {mData: "nomor"}
                  {mData: "nomor"}
                  {mData: "nomor"}

                ],



        
            });

</script>        
@stop

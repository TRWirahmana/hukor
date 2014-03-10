@section('admin')

<div class="rightpanel">
    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Informasi</a> <span class="separator"></span></li>
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
    {{ Form::open($form_opts) }}
     {{ Form::hidden('id', $id) }}

        <div class="row-fluid">
            <div class="span6">
                <fieldset>
                      <div class="nav nav-tabs">
                        <h4>Informasi Pengusul</h4>
                      </div>
                    <div class="control-group">     
                        {{ Form::label('tgl_usulan', 'Tanggal Usulan', array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->tgl_usulan }}"></div>
                    </div>
                    
                    <div class="control-group">
                        {{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $penanggungJawab->nip }}"></div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $penanggungJawab->unit_kerja }}"></div>
                    </div>      

                    <div class="control-group">
                        {{ Form::label('nama_pemohon', "Nama", array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $penanggungJawab->nama }}"></div>
                    </div>  

                    <div class="control-group">
                        {{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
                        <div class="controls"> <textarea  rows="3" disabled> {{ $penanggungJawab->alamat_kantor }} </textarea></div>
                    </div>  

                    <div class="control-group">
                        {{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $penanggungJawab->telp_kantor }}"></div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('hp', 'Handphone', array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $penanggungJawab->hp }}"></div>
                    </div>


                    <div class="control-group">
                        {{ Form::label('pos_el', 'Email', array('class' => 'control-label'))}}
                        <div class="controls"> <input type="text" disabled="" value="{{ $penanggungJawab->email }}"></div>
                    </div>  
                </fieldset>
    
                <br />
                <fieldset>
                      <div class="nav nav-tabs">
                        <h4>Informasi Usulan</h4>
                      </div>
                    <div class="control-group">
                    {{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
                        <div class="controls"> <input type="text" disabled="" value="{{$pelembagaan->perihal }}"></div>
                    </div>

                    <div class="control-group">
                    {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
                        <div class="controls">
			<ul style="list-style:none">
			@foreach(unserialize($pelembagaan->lampiran) as $index => $lampiran )
			<li><a href="{{ URL::route('pelembagaan.download', array('id' => $pelembagaan->id, 'index' => $index)) }}">{{ explode('/',$lampiran)[2] }}</a> </li>
			@endforeach</ul>
				
			
                         <!--   <a href= {{ URL::asset('assets/uploads/pelembagaan/' . $pelembagaan->lampiran ); }} > {{ $pelembagaan->lampiran}} </a>  --> 
                    </div>
                    </div>
                </fieldset>
            </div>

            <div class="span6">
                <fieldset>
                      <div class="nav nav-tabs">
                        <h4>Update Status</h4>
                      </div>
                    <div class="control-group">
                    {{ Form::label("status", "Status", array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ Form::select('status', array('' => 'Pilih Status', '1' => 'Diproses', '2' => 'Kirim Ke Bagian Peraturan PerUU' )); }} </div>
                    </div>
                
                    <div class="control-group">
                    {{ Form::label('catatan', "Keterangan", array('class' => 'control-label')) }}
                        <div class="controls">{{ Form::textarea('catatan', null, array('placeholder' => "Masukkan Keterangan...")) }}</div>
                    </div>

                    <div class="control-group">
                    {{ Form::label("ket_lampiran", "Ket. Lampiran", array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ Form::text("keterangan", null, array('placeholder' => "Masukkan Keterangan Lampiran...")) }}</div>
                    </div>

                    <div class="control-group">
                    {{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ Form::file('lampiran[]', array('multiple' => true)) }}</div>
                    </div>

                    <div class="control-group">
                    {{ Form::label('status_terakhir', "Status Terakhir", array('class' => 'control-label')) }}
                        <div class="controls">
                
                            {{ Form::text("status_terakhir", $pelembagaan->getStatus($pelembagaan->status) ) }}</div>
                        </div>
                    <p>( <a href="#">klik disini untuk merubah informasi registrasi</a> )</p>

                    <div class="form-actions">
                        {{ Form::submit('Kirim', array('id' => 'kirim_btn', 'class' => 'btn btn-primary', 'style'=>'float: left')) }}
                         <input class='btn btn-primary' style = 'float: left; margin: 0 0 0 8px;' Type="button" value="Batal" onClick="history.go(-1);return true;">
                    </div>
                </fieldset>
            </div>
 </div>



<br />

<div class="row-fluid">
    <table id="tbl-log_pelembagaan">  
        <thead>
        <tr role="row">
            <th>Tgl Proses</th>
            <th>Status</th>
            <th>Catatan</th>
            <th>Lampiran</th>
            <th> Ket </th>
            <th> - </th>
        </tr>        </thead>
        <tbody></tbody>

    </table>

</div> {{ Form::close() }}

                <!-- END OF MAIN CONTENT -->

                <div class="footer">
                <div class="footer-left">
                    <span>&copy;2014 Direktorat Jenderal Kebudayaan Republik Indonesia</span>
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
    <script type="text/javascript">
    jQuery(function($){ 
    var oTable;

    $(document).ready(function(){
    oTable = $("#tbl-log_pelembagaan").dataTable({
             iDisplayLength: 5,
                bServerSide: true,
                    sAjaxSource: document.location.href,
                    aoColumns: [
                    {
                        mData: "tgl_proses",
                        sClass: 'center-ac',
                       sWidth: '20%'
                    },
                    {
                        mData: "status",
                        sWidth: '20%',
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
                        mData: "catatan",
                        sClass: 'center-ac',                              
                        sWidth: '35%',
                    },
                    {

                    //  URL::asset('assets/uploads/

                        mData: "lampiran",
                        sClass: 'center-ac',                              
                        sWidth: '14%',
                        mRender: function(data, type, full) {
                            // var downloadUrl = baseUrl + '/assets/uploads/pelembagaan/' + data;
                            // return "<a href=" + downloadUrl + "> Unduh </>";
                             return '<a href="'+baseUrl+'/admin/pelembagaan/log/download/'+full.id+'">Unduh</a>';
//                            return  "<a href='"+location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/" + "assets/uploads/pelembagaan/"+lampiran+"' >Unduh</a>"
                        }
                    },
                    {
                        mData: "keterangan",
                        sClass: 'center-ac',                              
                        sWidth: '14%'
                    },
                    {
                        mData: "id",
                        sClass: 'center-ac',                              
                        sWidth: '10%',
                        mRender: function(data, type, full) {
                           var deleteUrl = baseUrl + '/admin/pelembagaan/deletelog/' + data;

                            return "<a class='btn_delete' title='Hapus' href='" + deleteUrl + "'>"
                                                + "<i class='icon-trash'></i></a>";
                        }        
                    }
                    ]
        });
    });

        $("#tbl-log_pelembagaan").on('click', '.btn_delete', function(e){
            if (confirm('Apakah anda yakin ?')) {
                $.ajax({
                url: $(this).attr('href'),
                     type: 'GET',
                     success: function(response) {
                            oTable.fnReloadAjax();
                        }
                });
             }
            e.preventDefault();
            return false;
        });
/*
                  $("#tbl-pelembagaan").on('click', '.btn_delete', function(e){
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
 */


         $("#kirim_btn").click(function(e){
             oTable.fnReloadAjax();
         });
    
    });
    </script>

@stop

@section('scripts')
@parent

<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>
<script src="{{asset('assets/js/pelembagaan.js')}}"></script>

<script type="text/javascript">
    Pelembagaan.Update();
</script>

@stop

@section('admin')

<h2>PERLEMBAGAAN</h2>
<div class="stripe-accent"></div>

@include('flash')
	{{ Form::open($form_opts) }}

		<div class="row-fluid">
		
			<div class="span12">
				<fieldset>
		              <div class="nav nav-tabs">
						<h4>Informasi Pengusul</h4>
		              </div>
					<div class="control-group">		
						{{ Form::label('tgl_usulan', 'Tanggal Usulan', array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->tgl_usulan }}"></div>
					</div>
					
					<div class="control-group">
						{{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->pengguna->unit_kerja }}"></div>
					</div>		

					<div class="control-group">
						{{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->pengguna->nip }}"></div>
					</div>

					<div class="control-group">
						{{ Form::label('nama_pemohon', "Nama", array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->pengguna->nama_lengkap }}"></div>
					</div>	


					<div class="control-group">
						{{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->pengguna->alamat_kantor }}"></div>
					</div>	

					<div class="control-group">
						{{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->pengguna->tlp_kantor }}"></div>					
					</div>	

					<div class="control-group">
						{{ Form::label('pos_el', 'Pos_el', array('class' => 'control-label'))}}
						<div class="controls"> <input type="text" disabled="" value="{{ $pelembagaan->pengguna->email }}"></div>					
					</div>	
				</fieldset>
	
				<br />
				<fieldset>
		              <div class="nav nav-tabs">
						<h4>Informasi Perihal & Lampiran</h4>
		              </div>
					<div class="control-group">
					{{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
						<div class="controls"> <input type="text" disabled="" value="{{$pelembagaan->perihal }}"></div>					
					</div>

					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">

							<a href= {{ URL::asset('assets/uploads/' . $pelembagaan->lampiran ); }} > {{ $pelembagaan->lampiran}} </a>
					</div>
				</fieldset>
			</div>

			<div class="span12">
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
					{{ Form::label('catatan', "Catatan", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::textarea('catatan') }}</div>
					</div>

					<div class="control-group">
					{{ Form::label("ket_lampiran", "Ket. Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::text("keterangan") }}</div>
					</div>

					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">
							{{ Form::file('lampiran') }}</div>
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
        </tr>        </thead>
        <tbody></tbody>

    </table>

@section('scripts')
	@parent
	<script type="text/javascript">
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

                    //	URL::asset('assets/uploads/

                  		mData: "lampiran",
                        sClass: 'center-ac',                              
                        sWidth: '14%',
                        mRender: function(lampiran) {
//                        	return "<a href='"+baseUrl+"/assets/uploads/"+lampiran+"' >Unduh</a>"
                        	return  "<a href='"+location.protocol + "//" + location.hostname + (location.port && ":" + location.port) + "/" + "assets/uploads/"+lampiran+"' >Unduh</a>"
                        }
                    },
                    {
                  		mData: "keterangan",
                        sClass: 'center-ac',                              
                        sWidth: '14%'
                    }
                    ]
		});
	});

	     $("#kirim_btn").click(function(e){
     	 	 oTable.fnReloadAjax();
     	 });
	

	</script>

@stop

</div>
	{{ Form::close() }}

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
@stop
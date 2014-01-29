@section('content')

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
						<div class="controls">
								{{ Form::text('tgl_usulan', $pelembagaan->tgl_usulan ) }}
						</div>
					</div>
					
					<div class="control-group">
						{{ Form::label('unit_kerja', 'Unit Kerja', array('class' => 'control-label'))}}
						<div class="controls"> 
						    @if(!is_object($pelembagaan->pengguna))
								{{ Form::text('unit_kerja' ) }}
							@else
								{{ Form::text('unit_kerja', $pelembagaan->pengguna->unit_kerja ) }}
							@endif
						</div>
					</div>		

					<div class="control-group">	
						{{ Form::label('jabatan', 'Jabatan', array('class' => 'control-label'))}}
						<div class="controls">
						    @if(!is_object($pelembagaan->pengguna))
								{{ Form::text('jabatan') }}
							@else
								{{ Form::text('jabatan', $pelembagaan->pengguna->jabatan) }}
	                    	@endif
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('nip', "NIP", array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('nip') }}
							@else
								{{ Form::text('nip', $pelembagaan->pengguna->nip) }}
							@endif
						</div>
					</div>

					<div class="control-group">
						{{ Form::label('nama_pemohon', "Nama", array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('nama_pemohon') }}
							@else
								{{ Form::text('nama_pemohon', $pelembagaan->pengguna->nama_lengkap) }}
							@endif
						</div>
					</div>	


					<div class="control-group">
						{{ Form::label('alamat_kantor', 'Alamat Kantor', array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::textarea('alamat_kantor')}}
							@else
								{{ Form::textarea('alamat_kantor', $pelembagaan->pengguna->alamat_kantor) }}
							@endif
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('telp_kantor', 'Telepon Kantor', array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('telp_kantor')}}
							@else
								{{ Form::text('telp_kantor', $pelembagaan->pengguna->tlp_kantor) }}
							@endif
						</div>
					</div>	

					<div class="control-group">
						{{ Form::label('pos_el', 'Pos_el', array('class' => 'control-label'))}}
						<div class="controls">
							@if(!is_object($pelembagaan->pengguna))
								{{ Form::text('pos_el') }}
							@else
								{{ Form::text('pos_el', $pelembagaan->pengguna->email) }}
							@endif							
						</div>
					</div>	
				</fieldset>
	
				<br />
				<fieldset>
		              <div class="nav nav-tabs">
						<h4>Informasi Perihal & Lampiran</h4>
		              </div>
					<div class="control-group">
					{{ Form::label("perihal", "Perihal", array('class' => 'control-label')) }}
						<div class="controls">{{ Form::text('perihal', $pelembagaan->perihal) }}</div>
					</div>

					<div class="control-group">
					{{ Form::label('lampiran', "Lampiran", array('class' => 'control-label')) }}
						<div class="controls">

							<a href= {{ URL::asset('assets/uploads/' . $pelembagaan->lampiran ); }} > Unduh </a>
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
						<?php $results = DB::table('log_pelembagaan')->where('pelembagaan_id','=', $id)->orderBy('tgl_proses', 'desc')->take(1)->get(); ?>
							<?php //var_dump($results);   ?>
							<?php //echo $results[0]->id;   ?>
							<?php 
								$report = '';
								if($results[0]->status === '1'){
									$report = 'Diproses';
								}else if($results[0]->status === '2'){
									$report = 'Di Proses Ke Bagian PerUU';
								}
							?>
							{{ Form::text("status_terakhir", $report ) }}</div>
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
                        	return "<a href='"+baseUrl+"/assets/uploads/"+lampiran+"' >Unduh</a>"
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

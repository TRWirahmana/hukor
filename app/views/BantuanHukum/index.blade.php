@section('content')


<h2>BANTUAN HUKUM</h2>
<div class="stripe-accent"></div>
    <legend>Bantuan Hukum
    </legend>

    @include('flash')
<div class="row-fluid">
    <div class="span24">
        <div class="control-group span8">
            <label for="status-pemohon" class="control-label span8">Status Pemohon</label>
            <div class="controls">
                <select id="status-pemohon">
                    <option value="0">Tampilkan Semua</option>
                    <option value="1">Tergugat</option>
                    <option value="2">Penggugat</option>
                    <option value="3">Interfent</option>
                    <option value="4">Saksi</option>
                    <option value="5">Pemohon</option>
                </select>
            </div>
        </div>

        <div class="control-group span8">
            <label for="jenis-perkara" class="control-label span8">Jenis Perkara</label>
            <div class="controls">
                <select id="jenis-perkara">
                    <option value="0">Tampilkan Semua</option>
                    <option value="1">Tata Usaha Negara</option>
                    <option value="2">Perdata</option>
                    <option value="3">Pidana</option>
                    <option value="4">Uji Materil MK</option>
                    <option value="5">Uji Materil MA</option>
                </select>
            </div>
        </div>

        <div class="control-group span8">
            <label for="advokasi" class="control-label span8">Advokasi</label>
            <div class="controls">
                <select id="advokasi">
                    <option value="0">Tampilkan Semua</option>
                    <option value="1">Bankum I</option>
                    <option value="2">Bankum II</option>
                    <option value="3">Bankum III</option>
                </select>
            </div>
        </div>
    </div>
</div>

<br>
    {{ Form::open(array('action' => 'BantuanHukumController@convertpdf', 'method' => 'post',
    'id' => 'pdf-form', 'autocomplete' => 'off', 'class' => 'front-form form-horizontal')) }}

        <div class="control-group span24">
            {{ Form::label('start-date', 'Tanggal Awal', array('class' => 'control-label')) }}
            <div class="controls span5">
                {{ Form::text('start_date', '', array('id' => 'start-date', 'class' => 'datepicker', 'style' => 'margin-left:-100px;')) }}
            </div>
        </div>

        <div class="control-group span24">
            {{ Form::label('end-date', 'Tanggal Akhir', array('class' => 'control-label')) }}
            <div class="controls span5">
                {{ Form::text('end_date', '', array('id' => 'end-date', 'class' => 'datepicker', 'style' => 'margin-left:-100px;')) }}
            </div>
        </div>

    <div class="control-group span24">
        <button class="btn btn-hukor" type="submit">Simpan</button>
    </div>


    {{ Form::close() }}
    
    <table id="basictable" class="dataTable">
        <thead>
        <tr>
            <th>Nama Pemohon</th>
            <th>Jenis Perkara</th>
            <th>Status Pemohon</th>
            <th>Status Perkara</th>
            <th>Advokasi</th>
            <th>Advokator</th>
            <th></th>
        </tr>
        </thead>
    </table>

    @section('scripts')
        @parent
        <script type="text/javascript">
            $( ".datepicker" ).datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            }).val();

            var tbl_data = $("#basictable").dataTable({
                bFilter: true,
                bInfo: false,
                bSort: false,
                bPaginate: true,
                bLengthChange: false,
                bServerSide: true,
                bProcessing: true,
//                sAjaxSource: baseUrl + "/lkpm/data",
                sAjaxSource: '<?php echo URL::to("tabelbahu"); ?>',
                aoColumns: [
                    {mData: "pengguna.nama_lengkap"},
                    {
                        mData: "jenis_perkara",
                        sClass: "center",
                        mRender: function(id){
                            var jenis_perkara;
                            switch (id){
                                case 1:
                                    jenis_perkara = 'Tata Usaha Negara';
                                    break;
                                case 2:
                                    jenis_perkara = 'Perdata';
                                    break;
                                case 3:
                                    jenis_perkara = 'Pidana';
                                    break;
                                case 4:
                                    jenis_perkara = 'Uji Materil MK';
                                    break;
                                case 5:
                                    jenis_perkara = 'Uji Materil MA';
                                    break;
                            }

                            return jenis_perkara;
                        }
                    },
                    {
                        mData: "status_pemohon",
                        mRender: function(id){
                            var status_pemohon;
                            switch (id){
                                case 1:
                                    status_pemohon = 'Tergugat';
                                    break;
                                case 2:
                                    status_pemohon = 'Penggugat';
                                    break;
                                case 3:
                                    status_pemohon = 'Interfent';
                                    break;
                                case 4:
                                    status_pemohon = 'Saksi';
                                    break;
                                case 5:
                                    status_pemohon = 'Pemohon';
                                    break;
                            }

                            return status_pemohon;
                        }
                    },
                    {mData: "status_perkara"},
                    {
                        mData: "advokasi",
                        mRender: function(id){
                            var advokasi;
                            switch (id){
                                case 1:
                                    advokasi = "Bankum I";
                                    break;
                                case 2:
                                    advokasi = "Bankum II";
                                    break;
                                case 3:
                                    advokasi = "Bankum III";
                                    break;
                                default:
                                    advokasi = "";
                                    break;
                            }

                            return advokasi;
                        }
                    },
                    {mData: "advokator"},
                    {
                        mData: "id",
                        mRender: function(data, type, full){
                            var detailUrl = baseUrl + '/detail_banhuk?id=' + data;
                            var deleteUrl = baseUrl + '/delete_banhuk?id=' + data;
                            var downloadUrl = baseUrl + '/download_banhuk?id=' + data;

                            return '<a href="' + downloadUrl + '" title="Download"><i class="rulycon-arrow-down "></i></a> &nbsp;' +
                                '<a href="' + detailUrl + '" title="Detail"><i class="rulycon-file"></i></a> &nbsp;' +
                                '<a href="' + deleteUrl + '" title="Delete" class="btn_delete"><i class="rulycon-remove-2"></i></a>';
                        }
                    }
                ],
                fnServerParams: function(aoData) {
                    aoData.push({name: "jenis_perkara", value: $("#jenis-perkara").val()});
                    aoData.push({name: "status_pemohon", value: $("#status-pemohon").val()});
                    aoData.push({name: "advokasi", value: $("#advokasi").val()});
                },
                fnServerData: function(sSource, aoData, fnCallback) {
                    $.getJSON(sSource, aoData, function(json) {
                        $("#text-tahun").text(json.tahun);
                        fnCallback(json);
                    });
                }
            });

            $("#jenis-perkara").change(function(){
                tbl_data.fnReloadAjax();
            });

            $("#status-pemohon").change(function(){
                tbl_data.fnReloadAjax();
            });

            $("#advokasi").change(function(){
                tbl_data.fnReloadAjax();
            });

            $("#print").click(function(){

            });
        </script>
    @stop
@stop
@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Ketatalaksanaan</a> <span class="separator"></span></li>
        <li>Tambah Ketatalaksanaan</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-notebook"></span></div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>{{ $title }}</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <div class="row-fluid">
                {{ Form::open($form_opts) }}

                <div class="span8 offset2">
                    <fieldset>
                        <p class="text-info">{{$detail}}</p>

                        <div class="control-group">
                            {{ Form::label('produk', 'Produk', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::select('produk', array(
                                '0' => '- Pilih Kategori -',
                                '1' => 'Uraian Jabatan',
                                '2' => 'Daftar Jabatan',
                                '3' => 'Kamus Jabatan',
                                '4' => 'Indeks Kepuasan Masyarakat',
                                '5' => 'Prosedur Operasional Standard',
                                '6' => 'Standard Layanan',
                                ), $data->produk) }}
                            </div>
                        </div>

                        <div class="control-group">
                            {{ Form::label('unit', 'Unit', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::text('unit', $data->unit, array('id' => 'unit')) }}
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('password')?'error':''}}">
                            {{ Form::label('tanggal', 'Tanggal Pengesahan', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{Form::text('tanggal', $data->tanggal, array('id'=>'tanggal', 'class'=>'datepicker'))}}
                            </div>
                        </div>

                        <div class="control-group">
                            {{ Form::label('file_dokumen', 'File Dokumen', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::file('file_dokumen', array('id'=>'file_dokumen')) }}
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
                            </div>
                        </div>

                    </fieldset>

                </div>
                {{ Form::close() }}
            </div>


            <div class="footer">
                <div class="footer-left">
                    <span>&copy;2014 Biro Hukum dan Organisasi</span>
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
    var $ = jQuery.noConflict();
    $(function () {
        $(".datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            yearRange: "1970:2020",
            changeYear: true
        }).val();
    });
</script>

<script>
    jQuery("#app_ketatalaksanaan > a").addClass("sub-menu-active");
    jQuery("#app").css({
        "display": "block",
        "visibility": "visible"
    });
</script>
@stop

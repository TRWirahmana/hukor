@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Dokumentasi</a>  <span class="separator"></span></li>
        <li>Tambah Dokumen</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Detail Dokumen</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            {{ Form::open($form_opts) }}

            <div>
                <fieldset>
                    <legend class="f_legend">{{$title}}</legend>
                    <p class="text-info">{{$detail}}</p>

                    <div class="control-group">
                        {{ Form::label('', 'Nama Pemohon', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $data->nomor }}
                        </div>
                    </div>

                    <?php
                    $kategori = "";
                    switch($data->kategori)
                    {
                        case 1:
                            $kategori = "Keputusan Menteri";
                            break;
                        case 2:
                            $kategori = "Peraturan Menteri";
                            break;
                        case 3:
                            $kategori = "Peraturan Bersama";
                            break;
                        case 4:
                            $kategori = "Keputusan Bersama";
                            break;
                        case 5:
                            $kategori = "Instruksi Menteri";
                            break;
                        case 6:
                            $kategori = "Surat Edaran";
                            break;
                    }
                    ?>
                    <div class="control-group">
                        {{ Form::label('', 'Kategori', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $kategori }}
                        </div>
                    </div>

                    <?php
                    $masalah = "";
                    switch($data->masalah)
                    {
                        case 1:
                            $masalah = "Kepegawaian";
                            break;
                        case 2:
                            $masalah = "Keuangan";
                            break;
                        case 3:
                            $masalah = "Organisasi";
                            break;
                        case 4:
                            $masalah = "Umum";
                            break;
                        case 5:
                            $masalah = "Perlengkapan";
                            break;
                        case 6:
                            $masalah = "Lainnya";
                            break;
                    }
                    ?>
                    <div class="control-group">
                        {{ Form::label('', 'Masalah', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $masalah }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('', 'Tentang', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $data->perihal }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('', 'Deskripsi', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $data->deskripsi }}
                        </div>
                    </div>

                    <div class="control-group {{$errors->has('password')?'error':''}}">
                        {{ Form::label('', 'Tanggal Pengesahan', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $data->tgl_pengesahan }}
                        </div>
                    </div>

                    <div class="control-group">
                        {{ Form::label('', 'File Dokumen', array('class' => 'control-label')) }}
                        <div class="controls">
                            {{ $data->file_dokumen }}
                        </div>
                    </div>

                </fieldset>

                <div class="form-actions">
                    <div class="controls">
                        <a href="{{URL::previous()}}">{{ Form::button('Kembali', array('class' => 'btn btn-primary')) }}</a>
                    </div>
                </div>

            </div>
            {{ Form::close() }}

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

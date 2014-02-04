@section('admin')
@include('flash')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Informasi</a> <span class="separator"></span></li>
        @if($id === 2)
           <li>Layanan Sistem dan Prosedur Kerja</li>
        @elseif($id === 3)
           <li>Sistem Manajemen Mutu</li>        
        @elseif ($id === 4)
           <li>Analisis Jabatan</li>        
        @elseif($id === 5)
           <li>Perhitungan Beban Kerja</li>        
        @elseif($id === 6)
           <li>Tata Nilai & Budaya Kerja Organisasi</li>        
        @elseif($id === 7)
           <li>Pelayanan Publik</li>        
        @elseif($id === 8)
           <li>Tata Naskah Dinas</li>        
        @else        
           <li>Layanan Ketatalaksanaan</li>        
        @endif
    </ul>

    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->
           <h1>Layanan Ketatalaksanaan</h1>        
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
<!--            {{-- form informasi layanan kelembagaan --}}-->
            {{ Form::open($form_opts) }}

            <div class="row-fluid">
                <!--            left content-->
                <div class="span24">
                    <div class="nav nav-tabs">
                        @if($id === 2)
                           <h4>Layanan Sistem dan Prosedur Kerja</h4>
                        @elseif($id === 3)
                           <h4>Sistem Manajemen Mutu</h4>        
                        @elseif ($id === 4)
                           <h4>Analisis Jabatan</h4>        
                        @elseif($id === 5)
                           <h4>Perhitungan Beban Kerja</h4>        
                        @elseif($id === 6)
                           <h4>Tata Nilai & Budaya Kerja Organisasi</h4>        
                        @elseif($id === 7)
                           <h4>Pelayanan Publik</h4>        
                        @elseif($id === 8)
                           <h4>Tata Naskah Dinas</h4>        
                        @else        
                           <h4>Layanan Ketatalaksanaan</h4>        
                        @endif
                    </div>

            {{Form::hidden('id', $id, '')}}

                    <div class="span24">
                        <div class="control-group {{$errors->has('judul_berita')?'error':''}}">
                            {{ Form::label('judul_berita', 'Judul Informasi', array('class' => 'control-label')) }}
                            <div class="controls">
                                @if(!is_null($info))
                                {{ Form::text('layananketatalaksanaan[judul_berita]', $info->judul_berita,
                                array('placeholder' => 'ketikkan judul informasi di sini...'))
                                }}
                                @else
                                {{ Form::text('layananketatalaksanaan[judul_berita]', '',
                                array('placeholder' => 'ketikkan judul informasi di sini...')) }}
                                @endif

                                @foreach($errors->get('judul_berita') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('berita')?'error':''}}">
                            {{ Form::label('berita', 'Informasi / Berita', array('class' => 'control-label')) }}
                            <div class="controls">
                                @if(!is_null($info))
                                {{ Form::textarea('layananketatalaksanaan[berita]', $info->berita,
                                array('placeholder' => 'ketikkan Informasi atau berita anda di sini...', 'id' => 'berita'))
                                }}
                                @else
                                {{ Form::textarea('layananketatalaksanaan[berita]', '',
                                array('placeholder' => 'ketikkan Informasi atau berita anda di sini...',  'id' => 'berita')) }}
                                @endif

                                @foreach($errors->get('berita') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('penanggung_jawab')?'error':''}}">
                            {{ Form::label('penanggung_jawab', 'Unit Penanggung Jawab', array('class' => 'control-label')) }}
                            <div class="controls">
                                @if(!is_null($info))
                                {{Form::text('layananketatalaksanaan[penanggung_jawab]', $info->penanggung_jawab,
                                array('placeholder' => 'ketikkan unit penanggungjawab di sini...'))
                                }}
                                @else
                                {{ Form::text('layananketatalaksanaan[penanggung_jawab]', '',
                                array('placeholder' => 'ketikkan unit penanggungjawab di sini...')) }}
                                @endif

                                @foreach($errors->get('penanggung_jawab') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('image')?'error':''}}">
                            {{ Form::label('image', 'Gambar', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::file('layananketatalaksanaan[image]')}}

                                @foreach($errors->get('image') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span24 text-center">
                        <button class="btn" type="submit">Submit</button>
                    </div>
                </div>

                {{ Form::close() }}

                <!-- END OF MAIN CONTENT -->

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

@stop


@section('scripts')
@parent
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<script src="{{asset('assets/js/registrasi.js')}}"></script>

<script type="text/javascript">
    tinyMCE.init({
        theme : "modern",
        mode: "exact",
        elements : "berita",
        theme_advanced_toolbar_location : "top",
        theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,"
            + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
            + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2 : "link,unlink,anchor,image,separator,"
            +"undo,redo,cleanup,code,separator,sub,sup,charmap",
        theme_advanced_buttons3 : "",
        height:"350px"
    });

    Registrasi.Form();
</script>
@stop
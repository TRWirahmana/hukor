@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Informasi</a> <span class="separator"></span></li>
        <li>Layanan Kelembagaan</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Informasi Layanan kelembagaan</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
<!--            {{-- form informasi layanan kelembagaan --}}-->
            {{ Form::open(array('action' => array('LayananKelembagaanController@submit'), 'method' => 'post', 'id'=>'layanan-form', 'class' =>'front-form form-horizontal', 'autocomplete' => 'off', 'enctype' => "multipart/form-data" )) }}
            {{Form::hidden('id', $id, '')}}

            <div class="row-fluid">
                <!--            left content-->
                <div class="span24">
                    <div class="nav nav-tabs">
                        <h4>Informasi layanan Kelembagaan</h4>
                    </div>

                    <div class="span24">
                        <div class="control-group {{$errors->has('judul_berita')?'error':''}}">
                            {{ Form::label('judul_berita', 'Judul Informasi', array('class' => 'control-label')) }}
                            <div class="controls">
                                @if(!is_null($info))
                                {{ Form::text('layananlembaga[judul_berita]', $info->judul_berita,
                                array('placeholder' => 'ketikkan judul informasi di sini...'))
                                }}
                                @else
                                {{ Form::text('layananlembaga[judul_berita]', '',
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
                                {{ Form::textarea('layananlembaga[berita]', $info->berita,
                                array('placeholder' => 'ketikkan Informasi atau berita anda di sini...', 'id' => 'berita'))
                                }}
                                @else
                                {{ Form::textarea('layananlembaga[berita]', '',
                                array('placeholder' => 'ketikkan Informasi atau berita anda di sini...', 'id' => 'berita')) }}
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
                                {{Form::text('layananlembaga[penanggung_jawab]', $info->penanggung_jawab,
                                array('placeholder' => 'ketikkan unit penanggungjawab di sini...'))
                                }}
                                @else
                                {{ Form::text('layananlembaga[penanggung_jawab]', '',
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
                                {{ Form::file('layananlembaga[image]')}}

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

<script src="{{asset('assets/js/layanan.js')}}"></script>

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
    Layanan.Form();

</script>
    <style>
        .leftmenu .nav-tabs.nav-stacked > li.dropdown ul {
            display: block !important;
        }
        #produkhukum, #ketatalaksanaan, #bahu, #puu, #diskusi, #callcenter, #app, #manage {
            display: none !important;
        }
        #laykel{
            background: #0866C6;
        }
    </style>
@stop
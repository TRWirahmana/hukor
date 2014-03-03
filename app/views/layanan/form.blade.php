@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="#"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Informasi</a> <span class="separator"></span></li>
        <li>Layanan</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1></h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            <!--            {{-- form informasi layanan kelembagaan --}}-->
            {{ Form::open($form_opts) }}
<!--            {{ Form::open(array('action' => array('LayananController@submit'), 'method' => 'post', 'id'=>'layanan-form', 'class' =>'front-form form-horizontal', 'autocomplete' => 'off', 'enctype' => "multipart/form-data" )) }}-->
            <div class="row-fluid">
                <!--            left content-->
                <div class="span24">
                    <div class="nav nav-tabs">
                        <h4>Informasi layanan</h4>
                    </div>

                    <div class="span24">
                            <div class="control-group">
                                {{ Form::label('menu', 'Pilih Menu', array('class' => 'control-label')) }}
                                <div class="controls">
                                    {{ Form::select('layanan[menu]', $listMenu, $menu->submenu->menu->id , array("id" => "menu")) }}
                                </div>
                            </div>

                            <div class="control-group">
                                {{ Form::label('submenu', 'Pilih Submenu', array('class' => 'control-label')) }}
                                <div class="controls">
                                    @if(!is_null($menu))
                                    {{ Form::select('layanan[submenu]', $listSubmenu, $menu->submenu->id , array("id" => "submenu")) }}
                                    @else

                                    <select name="layanan[submenu]" id="submenu">
                                    </select>
                                    @endif
                                </div>
                            </div>

                        <div class="control-group {{$errors->has('berita')?'error':''}}">
                            {{ Form::label('berita', 'Informasi / Berita', array('class' => 'control-label')) }}
                            <div class="controls">
                                @if(!is_null($menu))
                                {{ Form::textarea('layanan[berita]', $menu->berita,
                                array('placeholder' => 'Masukan Informasi atau berita anda di sini...', 'id' => 'berita'))
                                }}
                                @else
                                {{ Form::textarea('layanan[berita]', '',
                                array('placeholder' => 'Masukan Informasi atau berita anda di sini...', 'id' => 'berita')) }}
                                @endif



                                @foreach($errors->get('berita') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('penanggung_jawab')?'error':''}}">
                            {{ Form::label('penanggung_jawab', 'Unit Penanggung Jawab', array('class' => 'control-label')) }}
                            <div class="controls">
                                @if(!is_null($menu))
                                {{ Form::select('layanan[penanggung_jawab]', $listPJ, $user->pengguna->bagian, array("id" => "PJ")) }}
                                @else
                                {{ Form::select('layanan[penanggung_jawab]', $listPJ, $user->pengguna->bagian, array("id" => "PJ")) }}
                                @endif

                                @foreach($errors->get('penanggung_jawab') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('image')?'error':''}}">
                            {{ Form::label('image', 'Gambar', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::file('layanan[image]')}}

                                @foreach($errors->get('image') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row-fluid">
                    <div class="span24 text-center">
                        {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>

                {{ Form::close() }}

                <!-- END OF MAIN CONTENT -->

                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2014. Admin Template. All Rights Reserved.</span>
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
        jQuery( document ).ready(function() {


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
        });

    </script>
<!--    <style>-->
<!--        .leftmenu .nav-tabs.nav-stacked > li.dropdown ul {-->
<!--            display: block !important;-->
<!--        }-->
<!--        #produkhukum, #ketatalaksanaan, #bahu, #puu, #diskusi, #callcenter, #app, #manage, #info {-->
<!--            display: none !important;-->
<!--        }-->
<!--    </style>-->
    @stop
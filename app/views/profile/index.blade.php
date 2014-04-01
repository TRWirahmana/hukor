@section('admin')
<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Profile</a> <span class="separator"></span></li>
        <li>Kelola Profile</li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon"><span class="rulycon-newspaper"></span></div>
        <div class="pagetitle">
            <h1>Kelola Profile</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            {{ Form::open($form_opts) }}

            <div class="row-fluid">
                <div class="span8 offset2">
                    <fieldset>
                        <p class="text-info">{{$detail}}</p>
<!--                        <legend class="f_legend">{{$title}}</legend>-->

                        <div class="control-group">
                            {{ Form::label('isi', 'Isi', array('class' => 'control-label')); }}
                            <div class="controls">
                                {{ Form::textarea('isi', $data->isi,
                                array('placeholder' => 'Masukan Profile disini...', 'id' => 'misi')) }}
                            </div>
                        </div>

                        <div class="control-group {{$errors->has('gambar')?'error':''}}">
                            {{ Form::label('gambar', 'Gambar', array('class' => 'control-label')) }}
                            <div class="controls">
                                {{ Form::file('gambar')}}

                                @foreach($errors->get('gambar') as $error)
                                <span class="help-block">{{$error}}</span>
                                @endforeach
                            </div>
                        </div>

                        <hr/>

                        <div class="control-group">
                            <div class="controls">
                                {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
                            </div>

                        </div>

                    </fieldset>
                </div>

            </div>
            {{ Form::close() }}

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
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>
<script type="text/javascript">
    tinyMCE.init({
        theme: "modern",
        mode: "exact",
        elements: "visi",
        theme_advanced_toolbar_location: "top",
        theme_advanced_buttons1: "bold,italic,underline,strikethrough,separator,"
            + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
            + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2: "link,unlink,anchor,image,separator,"
            + "undo,redo,cleanup,code,separator,sub,sup,charmap",
        theme_advanced_buttons3: "",
        height: "350px"
    });

    tinyMCE.init({
        theme: "modern",
        mode: "exact",
        elements: "misi",
        theme_advanced_toolbar_location: "top",
        theme_advanced_buttons1: "bold,italic,underline,strikethrough,separator,"
            + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
            + "bullist,numlist,outdent,indent",
        theme_advanced_buttons2: "link,unlink,anchor,image,separator,"
            + "undo,redo,cleanup,code,separator,sub,sup,charmap",
        theme_advanced_buttons3: "",
        height: "350px"
    });

//    Berita.Form();
</script>
@stop
    
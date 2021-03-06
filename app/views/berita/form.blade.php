@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Berita</a> <span class="separator"></span></li>
    <li>Tambah Berita</li>
  </ul>
  @include('adminflash')
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-newspaper"></span></div>
    <div class="pagetitle">
      <h1>Tambah Berita</h1>
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
            <legend class="f_legend">{{$title}}</legend>
            <div class="control-group {{$errors->has('judul')? 'error':''}}">
              {{ Form::label('judul', 'Judul Berita', array('class' => 'control-label')); }}
              <div class="controls">
                @if(!is_object($berita->judul))
                {{ Form::text('judul', $berita->judul, array('placeholder' => 'Isi Judul Berita')) }}
                @else
                {{ Form::text('judul', $berita->judul, array('placeholder' => 'Isi Judul Berita.')) }}
                @endif
              </div>

                @foreach($errors->get('judul') as $error)
                <span class="help-block">{{ $error }}</span>
                @endforeach
            </div>

            <div class="control-group">
              {{Form::label("Kategori", null, array("class" => "control-label"))}}
              <div class="controls">
                {{ Form::select('kategori', $kategori, $berita->kategori->id, array("id" => "kategori_id")) }}
              </div>
            </div>

            <div class="control-group {{$errors->has('berita')? 'error':''}}">
              {{ Form::label('berita', 'Isi Berita', array('class' => 'control-label')) }}
              <div class="controls">
                @if(!is_object($berita->berita))
                {{ Form::textarea('berita', $berita->berita,
                array('placeholder' => 'Isi Berita disini...', 'id' => 'berita'))
                }}
                @else
                {{ Form::textarea('berita', $berita->berita,
                array('placeholder' => 'Isi Berita disini...', 'id' => 'berita'))
                }}
                @endif

                @foreach($errors->get('berita') as $error)
                <span class="help-block">{{ $error }}</span>
                @endforeach
              </div>
            </div>

            <div class="control-group {{$errors->has('gambar')?'error':''}}">
              {{ Form::label('gambar', 'Thumbnail', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::file('gambar')}}

                @foreach($errors->get('gambar') as $error)
                <span class="help-block">{{$error}}</span>
                @endforeach
              </div>
                <p class="span9 offset2" style="color: #616D79;font-size: 11px;">Rekomendasi ukuran gambar: lebar 200 pixel, tinggi 200 pixel</p>
            </div>

            <div class="control-group {{$errors->has('gambar')?'error':''}}">
              {{ Form::label('slider', 'Slider', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::file('slider')}}
                @foreach($errors->get('slider') as $error)
                <span class="help-block">{{$error}}</span>
                @endforeach
              </div>
                <p class="span9 offset2" style="color: #616D79;font-size: 11px;">Rekomendasi ukuran gambar: lebar 656 pixel, tinggi 492 pixel</p>
            </div>

            <hr/>

            <div class="control-group">
              <div class="controls">
                  <input class="btn btn-primary" type="button" value="Batal" onclick="history.go(-1);return true;" name="batal">
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

<script src="{{asset('assets/js/berita.js')}}"></script>
<script type="text/javascript">
  tinyMCE.init({
    theme: "modern",
    mode: "exact",
    elements: "berita",
    theme_advanced_toolbar_location: "top",
    theme_advanced_buttons1: "bold,italic,underline,strikethrough,separator,"
      + "justifyleft,justifycenter,justifyright,justifyfull,formatselect,"
      + "bullist,numlist,outdent,indent",
    theme_advanced_buttons2: "link,unlink,anchor,image,separator,"
      + "undo,redo,cleanup,code,separator,sub,sup,charmap",
    theme_advanced_buttons3: "",
    height: "350px"
  });

  jQuery("#menu_berita > li:first-child > a").addClass("sub-menu-active");
  jQuery("#menu_berita").css({
      "display": "block",
      "visibility": "visible"
  });

  Berita.Form();
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Tambah Berita"
  });
</script>
@stop
    
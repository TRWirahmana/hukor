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

      <div>
        <fieldset>
          <p class="text-info">{{$detail}}</p>
          <legend class="f_legend">{{$title}}</legend>
          <div class="control-group">
            {{ Form::label('judul', 'Judul Berita', array('class' => 'control-label')); }}
            <div class="controls">
              @if(!is_object($berita->judul))
              {{ Form::text('judul', $berita->judul, array('placeholder' => 'Isi Judul Berita')) }}
              @else
              {{ Form::text('judul', $berita->judul, array('placeholder' => 'Isi Judul Berita.')) }}
              @endif
            </div>
          </div>

          <div class="control-group">
            {{Form::label("Kategori", null, array("class" => "control-label"))}}
            <div class="controls">
              {{Form::select("kategori", Category::lists('nama_kategori', 'id'))}}
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
            {{ Form::label('gambar', 'Gambar Thumbnail', array('class' => 'control-label')) }}
            <div class="controls">
              {{ Form::file('gambar')}}

              @foreach($errors->get('gambar') as $error)
              <span class="help-block">{{$error}}</span>
              @endforeach
            </div>
          </div>

          <div class="control-group {{$errors->has('gambar')?'error':''}}">
            {{ Form::label('slider', 'Gambar Slider', array('class' => 'control-label')) }}
            <div class="controls">
              {{ Form::file('slider')}}

              @foreach($errors->get('slider') as $error)
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

  Berita.Form();
</script>
@stop
    
@section('admin')

<div class="rightpanel">
  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li>Kelola Kontak Kami</li>
  </ul>
  <div class="pageheader">
    <div class="pageicon"><span class="rulycon-settings"></span></div>
    <div class="pagetitle">
      <h1>Kelola Kontak Kami</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    @include('flash')
    <div class="maincontentinner">
      <!-- MAIN CONTENT -->
      {{ Form::open($form_opts ) }}

      <div class="row-fluid">
        <div class="span6 offset3">
          <fieldset>
            <div class="control-group">
              {{ Form::label('email', 'Email', array('class' => 'control-label')); }}
              <div class="controls">
                @if($call->email)
                {{ Form::text('email', $call->email) }}
                @else
                {{ Form::text('email') }}
                @endif
              </div>
            </div>
            <div class="control-group">
              {{ Form::label('alamat', 'Alamat', array('class' => 'control-label')); }}
              <div class="controls">
                @if($call->alamat)
                {{ Form::textarea('alamat', $call->alamat) }}
                @else
                {{ Form::textarea('alamat') }}
                @endif
              </div>
            </div>
            <div class="control-group">
              {{ Form::label('telp', 'telp', array('class' => 'control-label')); }}
              <div class="controls">
                @if($call->telp)
                {{ Form::text('telp', $call->telp) }}
                @else
                {{ Form::text('telp') }}
                @endif
              </div>
            </div>
            <div class="control-group">
              {{ Form::label('fax', 'fax', array('class' => 'control-label')); }}
              <div class="controls">
                @if($call->fax)
                {{ Form::text('fax', $call->fax) }}
                @else
                {{ Form::text('fax') }}
                @endif
              </div>
            </div>
            <div class="control-group">
              <div class="controls">
                {{ Form::submit('Simpan', array('class' => 'btn btn-primary btn-block')) }}
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
  </div>


  @section('scripts')
  @parent
  <script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
  <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
  <script src="{{asset('assets/js/additional-methods.js')}}"></script>

  <!--<script src="{{asset('assets/js/berita.js')}}"></script>-->
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
  </script>

  <script>
    jQuery("#manage-menu > li:nth-child(5) > a").addClass("sub-menu-active");
    jQuery("#manage-menu").css({
      "display": "block",
      "visibility": "visible"
    });
  </script>

  <script>
    jQuery(document).on("ready", function() {
      document.title = "Layanan Biro Hukum dan Organisasi | Kelola Kontak Kami"
    });
  </script>
  @stop
  @stop
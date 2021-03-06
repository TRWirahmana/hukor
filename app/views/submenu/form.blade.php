@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li><a href="{{URL::previous()}}">Kelola</a> <span class="separator"></span></li>
      <li><a href="{{URL::previous()}}">Kelola Submenu</a> <span class="separator"></span></li>
    <li>{{ $title }}</li>
  </ul>
  @include('adminflash')
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-settings"></span></div>
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
            <legend class="f_legend">{{$title}}</legend>
            <p class="text-info">{{$detail}}</p>

            <div class="control-group">
              {{ Form::label('menu', 'Pilih Menu', array('class' => 'control-label')) }}
              <div class="controls">
                {{ Form::select('menu', $listmenu, $submenu->menu->id, array("id" => "menu_id")) }}
              </div>
            </div>

            <div class="control-group">
              {{ Form::label('submenu', 'Nama Submenu', array('class' => 'control-label')); }}
              <div class="controls">
                @if(!is_object($submenu->nama_menu))
                {{ Form::text('submenu', $submenu->nama_submenu, array('placeholder' => 'Isi Nama Submenu')) }}
                @else
                {{ Form::text('submenu', $submenu->nama_submenu, array('placeholder' => 'Isi Nama Submenu.')) }}
                @endif
              </div>
            </div>

            <div class="control-group">
              <div class="controls">
                  <input class="btn btn-primary" type="button" value="Batal" onclick="history.go(-1);return true;" name="batal">
                  {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
              </div>
            </div>

        </div>

        </fieldset>

      </div>
      {{ Form::close() }}
    </div>


    <div class="footer span10">
      <span>&copy;2014 Biro Hukum dan Organisasi</span>
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

<script src="{{asset('assets/js/menus.js')}}"></script>
<script type="text/javascript">
    jQuery("#manage-menu > #kelola_submenu > a").addClass("sub-menu-active");
    jQuery("#manage-menu").css({
        "display": "block",
        "visibility": "visible"
    });

  Menu.Form();
</script>
<script>
  jQuery(document).on("ready", function() {
      var titles ='{{ $title }}';
    document.title = "Layanan Biro Hukum dan Organisasi | "+ titles;
  });
</script>
<!--<style>-->
<!--    .leftmenu .nav-tabs.nav-stacked > li.dropdown ul {-->
<!--        display: block !important;-->
<!--    }-->
<!--    #produkhukum, #ketatalaksanaan, #bahu, #puu, #diskusi, #callcenter, #app, #manage, #info {-->
<!--        display: none !important;-->
<!--    }-->
<!--</style>-->
@stop
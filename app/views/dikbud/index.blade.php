@section('admin')

<div class="rightpanel">

  <ul class="breadcrumbs">
    <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
    <li>Kelola Link</li>
  </ul>
  @include('adminflash')
  <div class="pageheader">
    <!--        <form action="results.html" method="post" class="searchbar">-->
    <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
    <!--        </form>-->
    <div class="pageicon"><span class="rulycon-settings"></span></div>
    <div class="pagetitle"><h1>Kelola Link</h1>
    </div>
  </div>
  <!--pageheader-->

  <div class="maincontent">
    <div class="maincontentinner">
      <!-- MAIN CONTENT -->
      {{ Form::open($form_opts) }}

      <style>
        input[type=file] {
          margin-top: 6px;
          margin-bottom: 6px;
        }
      </style>

      <div class="row-fluid">
        <div class="span6 offset3">
          <fieldset>

            <p class="text-info">{{$detail}}</p>
            <legend class="f_legend">{{$title}}</legend>

            <?php if (count($data) != 0) { ?>

              <?php $counter = 1; ?>
              <?php foreach ($data as $dat) { ?>

                <div class="control-group">
                  {{ Form::label('link', 'Link', array('class' => 'control-label')); }}
                  <div class="controls">
                    <input type="text" name="link[]" value="<?php echo $dat['link']; ?>" class="link"
                           placeholder="contoh : kemdikbud.go.id">

                    <input type="hidden" class="id_link" name="id[]" value="<?php echo $dat['id']; ?>">

                    <input type="file" name="gambar[]" value="<?php echo $dat['gambar']; ?>" class="gambar">
                    @foreach($errors->get('gambar') as $error)
                    <span class="help-block">{{$error}}</span>
                    @endforeach

                    <?php if (count($data) != $counter++) { ?>
                      {{ Form::button('Hapus', array('class' => 'btn btn-primary hapus')) }}
                    <?php } else { ?>
                      {{ Form::button('Tambah', array('class' => 'btn btn-primary tambah')) }}
                    <?php } ?>
                  </div>
                </div>
              <?php } ?>

            <?php } else { ?>
              <div class="control-group">
                {{ Form::label('link', 'Link', array('class' => 'control-label')); }}
                <div class="controls">
                  <input type="text" name="link[]" class="link" placeholder="contoh : kemdikbud.go.id">

                  <input type="file" name="gambar[]" class="gambar">
                  @foreach($errors->get('gambar') as $error)
                  <span class="help-block">{{$error}}</span>
                  @endforeach

                  {{ Form::button('Tambah', array('class' => 'btn btn-primary tambah')) }}
                </div>
              </div>
            <?php } ?>

          </fieldset>

            <hr/>

            <div class="control-group">
                <div class="controls">
                    <input class="btn btn-primary" type="button" value="Batal" onclick="window.location='{{ URL::to(admin) }}'" name="batal">
                    {{ Form::submit('Simpan perubahan', array('class' => 'btn btn-primary')) }}
                </div>
            </div>
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
<script type="text/javascript">
  jQuery('.tambah').live('click', function () {
    jQuery(this).parents('.control-group').clone().appendTo('fieldset');
    jQuery(this).removeClass('tambah').addClass('hapus');
    jQuery(this).text('Hapus');

    jQuery(this).parents('fieldset').find('.control-group').last().find('.link').val('');
    jQuery(this).parents('fieldset').find('.control-group').last().find('.gambar').val('');
    jQuery(this).parents('fieldset').find('.control-group').last().find('.id_link').val('');
  });

  jQuery('.hapus').live('click', function () {
    jQuery(this).parents('.control-group').remove();
  });
</script>

<script>
  jQuery("#manage-menu > li:last-child > a").addClass("sub-menu-active");
  jQuery("#manage-menu").css({
    "display": "block",
    "visibility": "visible"
  });
</script>

<script>
  jQuery(document).on("ready", function() {
    document.title = "Layanan Biro Hukum dan Organisasi | Kelola Link"
  });
</script>
@stop
    
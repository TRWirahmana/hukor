@section('content')
<!--FORUM DISKUSI-->
<script>
  document.getElementById("content-title-heading").innerHTML = "<span class='rulycon-bubbles'></span> Forum diskusi";
</script>
<div class="stripe-accent"></div>
<iframe src="{{ URL::to('forum/index.php') }}" frameborder="0" width="100%" height="87%" style="padding: 0"></iframe>

@stop

@section('scripts')
@parent
<script type="text/javascript">
$("#menu-forum").addClass("active");
</script>

<script type="text/javascript">
    var $ = jQuery.noConflict();

    $(document).on("ready", function() {
        document.title = "Layanan Biro Hukum dan Organisasi | Forum";
    });
</script>
@stop

@section('admin')

<div class="rightpanel">
<ul class="breadcrumbs">
        <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Berita</a>  <span class="separator"></span></li>
        <li>Call Center</li>
</ul>
    <div class="pageheader">
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <h1>Call Center</h1>
        </div>
    </div>
    <!--pageheader-->

 <div class="maincontent">
 @include('flash')
        <div class="maincontentinner">
            <!-- MAIN CONTENT -->
            {{ Form::open($form_opts ) }}

            <div>
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
                            {{ Form::text('alamat', $call->alamat) }}
                        @else
                            {{ Form::text('alamat') }}
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
                </fieldset>

                <div class="form-actions">
                    <div class="controls">
                        {{ Form::submit('Simpan', array('class' => 'btn btn-primary')) }}
                    </div>
                </div>
            </div>
            {{ Form::close() }}

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
</div>   


@section('scripts')
@parent
<script src="{{ asset('assets/lib/tinymce/tinymce.min.js') }}"></script>
<script src="{{asset('assets/js/jquery.validate.js')}}"></script>
<script src="{{asset('assets/js/additional-methods.js')}}"></script>

<!--<script src="{{asset('assets/js/berita.js')}}"></script>-->
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
</script>
@stop
@stop
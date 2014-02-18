@section('admin')

<div class="rightpanel">

    <ul class="breadcrumbs">
        <li><a href="{{URL::previous()}}"><i class="iconfa-home"></i></a> <span class="separator"></span></li>
        <li><a href="{{URL::previous()}}">Manage Menu</a>  <span class="separator"></span></li>
    </ul>
    @include('adminflash')
    <div class="pageheader">
        <!--        <form action="results.html" method="post" class="searchbar">-->
        <!--            <input type="text" name="keyword" placeholder="To search type and hit enter..."/>-->
        <!--        </form>-->
        <div class="pageicon">&nbsp;</div>
        <div class="pagetitle">
            <!--<h5>Events</h5>-->

            <h1>Tambah Menu</h1>
        </div>
    </div>
    <!--pageheader-->

    <div class="maincontent">
        <div class="maincontentinner">

            <!-- MAIN CONTENT -->
            {{ Form::open($form_opts) }}

            <div>
                <fieldset>
                    <legend class="f_legend">{{$title}}</legend>
                    <p class="text-info">{{$detail}}</p>

                    <div class="control-group">
                        {{ Form::label('menu', 'Nama Menu', array('class' => 'control-label')); }}
                        <div class="controls">
                            @if(!is_object($menu->nama_menu))
                            {{ Form::text('menu', $menu->nama_menu, array('placeholder' => 'Isi Nama Menu')) }}
                            @else
                            {{ Form::text('menu', $menu->nama_menu, array('placeholder' => 'Isi Nama Menu.')) }}
                            @endif
                        </div>
                    </div>

<!--                    <div class="control-group {{$errors->has('nama_submenu')? 'error':''}}">-->
<!--                        {{ Form::label('sub_menu', 'Sub Menu', array('class' => 'control-label')) }}-->
<!--                        <div class="controls">-->
<!--                            @if(!is_object($menu->submenu->nama_submenu))-->
<!--                            {{ Form::text('nama_submenu', $menu->submenu->nama_submenu, array('placeholder' => 'Isi Nama Sub Menu')) }}-->
<!--                            @else-->
<!--                            {{ Form::text('nama_submenu', $menu->submenu->nama_submenu, array('placeholder' => 'Isi Nama Sub Menu.')) }}-->
<!--                            @endif-->
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div id="submenus" class="control-group {{$errors->has('nama_submenu')? 'error':''}}">-->
<!---->
<!--                        @if($menu->submenu->count() == 0)-->
<!--                        <div class="control-group block-field block-submenu" >-->
<!--                            <label class="control-label label-subject">Sub Menu (1)</label>-->
<!--                            {{ Form::label('submenu', 'Sub Menu', array('class' => 'control-label')) }}-->
<!--                            <div class="controls">-->
<!--                                {{ Form::text('submenu[0][nama_submenu]', '', array('class' => 'submenu', 'id'=>'submenu','placeholder'=>'Tuliskan Sub Menu di sini...')) }}-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        @else-->
<!--                        @foreach($menu->submenu as $index => $submenu)-->
<!---->
<!--                        <div class="control-group  block-field block-submenu">-->
<!--                            <label class="control-label label-subject">Sub Menu ({{ $index + 1 }}) <a class="delete_submenu">Hapus</a></label>-->
<!--                            <div class="controls">-->
<!--                                {{ Form::text('submenu[' . $index . '][nama_submenu]', $submenu->nama_submenu, array('class'=>'submenu', 'id'=>'submenu','placeholder'=>'Tuliskan Sub Menu di sini...', 'style'=>'width:90%')) }}-->
<!---->
<!--                            </div>-->
<!--                        </div>-->
<!--                        @endforeach-->
<!--                        @endif-->
<!---->
<!--                        <a id='add-submenu' href="javascript:void(0)">Tambah Sub Menu</a>-->
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

<script src="{{asset('assets/js/menus.js')}}"></script>
<script type="text/javascript">
    Menu.Form();
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
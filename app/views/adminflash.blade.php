@if(Session::has('success'))
<div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Berhasil!</strong> {{Session::get('success')}}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-error">
    <buton class="close" type="button" data-dismiss="alert">&times;</buton>
    <strong>Kesalahan!</strong> {{Session::get('error')}}
</div>
@endif
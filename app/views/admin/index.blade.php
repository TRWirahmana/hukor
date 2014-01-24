@section('styles')
@parent
<link rel="stylesheet" href="{{asset('assets/css/jquery.dataTables.css')}}">
@stop

@section('content')
<h2>Kelola Akun</h2>
<div class="stripe-accent"></div>

<form class="form-inline">
    <fieldset>
        <legend>Kelola Akun <a class="btn btn-mini btn-primary pull-right" href="{{ URL::to('/admin/account/create')}}">Tambah Akun Baru</a></legend>
        <label for="select_role" class="control-label">Tipe Pengguna</label>
        <select id="select_role">
            <option value="0">Semua User</option>
            <option value="2">User</option>
            <option value="3">Admin</option>
        </select>
    </fieldset>
</form>

<table id="table_admin" class="table">
    <thead>
    <tr>
        <td>Nama Lengkap</td>
        <td>Username</td>
        <td>Email</td>
        <td></td>
    </tr>
    </thead>
</table>

@stop

@section('scripts')
@parent
<script src="{{asset('assets/js/admin_index.js')}}"></script>
@stop
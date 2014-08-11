<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
</head>
<body>
<h1>{{ $title }}</h1>

<strong>Informasi Pengusul</strong>
<table>
    <tr>
        <th align="left">Nama pengusul</th>
        <td>: {{ $pengguna->nama_lengkap }}</td>
    </tr>
<!--    <tr>-->
<!--        <th align="left">Unit Kerja</th>-->
<!--        <td>: {{ $pengguna->unit_kerja }}</td>-->
<!--    </tr>-->
<!--    <tr>-->
<!--        <th align="left">Jabatan</th>-->
<!--        --><?php //$jabatan = ($pengguna->jabatan == 1) ? 'Direktur' : 'Kepala Divis'; ?>
<!--        <td>: {{ $jabatan }}</td>-->
<!--    </tr>-->
    <tr>
        <th align="left">Email</th>
        <td>: {{ $pengguna->email }}</td>
    </tr>
</table>

<span>Telah mengajukan usulan {{ $jenis_usulan }}.</span>

</body>
</html>


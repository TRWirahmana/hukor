<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pengajuan Usulan Baru</title>
</head>
<body>
	<h1>Pengajuan Usulan Baru</h1>
	<h3>Perihal: {{ $data->perihal }}</h3>

	<strong>Informasi Pengusul</strong>
	<table>
		<tr>
			<th align="left">Nama pengusul</th>
			<td>: {{ $user->pengguna->nama_lengkap }}</td>
		</tr>
		<tr>
			<th align="left">Unit Kerja</th>
			<td>: {{ $user->pengguna->unit_kerja }}</td>
		</tr>
		<tr>
			<th align="left">Jabatan</th>
			<td>: {{ $user->pengguna->detailjabatan->nama_jabatan }}</td>
		</tr>
		<tr>
			<th align="left">Email</th>
			<td>: {{ $user->pengguna->email }}</td>
		</tr>
	</table>

	<strong>Catatan:</strong>
	<div>{{ $data->catatan }}</div>
</body>
</html>


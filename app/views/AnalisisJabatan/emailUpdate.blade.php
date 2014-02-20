<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perubahan Usulan</title>
</head>
<body>
	<h1>Perubahan Usulan</h1>
	<h3>Perihal: {{ $data->perihal }}</h3>
	
	<strong>Status Sebelumnya</strong>
	<table>
		<tr>
			<th align="left">Status</th>
			<td>: 
					@if ($log->status == 1)
						Diproses
					@elseif($log->status == 2)
						Ditunda
					@elseif($log->status == 3)
						Ditolak
					@elseif($log->status == 4)
						Buat Salinan
					@elseif($log->status == 5)
						Penetapan
					@endif
			</td>
		</tr>
		<tr>
			<th align="left">Tanggal Proses</th>
			<td>: {{ $log->tgl_proses->format('d/m/Y') }}</td>
		</tr>
		<tr>
			<th align="left">Lampiran</th>
			<td>: 
				<a href="/assets/uploads/{{ $log->lampiran }}">
					{{ explode('/', $log->lampiran)[1] }}
				</a>
			</td>
		</tr>
		<tr>
			<th align="left">Catatan</th>
			<td>: {{ $log->catatan }}</td>
		</tr>
	</table>
	<br><br>
	<strong>Status Baru</strong>
	<table>
		<tr>
			<th align="left">Status</th>
			<td>: 
					@if ($data->status == 1)
						Diproses
					@elseif($data->status == 2)
						Ditunda
					@elseif($data->status == 3)
						Ditolak
					@elseif($data->status == 4)
						Buat Salinan
					@elseif($data->status == 5)
						Penetapan
					@endif
			</td>
		</tr>
		<tr>
			<th align="left">Tanggal Usulan</th>
			<td>: {{ $data->tgl_usulan }}</td>
		</tr>
		<tr>
			<th align="left">Lampiran</th>
			<td>: 
				<a href="/assets/uploads/{{ $data->lampiran }}">
					{{ explode('/', $data->lampiran)[1] }}
				</a>
			</td>
		</tr>
		<tr>
			<th align="left">Catatan</th>
			<td>: {{ $data->catatan }}</td>
		</tr>
	</table>
</body>
</html>
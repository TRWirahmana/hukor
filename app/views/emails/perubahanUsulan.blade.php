<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perubahan Usulan</title>
</head>
<body>
	<h1>Perubahan Usulan</h1>
	<h3>Perihal: {{ $perUU->perihal }}</h3>
	
	<strong>Status Sebelumnya</strong>
	<table>
		<tr>
			<th align="left">Status</th>
			<td>: 
					@if ($logPerUU->status == 1)
						Diproses
					@elseif($logPerUU->status == 2)
						Ditunda
					@elseif($logPerUU->status == 3)
						Ditolak
					@elseif($logPerUU->status == 4)
						Buat Salinan
					@elseif($logPerUU->status == 5)
						Penetapan
					@endif
			</td>
		</tr>
		<tr>
			<th align="left">Tanggal Proses</th>
			<td>: {{ $logPerUU->tgl_proses->format('d/m/Y') }}</td>
		</tr>
		<tr>
			<th align="left">Lampiran</th>
			<td>: 
				<a href="/assets/uploads/{{ $logPerUU->lampiran }}">
					{{ explode('/', $logPerUU->lampiran)[1] }}
				</a>
			</td>
		</tr>
		<tr>
			<th align="left">Catatan</th>
			<td>: {{ $logPerUU->catatan }}</td>
		</tr>
	</table>
	<br><br>
	<strong>Status Baru</strong>
	<table>
		<tr>
			<th align="left">Status</th>
			<td>: 
					@if ($perUU->status == 1)
						Diproses
					@elseif($perUU->status == 2)
						Ditunda
					@elseif($perUU->status == 3)
						Ditolak
					@elseif($perUU->status == 4)
						Buat Salinan
					@elseif($perUU->status == 5)
						Penetapan
					@endif
			</td>
		</tr>
		<tr>
			<th align="left">Tanggal Usulan</th>
			<td>: {{ $perUU->tgl_usulan }}</td>
		</tr>
		<tr>
			<th align="left">Lampiran</th>
			<td>: 
				<a href="/assets/uploads/{{ $perUU->lampiran }}">
					{{ explode('/', $perUU->lampiran)[1] }}
				</a>
			</td>
		</tr>
		<tr>
			<th align="left">Catatan</th>
			<td>: {{ $perUU->catatan }}</td>
		</tr>
	</table>
</body>
</html>
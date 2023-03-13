<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Laporan Pengaduan</title>
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			font-size: 14px;
			line-height: 1.4;
		}
		h1 {
			font-size: 24px;
			margin-top: 0;
		}
		table {
			border-collapse: collapse;
			width: 100%;
		}
		table th, table td {
			border: 1px solid #ddd;
			padding: 8px;
			text-align: left;
		}
		table th {
			background-color: #f2f2f2;
		}
		img {
			max-width: 100%;
            width: 200px;
		}
	</style>
</head>
<body>
	<h1>Laporan Pengaduan</h1>
	<table>
		<thead>
			<tr>
				<th>Tanggal Pengaduan</th>
				<th>Nama Pelapor</th>
				<th>Kategori</th>
				<th>Judul Laporan</th>
				<th>Isi Laporan</th>
				<th>Foto</th>
				<th>Status</th>
				<th>visibilitas</th>
				<th>Tanggapan</th>
				<th>Petugas</th>
			</tr>
		</thead>
		<tbody>
			@foreach($pengaduan as $row)
				<tr>
					<td>{{ $row->created_at->format("Y-m-d") }}</td>
					<td>{{ $row->masyarakat->nama }}</td>
					<td>{{ (ucfirst(str_replace('_', ' ', $row->kategori))) }}</td>
					<td>{{ $row->judul_laporan }}</td>
					<td>{{ $row->isi_laporan }}</td>
					<td><img src="{{ public_path('foto/'.$row->foto) }}"/></td>
					<td>{{ $row->status }}</td>
					<td>{{ $row->visibilitas }}</td>
					<td>{{ $row->tanggapan->tanggapan }}</td>
					<td>{{ $row->tanggapan->petugas->nama }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>

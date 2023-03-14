<!DOCTYPE html>
<html>
<head>
	<title>Laporan #{{ $pengaduan->id }} </title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .img-thumbnail{
            position: relative;
            display: block;
        }
    </style>
</head>
<body>
	<h1>Laporan #{{ $pengaduan->id }}</h1>
    <p>Tanggal: {{ \Carbon\Carbon::parse($pengaduan->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
    <p>Judul Laporan: <br>
        {{ $pengaduan->judul_laporan }} 
    </p>
    <p>Isi Laporan: <br>
        {{ $pengaduan->isi_laporan }} 
    </p>
    <p>Foto: <br>
		<img src="{{ public_path('foto/'.$pengaduan->foto) }}" style="width:200px" />
	</p>
	<p>Petugas: {{ $pengaduan->tanggapan->petugas->nama }}</p>
	<p>Tanggal Tanggapan: {{ \Carbon\Carbon::parse($pengaduan->tanggapan->created_at)->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
    <p>Tanggapan: <br>
        {{ $pengaduan->tanggapan->tanggapan }}
    </p>
</body>
</html>
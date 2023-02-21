<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .img-thumbnail{
            position: relative;
            display: block;
        }
    </style>
</head>
<body>
	<h1>Laporan #{{ $data->id }}</h1>
    <p>Tanggal: {{ $data->created_at }}</p>
    <p>Isi Laporan: <br>
        {{ $data->pengaduan->isi_laporan }} 
    </p>
    {{-- <p>Foto: <img src="/foto/{{$data->pengaduan->foto}}" class="img-thumbnail" style="width:200px" /></p> --}}
    <p>Tanggapan: <br>
        {{ $data->tanggapan }}
    </p>
    <p>Petugas: {{ $data->petugas->nama }}</p>
</body>
</html>
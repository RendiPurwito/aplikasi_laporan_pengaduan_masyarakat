<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Tanggal Pengaduan</th>
                <th>Judul Laporan</th>
                <th>Kategori Laporan</th>
                <th>Isi Laporan</th>
                <th>Foto</th>
                <th>Koordinat Lokasi</th>
                <th>Petugas</th>
                <th>Tanggal Tanggapan</th>
                <th>Isi Tanggapan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $row)
                <tr>
                    <td>{{ $row->created_at->format('d/m/Y') }}</td>
                    <td>{{ $row->judul_laporan }}</td>
                    <td>{{ $row->kategori->nama_kategori }}</td>
                    <td>{{ $row->isi_laporan }}</td>
                    <td>{{ $row->foto }}</td>
                    <td>{{ $row->lokasi }}</td>
                    <td>{{ $row->tanggapan ? $row->tanggapan->petugas->nama : '' }}</td>
                    <td>{{ $row->tanggapan ? $row->tanggapan->created_at->format('d/m/Y') : '' }}</td>
                    <td>{{ $row->tanggapan ? $row->tanggapan->tanggapan : '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
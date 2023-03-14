<!DOCTYPE html>
<html>
<head>
    <title>Export PDF</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Pengaduan Berdasarkan Kategori Dan Tanggal</h2>
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
				<th>Tanggapan</th>
				<th>Petugas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengaduan as $row)
                <tr>
                    <td>{{ $row->created_at->format("Y-m-d") }}</td>
					<td>{{ $row->masyarakat->nama }}</td>
					<td>{{ $row->kategori->nama_kategori }}</td>
					<td>{{ $row->judul_laporan }}</td>
					<td>{{ $row->isi_laporan }}</td>
					<td>
                        @if ($row->foto)
                            <img src="{{ public_path('foto/'.$row->foto) }}" width="100px"/>
                        @else
                            Tidak ada foto
                        @endif
                    </td>
					<td>{{ $row->status }}</td>
					@if ($row->tanggapan)
                        <td>{{ $row->tanggapan->tanggapan }}</td>
                        <td>{{ $row->tanggapan->petugas->nama }}</td>
                    @else
                        <td colspan="2">Belum Ditanggapi</td>
                        {{-- <td> Belum Ditanggapi</td> --}}
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</

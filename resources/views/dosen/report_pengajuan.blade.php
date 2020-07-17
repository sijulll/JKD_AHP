<html>
<head>
<title>Document Pengajuan Angka Kredit Dosen</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Politeknik Negeri Jakarta</h4>
		<h6>Jurusan Teknik Informatika dan Komputer</h5>
	</center>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Dosen</th>
				<th>Komponen Kegiatan</th>
				<th>Poin</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($pengajuanData as $p)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$p->dosen->nama_dosen}}</td>
				<td>{{$p->komponenkegiatan->nama_kegiatan}}</td>
				<td>{{$p->komponenkegiatan->kegiatan_point}}</td>
				<td>
                    @if ($p->status == 1)
                        Disetujui
                    @endif
                </td>
			</tr>
			@endforeach
		</tbody>
    </table>
    <footer>
        Politeknik Negeri Jakarta
    </footer>
</body>
</html>

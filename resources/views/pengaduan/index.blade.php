<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Pengaduan</title>

    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            font-size: 13px;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto;
            font-size: inherit; /* Supaya ikut ukuran body */
        }

        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            vertical-align: top;
            word-break: break-word;
        }

        th {
            background-color: #f2f2f2;
            white-space: nowrap;
        }

        a {
            color: blue;
        }

        select {
            padding: 6px 10px;
            font-size: inherit;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #fff;
        }

        td select {
            width: 100%;
            max-width: 160px;
        }

        /* Set min-width untuk kolom supaya lebih rapi */
        th:nth-child(1), td:nth-child(1) { min-width: 20px; text-align: center; }         /* No */
        th:nth-child(2), td:nth-child(2) { min-width: 120px; }                            /* Nama */
        th:nth-child(3), td:nth-child(3) { min-width: 100px; }                            /* Telepon */
        th:nth-child(4), td:nth-child(4) { min-width: 150px; }                            /* Judul */
        th:nth-child(5), td:nth-child(5) { min-width: 400px; }                            /* Isi */
        th:nth-child(6), td:nth-child(6) { min-width: 200px; }                            /* Email */
        th:nth-child(7), td:nth-child(7) { min-width: 130px; }                            /* No. Surat */
        th:nth-child(8), td:nth-child(8) { min-width: 100px; }                            /* Tanggal */
        th:nth-child(9), td:nth-child(9),
        th:nth-child(10), td:nth-child(10),
        th:nth-child(11), td:nth-child(11) {
            min-width: 80px;
            text-align: center;
        }

        form {
            margin-bottom: 10px;
        }

        form select {
            padding: 5px 10px;
            font-size: inherit;
        }
    </style>
</head>

<body>
    <h1>Daftar Pengaduan</h1>

    @if($pengaduans->isEmpty())
        <p>Tidak ada pengaduan.</p>
    @else
        <form method="GET" action="{{ url('/admin/pengaduan') }}">
            <label for="status">Filter Status: </label>
            <select name="status" onchange="this.form.submit()">
                <option value="">-- Semua --</option>
                <option value="Belum Ditindaklanjuti" {{ $statusFilter == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum Ditindaklanjuti</option>
                <option value="Sedang Diproses" {{ $statusFilter == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="Selesai" {{ $statusFilter == 'Selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </form>

        <br>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Telepon</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Email</th>
                        <th>No. Surat Pengirim</th>
                        <th>Tanggal Surat</th>
                        <th>Lampiran</th>
                        <th>Cetak</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduans as $pengaduan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengaduan->nama }}</td>
                        <td>{{ $pengaduan->telepon }}</td>
                        <td>{{ $pengaduan->judul }}</td>
                        <td>{{ $pengaduan->isi }}</td>
                        <td>{{ $pengaduan->email }}</td>
                        <td>{{ $pengaduan->nomor_surat_pengirim }}</td>
                        <td>
                            {{ !empty($pengaduan->tanggal_surat) ? \Carbon\Carbon::parse($pengaduan->tanggal_surat)->format('d-m-Y') : '' }}
                        </td>

                        <td>
                            @if($pengaduan->lampiran)
                                <a href="{{ url('/admin/pengaduan/'.$pengaduan->id.'/print') }}" target="_blank">Cetak</a>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            <form method="POST" action="{{ url('/admin/pengaduan/'.$pengaduan->id.'/status') }}">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()">
                                    <option {{ $pengaduan->status == 'Belum Ditindaklanjuti' ? 'selected' : '' }}>Belum Ditindaklanjuti</option>
                                    <option {{ $pengaduan->status == 'Sedang Diproses' ? 'selected' : '' }}>Sedang Diproses</option>
                                    <option {{ $pengaduan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <br>
    <a href="/pengaduan">← Kembali ke Form</a>

    <script>
        function fetchPengaduanRows() {
            fetch('{{ url("/admin/pengaduan/fetch") }}')
                .then(response => response.text())
                .then(html => {
                    const tbody = document.querySelector('table tbody');
                    if (tbody) {
                        tbody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Gagal memuat data:', error);
                });
        }

        // Panggil pertama kali
        fetchPengaduanRows();

        // Auto-refresh tiap 15 detik
        setInterval(fetchPengaduanRows, 15000);
    </script>


</body>
</html>

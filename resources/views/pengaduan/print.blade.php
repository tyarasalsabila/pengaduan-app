<!DOCTYPE html>
<html>
<head>
    <title>Disposisi Pengaduan</title>
    <style>
        @page {
            size: A5 portrait;
            margin: 10mm;
        }

        body {
            font-family: "Segoe UI", sans-serif;
            font-size: 10px;
            margin: 0;
        }

        .kop {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .kop img {
            height: 30px;
            width: auto;
        }

        .kop-title {
            text-align: center;
            flex: 1;
        }

        .kop-title h2 {
            font-size: 12px;
            margin: 0;
        }

        .kop-title h4 {
            font-size: 10px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        td, th {
            padding: 4px 6px;
            border: 1px solid #000;
            vertical-align: top;
        }

        .box-coratcoret {
            border: 1px solid #000;
            height: 60px;
            padding: 6px;
            margin-top: 6px;
        }

        .ttd {
            text-align: center;
            margin-top: 30px;
        }

        .checkbox td {
            padding: 4px 6px;
        }

        .nowrap {
            white-space: nowrap;
        }

    </style>
</head>
<body onload="window.print()">

    <div class="kop">
        <img src="{{ asset('logo-tasikmalaya.png') }}" alt="Logo">
        <div class="kop-title">
            <h2>INSPEKTORAT DAERAH KABUPATEN TASIKMALAYA</h2>
            <h4>Lembar Disposisi Pengaduan Masyarakat</h4>
        </div>
    </div>

    <table>
        <tr>
            <th style="width: 40%;">Nomor Agenda</th>
            <td>: 2025/PENGADUAN/{{ $pengaduan->id }}</td>
        </tr>
        <tr>
            <th>Nomor Surat dari Pengirim</th>
            <td>: {{ $pengaduan->nomor_surat_pengirim ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Surat</th>
            <td>: {{ $pengaduan->tanggal_surat ? \Carbon\Carbon::parse($pengaduan->tanggal_surat)->format('d-m-Y') : '-' }}</td>
        </tr>
        <tr>
            <th>Nama Pelapor</th>
            <td>: {{ $pengaduan->nama }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>: {{ $pengaduan->telepon ?? '-' }}</td>
        </tr>
        <tr>
            <th>Alamat Email</th>
            <td>: {{ $pengaduan->email }}</td>
        </tr>
        <tr>
            <th>Judul Pengaduan</th>
            <td>: {{ $pengaduan->judul }}</td>
        </tr>
        <tr>
            <th>Isi Pengaduan</th>
            <td>: {!! nl2br(e(Str::limit($pengaduan->isi, 400))) !!}</td>
        </tr>
        @if($pengaduan->lampiran)
        <tr>
            <th>Lampiran</th>
            <td>: <a href="{{ asset('storage/'.$pengaduan->lampiran) }}" target="_blank">{{ basename($pengaduan->lampiran) }}</a></td>
        </tr>
        @endif
    </table>

    <br>

    <table class="checkbox">
        <tr>
            <th style="width: 50%;">Diteruskan Kepada</th>
            <th>Keterangan</th>
        </tr>
        <tr>
            <td>
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                    <input type="checkbox" style="margin: 0;"> Sekretaris
                </label>
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                    <input type="checkbox" style="margin: 0;"> Inspektur Pembantu I
                </label>
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                    <input type="checkbox" style="margin: 0;"> Inspektur Pembantu II
                </label>
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                    <input type="checkbox" style="margin: 0;"> Inspektur Pembantu III
                </label>
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                    <input type="checkbox" style="margin: 0;"> Kasubag Umum
                </label>
                <label style="display: flex; align-items: center; gap: 6px; margin-bottom: 2px;">
                    <input type="checkbox" style="margin: 0;"> Kasubag Keuangan
                </label>
                <label style="display: flex; align-items: center; gap: 6px;">
                    <input type="checkbox" style="margin: 0;"> PEP
                </label>
            </td>

            <td></td>
        </tr>
    </table>

   <div style="text-align: right;">
        <div class="ttd" style="text-align: center; display: inline-block;">
            <p style="margin-bottom: 50px;"><strong>Inspektur</strong></p>
            <p>____________________________</p>
        </div>
    </div>

</body>
</html>

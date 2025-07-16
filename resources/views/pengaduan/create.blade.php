<!DOCTYPE html>
<html>
<head>
    <title>Form Pengaduan</title>
    <style>
        body {
            font-family: sans-serif;
            max-width: 700px;
            margin: 40px auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            background: #f9f9f9;
            padding: 25px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="file"] {
            padding: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }

        .back-link {
            margin-top: 20px;
            display: inline-block;
        }

        .error {
            color: red;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <h1>Formulir Pengaduan</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/pengaduan" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>

        <label for="telepon">Nomor Telepon</label>
        <input type="text" id="telepon" name="telepon" value="{{ old('telepon') }}" required>

        <label for="judul">Judul Pengaduan</label>
        <input type="text" id="judul" name="judul" value="{{ old('judul') }}" required>

        <label for="isi">Isi Pengaduan</label>
        <textarea id="isi" name="isi" rows="5" required>{{ old('isi') }}</textarea>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>

        <label for="nomor_surat_pengirim">Nomor Surat dari Pengirim</label>
        <input type="text" id="nomor_surat_pengirim" name="nomor_surat_pengirim" value="{{ old('nomor_surat_pengirim') }}">

        <label for="tanggal_surat">Tanggal Surat</label>
        <input type="date" id="tanggal_surat" name="tanggal_surat" value="{{ old('tanggal_surat') }}">

        <label for="lampiran">Upload Lampiran (PDF/JPG/PNG)</label>
        <input type="file" id="lampiran" name="lampiran" accept=".pdf,.jpg,.jpeg,.png">

        <button type="submit">Kirim Pengaduan</button>
    </form>

    <a class="back-link" href="/admin/pengaduan">← Kembali ke Admin</a>

</body>
</html>

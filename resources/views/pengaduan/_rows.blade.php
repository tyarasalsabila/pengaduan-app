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
            <a href="{{ asset('storage/'.$pengaduan->lampiran) }}" target="_blank">Lihat</a>
        @else
            -
        @endif
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

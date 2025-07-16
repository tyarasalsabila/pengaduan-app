<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    public function create()
    {
        return view('pengaduan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'judul' => 'required',
            'isi' => 'required',
            'email' => 'required|email',
            'telepon' => 'nullable|string',
            'nomor_surat_pengirim' => 'nullable|string',
            'tanggal_surat' => 'nullable|date',
            'lampiran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only([
            'nama',
            'judul',
            'isi',
            'email',
            'telepon',
            'nomor_surat_pengirim',
            'tanggal_surat',
        ]);

        if ($request->hasFile('lampiran')) {
            $data['lampiran'] = $request->file('lampiran')->store('lampiran', 'public');
        }

        \App\Models\Pengaduan::create($data);

        return redirect('/pengaduan')->with('success', 'Pengaduan berhasil dikirim!');
    }


    public function index(Request $request)
    {
        $statusFilter = $request->query('status');

        $pengaduans = \App\Models\Pengaduan::query();

        if ($statusFilter) {
            $pengaduans->where('status', $statusFilter);
        }

        return view('pengaduan.index', [
            'pengaduans' => $pengaduans->latest()->get(),
            'statusFilter' => $statusFilter
        ]);
    }


    public function print($id)
    {
        $pengaduan = \App\Models\Pengaduan::findOrFail($id);
        return view('pengaduan.print', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $id)
    {
        $pengaduan = \App\Models\Pengaduan::findOrFail($id);
        $pengaduan->status = $request->status;
        $pengaduan->save();

        return redirect('/admin/pengaduan')->with('success', 'Status diperbarui.');
    }

    public function fetch(Request $request)
    {
        $statusFilter = $request->query('status');

        $pengaduans = Pengaduan::query();

        if ($statusFilter) {
            $pengaduans->where('status', $statusFilter);
        }

        $pengaduans = $pengaduans->latest()->get();

        return view('pengaduan._rows', compact('pengaduans'))->render();
    }



}

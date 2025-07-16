<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
   protected $fillable = [
    'nama',
    'judul',
    'isi',
    'email',
    'telepon',
    'nomor_surat_pengirim',
    'tanggal_surat',
    'lampiran',
    'status',
];

}

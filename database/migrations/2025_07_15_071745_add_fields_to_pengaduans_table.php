<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->string('nomor_surat_pengirim')->nullable();
            $table->string('telepon')->nullable();
            $table->date('tanggal_surat')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['nomor_surat_pengirim', 'telepon', 'tanggal_surat']);
        });
    }
};

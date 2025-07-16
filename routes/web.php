<?php

use App\Http\Controllers\PengaduanController;

Route::get('/pengaduan', [PengaduanController::class, 'create']);
Route::post('/pengaduan', [PengaduanController::class, 'store']);

Route::get('/admin/pengaduan', [PengaduanController::class, 'index']);
Route::get('/admin/pengaduan/{id}/print', [PengaduanController::class, 'print']);
Route::put('/admin/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus']);

Route::get('/admin/pengaduan/fetch', [PengaduanController::class, 'fetch']);


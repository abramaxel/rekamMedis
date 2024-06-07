<?php


use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('beranda');
});


Route::get('/rekam-medis', function () {
    return view('rekamMedis');
});

Route::get('/master', function () {
    return view('master');
});

Route::get('/riwayat/{no_rm}', function ($no_rm) {
    return view('riwayat', ['no_rm' => $no_rm]);
});

Route::get('/detail/{no_rm}', function ($no_rm) {
    return view('detail', ['no_rm' => $no_rm]);
});

// Route::get('/riwayat-pdf/{no_rm}', function ($no_rm) {
//     // Logika untuk menghasilkan PDF berdasarkan $no_rm
//     $data = [
//         'no_rm' => $no_rm,
//         // data lainnya yang diperlukan
//     ];
//     $pdf = Pdf::loadView('riwayat_pdf', $data);
//     return $pdf->stream('riwayat.pdf'); // Untuk menampilkan di tab baru
// })->name('riwayat.pdf');

Route::get('/riwayat-pdf/{no_rm}', function ($no_rm) {
    // Mengambil data profil pasien dan riwayat rekam medis dari API atau sumber lainnya
    $profilResponse = Http::get("http://localhost:8080/silk2024-slim/public/detail-pasien/{$no_rm}");
    $riwayatResponse = Http::get("http://localhost:8080/silk2024-slim/public/riwayat/{$no_rm}");

    if ($profilResponse->failed() || $riwayatResponse->failed()) {
        abort(404, 'Data tidak ditemukan');
    }

    $profil = $profilResponse->json();
    $riwayat = $riwayatResponse->json();

    // Mengirim data ke view 'riwayat_pdf'
    $data = [
        'no_rm' => $profil['no_rm'] ?? 'No RM tidak ditemukan',
        'nama' => $profil['nama'] ?? 'Nama tidak ditemukan',
        'riwayat' => array_map(function($entry) {
            return [
                'tanggal' => $entry['tanggal'] ?? 'Tanggal tidak ditemukan',
                'dokter' => $entry['dokter'] ?? 'Dokter tidak ditemukan',
                'keluhan' => $entry['keluhan'] ?? 'Keluhan tidak ditemukan',
                'obat' => $entry['obat'] ?? [] // Pastikan ini adalah array
            ];
        }, $riwayat)
    ];

    $pdf = Pdf::loadView('riwayat_pdf', $data);
    return $pdf->stream('riwayat.pdf'); // Untuk menampilkan di tab baru
})->name('riwayat.pdf');      









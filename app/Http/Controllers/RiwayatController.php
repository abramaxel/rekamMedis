<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class RiwayatController extends Controller
{
    public function generatePdf(Request $request)
    {
        // Logic untuk membuat file PDF tanpa perlu nomor rekam medis

        // Contoh pembuatan file PDF dengan menggunakan DomPDF
        $pdf = PDF::loadView('pdf.riwayat'); // Contoh menggunakan view 'pdf.riwayat'
        
        // Contoh menyimpan file PDF ke dalam storage
        $pdf->save(storage_path('app/public/riwayat.pdf'));

        // Contoh mengirimkan file PDF sebagai respons
        return response()->download(storage_path('app/public/riwayat.pdf'));
    }
}

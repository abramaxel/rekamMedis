@extends('layouts.app')

@section('title', 'Riwayat')

@section('content')
<div class="container">
    <!-- Card untuk Profil Singkat, Pemilihan Tanggal, dan Riwayat Rekam Medis -->
    <div class="card">
        <!-- Kop Surat -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="col-md-4">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTP8VppAhS-l0_hhUtv_jWsuxeMQpd8qeFjzWSF8VuWTQ&s" alt="Logo" style="width: 100px;">
            </div>
            <div class="col-md-4 text-center">
                <h4 class="mb-1">Rumah Sakit XYZ</h4>
                <div class="mb-1" style="font-size: 12px;">Alamat Rumah Sakit, Kota, Negara</div>
                <div class="mb-1" style="font-size: 10px;">No. Telp: 123-456-7890</div>
                <div style="font-size: 8px;">Email: rs_xyz@example.com</div>
            </div>
            <div class="col"></div>
        </div>
        
        <!-- Card Body -->
        <div class="card-body">
            <!-- Profil Singkat -->
            <div class="mb-4">
                <label for="nama"><b>Nama : </b></label>
                <span id="nama"></span>
                <br>
                <label for="no_rm"><b>No. Rekam Medis : </b></label>
                <span id="no_rm">{{ $no_rm }}</span>
                <!-- tambahkan informasi profil lainnya jika diperlukan -->
            </div>

            
            <!-- Tabel untuk menampilkan riwayat rekam medis -->
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Dokter</th>
                        <th>Keluhan</th>
                        <th>Obat</th>
                    </tr>
                </thead>
                <tbody id="riwayat-body">
                    <!-- Isi tabel akan di-generate oleh JavaScript -->
                </tbody>
            </table>
            <!-- Tombol cetak -->
            <div class="text-right mb-3">
                <button class="btn btn-primary" onclick="openPdfInNewTab()">Cetak Riwayat</button>
            </div>
        </div>
        <!-- Akhir Card Body -->
    </div>
    <!-- Akhir Card -->
</div>

<script>
    function openPdfInNewTab() {
        // Mendapatkan URL untuk riwayat PDF
        var no_rm = "{{ $no_rm }}";
        var pdfUrl = "{{ route('riwayat.pdf', ['no_rm' => ':no_rm']) }}".replace(':no_rm', no_rm);

        // Membuka URL dalam tab baru
        window.open(pdfUrl, '_blank');
    }
</script>
@endsection

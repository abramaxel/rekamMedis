@extends('layouts.app')

@section('title', 'Beranda Rekam Medis')

@section('content')
<div class="container">
    <h2>Selamat datang di Beranda Rekam Medis</h2>
    
    <!-- Deskripsi singkat -->
    <p>Platform ini menyediakan akses mudah dan aman untuk mengelola rekam medis Anda. 
    Anda dapat melihat riwayat medis, menjadwalkan janji temu, dan mengakses informasi kesehatan terbaru.</p>
    
    <!-- Statistik atau informasi penting -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pasien</h5>
                    <p class="card-text">1,234</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Janji Temu Mendatang</h5>
                    <p class="card-text">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Dokter Tersedia</h5>
                    <p class="card-text">24</p>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Tautan navigasi -->
    <div class="mt-4">
        <a href="{{ route('medical_records.index') }}" class="btn btn-primary">Lihat Rekam Medis</a>
        <a href="{{ route('appointments.index') }}" class="btn btn-secondary">Jadwalkan Janji Temu</a>
        <a href="{{ route('doctors.index') }}" class="btn btn-info">Lihat Daftar Dokter</a>
    </div> --}}

    <!-- Tambahkan elemen atau konten lain di sini sesuai kebutuhan -->
</div>
@endsection

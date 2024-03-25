@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('content')
<div class="container">
    <h2>Detail Pasien</h2>
    <div class="table-responsive">
        <table class="table" id="outputTableDetailPasien">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Jenis Kelamin</th>
                    <th>NIK</th>
                    <th>No. Rekam Medis</th>
                    <th>Tanggal Lahir</th>
                    <th>Tempat Lahir</th>
                    <th>Golongan Darah</th>
                    <th>Tinggi Badan</th>
                    <th>Berat Badan</th>
                    <th>Kontak Keluarga</th>
                    <th>No. HP Kontak Keluarga</th>
                    <th>Alamat Kontak Keluarga</th>
                </tr>
            </thead>
            <tbody id="outputTableDetailPasienBody">
                <!-- Data pasien akan dimasukkan di sini oleh JavaScript -->
            </tbody>
        </table>
    </div>
</div>

@endsection

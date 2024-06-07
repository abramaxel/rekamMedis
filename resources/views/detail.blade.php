{{-- @extends('layouts.app')

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

@endsection --}}

@extends('layouts.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="container">
    <h2>Detail Pasien</h2>
    <div class="row">
        <!-- Card Pertama: Informasi Dasar -->
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Informasi Dasar</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span style="font-weight: bold;">Nama:</span> <span id="nama"></span></li>
                        <li class="list-group-item"><span style="font-weight: bold;">Alamat:</span> <span id="alamat"></span></li>
                        <li class="list-group-item"><span style="font-weight: bold;">No. HP:</span> <span id="no_hp"></span></li>
                    </ul>                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Card Kedua: Informasi Detail -->
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Informasi Detail</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <p class="card-text"><span style="font-weight: bold;">Jenis Kelamin:</span> <span id="jk"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">NIK:</span> <span id="nik"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">No. Rekam Medis:</span> <span id="no_rm"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">Tanggal Lahir:</span> <span id="tgl_lahir"></span></p>
                        </div>
                        <div class="col-md-4">
                            <p class="card-text"><span style="font-weight: bold;">Tempat Lahir:</span> <span id="tempat_lahir"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">Golongan Darah:</span> <span id="gol_darah"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">Tinggi Badan:</span> <span id="tinggi"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">Berat Badan:</span> <span id="berat"></span></p>
                        </div>
                        <div class="col-md-4">
                            <p class="card-text"><span style="font-weight: bold;">Kontak Keluarga:</span> <span id="kontak_keluarga"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">No. HP Kontak Keluarga:</span> <span id="kontak_keluarga_hp"></span></p><hr> 
                            <p class="card-text"><span style="font-weight: bold;">Alamat Kontak Keluarga:</span> <span id="kontak_keluarga_alamat"></span></p>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('js/custom.js') }}"></script>
@endsection

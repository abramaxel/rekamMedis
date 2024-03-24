<!-- Tambahkan Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Tambahkan Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h2>Form Pengisian Data Rekam Medis</h2>
    <form>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" id="nama" placeholder="Masukkan nama pasien">
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir">
        </div>
        <div class="mb-3">
            <label for="diagnosis" class="form-label">Diagnosis</label>
            <textarea class="form-control" id="diagnosis" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection --}}

@extends('layouts.app')

@section('title', 'Pengisian Data Rekam Medis')

@section('content')
<div class="container">
    <h2>Form Pengisian Data Rekam Medis</h2>
    <form name="rekamMedis">
        <div class="card" id="card-kosong">
            <div class="card-body">
                <div class="card-body">
                    <p>Tabel Obat</p>
                    <table id="outputTabel">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>SKU</th>
                                <th>Label</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Isi tabel akan ditambahkan melalui JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
            <input type="text" class="form-control" id="no_rm" placeholder="Masukkan nomor rekam medis">
        </div>
        <div class="mb-3">
            <label for="keluhan" class="form-label">Keluhan</label>
            <textarea class="form-control" id="keluhan" rows="3"></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="tinggi" class="form-label">Tinggi Badan (cm)</label>
                <input type="number" class="form-control" id="tinggi">
            </div>
            <div class="col-md-6 mb-3">
                <label for="berat" class="form-label">Berat Badan (kg)</label>
                <input type="number" class="form-control" id="berat">
            </div>
        </div>
        <div class="mb-3">
            <label for="tensi" class="form-label">Tensi</label>
            <input type="text" class="form-control" id="tensi">
        </div>
        <div class="mb-3">
            <label for="dokter" class="form-label">Dokter</label>
            <input type="text" class="form-control" id="dokter" placeholder="Masukkan nama dokter">
        </div>
        <div class="mb-3">
            <label for="status_obat" class="form-label">Status Obat</label>
            <select class="form-select" id="status_obat">
                <option value="Belum Diberikan">Belum Diberikan</option>
                <option value="Sudah Diberikan">Sudah Diberikan</option>
            </select>
        </div>
        <button type="button" onclick="insertObat" btn btn-primary">Submit</button>
    </form>
</div>
@endsection


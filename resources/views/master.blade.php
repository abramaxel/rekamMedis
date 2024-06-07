@extends('layouts.app')

@section('title', 'Daftar Pasien')

@section('content')
<div class="container">
    <h2>Daftar Pasien</h2>
    <table class="table" id="outputTabelRM">
        <thead>
            <tr>
                <th scope="col">No. Rekam Medis</th>
                <th scope="col">Nama Pasien</th>
                <th scope="col">Tindakan</th>
                <th scope="col">Obat</th>
                <th scope="col">Riwayat</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data Pasien -->
            <!-- Data Obat akan diisi menggunakan JavaScript -->
        </tbody>
    </table>
</div>


@endsection

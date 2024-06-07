<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px; /* Lebar maksimal konten */
            margin: 0 auto; /* Membuat konten berada di tengah */
            padding: 20px; /* Ruang putih di sekitar konten */
        }
        table {
            width: 100%; /* Tabel mengisi lebar konten */
            border-collapse: collapse; /* Menghilangkan jarak antar sel tabel */
        }
        th, td {
            padding: 8px; /* Ruang putih di dalam sel tabel */
            text-align: left; /* Teks dalam sel tabel diatur kiri */
            vertical-align: top; /* Rata atas untuk kolom */
            border-bottom: 1px solid #ccc; /* Garis bawah untuk setiap sel tabel */
        }
        th {
            border-top: 1px solid #ccc; /* Garis atas untuk header tabel */
        }
        h4 {
            margin-top: 0; /* Menghilangkan margin atas dari judul */
        }
        hr {
            margin-top: 20px; /* Spasi sebelum garis */
            border: none;
            border-top: 1px solid #ccc; /* Garis tipis */
        }
        .info {
            margin-bottom: 5px; /* Spasi bawah */
            line-height: 1; /* Jarak antar baris yang lebih kecil */
            padding-left: 20px; /* Padding di sebelah kiri */
            text-align: center; /* Informasi rata tengah */
        }
        .info p {
            font-size: 12px; /* Ukuran font untuk informasi rumah sakit */
            margin: 5px 0; /* Spasi atas dan bawah */
        }
        .info-col {
            width: 40%; /* Lebar kolom informasi rumah sakit */
        }
        .spacer-col {
            width: 20%; /* Lebar kolom kosong yang lebih kecil */
        }
        .profile-section {
            margin-bottom: 20px; /* Menambah jarak antara profil dan tabel */
        }
        .profile-section label {
            display: inline-block; /* Menampilkan label sebagai blok */
            width: 150px; /* Lebar label */
        }
        .profile-section span {
            display: inline-block; /* Menampilkan setiap elemen sebagai blok */
            margin-bottom: 10px; /* Menambah jarak antara elemen */
        }
        @page {
            margin: 1in; /* Margin halaman untuk cetakan */
        }
        @media print {
            body {
                counter-reset: page; /* Inisialisasi penghitung halaman */
            }
            .page-number:after {
                content: "Page " counter(page); /* Menampilkan nomor halaman */
                counter-increment: page; /* Menambah nomor halaman */
            }
            .page-number {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Tabel untuk menyusun logo dan informasi rumah sakit -->
    <table>
        <tr>
            <td style="width: 20%;">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTP8VppAhS-l0_hhUtv_jWsuxeMQpd8qeFjzWSF8VuWTQ&s" alt="Logo" style="width: 100px;">
            </td>
            <td class="info info-col">
                <h4>Rumah Sakit XYZ</h4>
                <p>Alamat Rumah Sakit, Kota, Negara</p>
                <p>No. Telp: 123-456-7890</p>
                <p>Email: rs_xyz@example.com</p>
            </td>
            <td class="spacer-col"></td>
        </tr>
    </table>
    
    <!-- Garis setelah tabel logo -->

    <br>
    <!-- Profil Singkat -->
    <div class="profile-section">
        <label for="nama" style="vertical-align: top;">Nama:</label>
        <span id="nama" style="vertical-align: top;">{{ $nama }}</span><br>
        <label for="no_rm" style="vertical-align: top;">No. Rekam Medis:</label>
        <span id="no_rm" style="vertical-align: top;">{{ $no_rm }}</span>
    </div>
    

    <!-- Tabel untuk menampilkan riwayat rekam medis -->
    <div>
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Dokter</th>
                    <th>Keluhan</th>
                    <th>Obat</th>
                </tr>
               
            </thead>
            <tbody>
                @foreach($riwayat as $entry)
                    <tr>
                        <td>{{ $entry['tanggal'] }}</td>
                        <td>{{ $entry['dokter'] }}</td>
                        <td>{{ $entry['keluhan'] }}</td>
                        <td>
                            @if(is_array($entry['obat']))
                                @foreach($entry['obat'] as $obat)
                                    <div>{{ $obat }}</div>
                                @endforeach
                            @else
                                {{ $entry['obat'] }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
    <div class="page-number"></div>
</body>
</html>

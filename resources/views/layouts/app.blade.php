<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tambahkan Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan CSS kustom jika diperlukan -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <!-- Tambahkan Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<script type="text/javascript">
    function getRekamMedis() {
        // Buat XMLHttpRequest object
        let xhr = new XMLHttpRequest();

        // Configure: GET-request untuk URL /rekam-medis
        xhr.open('GET', 'http://localhost:8080/silk2024-slim-main/public/rekam-medis');

        // Kirim permintaan
        xhr.send();

        // Setelah respons diterima
        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 201) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let responseData = JSON.parse(xhr.responseText);
                let outputTabel = document.getElementById("outputTabelRM").querySelector("tbody");

                // Bersihkan isi tbody sebelum menambahkan data baru
                outputTabel.innerHTML = "";

                // Loop data dan tambahkan baris ke tabel
                responseData.forEach(function(data) {
                    let row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${data.no_rm}</td>
                        <td>${data.nama_pasien}<a href="/detail/${data.no_rm}"><i class="fas fa-info-circle"></i></a></td>  
                        <td>${data.deskripsi_tindakan}</td>
                        <td>${data.nama_obat}</td>
                    `;
                    outputTabel.appendChild(row);
                });
            }
        };
    }

    function loadDetailPasien(no_rm) {
    if (!no_rm) {
        alert('Nomor rekam medis tidak tersedia.');
        return;
    }
    // Memuat detail pasien berdasarkan nomor rekam medis
    getDetailPasien(no_rm);
}
function getDetailPasien(no_rm) {
    // Buat XMLHttpRequest hanya jika no_rm tersedia
    let xhr = new XMLHttpRequest();

    // Konfigurasikan permintaan
    xhr.open('GET', `http://localhost:8080/silk2024-slim-main/public/detail-pasien/${no_rm}`);
    xhr.send();

    // Callback ketika respon diterima
    xhr.onload = function() {
        if (xhr.status != 200 && xhr.status != 201) {
            alert(`Error ${xhr.status}: ${xhr.statusText}`);
        } else {
            let data = JSON.parse(xhr.responseText);
            displayData(data); // Memanggil fungsi untuk menampilkan data
        }
    };
}

function displayData(data) {
    // Ambil elemen table dan tbody dari tabel
    let table = document.getElementById("outputTableDetailPasien");
    let tbody = table.getElementsByTagName("tbody")[0];

    // Clear tbody sebelum menambahkan data baru
    tbody.innerHTML = "";

    // Buat elemen <tr> baru untuk data
    let row = document.createElement("tr");

    // Isi row dengan data dari respons
    row.innerHTML = `
        <td>${data.nama}</td>
        <td>${data.alamat}</td>
        <td>${data.no_hp}</td>
        <td>${data.jk}</td>
        <td>${data.nik}</td>
        <td>${data.no_rm}</td>
        <td>${data.tgl_lahir}</td>
        <td>${data.tempat_lahir}</td>
        <td>${data.gol_darah}</td>
        <td>${data.tinggi}</td>
        <td>${data.berat}</td>
        <td>${data.kontak_keluarga}</td>
        <td>${data.kontak_keluarga_hp}</td>
        <td>${data.kontak_keluarga_alamat}</td>
    `;

    // Tambahkan row ke tbody
    tbody.appendChild(row);

    // Periksa apakah header tabel sudah ada, jika tidak tambahkan
    if (!table.tHead) {
        // Buat elemen thead dan header untuk tabel
        let thead = document.createElement("thead");
        let headerRow = document.createElement("tr");

        // Isi header dengan teks untuk setiap kolom
        const headers = [
            "Nama", "Alamat", "No. HP", "Jenis Kelamin", "NIK",
            "No. Rekam Medis", "Tanggal Lahir", "Tempat Lahir",
            "Golongan Darah", "Tinggi Badan", "Berat Badan",
            "Kontak Keluarga", "No. HP Kontak Keluarga", "Alamat Kontak Keluarga"
        ];

        headers.forEach(headerText => {
            let header = document.createElement("th");
            header.textContent = headerText;
            headerRow.appendChild(header);
        });

        // Tambahkan baris header ke dalam thead
        thead.appendChild(headerRow);

        // Tambahkan thead ke dalam tabel
        table.appendChild(thead);
    }
}


window.onload = function() {
    // Memeriksa apakah URL saat ini adalah halaman /master
    if (window.location.pathname === '/master') {
        getRekamMedis();
    }

    // Memeriksa apakah URL saat ini adalah halaman /detail
    if (window.location.pathname.includes('/detail')) {
        // Mendapatkan nomor rekam medis dari URL
        const no_rm = window.location.pathname.split('/').pop();
        if (no_rm) {
            // Memuat detail pasien berdasarkan nomor rekam medis
            loadDetailPasien(no_rm);
        } else {
            alert('Nomor rekam medis tidak tersedia.');
        }
    }
};



</script>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">RS Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/rekam-medis">Pengisian Rekam Medis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/master">Daftar Pasien</a>
                        </li>
                        <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-4">
            @yield('content')
        </div>

        <!-- Tambahkan Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Tambahkan JS kustom jika diperlukan -->
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
    </html>

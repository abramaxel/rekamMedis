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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" rel="stylesheet">
</head>

<script type="text/javascript">

    function getRekamMedis() {
        // Buat XMLHttpRequest object
        let xhr = new XMLHttpRequest();

        // Configure: GET-request untuk URL /rekam-medis
        xhr.open('GET', 'http://localhost:8080/silk2024-slim/public/rekam-medis');

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
                        <td><button onclick="navigateToRiwayat('${data.no_rm}')"><i class="fas fa-history"></i></button></td>
                    `;
                    outputTabel.appendChild(row);
                });
            }
        };
    }
    function searchPasien() {
    // Mendapatkan nilai input pencarian
    let input = document.getElementById("searchInput").value.toUpperCase();

    // Mendapatkan semua baris dalam tabel hasil pencarian rekam medis
    let rows = document.getElementById("outputTabelRM").querySelectorAll("tbody tr");

    // Loop melalui setiap baris dan sembunyikan yang tidak cocok dengan pencarian
    rows.forEach(function(row) {
        let nama = row.getElementsByTagName("td")[1].textContent.toUpperCase();
        let noRm = row.getElementsByTagName("td")[0].textContent.toUpperCase();
        if (nama.includes(input) || noRm.includes(input)) {
            row.style.display = ""; // Tampilkan baris jika cocok dengan pencarian
        } else {
            row.style.display = "none"; // Sembunyikan baris jika tidak cocok dengan pencarian
        }
    });
}
    


    // Fungsi untuk menavigasi ke halaman riwayat dengan membawa nomor rekam medis
    function navigateToRiwayat(no_rm) {
        window.location.href = '/riwayat/' + encodeURIComponent(no_rm);
    }

    // Fungsi untuk menavigasi ke halaman pembuatan PDF riwayat
    function navigateToGeneratePdf(no_rm) {
        window.location.href = '/riwayat/' + encodeURIComponent(no_rm) + '/pdf';
    }


    function loadRiwayat(no_rm) {
        if (!no_rm) {
            alert('Nomor rekam medis tidak tersedia.');
            return;
        }
        // Memuat detail pasien berdasarkan nomor rekam medis
        getProfil(no_rm);
        getRiwayat(no_rm);
    }


        // Fungsi untuk memuat profil pasien berdasarkan nomor rekam medis yang didapat dari URL
    function getProfil(no_rm) {

        // Buat XMLHttpRequest dengan nomor rekam medis dari URL
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/silk2024-slim/public/detail-pasien/${no_rm}`);
        xhr.send();

        // Callback ketika respon diterima
        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 201) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let data = JSON.parse(xhr.responseText);
                displayProfil(data); // Memanggil fungsi untuk menampilkan data
            }
        };
    }

        // Fungsi untuk menampilkan data pasien di halaman riwayat
    function displayProfil(data) {
        // Periksa apakah data tidak kosong
        if (!data || !data.nama || !data.no_rm) {
            alert('Data pasien tidak lengkap atau tidak ditemukan.');
            return;
        }

        // Temukan elemen-elemen di halaman untuk menampilkan informasi berdasarkan ID
        let namaElement = document.getElementById('nama');
        let noRmElement = document.getElementById('no_rm');

        // Perbarui teks di elemen-elemen tersebut dengan informasi dari data
        if (namaElement) {
            namaElement.textContent = data.nama;
        }
        if (noRmElement) {
            noRmElement.textContent = data.no_rm;
        }
    }

    function getRiwayat(no_rm) {

        // Buat XMLHttpRequest dengan nomor rekam medis dari URL
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `http://localhost:8080/silk2024-slim/public/riwayat/${no_rm}`);
        xhr.send();

        // Callback ketika respon diterima
        xhr.onload = function() {
            if (xhr.status != 200 && xhr.status != 201) {
                alert(`Error ${xhr.status}: ${xhr.statusText}`);
            } else {
                let data = JSON.parse(xhr.responseText);
                displayRiwayat(data); // Memanggil fungsi untuk menampilkan data
            }
        };
    }

   // Fungsi untuk menampilkan riwayat rekam medis dalam tabel
function displayRiwayat(data) {
    // Temukan elemen tbody di dalam tabel untuk menambahkan baris data
    let tbody = document.getElementById('riwayat-body');

    // Kosongkan isi dari tbody untuk menghapus riwayat sebelumnya (jika ada)
    tbody.innerHTML = '';

    // Loop melalui setiap entri dalam data riwayat dan tambahkan baris ke tabel
    data.forEach(function(entry) {
        // Buat elemen tr untuk setiap entri
        let row = document.createElement('tr');

        // Buat sel untuk setiap kolom dalam entri
        let tanggalCell = document.createElement('td');
        tanggalCell.textContent = entry.tanggal;
        let dokterCell = document.createElement('td');
        dokterCell.textContent = entry.dokter;
        let tindakanCell = document.createElement('td');
        tindakanCell.textContent = entry.keluhan;
        let obatCell = document.createElement('td');

        // Cek apakah entry.obat adalah array
        if (Array.isArray(entry.obat)) {
            entry.obat.forEach(function(obat) {
                let div = document.createElement('div');
                div.textContent = obat;
                obatCell.appendChild(div);
            });
        } else {
            obatCell.textContent = entry.obat;
        }

        // Tambahkan sel ke baris
        row.appendChild(tanggalCell);
        row.appendChild(dokterCell);
        row.appendChild(tindakanCell);
        row.appendChild(obatCell);

        // Tambahkan baris ke tbody
        tbody.appendChild(row);
    });
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
        xhr.open('GET', `http://localhost:8080/silk2024-slim/public/detail-pasien/${no_rm}`);
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
    // Memasukkan data ke dalam elemen dengan ID yang sesuai
    document.getElementById("nama").textContent = data.nama;
    document.getElementById("alamat").textContent = data.alamat;
    document.getElementById("no_hp").textContent = data.no_hp;
    document.getElementById("jk").textContent = data.jk;
    document.getElementById("nik").textContent = data.nik;
    document.getElementById("no_rm").textContent = data.no_rm;
    document.getElementById("tgl_lahir").textContent = data.tgl_lahir;
    document.getElementById("tempat_lahir").textContent = data.tempat_lahir;
    document.getElementById("gol_darah").textContent = data.gol_darah;
    document.getElementById("tinggi").textContent = data.tinggi;
    document.getElementById("berat").textContent = data.berat;
    document.getElementById("kontak_keluarga").textContent = data.kontak_keluarga;
    document.getElementById("kontak_keluarga_hp").textContent = data.kontak_keluarga_hp;
    document.getElementById("kontak_keluarga_alamat").textContent = data.kontak_keluarga_alamat;

    // Memanggil fungsi untuk membuat card pertama
    let card1 = createCard("Informasi Dasar", [
        { label: "Nama", value: data.nama },
        { label: "Alamat", value: data.alamat },
        { label: "No. HP", value: data.no_hp }
    ]); 
    
    // Memanggil fungsi untuk membuat card kedua
    let card2 = createCard("Informasi Detail", [
        { label: "Jenis Kelamin", value: data.jk },
        { label: "NIK", value: data.nik },
        { label: "No. Rekam Medis", value: data.no_rm },
        { label: "Tanggal Lahir", value: data.tgl_lahir },
        { label: "Tempat Lahir", value: data.tempat_lahir },
        { label: "Golongan Darah", value: data.gol_darah },
        { label: "Tinggi Badan", value: data.tinggi },
        { label: "Berat Badan", value: data.berat },
        { label: "Kontak Keluarga", value: data.kontak_keluarga },
        { label: "No. HP Kontak Keluarga", value: data.kontak_keluarga_hp },
        { label: "Alamat Kontak Keluarga", value: data.kontak_keluarga_alamat }
    ]);

    // Mengambil elemen untuk memasukkan card
    let cardContainer1 = document.getElementById("cardContainer1");
    let cardContainer2 = document.getElementById("cardContainer2");
    
    // Menghapus semua isi sebelumnya dari container
    cardContainer1.innerHTML = "";
    cardContainer2.innerHTML = "";

    // Menambahkan card pertama dan card kedua ke dalam container
    cardContainer1.appendChild(card1);
    cardContainer2.appendChild(card2);
}



window.onload = function() {
    // Memeriksa apakah URL saat ini adalah halaman /master
    if (window.location.pathname === '/master') {
        getRekamMedis();
        searchPasien();
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
        // Memeriksa apakah URL saat ini adalah halaman /riwayat
    if (window.location.pathname.includes('/riwayat')) {
        // Mendapatkan nomor rekam medis dari URL
        const no_rm = window.location.pathname.split('/').pop();
        if (no_rm) {
            // Memuat riwayat berdasarkan nomor rekam medis
            loadRiwayat(no_rm);
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
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="/rekam-medis">Pengisian Rekam Medis</a>
                        </li> --}}
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

    
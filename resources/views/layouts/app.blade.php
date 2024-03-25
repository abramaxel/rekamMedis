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
</head>
<script type="text/javascript">
        
        function getObat(){
            // 1. Create a new XMLHttpRequest object
            let xhr = new XMLHttpRequest();

            // 2. Configure it: GET-request for the URL /article/.../load
            xhr.open('GET', 'http://localhost:8080/silk2024-slim-main/public/obat');

            // 3. Send the request over the network
            xhr.send();

            // 4. This will be called after the response is received
                        xhr.onload = function() {
                    if (xhr.status != 200 && xhr.status != 201) { // Fix logical operator here
                        alert(`Error ${xhr.status}: ${xhr.statusText}`); // e.g. 404: Not Found
                    } else { // show the result
                        // alert(`Done, got ${xhr.response.length} bytes`);
                        // alert(xhr.responseText); // response is the server response
                        // document.getElementById("card-kosong").innerHTML = xhr.responseText;
                        let responseData = JSON.parse(xhr.responseText);
                        let outputTabel = document.getElementById("outputTabel");
                        let tbody = outputTabel.querySelector("tbody");

                        // Bersihkan isi tbody sebelum menambahkan data baru
                        tbody.innerHTML = "";

                        // Loop melalui data dan tambahkan baris-baris baru ke dalam tabel
                        responseData.forEach(function(data) {
                            let row = document.createElement("tr");
                            row.innerHTML = `
                                <td>${data.id}</td>
                                <td>${data.sku}</td>
                                <td>${data.label_catatan}</td>
                                <td>${data.jumlah}</td>
                            `;
                            tbody.appendChild(row);
                        }); 
                                    }
                };

            xhr.onerror = function() {
            alert("Request failed");
            };
        }

        function insertRekamMedis(){
        // Mengambil data dari form atau dari input pengguna
        let data = {
            // Misalnya, jika Anda memiliki input dengan id 'inputId', Anda bisa mengambil nilai seperti ini:
            id: document.getElementById('inputId').value,
            sku: document.getElementById('inputSku').value,
            label_catatan: document.getElementById('inputLabelCatatan').value,
            jumlah: document.getElementById('inputJumlah').value
        };

        // Mengirim data ke server menggunakan XMLHttpRequest atau fetch API
        // Pastikan untuk mengatur method, url, dan data yang akan dikirim sesuai dengan kebutuhan Anda
        // Anda juga harus menangani respon dari server, misalnya menampilkan pesan sukses atau gagal
        let xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost:8080/silk2024-slim-main/public/obat');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send(JSON.stringify(data));

        xhr.onload = function() {
            if (xhr.status === 200 || xhr.status === 201) {
                alert('Data rekam medis berhasil ditambahkan!');
                // Jika Anda ingin melakukan sesuatu setelah berhasil menambahkan data, Anda bisa menambahkannya di sini
            } else {
                alert('Terjadi kesalahan saat menambahkan data rekam medis.');
            }
        };

        xhr.onerror = function() {
            alert("Request failed");
        };
    }

        function updateRekamMedis(id){
            // Mendapatkan data yang ingin diupdate, mungkin dengan menampilkan form dengan data yang sudah ada
            // Kemudian, setelah pengguna mengubah data dan menekan tombol update, Anda dapat mengirim data tersebut ke server untuk diupdate
            // Pastikan untuk menangani respon dari server, misalnya menampilkan pesan sukses atau gagal
            let dataToUpdate = {
                id: id,
                // Misalnya, jika Anda memiliki input dengan id 'inputIdUpdate', Anda bisa mengambil nilai seperti ini:
                sku: document.getElementById('inputSkuUpdate').value,
                label_catatan: document.getElementById('inputLabelCatatanUpdate').value,
                jumlah: document.getElementById('inputJumlahUpdate').value
            };

            let xhr = new XMLHttpRequest();
            xhr.open('PUT', 'http://localhost:8080/silk2024-slim-main/public/obat/' + id);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.send(JSON.stringify(dataToUpdate));

            xhr.onload = function() {
                if (xhr.status === 200 || xhr.status === 201) {
                    alert('Data rekam medis berhasil diupdate!');
                    // Jika Anda ingin melakukan sesuatu setelah berhasil mengupdate data, Anda bisa menambahkannya di sini
                } else {
                    alert('Terjadi kesalahan saat mengupdate data rekam medis.');
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }

        function deleteRekamMedis(id){
            // Mengirim request ke server untuk menghapus data rekam medis dengan id tertentu
            // Pastikan untuk menangani respon dari server, misalnya menampilkan pesan sukses atau gagal
            let xhr = new XMLHttpRequest();
            xhr.open('DELETE', 'http://localhost:8080/silk2024-slim-main/public/obat/' + id);
            xhr.send();

            xhr.onload = function() {
                if (xhr.status === 200 || xhr.status === 204) {
                    alert('Data rekam medis berhasil dihapus!');
                    // Jika Anda ingin melakukan sesuatu setelah berhasil menghapus data, Anda bisa menambahkannya di sini
                } else {
                    alert('Terjadi kesalahan saat menghapus data rekam medis.');
                }
            };

            xhr.onerror = function() {
                alert("Request failed");
            };
        }

        window.onload = getObat;   
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

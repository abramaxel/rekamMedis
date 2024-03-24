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

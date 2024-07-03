<?php 
session_start(); // Memulai sesi PHP untuk menyimpan data antar halaman
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Mengimpor library JavaScript untuk scanning QR code dan lainnya -->
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Mengimpor CSS untuk styling halaman -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .bright-green {
            font-family: "Times New Roman", Times, serif;
            background-color: #00FF00;
            color: #000000;
        }
        .btn-light-blue {
            background-color: rgba(54, 162, 235, 0.2);
            color: #000000;
        }
        .heading {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .heading h1 {
            font-family: "Times New Roman", Times, serif;
            background-color: #e0e0e0;
            padding: 10px;
            border-radius: 5px;
            display: inline-block;
        }
        .subheading {
            font-family: "Times New Roman", Times, serif;
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color:  #e0e0e0; /* Warna abu rokok */
            padding: 10px;
            border-radius: 5px;
        }
        .custom-label {
            font-family: "Times New Roman", Times, serif;
        }
        .gif-container {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .gif-container img {
            max-width: 100%; /* Memastikan gambar GIF tidak melewati batas kontainer */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="heading">
            <h1>Sistem Log Pengunjung Perpustakaan IT Del</h1>
        </div>
        <div class="gif-container">
            <!--<img src="../image/qrcode.gif" alt="Loading GIF">-->
        </div>
        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video> <!-- Video untuk menampilkan preview kamera -->

                <?php
                    if(isset($_SESSION['error'])){ // Memeriksa apakah ada pesan error di sesi
                        echo "
                        <div class='alert alert-danger'>
                            <h4>Warning!</h4>
                            ".$_SESSION['error']."
                        </div>
                        ";
                        unset($_SESSION['error']); // Menghapus pesan error setelah ditampilkan
                    }

                    if(isset($_SESSION['success'])){ // Memeriksa apakah ada pesan sukses di sesi
                        echo "
                        <div class='alert alert-success bright-green'>
                            <h4>Success!</h4>
                            ".$_SESSION['success']."
                        </div>
                        ";
                        unset($_SESSION['success']); // Menghapus pesan sukses setelah ditampilkan
                    }
                ?>
            </div>
            <div class="col-md-6">
                <form action="koneksii.php" method="post" class="form-horizontal">
                <label class="custom-label">SCAN QR CODE PENGUNJUNG PERPUSTAKAAN</label>
                    <input type="text" name="nim" id="nim" readonly placeholder="scan qrcode" class="form-control"> <!-- Input untuk NIM yang diisi otomatis -->
                </form>
                <!-- Memindahkan tag table ke dalam form -->
                <form action="index.php" method="post" class="form-horizontal">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>ID Log</td>
                                <td>NIM/NIK</td>
                                <td>Status Pengunjung</td> <!-- Kolom untuk Nama Status -->
                                <td>Nama</td>
                                <td>Foto</td>
                                <td>Waktu Masuk</td>
                                <td>Waktu Keluar</td>
                                <td>Tanggal</td>
                                <td>Status Log</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            $server = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "apk_perpusdel";
                        
                            $conn = new mysqli($server, $username, $password, $dbname); // Membuat koneksi ke database
                            
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error); // Menangani kesalahan koneksi
                            }
                            
                            $sql = "SELECT log_pengunjung.id_log, tbl_pengunjung.nim, status_pengunjung.nama_status, tbl_pengunjung.nama, tbl_pengunjung.foto, log_pengunjung.log_masuk, log_pengunjung.log_keluar, log_pengunjung.tanggal_log, log_pengunjung.statuss 
                                    FROM log_pengunjung 
                                    JOIN tbl_pengunjung ON log_pengunjung.id = tbl_pengunjung.id
                                    JOIN status_pengunjung ON log_pengunjung.id_status = status_pengunjung.id_status
                                    WHERE DATE(log_pengunjung.log_masuk) = CURDATE()
                                    ORDER BY log_pengunjung.id_log DESC"; // Query untuk mendapatkan log pengunjung hari ini
                            $query = $conn->query($sql);

                            $rows = array();
                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    $rows[] = $row;
                                }
                                $count = 0;
                                foreach ($rows as $row) {
                                    $count++;
                                    $row_class = $count > 5 ? 'class="more-rows" style="display: none;"' : ''; // Menyembunyikan baris lebih dari 5
                                    echo "<tr $row_class>";
                                    echo "<td>" . $row['id_log'] . "</td>";
                                    echo "<td>" . $row['nim'] . "</td>";
                                    echo "<td>" . $row['nama_status'] . "</td>"; // Menampilkan nama status
                                    echo "<td>" . $row['nama'] . "</td>";
                                    echo "<td><img src='../image/" . $row['foto'] . "' alt='Foto Pengunjung' width='50' height='50'></td>";
                                    echo "<td>" . $row['log_masuk'] . "</td>";
                                    echo "<td>" . $row['log_keluar'] . "</td>";
                                    echo "<td>" . $row['tanggal_log'] . "</td>";
                                    echo "<td>" . $row['statuss'] . "</td>";
                                    echo "</tr>";
                                }
                                if ($count > 5) {
                                    echo "<tr id='show-more-row'>";
                                    echo "<td colspan='9'><button id='show-more-btn' type='button' class='btn btn-primary' style='font-family: \"Times New Roman\", Times, serif;'>Lihat Keseluruhan</button></td>";
                                    echo "</tr>";
                                    echo "<tr id='show-less-row' style='display: none;'>";
                                    echo "<td colspan='9'><button id='show-less-btn' type='button' class='btn btn-light-blue' style='font-family: \"Times New Roman\", Times, serif;'>Lihat Lebih Sedikit</button></td>";
                                    
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No records found for today.</td></tr>"; // Pesan jika tidak ada log hari ini
                            }

                            $sql = "SELECT tbl_pengunjung.nim, tbl_pengunjung.nama, COUNT(log_pengunjung.id_log) as jumlah_kunjungan
                                    FROM log_pengunjung
                                    JOIN tbl_pengunjung ON log_pengunjung.id = tbl_pengunjung.id
                                    GROUP BY tbl_pengunjung.nim, tbl_pengunjung.nama
                                    ORDER BY jumlah_kunjungan DESC"; // Query untuk mendapatkan jumlah kunjungan per pengunjung
                            $query = $conn->query($sql);

                            $pengunjung = array();
                            $jumlah_kunjungan = array();

                            if ($query->num_rows > 0) {
                                while ($row = $query->fetch_assoc()) {
                                    $pengunjung[] = $row['nama'];
                                    $jumlah_kunjungan[] = $row['jumlah_kunjungan'];
                                }
                            } else {
                                echo "No records found"; // Pesan jika tidak ada catatan kunjungan
                            }

                            $conn->close(); // Menutup koneksi database
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
        <div class="row subheading">
            <h2>Grafik Pengunjung</h2><br>
            <h3>Lima Pengunjung dengan Kunjungan Terbanyak</h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <canvas id="kunjunganChart"></canvas><br> <!-- Kanvas untuk menampilkan grafik -->
                <br><br><br>
            </div>
        </div>
    </div>
    <!-- Audio untuk memainkan suara beep -->
    <audio id="beepAudio" src="audio/beep.mp3" preload="auto" controls></audio>

    <script>//QR code dibaca menggunakan Instascan.Scanner pada elemen video dengan id 'preview'. 
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') }); // Membuat scanner untuk membaca QR code
        Instascan.Camera.getCameras().then(function(cameras) {//pemeriksaan kamera, ini memeriksa apakah ada kamera yang tersedia pada perangkat
            if (cameras.length > 0) {
                scanner.start(cameras[0]); // Memulai scanner dengan kamera pertama yang ditemukan
            } else {
                alert('No cameras found'); // Pesan jika tidak ada kamera yang ditemukan
            }
        }).catch(function(e) {
            console.error(e); // Menangani kesalahan saat mencari kamera
        });
        //Saat QR code terbaca, kontennya akan ditampilkan di elemen dengan ID 'nim'.
        scanner.addListener('scan', function(content) {//Ketika QR code terbaca, kontennya ditangkap (content) dan digunakan untuk mengisi nilai input dengan id 'nim'. Kemudian, form secara otomatis dikirimkan (submit()), dan suara beep diputar sebagai umpan balik.
            document.getElementById('nim').value = content; // Mengisi input dengan hasil scan
            document.forms[0].submit(); // Mengirim form secara otomatis
            playBeepSound(); // Memainkan suara beep
        });
     // Fungsi untuk memainkan suara beep    
    function playBeepSound() {
        var audio = document.getElementById('beepAudio');  // Mendapatkan elemen audio dengan id 'beepAudio'
        audio.play();  // Memainkan suara
    }

        const pengunjung = <?php echo json_encode($pengunjung); ?>; // Mengambil data pengunjung dari PHP
        const jumlah_kunjungan = <?php echo json_encode($jumlah_kunjungan); ?>; // Mengambil data jumlah kunjungan dari PHP
        
        const data = {
            labels: pengunjung.slice(0, 5), // Menampilkan 5 pengunjung pertama
            datasets: [{
                label: 'Jumlah Kunjungan',
                data: jumlah_kunjungan.slice(0, 5), // Menampilkan jumlah kunjungan untuk 5 pengunjung pertama
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        };
        
        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Memulai skala Y dari nol
                    }
                }
            }
        };
        
        const kunjunganChart = new Chart(
            document.getElementById('kunjunganChart'), // Membuat chart dengan elemen kanvas
            config
        );
    </script>
</body>
</html>

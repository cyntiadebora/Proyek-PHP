<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah admin
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'Admin') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}
// Memasukkan file function.php untuk menggunakan fungsi-fungsi yang didefinisikan di sana
require '../function.php'; // Akses ke function.php di folder pa2
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Statistik Chart</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Custom CSS -->
    <style>
        .navbar-dark-blue {
            background-color: #001f3f !important; /* Dark Blue */
        }
        .sb-sidenav-dark-blue {
            background-color: #001f3f !important; /* Dark Blue */
        }
        .sb-sidenav-dark-blue .nav-link,
        .sb-sidenav-dark-blue .sb-sidenav-menu-heading,
        .sb-sidenav-dark-blue .sb-sidenav-menu-nested .nav-link {
            color: #ffffff !important; /* White */
        }
        .sb-sidenav-dark-blue .sb-nav-link-icon {
            color: #ffffff !important; /* White */
        }
        .nav-link:hover {
            background-color: #004080 !important; /* Hover effect for nav links */
        }
        .sb-sidenav-footer{
                color: white;
        }
    </style>
</head>
<body class="sb-nav-fixed" class="sb-nav-fixed" style="background-color: #F0F0F0;">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-dark-blue" style="font-family: 'Times New Roman', Times, serif;">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">Del Library</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="../index.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark-blue" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="font-family: 'Times New Roman', Times, serif;">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Data</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Pengunjung
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="form-daftar.php">Daftar Anggota Baru</a>
                                <a class="nav-link" href="tambah-pengunjung.php">Daftar Seluruh Anggota</a>
                                <a class="nav-link" href="validasi.php">Validasi Pendaftaran Anggota</a> <!-- Tambahkan ini -->
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Statistik Pengunjung</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts 
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables 
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer" style="font-family: 'Times New Roman', Times, serif;">
                    <div class="small"></div>
                    Staff Perpustakaan
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4" style="font-family: 'Times New Roman', Times, serif;">
                    <h2 class="mt-4 judul-halaman">Grafik Keseluruhan Pengunjung</h2>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Charts</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                           Berikut ini adalah grafik pengunjung perpustakaan Institut Teknologi Del. 
                            <a target="_blank" href="tables.php">Lihat tabel!</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid px-4" style="font-family: 'Times New Roman', Times, serif;">
                    <h2 class="text-center">Grafik Pengunjung</h2>
                    <div style="width: 80%; margin: auto;">
                        <canvas id="grafik"></canvas>
                        <br>
                        <h5>Gunakan filter di bawah ini untuk melihat grafik pengunjung berdasarkan bulan tertentu!</h5>
                        <input onchange="filterData()" type="month" id="monthFilter">
                    </div>
                </div>
                <script>
                    async function fetchData(month = '') {
                        const response = await fetch('get_data.php?month=' + month);
                        const result = await response.json();
                        return result;
                    }

                    let myChart;

                    fetchData().then(result => {
                        const ctx = document.getElementById('grafik').getContext('2d'); // Mendapatkan konteks canvas
                        myChart = new Chart(ctx, { // Membuat chart baru
                            type: 'bar', // Jenis chart: bar
                            data: {
                                labels: result.labels, // Label chart
                                datasets: [{
                                    label: 'Jumlah Pengunjung',
                                    data: result.counts, // Data chart
                                    backgroundColor: [ // Warna background bar
                                        'rgba(63, 81, 181, 0.9)', // Biru tua
                                        'rgba(33, 150, 243, 0.9)', // Biru cerah
                                        'rgba(156, 39, 176, 0.9)', // Ungu tua
                                        'rgba(255, 152, 0, 0.9)', // Oranye
                                        'rgba(76, 175, 80, 0.9)', // Hijau tua
                                        'rgba(255, 87, 34, 0.9)', // Merah oranye
                                        'rgba(255, 193, 7, 0.9)', // Kuning
                                        'rgba(121, 85, 72, 0.9)', // Coklat tua
                                        'rgba(255, 235, 59, 0.9)', // Kuning cerah
                                        'rgba(255, 152, 0, 0.9)'   // Oranye
                                    ],
                                    borderColor: [
                                        'rgba(63, 81, 181, 0.9)', // Biru tua
                                        'rgba(33, 150, 243, 0.9)', // Biru cerah
                                        'rgba(156, 39, 176, 0.9)', // Ungu tua
                                        'rgba(255, 152, 0, 0.9)', // Oranye
                                        'rgba(76, 175, 80, 0.9)', // Hijau tua
                                        'rgba(255, 87, 34, 0.9)', // Merah oranye
                                        'rgba(255, 193, 7, 0.9)', // Kuning
                                        'rgba(121, 85, 72, 0.9)', // Coklat tua
                                        'rgba(255, 235, 59, 0.9)', // Kuning cerah
                                        'rgba(255, 152, 0, 0.9)'   // Oranye
                                    ],
                                    borderWidth: 1 // Lebar border
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true // Mulai skala y dari 0
                                    }
                                }
                            }
                        });
                    });

                    function filterData() {
                        const month = document.getElementById('monthFilter').value; // Mendapatkan nilai filter bulan
                        fetchData(month).then(result => { // Fetch data berdasarkan bulan
                            myChart.data.labels = result.labels; // Update label chart
                            myChart.data.datasets[0].data = result.counts; // Update data chart
                            myChart.update(); // Update chart
                        });
                    }
                </script>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted" style="font-family: 'Times New Roman', Times, serif;">Copyright &copy; Kelompok 7 PA 2 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="assets/demo/chart-pie-demo.js"></script>
</body>
</html>
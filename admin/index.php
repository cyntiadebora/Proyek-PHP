<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah admin
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'Admin') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

require '../function.php'; // Akses ke function.php di folder pa2

$nama_pengguna = $_SESSION['nama_pengguna']; // Ambil nama pengguna dari sesi
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard Staff Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            #chartContainer {
                width: 100% !important;
                height: 100vh !important;
            }
            .full-screen-chart {
                position: relative;
                width: 100%;
                height: 100%;
                background-color: white;
            }
            .navbar-dark-blue {
                background-color: #001f3f !important; /* Dark Blue */
            }
            .sb-sidenav-dark-blue {
                background-color: #001f3f !important; /* Dark Blue */
            }
            .sb-sidenav-dark-blue .nav-link,
            .sb-sidenav-dark-blue .sb-sidenav-menu-heading,
            .sb-sidenav-dark-blue .sb-sidenav-menu-nested .nav-link {
                color: #ffffff !important; /* Putih */
            }
            .sb-sidenav-dark-blue .sb-nav-link-icon {
                color: #ffffff !important; /* Putih */
            }
            .sb-sidenav-dark-blue .nav-link:hover {
                color: #d3d3d3 !important; /* Light Gray */
            }
            .sb-sidenav-footer {
                color: white;
            }
           
        </style>
    </head>
    <body class="sb-nav-fixed" style="background-color: #F0F0F0;">
        <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-dark-blue">
            <a class="navbar-brand ps-3" href="index.php" style="font-family: 'Times New Roman', Times, serif;">Del Library</a>
            <!--<a class="navbar-brand ps-3" href="index.php" style="font-family: 'Times New Roman', Times, serif;">
            <img src="assets/img/del.png" alt="Logo" style="height: 50px; margin-right: 50px;"> Del Library
            </a> --> 
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" style="font-family: 'Times New Roman', Times, serif;" href="../index.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark-blue" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav" style="font-family: 'Times New Roman', Times, serif;">
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
                    <div class="container-fluid px-4" style="background-color: #f2f2f2; font-family: 'Times New Roman', Times, serif;">
                        <h1 class="mt-4" style="font-family: 'Times New Roman', Times, serif;">Dashboard Staff Perpustakaan</h1>
                        <h4>Selamat datang, <?php echo $_SESSION['nama_pengguna']; ?>!</h4>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active" style="font-family: 'Times New Roman', Times, serif;">Dashboard</li>
                        </ol>
                        <div class="row">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <div class="card-header" style="font-family: 'Times New Roman', Times, serif;">
                                        <i class="fas fa-chart-area me-1"></i>
                                        Statistik Pengunjung Hari Ini
                                    </div>
                                    <div class="card-body full-screen-chart">
                                        <canvas id="chartContainer"></canvas>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                fetch('fetch_data.php')
                    .then(response => response.json())
                    .then(result => {
                        const ctx = document.getElementById('chartContainer').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: result.labels,
                                datasets: result.datasets.map((dataset, index) => ({
                                    label: dataset.label,
                                    data: dataset.data,
                                    backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`,
                                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                                    borderWidth: 1
                                }))
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                title: {
                                    display: true,
                                    //text: 'Statistik Pengunjung Hari Ini' // Judul grafik
                                }
                            }
                        });
                    });
            });
        </script>
         <script>
            document.addEventListener('DOMContentLoaded', function () {
                fetch('fetch_data.php')
                    .then(response => response.json())
                    .then(result => {
                        const ctx = document.getElementById('chartContainer').getContext('2d');
                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: result.labels,
                                datasets: result.datasets.map((dataset, index) => ({
                                    label: dataset.label,
                                    data: dataset.data,
                                    backgroundColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.6)`,
                                    borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`,
                                    borderWidth: 1
                                }))
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                },
                                title: {
                                    display: true,
                                    //text: 'Statistik Pengunjung Hari Ini' // Judul grafik
                                }
                            }
                        });
                    });
            });
        </script>
    </body>
</html>

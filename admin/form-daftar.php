<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah admin
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'Admin') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Periksa apakah file function.php ada
if (file_exists('../function.php')) {
    require '../function.php';
} else {
    die('File function.php tidak ditemukan.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Daftar Anggota Baru</title>
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
        .custom-table {
            background-color: #d3d3d3 !important; /* Light Grey */
            color: #333 !important; /* Dark Font Color */
        }
        .custom-table th, .custom-table td {
            border-color: #d3d3d3 !important;
        }
        .btn-custom-simpan {
            background-color: #28a745 !important; /* Bright Green */
            border-color: #28a745 !important;
            color: white !important;
        }
        .btn-custom-simpan:hover {
            background-color: #218838 !important;
            border-color: #1e7e34 !important;
        }
        .btn-custom-batal {
            background-color: #dc3545 !important; /* Bright Red */
            border-color: #dc3545 !important;
            color: white !important;
        }
        .btn-custom-batal:hover {
            background-color: #c82333 !important;
            border-color: #bd2130 !important;
        }
        .sb-sidenav-footer {
                color: white;
            }
    </style>
</head>

<body class="sb-nav-fixed" style="background-color: #F0F0F0;">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-dark-blue"style="font-family: 'Times New Roman', Times, serif;">
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
                <div class="sb-sidenav-menu">
                    <div class="nav"style="font-family: 'Times New Roman', Times, serif;">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="font-family: 'Times New Roman', Times, serif;"></i></div>
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
                                <a class="nav-link" href="form-daftar.php">Daftar Anggota Baru </a>
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
                <div class="container-fluid px-4">
                <h2 class="mt-4 judul-halaman"style="font-family: 'Times New Roman', Times, serif;">Tambah Anggota Baru</h2>
                    <ol class="breadcrumb mb=4">
                        <li class="breadcrumb-item"><a href="index.php" style="font-family: 'Times New Roman', Times, serif;"  style="color: #007bff;">Dashboard</a></li>
                        <li class="breadcrumb-item active"  style="font-family: 'Times New Roman', Times, serif;">Tambah Anggota Baru</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <p class="mb-5" style="font-family: 'Times New Roman', Times, serif;">Isi formulir berikut untuk menambahkan anggota baru!</p>
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <?php
                                    include "koneksi.php";
                                    $view = $_GET['view'] ?? '';
                                    if ($view == 'tambah') {
                                        include "data_pengunjung.php";
                                    }
                                    ?>
                                    <div class="panel-body" style="font-family: 'Times New Roman', Times, serif;">
                                        <form method="post" action="aksi_pengunjung.php?act=insert" enctype="multipart/form-data">
                                            <table class="table custom-table">
                                                <tr>
                                                    <td width="160">NIM/NIK</td>
                                                    <td>
                                                        <div class="col-md-4"><input class="form-control" type="text" name="nim" required /></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width='200'>Foto</td>
                                                    <td><div class="col-md-6"><input type="file" name="upload_gambar" id="upload_gambar" /></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td><div class="col-md-6"><input class="form-control" type="text" name="nama" required /></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Status</td>
                                                    <td>
                                                        <div class="col-md-6">
                                                            <select class="form-control" name="id_status">
                                                                <option>Pilih Status Pengunjung</option>
                                                                <?php
                                                                $query = mysqli_query($konek, "SELECT * FROM status_pengunjung") or die(mysqli_error($konek));
                                                                while ($d = mysqli_fetch_array($query)) {
                                                                    echo "<option value=$d[id_status]> $d[nama_status] </option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal Menjadi Anggota</td>
                                                    <td><div class="col-md-4"><input class="form-control" type="date" name="tgl" required /></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Alamat</td>
                                                    <td><div class="col-md-6"><input class="form-control" type="text" name="alamat" required /></div></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>
                                                        <div class="col-md-6">
                                                            <input id="simpanButton" class="btn btn-custom-simpan" type="submit" value="Simpan" />
                                                            <a class="btn btn-custom-batal" href="form-daftar.php">Batal</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted" style="font-family: 'Times New Roman', Times, serif;">Copyright &copy; Kelompok 7 2024</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>

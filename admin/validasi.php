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

// Query untuk mendapatkan data pengunjung yang belum divalidasi, diurutkan berdasarkan tanggal pendaftaran dari yang paling awal ke yang paling baru
$query = mysqli_query($koneksi, "
    SELECT tbl_pengunjung.*, status_pengunjung.nama_status 
    FROM tbl_pengunjung 
    JOIN status_pengunjung ON tbl_pengunjung.id_status = status_pengunjung.id_status 
    WHERE tbl_pengunjung.is_validated = 0
    ORDER BY tbl_pengunjung.tgl ASC
");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Validasi Pendaftaran</title>
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
        .sb-sidenav-footer {
            color: white;
        }
        .panel-primary {
            border-color: #001f3f !important;
        }
        .panel-primary > .panel-heading {
            background-color: #001f3f !important;
            border-color: #001f3f !important;
        }
        .panel-primary > .panel-heading .panel-title {
            color: #fff;
        }
        .table-bordered {
            border: 1px solid #001f3f !important;
        }
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #5bc0de;
        }
        .btn-success {
            background-color: #5cb85c;
            border-color: #4cae4c;
        }
        .btn-danger {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        /* Tambahkan padding ke kontainer untuk memberikan jarak */
        .container {
            padding-top: 20px; /* Jarak ke navigasi atas */
            padding-left: 20px; /* Jarak ke navigasi samping */
        }
    </style>
</head>

<body class="sb-nav-fixed" style="background-color: #F0F0F0;">
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
                <div class="container">
                    <div class="row">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title" style="font-family: 'Times New Roman', Times, serif;">Validasi Pendaftaran</h3>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>NIM/NIK</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Status</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php while ($d = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td><?php echo $d['nim']; ?></td>
                                        <td><img src="../image/<?php echo $d['foto']; ?>" width="100" height="100" /></td>
                                        <td><?php echo $d['nama']; ?></td>
                                        <td><?php echo $d['nama_status']; ?></td>
                                        <td><?php echo $d['tgl']; ?></td>
                                        <td><?php echo $d['alamat']; ?></td>
                                        <td>
                                            <a class='btn btn-success' href='validasi_aksi.php?id=<?php echo $d['id']; ?>&action=approve'>Setujui</a>
                                            <a class='btn btn-danger' href='validasi_aksi.php?id=<?php echo $d['id']; ?>&action=reject'>Tolak</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
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

<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah pengunjung
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'User') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan pengunjung
    exit();
}

require '../function.php'; // Akses ke function.php di folder pa2

$id_user = $_SESSION['id_user'];

$query = mysqli_query($koneksi, "
    SELECT tbl_pengunjung.*, status_pengunjung.nama_status 
    FROM tbl_pengunjung 
    JOIN status_pengunjung ON tbl_pengunjung.id_status = status_pengunjung.id_status 
    WHERE tbl_pengunjung.id_user = '$id_user'
");

$d = mysqli_fetch_array($query);

if ($d && $d['is_validated'] == 1 && !isset($_SESSION['validation_notified'])) {
    if ($d['validation_status'] == 'approved') {
        $_SESSION['validation_message'] = "Pendaftaran Anda telah disetujui.";
    } elseif ($d['validation_status'] == 'rejected') {
        $_SESSION['validation_message'] = "Pendaftaran Anda telah ditolak.";
    }
    $_SESSION['validation_notified'] = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Daftar Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        .bg-smoke {
            background-color: #aaaa  !important; /* Warna abu-abu rokok */
        }
        .sb-sidenav .nav-link, .sb-sidenav .sb-sidenav-menu-heading {
            color: black !important; /* Warna teks hitam */
        }
        .sb-sidenav .nav-link .fas {
            color: black !important; /* Warna ikon hitam */
        }
        .mt-4 {
            font-size: 30px;
        }
    </style>
</head>
<body class="sb-nav-fixed" style="background-color: #F0F0F0;">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-smoke">
        <a class="navbar-brand ps-3 font-weight-bold" href="index.php" style="font-family: 'Times New Roman', Times, serif; color: #000;">Del Library</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars" style="color: black;"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;"><i class="fas fa-user fa-fw" style="color: black;"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" >
                    <li><a class="dropdown-item" style="font-family: 'Times New Roman', Times, serif; color: black;" href="../index.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark bg-smoke" id="sidenavAccordion">
                <div class="sb-sidenav-menu" style="font-family: 'Times New Roman', Times, serif;">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: black;"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: black;"></i></div>
                            Daftar
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: black;"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="mendaftar.php">Daftar Sebagai Anggota</a>
                                <a class="nav-link" href="lihat-data.php">Lihat Validasi Data</a>
                            </nav>
                        </div>
                        
                    </div>
                </div>
                <div class="sb-sidenav-footer bg-smoke text-light" style="font-family: 'Times New Roman', Times, serif; ">
                    <div class="small"  style="color: #000;"></div>
                    <i class="fas fa-users" style="color: #000; margin-right: 8px;"></i>
                    <span style="color: black;">Pengunjung</span>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4" style="font-family: 'Times New Roman', Times, serif;">
                    <h1 class="mt-4">Data Anggota</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Saya</li>
                    </ol>
                    <br>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($d): ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>NIM/NIK</td>
                                        <td><?php echo htmlspecialchars($d['nim']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Foto</td>
                                        <td><img src="../image/<?php echo htmlspecialchars($d['foto']); ?>" width="100" height="100" /></td>
                                    </tr>
                                    <tr>
                                        <td>Nama</td>
                                        <td><?php echo htmlspecialchars($d['nama']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td><?php echo htmlspecialchars($d['nama_status']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Menjadi Anggota</td>
                                        <td><?php echo htmlspecialchars($d['tgl']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?php echo htmlspecialchars($d['alamat']); ?></td>
                                    </tr>
                                    <tr>
                                        <td>QR Code</td>
                                        <td>
                                            <?php if ($d['validation_status'] == 'approved'): ?>
                                                <img src="temp/<?php echo htmlspecialchars($d['nama']); ?>.png" />
                                            <?php else: ?>
                                                Pendaftaran Anda masih dalam proses validasi.
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Status Validasi</td>
                                        <td><?php echo htmlspecialchars($d['validation_status']); ?></td>
                                    </tr>
                                </table>
                                <?php if ($d['validation_status'] == 'approved'): ?>
                                    <a class='btn btn-success' href='cetak_kartu.php?id=<?php echo htmlspecialchars($d['id']); ?>' target='_blank'>Cetak Kartu</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <p>Anda belum mendaftar sebagai anggota. Silakan daftar terlebih dahulu di halaman pendaftaran.</p>
                            <?php endif; ?>
                            <a class="btn btn-danger no-print" href="index.php">Kembali</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.min.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>


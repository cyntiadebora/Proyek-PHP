<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah pengunjung
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'User') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan pengunjung
    exit();
}

require '../function.php'; // Akses ke function.php di folder pa2

$nama_pengguna = $_SESSION['nama_pengguna']; // Ambil nama pengguna dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mengambil status validasi pendaftaran
$query = mysqli_query($koneksi, "
    SELECT validation_status 
    FROM tbl_pengunjung 
    WHERE id_user = '$id_user'
");
$status = mysqli_fetch_assoc($query);

$pesan_validasi = "";
$warna_notifikasi = "";
$warna_teks = "white"; // Warna teks default adalah putih
if ($status) {
    if ($status['validation_status'] == 'pending') {
        $pesan_validasi = "Pendaftaran anggota Anda sedang menunggu validasi dari staf perpustakaan.";
        $warna_notifikasi = "yellow"; // Warna kuning untuk status pending
        $warna_teks = "black"; // Warna teks hitam untuk background kuning
    } elseif ($status['validation_status'] == 'approved') {
        $pesan_validasi = "Pendaftaran anggota Anda telah disetujui. Sekarang Anda telah memiliki kartu anggota. <br><a target=\"_blank\" href=\"lihat-data.php\" style=\"color: white;\">Lihat data saya!</a>";
        $warna_notifikasi = "green"; // Warna hijau untuk status approved
    } elseif ($status['validation_status'] == 'rejected') {
        $pesan_validasi = "Pendaftaran anggota Anda ditolak. Silakan hubungi staf perpustakaan untuk informasi lebih lanjut!";
        $warna_notifikasi = "red"; // Warna merah untuk status rejected
    }
} else {
    $pesan_validasi = "Anda belum mendaftar sebagai anggota, silahkan daftar untuk mendapatkan kartu anggota!";
    $warna_notifikasi = "blue"; // Warna biru untuk status belum mendaftar
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengunjung Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
         body {
            background-color: #ffff; /* Warna latar belakang default */
            color: #000;
         }
        .bg-smoke {
            background-color:  #aaaa !important; /* Warna abu-abu rokok */
        }
        .sb-sidenav .nav-link, .sb-sidenav .sb-sidenav-menu-heading {
            color: black !important; /* Warna teks hitam */
        }
        .sb-sidenav .nav-link .fas {
            color: white !important; /* Warna ikon hitam */
        }
        .mt-4 {
            font-size: 30px;
        }
        .card-body {
            background-color: inherit; /* Warna latar belakang sesuai dengan latar halaman */
            color: inherit; /* Warna teks sesuai dengan latar halaman */
        }
        .background-image {
            background-image: url('../image/qrcode.gif'); /* Ganti dengan path yang sesuai */
            background-size: cover;
            background-repeat: no-repeat;
            height: 500px; /* Sesuaikan dengan kebutuhan */
            margin-top: 20px; /* Jarak dari atas */
        }
    </style>
</head>
<body class="sb-nav-fixed">
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
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt" style="color: #000;"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns" style="color: #000;"></i></div>
                            Daftar
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down" style="color: #000;"></i></div>
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
            <header class="container-fluid px-4" style="background-color: #f2f2f2f2; font-family: 'Times New Roman', Times, serif;">
                <!--<h1 class="mt-4" style="font-family: 'Times New Roman', Times, serif;">Dashboard Pengunjung Perpustakaan</h1>-->
                <br>
                <h3>Selamat datang, <?php echo $_SESSION['nama_pengguna']; ?>!</h3>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active" style="font-family: 'Times New Roman', Times, serif;">Dashboard</li>
                </ol>
            </header>
            <main>
                <div class="container-fluid px-4"  style="background-color: #f2f2f2; font-family: 'Times New Roman', Times, serif;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-info-circle me-1"></i>
                                    Notifikasi
                                </div>
                                <div class="card-body" style="background-color: <?php echo $warna_notifikasi; ?>; color: <?php echo $warna_teks; ?>;">
                                    <p><?php echo $pesan_validasi; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tambahkan div untuk background di sini -->
                <div class="background-image"></div>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>
</html>

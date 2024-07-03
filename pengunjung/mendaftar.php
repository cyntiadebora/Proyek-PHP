<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Statistik Pengunjung</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
         body {
            background-color: #000; /* Warna latar belakang default */
            color: #000;
         }
         .bg-smoke {
            background-color:  #aaaa!important; /* Warna abu-abu rokok */
        }
        .sb-sidenav-menu-heading {
            color: white !important; /* Warna teks putih */
        }
        .sb-sidenav-dark {
            background-color: #aaaa !important; /* Warna abu-abu rokok */
        }
        .sb-sidenav-footer {
            background-color: #aaaa !important; /* Warna abu-abu rokok */
            color: white; /* Warna teks putih */
        }
        .content-wrapper {
            padding: 20px; /* Memberikan jarak antara navigasi samping dan atas dengan konten */
        }
        .sb-sidenav .nav-link, .sb-sidenav .sb-sidenav-menu-heading {
            color: black !important; /* Warna teks hitam */
        }
        .sb-sidenav .nav-link .fas {
            color: black !important; /* Warna ikon hitam */
        }
    </style>
</head>
<body class="sb-nav-fixed" style="background-color: #F0F0F0;"> <!-- Warna abu-abu terang -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-smoke" >
        <a class="navbar-brand ps-3 font-weight-bold" href="index.php" style="font-family: 'Times New Roman', Times, serif; color: black;">Del Library</a>
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
            <main class="content-wrapper">
                <?php include "data_mahasiswa.php"; ?>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tabel Rekapitulasi</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Menambahkan CSS khusus untuk warna teks dan latar belakang -->
    <style>
        .judul-halaman {
            color: black !important; /* Ubah warna teks menjadi hitam pekat */
        }
        .breadcrumb-item a {
            color: blue !important; /* Ubah warna teks menjadi biru untuk link */
        }
        .navbar-dark-blue {
            background-color: #001f3f !important; /* Dark Blue */
        }
        .sb-sidenav-blue {
            background-color: #001f3f !important; /* Blue */
        }
        .sb-sidenav-blue .nav-link,
        .sb-sidenav-blue .sb-sidenav-menu-heading,
        .sb-sidenav-blue .sb-sidenav-menu-nested .nav-link {
            color: #ffffff !important; /* White */
            font-size: 16px !important; /* Larger Font Size */
        }
        .sb-sidenav-blue .sb-nav-link-icon {
            color: #ffffff !important; /* White */
        }
        .nav-link:hover {
            background-color: #0056b3 !important; /* Hover effect for nav links */
        }
        .sb-sidenav-footer{
            color: white;
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
<body class="sb-nav-fixed" style="font-family: 'Times New Roman', Times, serif; background-color: #F0F0F0;">
    <nav class="sb-topnav navbar navbar-expand navbar-dark navbar-dark-blue">
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
                <div class="container-fluid px-4">
                    <h2 class="mt-4 judul-halaman">Rekapitulasi Pengunjung</h2>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php" style="font-family: 'Times New Roman', Times, serif;"  style="color: #007bff;">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tables</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body" style="color: black;">
                            Data berikut merupakan hasil rekapitulasi pengunjung perpustakaan dari tanggal yang dapat Anda filter.
                            <a target="_blank" href="charts.php"> Lihat grafik!</a>
                        </div>
                    </div>
                    <!-- Awal row -->
                    <?php include "headerr.php";?>
                    <?php include "connec.php";?>
                    <!-- Awal row -->
                    <div class="row">
                        <div class="col-md-12"> <!--Awal col-md-12 -->
                            <div class="card shadow mb-4 mt-3"> <!--Awal card shadow -->
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Rekapitulasi Pengunjung</h6> <!-- Untuk menampilkan tanggal sekarang -->
                                </div>
                                <div class="card-body"> <!--Awal card body -->
                                    <!-- Form untuk filter tanggal -->
                                    <form method="POST" action="" class="text-center">
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label style="color: black;">Dari Tanggal</label>
                                                    <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1']) ? $_POST['tanggal1'] : date('Y-m-d')  ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label style="color: black;">Hingga Tanggal</label>
                                                    <input class="form-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2']) ? $_POST['tanggal2'] : date('Y-m-d')  ?>" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-2">
                                                <button class="btn btn-primary form-control" name="btntampilkan"><i class="fa fa-search"></i> Tampilkan</button>
                                            </div>
                                            <div class="col-md-2">
                                                <a href="tables.php" class="btn btn-danger form-control"><i class="fa fa-backward"></i> Kembali</a>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Akhir form -->

                                    <!-- Tabel data pengunjung -->
                                    <?php 
                                    if(isset($_POST['btntampilkan'])): //awal isset
                                        $tgl1 = $_POST['tanggal1'];
                                        $tgl2 = $_POST['tanggal2'];
                                        
                                        // Query to fetch data
                                        $query = "
                                            SELECT 
                                                lp.tanggal_log,
                                                lp.log_masuk,
                                                lp.log_keluar,
                                                tp.nim,
                                                tp.nama,
                                                tp.alamat,
                                                sp.nama_status
                                            FROM log_pengunjung lp
                                            JOIN tbl_pengunjung tp ON lp.id = tp.id
                                            JOIN status_pengunjung sp ON lp.id_status = sp.id_status
                                            WHERE lp.tanggal_log BETWEEN '$tgl1' AND '$tgl2'
                                            ORDER BY lp.log_masuk ASC
                                        ";
                                        
                                        $result = mysqli_query($koneksi, $query);
                                    ?>
                                        <div class="table-responsive"> <!-- Awal table responsive -->
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="color: black;">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Keluar</th>
                                                        <th>NIM/NIK</th>
                                                        <th>Nama Pengunjung</th>
                                                        <th>Alamat</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Jam Masuk</th>
                                                        <th>Jam Keluar</th>
                                                        <th>NIM/NIK</th>
                                                        <th>Nama Pengunjung</th>
                                                        <th>Alamat</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    while($data = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= $data['tanggal_log'] ?></td>
                                                        <td><?= $data['log_masuk'] ?></td>
                                                        <td><?= $data['log_keluar'] ?></td>
                                                        <td><?= $data['nim'] ?></td>
                                                        <td><?= $data['nama'] ?></td>
                                                        <td><?= $data['alamat'] ?></td>
                                                        <td><?= $data['nama_status'] ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div> <!-- Akhir table responsive -->
                                    <?php endif; ?> <!-- akhir isset -->
                                    <!-- Akhir tabel data pengunjung -->
                                </div> <!--Akhir card body -->
                            </div> <!--Akhir card shadow -->
                        </div> <!--Akhir col-md-12 -->
                    </div>
                    <!-- Akhir row -->              
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
                                
       
    
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/dataTable.min.js"></script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>



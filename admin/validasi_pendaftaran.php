<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['id_user']) || $_SESSION['role'] != 'Admin') {
    header('location:../index.php');
    exit();
}

$query = mysqli_query($konek, "
    SELECT tbl_pengunjung.*, status_pengunjung.nama_status 
    FROM tbl_pengunjung 
    JOIN status_pengunjung ON tbl_pengunjung.id_status = status_pengunjung.id_status 
    WHERE tbl_pengunjung.is_validated = 0
");
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Validasi Pendaftaran</title>
    <link rel="icon" href="./assets/img/logo.png">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/style.css" rel="stylesheet">
    <style>
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
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Validasi Pendaftaran</h3>
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

</body>
</html>

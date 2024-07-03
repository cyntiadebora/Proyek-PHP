<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="./assets/img/logo.png">

    <!-- Bootstrap core CSS -->
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/style.css" rel="stylesheet">

    <title>Data Mahasiswa</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading custom-panel-heading">
                <h3 class="panel-title">Data Mahasiswa</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NIM/NIK</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Tanggal Menjadi Anggota</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($konek, "SELECT * FROM tbl_pengunjung INNER JOIN status_pengunjung ON tbl_pengunjung.id_status=status_pengunjung.id_status");
                        while ($data = mysqli_fetch_array($query)) {
                            echo "
                            <tr>
                                <td>{$data['nim']}</td>
                                <td><img src='../image/{$data['foto']}' width='50' height='50'></td>
                                <td>{$data['nama']}</td>
                                <td>{$data['nama_status']}</td>
                                <td>{$data['tgl']}</td>
                                <td>{$data['alamat']}</td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
session_start();

// Periksa apakah sesi sudah dimulai dan pengguna adalah admin
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'Admin') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

require '../function.php'; // Akses ke function.php di folder pa2
?>
<?php 
include "koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Kartu Anggota</title>
    <link rel="icon" href="./assets/img/logo.png">
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
        }

        @media print {
            .no-print {
                display: none;
            }
        }

        table {
            border-collapse: collapse;
            width: 350px; /* Fixed width for card size */
            margin: auto;
            border: 2px solid #add8e6; /* Soft blue border */
        }

        .card-table {
            width: 100%;
            padding: 10px; /* Reduce padding for compact design */
        }

        .card-table img.logo {
            display: block;
            margin: auto;
        }

        .card-table h1, .card-table p {
            text-align: center;
            margin: 0;
            font-size: 16px;
        }

        .card-table h3 {
            margin: 5px 0;
            font-size: 14px;
        }

        .card-table td {
            padding: 5px;
            font-size: 12px; /* Smaller font size for compactness */
        }

        .identity-section {
            vertical-align: top;
        }

        .identity-section img {
            margin-left: 10px;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .signature-section img {
            width: 60px; /* Smaller size for QR code */
        }

        .signature-section div {
            text-align: right;
            font-size: 12px;
        }

        .signature-section p {
            margin: 0;
        }

        .small-font {
            font-size: 10px; /* Smaller font size */
        }

        .button {
            padding: 10px 20px;
            text-decoration: none;
            font-size: 14px;
            margin: 5px;
            border-radius: 5px;
            display: inline-block;
        }

        .button-print {
            background-color: #4CAF50; /* Green */
            color: white;
        }

        .button-back {
            background-color: #f44336; /* Red */
            color: white;
        }
    </style>
</head>
<body>
    <center>
        <table cellpadding="10" cellspacing="0">
            <tr>
                <td>
                    <table class="card-table">
                        <?php
                        $sql = mysqli_query($konek, "SELECT * FROM tbl_pengunjung, status_pengunjung WHERE tbl_pengunjung.id_status=status_pengunjung.id_status AND id='$_GET[id]'");
                        $d = mysqli_fetch_array($sql);
                        ?>
                        <tr>
                            <td colspan="4">
                                <center>
                                    <img src="assets/img/del.png" width="60" class="logo"><br>
                                    <h1>Kartu Pengunjung Perpustakaan IT Del</h1>
                                    <hr>
                                </center>
                            </td>
                        </tr>
                        <tr class="identity-section">
                            <td><h3>NIM/NIK</h3></td>
                            <td><h3>:</h3></td>
                            <td><h3><?php echo $d['nim']; ?></h3></td>
                            <td rowspan="4"><img src="../image/<?php echo $d['foto']; ?>" width="80" height="120" /></td>
                        </tr>
                        <tr class="identity-section">
                            <td><h3>Nama</h3></td>
                            <td><h3>:</h3></td>
                            <td><h3><?php echo $d['nama']; ?></h3></td>
                        </tr>
                        <tr class="identity-section">
                            <td><h3>Status</h3></td>
                            <td><h3>:</h3></td>
                            <td><h3><?php echo $d['nama_status']; ?></h3></td>
                        </tr>
                        <tr class="identity-section">
                            <td><h3>Alamat</h3></td>
                            <td><h3>:</h3></td>
                            <td><h3><?php echo $d['alamat']; ?></h3></td>
                        </tr>
                        <tr class="identity-section">
                        <td><h3>Tanggal Anggota</h3></td>
                        <td><h3>:</h3></td>
                        <td><h3><?php echo $d['tgl']; ?></h3></td>

                        </tr>
                        <tr>
                            <td colspan="4">
                                <div class="signature-section">
                                    <img src="temp/<?php echo $d['nama'].".png"; ?>" alt="QR Code">
                                    <div>
                                        <p class="small-font">IT DEL, <?php echo tglIndonesia(date('Y-m-d')); ?></p>
                                        <p class="small-font">Staff Perpustakaan,</p>
                                        <br/><br/>
                                        <p class="small-font"><b>Del Library</b></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </center>
    <br>
    <center>
        <a href="#" class="button button-print no-print" onclick="window.print();">Cetak/Print</a>
        <a href="tambah-pengunjung.php" class="button button-back no-print">Kembali</a>
    </center>
</body>
</html>

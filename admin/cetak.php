<?php
// Include koneksi.php untuk menghubungkan ke database
include "koneksi.php";

// Cek apakah form telah disubmit
if(isset($_POST['submit'])) {
    // Ambil data yang dikirim dari form
    $nim = $_POST['nim'];
    // Ambil nama file foto dari $_FILES
    $foto = $_FILES['upload_gambar']['name'];
    $nama = $_POST['nama'];
    $id_status = $_POST['id_status'];
    $tgl = $_POST['tgl'];
    $alamat = $_POST['alamat'];

    // Tentukan folder tempat menyimpan foto
    $folder_foto = "assets/img/";
    // Tentukan path lengkap untuk menyimpan foto
    $path_foto = $folder_foto . $foto;

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO tbl_pengunjung (nim, foto, nama, id_status, tgl, alamat) VALUES ('$nim', '$foto', '$nama', '$id_status', '$tgl', '$alamat')";
    if(mysqli_query($konek, $query)) {
        // Jika query berhasil dijalankan, pindahkan foto ke folder tujuan
        move_uploaded_file($_FILES['upload_gambar']['tmp_name'], $path_foto);
        $message = "Data berhasil disimpan!";
    } else {
        $message = "Error: " . $query . "<br>" . mysqli_error($konek);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- head section -->
</head>
<body>
    <!-- Tampilkan data yang dikirim dari form -->
    <p>NIM/NIK: <?php echo $nim; ?></p>
    <!-- Tampilkan foto pengunjung -->
    <p>Foto: <img src="<?php echo $path_foto; ?>" alt="Foto Pengunjung" style="max-width: 200px; max-height: 200px;"></p>
    <p>Nama: <?php echo $nama; ?></p>
    <p>Status: <?php echo $id_status; ?></p>
    <p>Tanggal Menjadi Anggota: <?php echo $tgl; ?></p>
    <p>Alamat: <?php echo $alamat; ?></p>

    <!-- Link untuk kembali ke halaman pendaftaran jika diperlukan -->
    <a href="layout-static.php">Kembali</a>
</body>
</html>

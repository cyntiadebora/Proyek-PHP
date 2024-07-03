<?php
// Mengatur zona waktu default
date_default_timezone_set("Asia/Jakarta");
// Memulai sesi
session_start();

// Informasi database
$server = "localhost";
$username = "root";
$password = "";
$dbname = "apk_perpusdel";

// Membuat koneksi ke database
$conn = new mysqli($server, $username, $password, $dbname);

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Memeriksa apakah data POST nim tersedia
if (isset($_POST['nim'])) {
    // Menghindari SQL Injection dengan melakukan escape pada input nim
    $nim = $conn->real_escape_string($_POST['nim']);
    // Mendapatkan tanggal dan waktu saat ini
    $date = date('Y-m-d');
    $time = date('H:i:s');

    // Memeriksa apakah NIM ada di tabel tbl_pengunjung dan mendapatkan id dan id_status
    $checkNimQuery = "SELECT id, id_status FROM tbl_pengunjung WHERE nim = '$nim'";
    $checkNimResult = $conn->query($checkNimQuery);

    if ($checkNimResult->num_rows > 0) {
        $row = $checkNimResult->fetch_assoc();
        $pengunjungId = $row['id'];
        $id_status = $row['id_status'];

        // Memeriksa apakah pengguna sudah melakukan scan masuk hari ini
        $sql = "SELECT * FROM log_pengunjung WHERE id='$pengunjungId' AND tanggal_log='$date' AND statuss='0'";
        $query = $conn->query($sql);

        if ($query->num_rows > 0) {
            // Memperbarui log_pengunjung untuk scan keluar
            $sql = "UPDATE log_pengunjung SET log_keluar=NOW(), statuss='1' WHERE id='$pengunjungId' AND tanggal_log='$date'";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = 'Anda Berhasil Melakukan Scan Keluar';
            } else {
                $_SESSION['error'] = 'Error: ' . $conn->error;
            }
        } else {
            // Memasukkan log baru untuk scan masuk
            $sql = "INSERT INTO log_pengunjung (id, log_masuk, tanggal_log, statuss, id_status) VALUES ('$pengunjungId', '$time', '$date', '0', '$id_status')";
            if ($conn->query($sql) === TRUE) {
                $_SESSION['success'] = 'Anda Berhasil Melakukan Scan Masuk';
            } else {
                $_SESSION['error'] = 'Error: ' . $conn->error;
            }
        }
    } else {
        $_SESSION['error'] = 'NIM tidak ditemukan di tabel pengunjung';
    }
} else {
    $_SESSION['error'] = 'Tolong scan QR Code Anda!';
}

// Mengarahkan ke halaman index setelah selesai
header("location: index.php");
// Menutup koneksi ke database
$conn->close();
?>

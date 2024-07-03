<?php
session_start();
include "../function.php"; // Pastikan path ke koneksi.php benar

if (!isset($_SESSION['log']) || $_SESSION['log'] != 'Logged' || $_SESSION['role'] != 'Admin') {
    header('Location: ../index.php'); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    if ($action == 'approve') {
        $query = mysqli_query($koneksi, "UPDATE tbl_pengunjung SET is_validated = 1, validation_status = 'approved' WHERE id = '$id'");
    } elseif ($action == 'reject') {
        // Hapus data terkait di log_pengunjung
        $deleteLogQuery = mysqli_query($koneksi, "DELETE FROM log_pengunjung WHERE id = '$id'");
        
        if ($deleteLogQuery) {
            // Setelah berhasil menghapus data terkait, hapus data di tbl_pengunjung
            $query = mysqli_query($koneksi, "DELETE FROM tbl_pengunjung WHERE id = '$id'");
        }
    }

    if (isset($query) && $query) {
        header('Location: validasi.php');
    } else {
        echo "Terjadi kesalahan. Silakan coba lagi.";
    }
} else {
    header('Location: validasi.php');
}
?>

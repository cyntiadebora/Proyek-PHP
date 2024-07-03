<?php
include "koneksi.php";

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Hapus data terkait dari tabel log_pengunjung
$sql_delete_log = "DELETE FROM log_pengunjung WHERE id=$id";

if (mysqli_query($konek, $sql_delete_log)) {
    // Jika berhasil menghapus data dari tabel log_pengunjung, lanjutkan untuk menghapus data dari tabel tbl_pengunjung
    $sql_delete_tbl = "DELETE FROM tbl_pengunjung WHERE id=$id";

    if (mysqli_query($konek, $sql_delete_tbl)) {
        // Redirect kembali ke halaman data_mahasiswa.php setelah menghapus data
        header("Location: tambah-pengunjung.php");
        exit();
    } else {
        echo "Error: " . $sql_delete_tbl . "<br>" . mysqli_error($konek);
    }
} else {
    echo "Error: " . $sql_delete_log . "<br>" . mysqli_error($konek);
}

mysqli_close($konek);
?>

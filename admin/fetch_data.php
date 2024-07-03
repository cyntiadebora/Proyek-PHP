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
include 'koneksi.php';

$tanggalHariIni = date('Y-m-d');

$query = "SELECT HOUR(log_masuk) AS jam, COUNT(*) AS jumlah, s.nama_status
FROM log_pengunjung lp
INNER JOIN tbl_pengunjung tp ON lp.id = tp.id
INNER JOIN status_pengunjung s ON tp.id_status = s.id_status
WHERE DATE(tanggal_log) = '$tanggalHariIni'
GROUP BY HOUR(log_masuk), s.nama_status";

$result = mysqli_query($konek, $query);

$data = [];
$labels = [];
$dataset = [];

// Mengisi data pengunjung ke dalam array $data dan membuat array $labels untuk label sumbu x
while ($row = mysqli_fetch_assoc($result)) {
    $jam = $row['jam'];
    $nama_status = $row['nama_status'];
    $jumlah = $row['jumlah'];

    // Menambahkan nama status pengunjung ke dalam array labels jika belum ada
    if (!in_array($nama_status, $labels)) {
        $labels[] = $nama_status;
    }

    // Memastikan setiap jam memiliki jumlah pengunjung untuk setiap status
    if (!isset($data[$jam])) {
        $data[$jam] = [];
    }
    $data[$jam][$nama_status] = $jumlah;
}

// Membuat dataset berdasarkan data yang diperoleh
foreach ($labels as $status) {
    $dataset[$status] = [
        'label' => $status,
        'data' => []
    ];

    // Mengisi data jumlah pengunjung untuk setiap jam pada status tertentu
    foreach ($data as $jam => $jumlah_per_status) {
        $dataset[$status]['data'][] = isset($jumlah_per_status[$status]) ? $jumlah_per_status[$status] : 0;
    }
}

// Menyusun data akhir untuk dikirim sebagai JSON
$finalData = [
    'labels' => array_keys($data), // Menggunakan jam sebagai label sumbu x
    'datasets' => array_values($dataset)
];

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($finalData);
?>

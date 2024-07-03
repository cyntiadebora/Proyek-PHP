
<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "apk_perpusdel";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Mendapatkan nilai parameter 'month' dari URL, jika tidak ada gunakan bulan saat ini
$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$startDate = $month . '-01';// Mengatur tanggal awal bulan
$endDate = date('Y-m-t', strtotime($startDate)); // Mengatur tanggal akhir bulan

// Query untuk mendapatkan jumlah pengunjung berdasarkan status dan bulan
$sql = "
    SELECT 
        sp.nama_status, 
        COUNT(lp.id) AS count
    FROM 
        log_pengunjung lp
    JOIN 
        status_pengunjung sp ON lp.id_status = sp.id_status
    WHERE 
        lp.tanggal_log BETWEEN '$startDate' AND '$endDate'
    GROUP BY 
        sp.nama_status
";

$result = $conn->query($sql); // Menjalankan query SQL dan menyimpan hasilnya

$data = []; // Inisialisasi array data untuk menyimpan hasil query
while ($row = $result->fetch_assoc()) {
    $data[$row['nama_status']] = $row['count']; // Menyimpan hasil query ke dalam array dengan kunci nama_status
}

// Menentukan label dan count, menentukan label status yang akan ditampilkan
$labels = ["Mahasiswa", "Staff", "Dosen", "Keluarga Staff/Dosen", "Guest"];
$counts = [];
foreach ($labels as $label) {
    $counts[] = isset($data[$label]) ? $data[$label] : 0; // Mengisi counts dengan jumlah pengunjung sesuai label, jika tidak ada diisi 0
}

echo json_encode(['labels' => $labels, 'counts' => $counts]);

$conn->close();
?>

<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "apk_perpusdel";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');
$startDate = $month . '-01';
$endDate = date('Y-m-t', strtotime($startDate));

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

$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[$row['nama_status']] = $row['count'];
}

// Menentukan label dan count
$labels = ["Mahasiswa", "Staff", "Dosen", "Keluarga Staff/Dosen", "Guest"];
$counts = [];
foreach ($labels as $label) {
    $counts[] = isset($data[$label]) ? $data[$label] : 0;
}

echo json_encode(['labels' => $labels, 'counts' => $counts]);

$conn->close();
?>

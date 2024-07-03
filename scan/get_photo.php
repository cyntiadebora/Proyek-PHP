<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "apk_perpusdel";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];
    $sql = "SELECT foto FROM tbl_pengunjung WHERE nim = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(['success' => true, 'foto' => $row['foto']]);
    } else {
        echo json_encode(['success' => false]);
    }
    
    $stmt->close();
}

$conn->close();
?>

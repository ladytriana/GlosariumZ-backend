<?php
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST'); 
header('Content-Type: application/json');

include "config.php";

$nama = $_GET['nama'] ?? '';

if (!$nama) {
    echo json_encode(['error' => 'Parameter nama kosong']);
    exit;
}

$stmt = $conn->prepare("SELECT * FROM istilah WHERE nama = ?");
$stmt->bind_param("s", $nama);
$stmt->execute();

$result = $stmt->get_result();
$data = $result->fetch_assoc();

if ($data) {
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}

$stmt->close();
$conn->close();
?>

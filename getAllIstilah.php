<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Mengizinkan akses dari domain lain
include "config.php"; // Pastikan ini berisi koneksi ke database

// Query untuk mengambil semua istilah
$query = "SELECT * FROM istilah";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $terms = [];
    while ($row = $result->fetch_assoc()) {
        $terms[] = $row;
    }
    echo json_encode($terms); // Mengirimkan data dalam format JSON
} else {
    echo json_encode(['error' => 'Data tidak ditemukan']);
}

$conn->close();
?>

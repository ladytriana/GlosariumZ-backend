<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Mengizinkan akses dari domain lain
include "config.php"; // Pastikan ini berisi koneksi ke database

$id = $_GET['id'] ?? '';

if (!$id) {
    echo json_encode(['error' => 'ID tidak ditemukan']);
    exit;
}

// Query untuk menghapus istilah berdasarkan ID
$stmt = $conn->prepare("DELETE FROM istilah WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Data berhasil dihapus']);
} else {
    echo json_encode(['error' => 'Gagal menghapus data']);
}

$stmt->close();
$conn->close();
?>

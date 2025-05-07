<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
include "config.php";

$id = $_GET['id'] ?? '';

if (!$id) {
  echo json_encode(['error' => 'ID tidak ditemukan']);
  exit;
}

$query = "SELECT * FROM istilah WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
  echo json_encode($row);
} else {
  echo json_encode(['error' => 'Data tidak ditemukan']);
}

$stmt->close();
$conn->close();
?>

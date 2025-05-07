<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

include 'config.php';

$data = json_decode(file_get_contents("php://input"), true);
var_dump($data);
if (!$data) {
  echo json_encode(["success" => false, "message" => "Tidak menerima data JSON"]);
  exit;
}

if (
  isset($data['nama']) &&
  isset($data['definisi']) &&
  isset($data['kelas_kata']) &&
  isset($data['sinonim']) &&
  isset($data['terkait']) &&
  isset($data['emoji'])
) {
  $nama = $data['nama'];
  $definisi = $data['definisi'];
  $kelas_kata = $data['kelas_kata'];
  $sinonim = $data['sinonim'];
  $terkait = $data['terkait'];
  $emoji = $data['emoji'];

  $stmt = $conn->prepare("INSERT INTO istilah (nama, definisi, kelas_kata, sinonim, terkait, emoji) VALUES (?, ?, ?, ?, ?, ?)");

  if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Prepare gagal: " . $conn->error]);
    exit;
  }

  $stmt->bind_param("ssssss", $nama, $definisi, $kelas_kata, $sinonim, $terkait, $emoji);

  if ($stmt->execute()) {
    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "message" => "Gagal simpan: " . $stmt->error]);
  }
} else {
  echo json_encode(["success" => false, "message" => "Data tidak lengkap"]);
}
?>

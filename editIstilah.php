<?php
include("config.php");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "message" => "Tidak menerima data JSON"]);
    exit();
}

$id = intval($data['id']);
$nama = $conn->real_escape_string($data['nama']);
$kelas_kata = $conn->real_escape_string($data['kelas_kata']);
$definisi = $conn->real_escape_string($data['definisi']);
$sinonim = $conn->real_escape_string($data['sinonim']);
$terkait = $conn->real_escape_string($data['terkait']);
$emoji = $conn->real_escape_string($data['emoji']);

$sql = "UPDATE istilah SET nama='$nama', kelas_kata='$kelas_kata', definisi='$definisi',
        sinonim='$sinonim', terkait='$terkait', emoji='$emoji' WHERE id=$id";

if ($conn->query($sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => $conn->error]);
}
?>

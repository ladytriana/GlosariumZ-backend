<?php
include "config.php";

$kata = $_GET['kata'] ?? '';

$query = "SELECT * FROM istilah WHERE nama LIKE '%$kata%'";
$result = mysqli_query($conn, $query);

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>

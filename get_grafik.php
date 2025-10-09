<?php
include("koneksi.php");

$data = [];
$query = mysqli_query($conn, "SELECT * FROM grafik ORDER BY id ASC");
while ($row = mysqli_fetch_assoc($query)) {
  $data[] = [
    'bulan' => ucfirst($row['bulan']),
    'jumlah' => (int)$row['jumlah']
  ];
}

header('Content-Type: application/json');
echo json_encode($data);
?>

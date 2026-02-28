<?php
include "../konek.php";

$id = $_GET['id'];

mysqli_query($koneksi,"UPDATE aduan SET status='Diproses' WHERE id='$id'");

header("Location: dashboard.php");
exit;
?>
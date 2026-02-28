<?php
include "konek.php";

$kode_aduan = "ADU".rand(10000,99999);
$nama = $_POST['nama'];
$no_hp = $_POST['no_hp'];
$instansi = $_POST['instansi_id'];
$isi = $_POST['isi_aduan'];
$status = "Menunggu";
$tanggal = date("Y-m-d");

$no_hp = preg_replace('/[^0-9]/','',$no_hp);
if(substr($no_hp,0,1)=="0"){
    $no_hp="62".substr($no_hp,1);
}

mysqli_query($koneksi,"INSERT INTO aduan
(kode_aduan,nama,no_hp,instansi_id,isi_aduan,status,tanggal)
VALUES
('$kode_aduan','$nama','$no_hp','$instansi','$isi','$status','$tanggal')
");

$token="ydSHDDfQ9utyLecNGBTa";
$target="6281216773105";

$message="🔔 Aduan Baru

Kode: $kode_aduan
Nama: $nama
No HP: $no_hp

Isi:
$isi";

$curl=curl_init();
curl_setopt_array($curl,array(
CURLOPT_URL=>"https://api.fonnte.com/send",
CURLOPT_RETURNTRANSFER=>true,
CURLOPT_POST=>true,
CURLOPT_POSTFIELDS=>array(
'target'=>$target,
'message'=>$message,
),
CURLOPT_HTTPHEADER=>array(
"Authorization: $token"
),
));
$response=curl_exec($curl);
curl_close($curl);

echo "<script>alert('Aduan berhasil dikirim');window.location='index.php';</script>";
?>
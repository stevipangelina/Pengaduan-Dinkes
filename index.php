<?php
 include "konek.php"; 
 ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengaduan Dinkes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style_bg.css">

<style>
.card {
    border-radius: 15px;
}

.card-header {
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.wa-float{
    position: fixed;
    bottom: 20px;
    right: 20px;
}

input, textarea, select {
    background-color: rgba(255,255,255,0.9);
    color: #0f172a;
}

.btn-success {
    background-color: #10b981;
    border-color: #10b981;
    color: white;
}

.btn-success:hover {
    background-color: #059669;
    border-color: #059669;
}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-success shadow">
<div class="container">
    <div class="d-flex align-items-center">
        <img src="assets/logodinkes.png" width="45" class="me-2">
        <span class="navbar-brand mb-0 h5">Layanan Pengaduan Dinkes</span>
    </div>
</div>
</nav>

<div class="container mt-4 mb-5">
<div class="row justify-content-center">
<div class="col-md-7">

<div class="card shadow">
<div class="card-header bg-success text-white text-center">
    <h5 class="mb-0">Form Pengaduan Masyarakat</h5>
</div>

<div class="card-body">

<form action="kirim_aduan.php" method="POST">

<div class="mb-3">
<label class="form-label">Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">No WhatsApp</label>
<input type="text" name="no_hp" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Instansi Tujuan</label>
<select name="instansi_id" class="form-select" required>
<option value="">-- Pilih Instansi --</option>
<?php
$q = mysqli_query($koneksi,"SELECT * FROM instansi ORDER BY nama_instansi ASC");
while($d=mysqli_fetch_assoc($q)){
    echo "<option value='$d[id]'>$d[nama_instansi]</option>";
}
?>
</select>
</div>

<div class="mb-3">
<label class="form-label">Isi Aduan</label>
<textarea name="isi_aduan" rows="4" class="form-control" required></textarea>
</div>

<button type="submit" class="btn btn-success w-100">
Kirim Pengaduan
</button>

</form>

</div>
</div>

</div>
</div>
</div>

<!-- tombol WA -->
<a href="https://wa.me/6281216773105" target="_blank" class="wa-float">
<img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" width="60">
</a>

</body>
</html>
<?php
session_start();
include "../konek.php";

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
    exit;
}

$total = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as jml FROM aduan"))['jml'];
$menunggu = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as jml FROM aduan WHERE status='Menunggu'"))['jml'];
$proses = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT COUNT(*) as jml FROM aduan WHERE status='Diproses'"))['jml'];

$q = mysqli_query($koneksi,"
SELECT 
    a.id,
    a.kode_aduan,
    a.nama,
    a.no_hp,
    a.status,
    a.instansi_id,
    IFNULL(i.nama_instansi,'Instansi tidak ditemukan') AS nama_instansi
FROM aduan a
LEFT JOIN instansi i 
    ON a.instansi_id = i.id
ORDER BY a.id DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../assets/style_bg.css">

<style>
.card-stat {
    border-radius: 15px;
}

.badge-status {
    font-size: 13px;
}

.card {
    border-radius: 15px;
}
</style>
</head>
<body>

<nav class="navbar navbar-dark bg-success shadow">
<div class="container">
    <div class="d-flex align-items-center">
        <img src="../assets/logodinkes.png" width="40" class="me-2">
        <span class="navbar-brand mb-0">Dashboard Admin</span>
    </div>
    <a href="logout.php" class="btn btn-light btn-sm">Logout</a>
</div>
</nav>

<div class="container mt-4">

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-success card-stat shadow">
            <div class="card-body text-center">
                <h3><?= $total ?></h3>
                Total Aduan
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-dark bg-warning card-stat shadow">
            <div class="card-body text-center">
                <h3><?= $menunggu ?></h3>
                Menunggu
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card text-white bg-primary card-stat shadow">
            <div class="card-body text-center">
                <h3><?= $proses ?></h3>
                Diproses
            </div>
        </div>
    </div>
</div>

<div class="card shadow">
<div class="card-header bg-success text-white">
    Data Aduan Masyarakat
</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover align-middle">
<thead class="table-success text-center">
<tr>
<th>Kode</th>
<th>Nama</th>
<th>No HP</th>
<th>Instansi</th>
<th>Status</th>
<th width="120">Aksi</th>
</tr>
</thead>

<tbody>
<?php if(mysqli_num_rows($q) > 0): ?>
<?php while($d = mysqli_fetch_assoc($q)): ?>
<?php
$badge = ($d['status'] == 'Menunggu') ? 'warning' : 'primary';
?>
<tr>
<td><?= htmlspecialchars($d['kode_aduan']); ?></td>
<td><?= htmlspecialchars($d['nama']); ?></td>
<td><?= htmlspecialchars($d['no_hp']); ?></td>
<td><?= htmlspecialchars($d['nama_instansi']); ?></td>

<td class="text-center">
<span class="badge bg-<?= $badge ?> badge-status">
<?= htmlspecialchars($d['status']); ?>
</span>
</td>

<td class="text-center">
<a class="btn btn-sm btn-success"
   href="status.php?id=<?= $d['id']; ?>"
   onclick="return confirm('Proses aduan ini?')">
Proses
</a>
</td>
</tr>
<?php endwhile; ?>
<?php else: ?>
<tr>
<td colspan="6" class="text-center text-muted">
Belum ada data aduan
</td>
</tr>
<?php endif; ?>
</tbody>
</table>

</div>
</div>

</div>
</body>
</html>
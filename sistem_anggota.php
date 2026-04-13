<?php
require_once 'function_anggota.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body>
<?php
$anggota_list = [
    ["id"=>"AGT-001","nama"=>"Budi Santoso","email"=>"budi@email.com","telepon"=>"081234567890","alamat"=>"Jakarta","tanggal_daftar"=>"2024-01-15","status"=>"Aktif","total_pinjaman"=>5],
    ["id"=>"AGT-002","nama"=>"Siti Aminah","email"=>"siti@email.com","telepon"=>"082345678901","alamat"=>"Bandung","tanggal_daftar"=>"2024-02-10","status"=>"Aktif","total_pinjaman"=>8],
    ["id"=>"AGT-003","nama"=>"Andi Pratama","email"=>"andi@email.com","telepon"=>"083456789012","alamat"=>"Semarang","tanggal_daftar"=>"2024-03-05","status"=>"Non-Aktif","total_pinjaman"=>2],
    ["id"=>"AGT-004","nama"=>"Dewi Lestari","email"=>"dewi@email.com","telepon"=>"084567890123","alamat"=>"Yogyakarta","tanggal_daftar"=>"2024-04-12","status"=>"Aktif","total_pinjaman"=>10],
    ["id"=>"AGT-005","nama"=>"Rizky Hidayat","email"=>"rizky@email.com","telepon"=>"085678901234","alamat"=>"Surabaya","tanggal_daftar"=>"2024-05-20","status"=>"Non-Aktif","total_pinjaman"=>1]
];

$total = hitung_total_anggota($anggota_list);
$aktif = hitung_anggota_aktif($anggota_list);
$nonaktif = $total - $aktif;
$rata = hitung_rata_rata_pinjaman($anggota_list);
$teraktif = cari_anggota_teraktif($anggota_list);
?>

<div class="container mt-5">
    <h1 class="mb-4"><i class="bi bi-people"></i> Sistem Anggota Perpustakaan</h1>

    <div class="row mb-4 g-3">
        <div class="col-md-3"><div class="card text-bg-primary"><div class="card-body"><h6>Total Anggota</h6><h3><?= $total ?></h3></div></div></div>
        <div class="col-md-3"><div class="card text-bg-success"><div class="card-body"><h6>Aktif</h6><h3><?= $aktif ?></h3></div></div></div>
        <div class="col-md-3"><div class="card text-bg-danger"><div class="card-body"><h6>Non-Aktif</h6><h3><?= $nonaktif ?></h3></div></div></div>
        <div class="col-md-3"><div class="card text-bg-warning"><div class="card-body"><h6>Rata-rata Pinjaman</h6><h3><?= number_format($rata,2) ?></h3></div></div></div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Anggota</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th><th>Nama</th><th>Email</th><th>Status</th><th>Total Pinjaman</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($anggota_list as $a): ?>
                    <tr>
                        <td><?= $a['id'] ?></td>
                        <td><?= $a['nama'] ?></td>
                        <td><?= $a['email'] ?></td>
                        <td><?= $a['status'] ?></td>
                        <td><?= $a['total_pinjaman'] ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Anggota Teraktif</h5>
        </div>
        <div class="card-body">
            <h4><?= $teraktif['nama'] ?></h4>
            <p>ID: <?= $teraktif['id'] ?></p>
            <p>Email: <?= $teraktif['email'] ?></p>
            <p>Total Pinjaman: <strong><?= $teraktif['total_pinjaman'] ?></strong></p>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

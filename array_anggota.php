<?php
$anggota_list = [
    [
        "id" => "AGT-001",
        "nama" => "Budi Santoso",
        "email" => "budi@email.com",
        "telepon" => "081234567890",
        "alamat" => "Jakarta",
        "tanggal_daftar" => "2024-01-15",
        "status" => "Aktif",
        "total_pinjaman" => 5
    ],
    [
        "id" => "AGT-002",
        "nama" => "Siti Aminah",
        "email" => "siti@email.com",
        "telepon" => "082345678901",
        "alamat" => "Bandung",
        "tanggal_daftar" => "2024-02-10",
        "status" => "Aktif",
        "total_pinjaman" => 8
    ],
    [
        "id" => "AGT-003",
        "nama" => "Andi Pratama",
        "email" => "andi@email.com",
        "telepon" => "083456789012",
        "alamat" => "Semarang",
        "tanggal_daftar" => "2024-03-05",
        "status" => "Non-Aktif",
        "total_pinjaman" => 2
    ],
    [
        "id" => "AGT-004",
        "nama" => "Dewi Lestari",
        "email" => "dewi@email.com",
        "telepon" => "084567890123",
        "alamat" => "Yogyakarta",
        "tanggal_daftar" => "2024-04-12",
        "status" => "Aktif",
        "total_pinjaman" => 10
    ],
    [
        "id" => "AGT-005",
        "nama" => "Rizky Hidayat",
        "email" => "rizky@email.com",
        "telepon" => "085678901234",
        "alamat" => "Surabaya",
        "tanggal_daftar" => "2024-05-20",
        "status" => "Non-Aktif",
        "total_pinjaman" => 1
    ]
];

$total_anggota = count($anggota_list);
$aktif = 0;
$nonaktif = 0;
$total_pinjaman = 0;
$teraktif = $anggota_list[0];

foreach ($anggota_list as $anggota) {
    if ($anggota['status'] == 'Aktif') {
        $aktif++;
    } else {
        $nonaktif++;
    }

    $total_pinjaman += $anggota['total_pinjaman'];

    if ($anggota['total_pinjaman'] > $teraktif['total_pinjaman']) {
        $teraktif = $anggota;
    }
}

$persen_aktif = ($aktif / $total_anggota) * 100;
$persen_nonaktif = ($nonaktif / $total_anggota) * 100;
$rata_pinjaman = $total_pinjaman / $total_anggota;

$status_filter = isset($_GET['status']) ? $_GET['status'] : 'Semua';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Data Anggota Perpustakaan</h2>

    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="card text-bg-primary"><div class="card-body"><h5>Total Anggota</h5><h3><?= $total_anggota ?></h3></div></div></div>
        <div class="col-md-4"><div class="card text-bg-success"><div class="card-body"><h5>Anggota Aktif</h5><h3><?= number_format($persen_aktif,2) ?>%</h3></div></div></div>
        <div class="col-md-4"><div class="card text-bg-danger"><div class="card-body"><h5>Anggota Non-Aktif</h5><h3><?= number_format($persen_nonaktif,2) ?>%</h3></div></div></div>
        <div class="col-md-6"><div class="card text-bg-warning"><div class="card-body"><h5>Rata-rata Pinjaman</h5><h3><?= number_format($rata_pinjaman,2) ?></h3></div></div></div>
        <div class="col-md-6"><div class="card text-bg-info"><div class="card-body"><h5>Anggota Teraktif</h5><h3><?= $teraktif['nama'] ?> (<?= $teraktif['total_pinjaman'] ?>)</h3></div></div></div>
    </div>

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="status" class="form-select" onchange="this.form.submit()">
                    <option value="Semua">Semua Status</option>
                    <option value="Aktif" <?= $status_filter == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                    <option value="Non-Aktif" <?= $status_filter == 'Non-Aktif' ? 'selected' : '' ?>>Non-Aktif</option>
                </select>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Tanggal Daftar</th>
                <th>Status</th>
                <th>Total Pinjaman</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anggota_list as $anggota): ?>
                <?php if ($status_filter == 'Semua' || $anggota['status'] == $status_filter): ?>
                <tr>
                    <td><?= $anggota['id'] ?></td>
                    <td><?= $anggota['nama'] ?></td>
                    <td><?= $anggota['email'] ?></td>
                    <td><?= $anggota['telepon'] ?></td>
                    <td><?= $anggota['alamat'] ?></td>
                    <td><?= $anggota['tanggal_daftar'] ?></td>
                    <td><?= $anggota['status'] ?></td>
                    <td><?= $anggota['total_pinjaman'] ?></td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

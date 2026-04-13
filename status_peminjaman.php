<?php
// =========================
// DATA ANGGOTA
// =========================
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2;
$buku_terlambat = 1;
$hari_keterlambatan = 5;

// =========================
// KONFIGURASI
// =========================
$max_pinjaman = 3;
$denda_per_hari = 1000;
$max_denda = 50000;

// =========================
// PROSES PERHITUNGAN DENDA
// =========================
$total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;

if ($total_denda > $max_denda) {
    $total_denda = $max_denda;
}

// =========================
// STATUS PEMINJAMAN (IF-ELSEIF-ELSE)
// =========================
if ($buku_terlambat > 0) {
    $status = "Tidak bisa meminjam (Masih ada buku terlambat)";
    $status_class = "danger";
} elseif ($total_pinjaman >= $max_pinjaman) {
    $status = "Tidak bisa meminjam (Sudah mencapai batas maksimal)";
    $status_class = "warning";
} else {
    $status = "Bisa meminjam buku";
    $status_class = "success";
}

// =========================
// LEVEL MEMBER (SWITCH)
// =========================
switch (true) {
    case ($total_pinjaman >= 0 && $total_pinjaman <= 5):
        $level = "Bronze";
        break;
    case ($total_pinjaman >= 6 && $total_pinjaman <= 15):
        $level = "Silver";
        break;
    default:
        $level = "Gold";
        break;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg rounded-4">
        <div class="card-header bg-primary text-white text-center">
            <h4>Status Peminjaman Perpustakaan</h4>
        </div>

        <div class="card-body">
            <h5 class="mb-3">Informasi Anggota</h5>

            <table class="table table-bordered">
                <tr>
                    <th>Nama Anggota</th>
                    <td><?php echo $nama_anggota; ?></td>
                </tr>
                <tr>
                    <th>Total Pinjaman</th>
                    <td><?php echo $total_pinjaman; ?></td>
                </tr>
                <tr>
                    <th>Buku Terlambat</th>
                    <td><?php echo $buku_terlambat; ?></td>
                </tr>
                <tr>
                    <th>Hari Keterlambatan</th>
                    <td><?php echo $hari_keterlambatan; ?> hari</td>
                </tr>
                <tr>
                    <th>Level Member</th>
                    <td><strong><?php echo $level; ?></strong></td>
                </tr>
            </table>

            <h5 class="mt-4">Status Peminjaman</h5>
            <div class="alert alert-<?php echo $status_class; ?>">
                <?php echo $status; ?>
            </div>

            <?php if ($buku_terlambat > 0): ?>
                <div class="alert alert-danger">
                    <strong>Peringatan!</strong><br>
                    Anda memiliki keterlambatan pengembalian buku.<br>
                    Total denda: <strong>Rp <?php echo number_format($total_denda, 0, ',', '.'); ?></strong>
                </div>
            <?php endif; ?>
        </div>

        <div class="card-footer text-center">
            <small>Sistem Perpustakaan - PHP Dasar</small>
        </div>
    </div>
</div>

</body>
</html>

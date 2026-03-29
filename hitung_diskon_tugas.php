<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Diskon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Sistem Perhitungan Diskon Bertingkat</h2>

    <?php
    // data pembeli
    $nama_pembeli = "Rahmawati";
    $judul_buku = "Belajar HTML dan CSS";
    $harga_satuan = 150000;
    $jumlah_beli = 4;
    $is_member = true;

    // hitung subtotal
    $subtotal = $harga_satuan * $jumlah_beli;

    // tentukan diskon berdasarkan jumlah
    if ($jumlah_beli >= 1 && $jumlah_beli <= 2) {
        $persentase_diskon = 0;
    } elseif ($jumlah_beli <= 5) {
        $persentase_diskon = 10;
    } elseif ($jumlah_beli <= 10) {
        $persentase_diskon = 15;
    } else {
        $persentase_diskon = 20;
    }

    // hitung diskon utama
    $diskon = $subtotal * ($persentase_diskon / 100);

    // setelah diskon pertama
    $total_setelah_diskon1 = $subtotal - $diskon;

    // diskon member
    $diskon_member = 0;
    if ($is_member) {
        $diskon_member = $total_setelah_diskon1 * 0.05;
    }

    // total setelah semua diskon
    $total_setelah_diskon = $total_setelah_diskon1 - $diskon_member;

    // ppn 11%
    $ppn = $total_setelah_diskon * 0.11;

    // total akhir
    $total_akhir = $total_setelah_diskon + $ppn;

    // total hemat
    $total_hemat = $diskon + $diskon_member;
    ?>

    <div class="card shadow">
        <div class="card-header bg-dark">
            Detail Pembelian
        </div>
        <div class="card-body">

            <p><b>Nama:</b> <?= $nama_pembeli ?></p>
            <p><b>Buku:</b> <?= $judul_buku ?></p>
            <p><b>Harga:</b> Rp <?= number_format($harga_satuan,0,',','.') ?></p>
            <p><b>Jumlah:</b> <?= $jumlah_beli ?> buku</p>

            <span class="badge bg-<?= $is_member ? 'success' : 'secondary' ?>">
                <?= $is_member ? 'Member' : 'Non Member' ?>
            </span>

            <hr>

            <table class="table">
                <tr>
                    <td>Subtotal</td>
                    <td>Rp <?= number_format($subtotal,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>Diskon (<?= $persentase_diskon ?>%)</td>
                    <td>- Rp <?= number_format($diskon,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>Diskon Member</td>
                    <td>- Rp <?= number_format($diskon_member,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>Total Setelah Diskon</td>
                    <td>Rp <?= number_format($total_setelah_diskon,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>PPN (11%)</td>
                    <td>Rp <?= number_format($ppn,0,',','.') ?></td>
                </tr>
                <tr class="table-success">
                    <th>Total Akhir</th>
                    <th>Rp <?= number_format($total_akhir,0,',','.') ?></th>
                </tr>
                <tr>
                    <td>Total Hemat</td>
                    <td>Rp <?= number_format($total_hemat,0,',','.') ?></td>
                </tr>
            </table>

        </div>
    </div>

</div>

</body>
</html>
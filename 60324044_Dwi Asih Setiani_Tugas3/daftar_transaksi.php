<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Daftar Transaksi Peminjaman</h1>
        
        <?php
        // =========================
        // STATISTIK
        // =========================
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;
        
        // Loop pertama untuk hitung statistik
        for ($i = 1; $i <= 10; $i++) {

            // Skip genap
            if ($i % 2 == 0) {
                continue;
            }

            // Stop di 8
            if ($i == 8) {
                break;
            }

            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

            $total_transaksi++;

            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>

        <!-- Statistik -->
        <div class="row mb-4 text-center">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5>Total Transaksi</h5>
                        <h3><?= $total_transaksi ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5>Masih Dipinjam</h5>
                        <h3><?= $total_dipinjam ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5>Sudah Dikembalikan</h5>
                        <h3><?= $total_dikembalikan ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>ID Transaksi</th>
                    <th>Peminjam</th>
                    <th>Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;

                // Loop untuk tampilkan data
                for ($i = 1; $i <= 10; $i++) {

                    // Skip genap
                    if ($i % 2 == 0) {
                        continue;
                    }

                    // Stop di 8
                    if ($i == 8) {
                        break;
                    }

                    // Generate data
                    $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                    $nama_peminjam = "Anggota " . $i;
                    $judul_buku = "Buku Teknologi Vol. " . $i;
                    $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                    $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                    $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                    // Hitung hari
                    $hari = (strtotime(date('Y-m-d')) - strtotime($tanggal_pinjam)) / (60 * 60 * 24);
                ?>

                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $id_transaksi ?></td>
                    <td><?= $nama_peminjam ?></td>
                    <td><?= $judul_buku ?></td>
                    <td><?= $tanggal_pinjam ?></td>
                    <td><?= $tanggal_kembali ?></td>
                    <td class="text-center"><?= $hari ?> hari</td>
                    <td class="text-center">
                        <?php if ($status == "Dipinjam") { ?>
                            <span class="badge bg-warning text-dark">Dipinjam</span>
                        <?php } else { ?>
                            <span class="badge bg-success">Dikembalikan</span>
                        <?php } ?>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
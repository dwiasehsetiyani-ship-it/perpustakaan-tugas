// modules/anggota/index.php
<?php
include '../../koneksi.php';

$limit = 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';
$jk = $_GET['jk'] ?? '';

$where = "WHERE 1=1";

if($search != ''){
    $where .= " AND (
        nama LIKE '%$search%' OR
        email LIKE '%$search%' OR
        telepon LIKE '%$search%'
    )";
}

if($status != ''){
    $where .= " AND status='$status'";
}

if($jk != ''){
    $where .= " AND jenis_kelamin='$jk'";
}

$total = $conn->query("SELECT COUNT(*) as total FROM anggota $where")->fetch_assoc()['total'];
$total_page = ceil($total / $limit);

$query = $conn->query("
SELECT * FROM anggota
$where
ORDER BY id_anggota DESC
LIMIT $start, $limit
");

$total_anggota = $conn->query("SELECT COUNT(*) as t FROM anggota")->fetch_assoc()['t'];
$total_aktif = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE status='Aktif'")->fetch_assoc()['t'];
$total_nonaktif = $conn->query("SELECT COUNT(*) as t FROM anggota WHERE status='Nonaktif'")->fetch_assoc()['t'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Data Anggota</h2>

    <div class="row mb-3">
        <div class="col-md-4">
            <div class="alert alert-primary">
                Total Anggota : <?= $total_anggota; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="alert alert-success">
                Aktif : <?= $total_aktif; ?>
            </div>
        </div>

        <div class="col-md-4">
            <div class="alert alert-danger">
                Nonaktif : <?= $total_nonaktif; ?>
            </div>
        </div>
    </div>

    <a href="create.php" class="btn btn-primary mb-3">
        Tambah Anggota
    </a>

    <a href="export.php" class="btn btn-success mb-3">
        Export Excel
    </a>

    <form method="GET" class="row mb-3">

        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
            placeholder="Cari nama/email/telepon"
            value="<?= $search; ?>">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">Semua Status</option>

                <option value="Aktif"
                <?= $status == 'Aktif' ? 'selected' : ''; ?>>
                Aktif
                </option>

                <option value="Nonaktif"
                <?= $status == 'Nonaktif' ? 'selected' : ''; ?>>
                Nonaktif
                </option>
            </select>
        </div>

        <div class="col-md-3">
            <select name="jk" class="form-control">
                <option value="">Semua Gender</option>

                <option value="Laki-laki"
                <?= $jk == 'Laki-laki' ? 'selected' : ''; ?>>
                Laki-laki
                </option>

                <option value="Perempuan"
                <?= $jk == 'Perempuan' ? 'selected' : ''; ?>>
                Perempuan
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">
                Cari
            </button>
        </div>

    </form>

    <table class="table table-bordered table-striped">

        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th>JK</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = $start + 1;
        while($row = $query->fetch_assoc()):
        ?>

        <tr>

            <td><?= $no++; ?></td>

            <td>
                <?php if($row['foto'] != ''): ?>

                    <img src="uploads/<?= $row['foto']; ?>"
                    width="70">

                <?php else: ?>

                    Tidak ada

                <?php endif; ?>
            </td>

            <td><?= $row['kode_anggota']; ?></td>
            <td><?= $row['nama']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['telepon']; ?></td>

            <td>
                <span class="badge bg-primary">
                    <?= $row['jenis_kelamin']; ?>
                </span>
            </td>

            <td>

                <?php if($row['status'] == 'Aktif'): ?>

                    <span class="badge bg-success">
                        Aktif
                    </span>

                <?php else: ?>

                    <span class="badge bg-danger">
                        Nonaktif
                    </span>

                <?php endif; ?>

            </td>

            <td>

                <a href="edit.php?id=<?= $row['id_anggota']; ?>"
                class="btn btn-warning btn-sm">
                Edit
                </a>

                <a href="delete.php?id=<?= $row['id_anggota']; ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin hapus data?')">
                Hapus
                </a>

            </td>

        </tr>

        <?php endwhile; ?>

    </table>

    <?php for($i=1; $i <= $total_page; $i++): ?>

        <a href="?page=<?= $i; ?>"
        class="btn btn-sm btn-secondary">
        <?= $i; ?>
        </a>

    <?php endfor; ?>

</div>

</body>
</html>
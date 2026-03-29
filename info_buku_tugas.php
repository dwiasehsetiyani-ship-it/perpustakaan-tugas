<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Informasi Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="mb-4">📚 Informasi Buku</h1>

    <?php
    // Buku 1
    $judul1 = "Pemrograman PHP Modern";
    $kategori1 = "Programming";
    $bahasa1 = "Indonesia";
    $halaman1 = 450;
    $berat1 = 600;

    // Buku 2
    $judul2 = "MySQL Database Administration";
    $kategori2 = "Database";
    $bahasa2 = "Inggris";
    $halaman2 = 350;
    $berat2 = 500;

    // Buku 3
    $judul3 = "Belajar HTML & CSS";
    $kategori3 = "Web";
    $bahasa3 = "Indonesia";
    $halaman3 = 250;
    $berat3 = 300;

    // fungsi warna badge
    function warnaBadge($kategori) {
        if ($kategori == "Programming") return "primary";
        else if ($kategori == "Database") return "success";
        else if ($kategori == "Web") return "warning";
        else return "secondary";
    }
    ?>

    <div class="row">

        <!-- Buku 1 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5><?= $judul1 ?></h5>
                    <span class="badge bg-<?= warnaBadge($kategori1) ?>">
                        <?= $kategori1 ?>
                    </span>
                    <p class="mt-2"><b>Bahasa:</b> <?= $bahasa1 ?></p>
                    <p><b>Jumlah Halaman:</b> <?= $halaman1 ?></p>
                    <p><b>Berat:</b> <?= $berat1 ?> gram</p>
                </div>
            </div>
        </div>

        <!-- Buku 2 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5><?= $judul2 ?></h5>
                    <span class="badge bg-<?= warnaBadge($kategori2) ?>">
                        <?= $kategori2 ?>
                    </span>
                    <p class="mt-2"><b>Bahasa:</b> <?= $bahasa2 ?></p>
                    <p><b>Jumlah Halaman:</b> <?= $halaman2 ?></p>
                    <p><b>Berat:</b> <?= $berat2 ?> gram</p>
                </div>
            </div>
        </div>

        <!-- Buku 3 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5><?= $judul3 ?></h5>
                    <span class="badge bg-<?= warnaBadge($kategori3) ?>">
                        <?= $kategori3 ?>
                    </span>
                    <p class="mt-2"><b>Bahasa:</b> <?= $bahasa3 ?></p>
                    <p><b>Jumlah Halaman:</b> <?= $halaman3 ?></p>
                    <p><b>Berat:</b> <?= $berat3 ?> gram</p>
                </div>
            </div>
        </div>

    </div>
</div>

</body>
</html>
<?php
include '../../koneksi.php';

if(isset($_POST['submit'])){

    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $pekerjaan = $_POST['pekerjaan'];

    $status = "Aktif";
    $tanggal_daftar = date('Y-m-d');

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        die("Email tidak valid");
    }

    if(!preg_match('/^08[0-9]{8,11}$/', $telepon)){
        die("Format telepon salah");
    }

    $umur = date('Y') - date('Y', strtotime($tanggal_lahir));

    if($umur < 10){
        die("Umur minimal 10 tahun");
    }

    $cek = $conn->query("
    SELECT * FROM anggota
    WHERE email='$email'
    OR kode_anggota='$kode'
    ");

    if($cek->num_rows > 0){
        die("Email atau kode anggota sudah digunakan");
    }

    $foto = '';

    if($_FILES['foto']['name'] != ''){

        $foto = time().'_'.$_FILES['foto']['name'];

        $tmp = $_FILES['foto']['tmp_name'];

        move_uploaded_file($tmp, "uploads/".$foto);
    }

    $conn->query("
    INSERT INTO anggota
    (
        kode_anggota,
        nama,
        email,
        telepon,
        alamat,
        tanggal_lahir,
        jenis_kelamin,
        pekerjaan,
        tanggal_daftar,
        status,
        foto
    )
    VALUES
    (
        '$kode',
        '$nama',
        '$email',
        '$telepon',
        '$alamat',
        '$tanggal_lahir',
        '$jk',
        '$pekerjaan',
        '$tanggal_daftar',
        '$status',
        '$foto'
    )
    ");

    header("Location:index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Anggota</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Tambah Anggota</h4>
        </div>

        <div class="card-body">

            <form method="POST" enctype="multipart/form-data">

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Kode Anggota</label>

                        <input type="text"
                        name="kode"
                        class="form-control"
                        required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Nama</label>

                        <input type="text"
                        name="nama"
                        class="form-control"
                        required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Email</label>

                        <input type="email"
                        name="email"
                        class="form-control"
                        required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Telepon</label>

                        <input type="text"
                        name="telepon"
                        class="form-control"
                        required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Tanggal Lahir</label>

                        <input type="date"
                        name="tanggal_lahir"
                        class="form-control"
                        required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Jenis Kelamin</label>

                        <select name="jk" class="form-select">

                            <option value="Laki-laki">
                                Laki-laki
                            </option>

                            <option value="Perempuan">
                                Perempuan
                            </option>

                        </select>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Alamat</label>

                        <textarea name="alamat"
                        class="form-control"
                        rows="3"
                        required></textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Pekerjaan</label>

                        <input type="text"
                        name="pekerjaan"
                        class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Foto</label>

                        <input type="file"
                        name="foto"
                        class="form-control">
                    </div>

                </div>

                <button type="submit"
                name="submit"
                class="btn btn-primary">

                    Simpan

                </button>

                <a href="index.php"
                class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>
<?php
$errors = [];
$data = [
 'nama'=>'','email'=>'','telepon'=>'','alamat'=>'','jk'=>'','tgl_lahir'=>'','pekerjaan'=>''
];
$success = false;

function e($v){ return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

if($_SERVER['REQUEST_METHOD']==='POST'){
    foreach($data as $k=>$v){ $data[$k] = trim($_POST[$k] ?? ''); }

    if($data['nama']==='' || strlen($data['nama']) < 3) $errors['nama']='Nama minimal 3 karakter.';
    if($data['email']==='' || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) $errors['email']='Email tidak valid.';
    if($data['telepon']==='' || !preg_match('/^08[0-9]{8,11}$/',$data['telepon'])) $errors['telepon']='Telepon harus format 08xxxxxxxxxx (10-13 digit).';
    if($data['alamat']==='' || strlen($data['alamat']) < 10) $errors['alamat']='Alamat minimal 10 karakter.';
    if($data['jk']==='') $errors['jk']='Pilih jenis kelamin.';
    if($data['tgl_lahir']===''){
        $errors['tgl_lahir']='Tanggal lahir wajib diisi.';
    } else {
        $birth = new DateTime($data['tgl_lahir']);
        $today = new DateTime();
        $age = $today->diff($birth)->y;
        if($age < 10) $errors['tgl_lahir']='Umur minimal 10 tahun.';
    }
    $allowed = ['Pelajar','Mahasiswa','Pegawai','Lainnya'];
    if(!in_array($data['pekerjaan'],$allowed)) $errors['pekerjaan']='Pilih pekerjaan.';

    if(empty($errors)) $success = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Form Registrasi Anggota</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card shadow">
<div class="card-header bg-primary text-white"><h3 class="mb-0">Registrasi Anggota Perpustakaan</h3></div>
<div class="card-body">
<?php if($success): ?>
<div class="alert alert-success">Registrasi berhasil!</div>
<div class="card border-success mb-4">
<div class="card-body">
<h5 class="card-title">Data Anggota</h5>
<p><strong>Nama:</strong> <?= e($data['nama']) ?></p>
<p><strong>Email:</strong> <?= e($data['email']) ?></p>
<p><strong>Telepon:</strong> <?= e($data['telepon']) ?></p>
<p><strong>Alamat:</strong> <?= nl2br(e($data['alamat'])) ?></p>
<p><strong>Jenis Kelamin:</strong> <?= e($data['jk']) ?></p>
<p><strong>Tanggal Lahir:</strong> <?= e($data['tgl_lahir']) ?></p>
<p><strong>Pekerjaan:</strong> <?= e($data['pekerjaan']) ?></p>
</div></div>
<?php endif; ?>
<form method="post" novalidate>
<div class="mb-3">
<label class="form-label">Nama Lengkap</label>
<input type="text" name="nama" class="form-control <?= isset($errors['nama'])?'is-invalid':'' ?>" value="<?= e($data['nama']) ?>">
<div class="invalid-feedback"><?= $errors['nama'] ?? '' ?></div>
</div>
<div class="mb-3">
<label class="form-label">Email</label>
<input type="email" name="email" class="form-control <?= isset($errors['email'])?'is-invalid':'' ?>" value="<?= e($data['email']) ?>">
<div class="invalid-feedback"><?= $errors['email'] ?? '' ?></div>
</div>
<div class="mb-3">
<label class="form-label">Telepon</label>
<input type="text" name="telepon" class="form-control <?= isset($errors['telepon'])?'is-invalid':'' ?>" value="<?= e($data['telepon']) ?>">
<div class="invalid-feedback"><?= $errors['telepon'] ?? '' ?></div>
</div>
<div class="mb-3">
<label class="form-label">Alamat</label>
<textarea name="alamat" class="form-control <?= isset($errors['alamat'])?'is-invalid':'' ?>" rows="3"><?= e($data['alamat']) ?></textarea>
<div class="invalid-feedback"><?= $errors['alamat'] ?? '' ?></div>
</div>
<div class="mb-3">
<label class="form-label d-block">Jenis Kelamin</label>
<div class="form-check form-check-inline">
<input class="form-check-input <?= isset($errors['jk'])?'is-invalid':'' ?>" type="radio" name="jk" value="Laki-laki" <?= $data['jk']==='Laki-laki'?'checked':'' ?>>
<label class="form-check-label">Laki-laki</label></div>
<div class="form-check form-check-inline">
<input class="form-check-input <?= isset($errors['jk'])?'is-invalid':'' ?>" type="radio" name="jk" value="Perempuan" <?= $data['jk']==='Perempuan'?'checked':'' ?>>
<label class="form-check-label">Perempuan</label></div>
<div class="invalid-feedback d-block"><?= $errors['jk'] ?? '' ?></div>
</div>
<div class="mb-3">
<label class="form-label">Tanggal Lahir</label>
<input type="date" name="tgl_lahir" class="form-control <?= isset($errors['tgl_lahir'])?'is-invalid':'' ?>" value="<?= e($data['tgl_lahir']) ?>">
<div class="invalid-feedback"><?= $errors['tgl_lahir'] ?? '' ?></div>
</div>
<div class="mb-4">
    <label class="form-label">Pekerjaan</label>
    <select name="pekerjaan" class="form-select <?= isset($errors['pekerjaan'])?'is-invalid':'' ?>">
        <option value="">-- Pilih Pekerjaan --</option>
        <option value="Pelajar" <?= $data['pekerjaan']=='Pelajar'?'selected':'' ?>>Pelajar</option>
        <option value="Mahasiswa" <?= $data['pekerjaan']=='Mahasiswa'?'selected':'' ?>>Mahasiswa</option>
        <option value="Pegawai" <?= $data['pekerjaan']=='Pegawai'?'selected':'' ?>>Pegawai</option>
        <option value="Lainnya" <?= $data['pekerjaan']=='Lainnya'?'selected':'' ?>>Lainnya</option>
    </select>
    <div class="invalid-feedback"><?= $errors['pekerjaan'] ?? '' ?></div>
</div>
<button type="submit" class="btn btn-primary">Daftar</button>
<button type="reset" class="btn btn-secondary">Reset</button>
</form>
</div></div></div></div></div>
</body></html>

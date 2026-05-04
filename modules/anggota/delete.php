<?php
include '../../koneksi.php';

if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = $_GET['id'];

$data = $conn->query("
SELECT * FROM anggota
WHERE id_anggota='$id'
")->fetch_assoc();

if(!$data){
    die("Data tidak ditemukan");
}

if($data['foto'] != ''){

    $path = "uploads/".$data['foto'];

    if(file_exists($path)){
        unlink($path);
    }
}

$conn->query("
DELETE FROM anggota
WHERE id_anggota='$id'
");

header("Location:index.php");
exit;
?>
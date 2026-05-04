<?php
$conn = new mysqli("localhost", "root", "", "perpustakaan2");

if($conn->connect_error){
    die("Koneksi gagal : " . $conn->connect_error);
}
?>
<?php
require "koneksi.php";
session_start();

$sesi = session_id();
$produk_id = $_POST['produk_id'];

$q = mysqli_query($conn, "SELECT * FROM cart WHERE sesi_id='$sesi' AND produk_id='$produk_id'");
$cek = mysqli_fetch_array($q);

if ($cek) {
    mysqli_query($conn, "UPDATE cart SET qty = qty + 1 
                         WHERE sesi_id='$sesi' AND produk_id='$produk_id'");
} else {
    mysqli_query($conn, "INSERT INTO cart (sesi_id, produk_id, qty) 
                         VALUES ('$sesi', '$produk_id', 1)");
}

header("Location: cart.php");

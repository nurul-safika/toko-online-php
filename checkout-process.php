<?php
require "koneksi.php";
session_start();

$nama = $_POST['nama'];
$email = $_POST['email'];
$nohp = $_POST['nohp'];
$total = $_POST['total'];
$sesi = session_id();

$order_code = "INV".time();

// simpan ke orders
mysqli_query($conn, 
"INSERT INTO orders (order_code, customer_name, customer_email, customer_phone, total)
 VALUES ('$order_code', '$nama', '$email', '$nohp', '$total')");

$order_id = mysqli_insert_id($conn);

// simpan detail produk
$q = mysqli_query($conn, "SELECT * FROM cart WHERE sesi_id='$sesi'");
while ($c = mysqli_fetch_array($q)) {
    mysqli_query($conn, 
    "INSERT INTO order_items (order_id, produk_id, qty, harga)
     VALUES ('$order_id', '$c[produk_id]', '$c[qty]', '$c[qty]')");
}

// kosongkan keranjang
mysqli_query($conn, "DELETE FROM cart WHERE sesi_id='$sesi'");

header("Location: pembayaran.php?order=$order_code");

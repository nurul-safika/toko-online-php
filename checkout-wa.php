<?php
require "koneksi.php";

mysqli_set_charset($conn, "utf8mb4");

$produk_id = (int) $_POST['produk'];
$qty = (int) $_POST['qty'];


$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$produk_id'");
$produk = mysqli_fetch_assoc($query);


$nama = $produk['nama'];
$harga = $produk['harga'];
$total = $harga * $qty;



$pesan = "Halo kak \n\n";
$pesan .= "Saya mau melakukan pemesanan:\n\n";
$pesan .= "Produk  : $nama\n";
$pesan .= "Jumlah  : $qty pcs\n";
$pesan .= "Harga   : Rp " . number_format($harga,0,',','.') . "\n";
$pesan .= "Total   : Rp " . number_format($total,0,',','.') . "\n\n";
$pesan .= "Mohon konfirmasi ketersediaan dan langkah selanjutnya ya kak\n";
$pesan .= "Terima kasih ";

$no_wa = "6282292359550";

header("Location: https://wa.me/$no_wa?text=" . urlencode($pesan));
exit;




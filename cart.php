<?php
require "koneksi.php";
session_start();

$sesi = session_id();
$q = mysqli_query($conn, 
    "SELECT cart.*, produk.nama, produk.harga, produk.foto
     FROM cart JOIN produk ON cart.produk_id = produk.id
     WHERE sesi_id='$sesi'");

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php require "navbar.php"; ?>

    <div class="container py-5">
        <h3>Keranjang Belanja</h3>

        <table class="table mt-4">
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
                <th></th>
            </tr>

            <?php while($r = mysqli_fetch_array($q)) { 
                $sub = $r['qty'] * $r['harga'];
                $total += $sub;
            ?>
            <tr>
                <td><?php echo $r['nama']; ?></td>  
                <td><?php echo $r['qty']; ?></td>
                <td>Rp <?php echo $r['harga']; ?></td>
                <td>Rp <?php echo $sub; ?></td>
                <td>
                    <a href="cart-remove.php?id=<?php echo $r['id']; ?>" class="btn btn-danger btn-sm">
                        Hapus
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <h4>Total: Rp <?php echo $total; ?></h4>

        <a href="checkout.php" class="btn btn-success mt-3">Lanjutkan Checkout</a>
    </div>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>

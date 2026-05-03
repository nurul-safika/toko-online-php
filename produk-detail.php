<?php
require "koneksi.php";

$id = (int) $_GET['id'];

$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$produk = mysqli_fetch_array($queryProduk);

$queryProdukTerkait = mysqli_query($conn, 
    "SELECT * FROM produk 
     WHERE kategori_id='{$produk['kategori_id']}' 
     AND id!='{$produk['id']}'
     LIMIT 4"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Detail Produk</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "navbar.php"; ?>

<!-- detail produk -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-5 mb-5">
                <img src="image/<?php echo $produk['foto']; ?>" class="w-100" alt="">
            </div>

            <div class="col-lg-6 offset-lg-1">
                <h1><?php echo $produk['nama']; ?></h1>

                <p class="fs-5"><?php echo $produk['detail']; ?></p>

                <p class="text-harga">Rp <?php echo $produk['harga']; ?></p>

                <p class="fs-5">
                    Status Ketersediaan :
                    <strong><?php echo $produk['ketersediaan_stok']; ?></strong>
                </p>

                <!-- Tombol Tambah ke Keranjang -->
                <form action="cart-add.php" method="POST">
                    <input type="hidden" name="produk_id" value="<?php echo $produk['id']; ?>">
                    <button type="submit" class="btn warna2 text-white mb-3">Tambah ke Keranjang</button>
                </form>

                <!-- Tombol Beli Sekarang -->
                <a href="checkout.php?produk_id=<?php echo $produk['id']; ?>" 
                    class="btn btn-warning text-dark mb-3">
                    Beli Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<!-- produk terkait -->
<div class="container-fluid py-5 warna2">
    <div class="container">
        <h2 class="text-center text-white mb-5">Produk Terkait</h2>

        <div class="row">

            <?php while ($data = mysqli_fetch_array($queryProdukTerkait)) { ?>
            <div class="col-md-6 col-lg-3 mb-3">
                <a href="produk-detail.php?id=<?php echo $produk['id']; ?>">
                    <div class="image-box">
                        <img src="image/<?php echo $data['foto']; ?>" 
                             class="img-fluid img-thumbnail produk-terkait-image" alt="">
                    </div>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>
</div>

<?php require "footer.php"; ?>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="fontawesome/js/all.min.js"></script>
</body>
</html>

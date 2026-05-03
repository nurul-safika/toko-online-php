<?php
require "koneksi.php";

if (!isset($_GET['produk_id'])) {
    echo "Produk tidak ditemukan";
    exit;
}

$id = (int) $_GET['produk_id'];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$produk = mysqli_fetch_assoc($query);

if (!$produk) {
    echo "Produk tidak ditemukan";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php require "navbar.php"; ?>

<div class="container py-5">
    <h2 class="mb-4">Checkout</h2>

    <div class="row">
        <div class="col-md-5">
            <img src="image/<?php echo $produk['foto']; ?>" class="img-fluid mb-3">
            <h4><?php echo $produk['nama']; ?></h4>
            <p>Rp <?php echo number_format($produk['harga']); ?></p>
        </div>

        <div class="col-md-7">
            <form action="checkout-wa.php" method="POST">

                <input type="hidden" name="produk" value="<?php echo $produk['id']; ?>">
                <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>">

                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>No WhatsApp</label>
                    <input type="text" name="hp" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" required></textarea>
                </div>

                <label>Jumlah</label>
                    <input type="number" name="qty" value="1" min="1" class="form-control mb-3">

                <button type="submit" class="btn btn-success w-100">
                    Pesan via WhatsApp
                </button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
